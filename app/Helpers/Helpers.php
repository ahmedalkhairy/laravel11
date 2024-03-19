<?php

namespace App\Helpers;

use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Helpers
{
    public static function getImage(string $imgUrl): array
    {
        $image_hash = 'images/' . uniqid() . '.jpg';
        Storage::put($image_hash, file_get_contents($imgUrl));
        return [$image_hash, Storage::get($image_hash)];
    }

    public static function prepareImage($hash, $image, $returnPil)
    {
        $t = new DateTime();
        $filename = "/serve_images/" .
            "{$t->format('Y')}-{$t->format('m')}-{$t->format('d')}" . "{$hash}.png";

        $imageResource = imagecreatefromstring($image);

        // Get the dimensions of the image
        $width = imagesx($imageResource);
        $height = imagesy($imageResource);

        // Calculate the aspect ratio and new dimensions
        $maxWidth = 800;
        $maxHeight = 400;
        $aspectRatio = $width / $height;


        if ($aspectRatio > 1) {
            $newWidth = min($maxWidth, $width);
            $newHeight = $newWidth / $aspectRatio;
        } else {
            $newHeight = min($maxHeight, $height);
            $newWidth = $newHeight * $aspectRatio;
        }

        // Create a new image with the resized dimensions
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($resizedImage, $imageResource, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);


        if ($returnPil) {
            // Return the resized image as a GD image resource
            return $resizedImage;
        } else {

            // Convert the GD image resource to a base64-encoded PNG
            ob_start();
            imagepng($resizedImage);

            $imageContent = ob_get_clean();
            // Write the image content to a file
            $storagePath = storage_path('app/serve_images'); // Replace with your actual storage path
            // Check if the directory doesn't exist, then create it
            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0777, true); // Recursive mode
            }
            $filename =  uniqid() . '.png'; // Replace with your desired filename
            $filePath = $storagePath . '/' . $filename;
            file_put_contents($filePath, $imageContent);
        }

        return $filePath;

    }

    public function decode_image($imagePath)
    {

        $buffered = fopen($imagePath, 'r');
        $imgBinary = fread($buffered, filesize($imagePath));
        $imgB64Str = base64_encode($imgBinary);

        fclose($buffered);
        return $imgB64Str;
    }


    public function clean_string($string)
    {


        $needle = '[/INST]Here is the JSON format for all attributes:';


        $lastPos = strrpos($string, $needle);

        if ($lastPos === false) {
            $needle = '[/INST]Here is the JSON format for the provided attributes:';
            $lastPos = strrpos($string, $needle);
        }


        if ($lastPos !== false) {
            $extractedText = substr($string, $lastPos + strlen($needle));
// Remove control characters
            $cleanedText = preg_replace('/[\x00-\x1F\x7F]/', '', $extractedText);
            // Remove all occurrences of \n
            $fixedString = str_replace(' \n\n', '","', $cleanedText);
            $fixedString = str_replace('\n', '', $fixedString);
            $fixedString = str_replace('\"', '"', $fixedString);
            $fixedString = str_replace('""', '","', $fixedString);
            $fixedString = str_replace(' ", "error_code": 0}', '', $fixedString);
        } else {
            $fixedString = '{}';
        }
        return $fixedString;
    }


}
