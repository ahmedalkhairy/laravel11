<?php

namespace App\Helpers;
class Conversation
{
    public $system;
    public $roles;
    public $messages;
    public $offset;
    public $sep_style;
    public $sep;
    public $sep2;
    public $version;

    public $skip_next = false;

    public function __construct($system, $roles, $messages, $offset, $sep_style = SeparatorStyle::SINGLE, $sep = "###", $sep2 = null, $version = "Unknown")
    {
        $this->system = $system;
        $this->roles = $roles;
        $this->messages = $messages;
        $this->offset = $offset;
        $this->sep_style = $sep_style;
        $this->sep = $sep;
        $this->sep2 = $sep2;
        $this->version = $version;
    }

    public function get_prompt()
    {
        $messages = $this->messages;
        if (count($messages) > 0 && is_array($messages[0][1]) && count($messages[0][1]) == 3) {
            $messages = $this->messages;
            $init_role = $messages[0][0];
            $init_msg = $messages[0][1][0];
            $init_msg = str_replace("<image>", "", $init_msg);
            if (strpos($this->version, 'mmtag') !== false) {
                $messages[0] = [$init_role, $init_msg];
                array_unshift($messages, [$this->roles[0], "<Image><image></Image>"]);
                array_splice($messages, 1, 0, [$this->roles[1], "Received."]);
            } else {
                $messages[0] = [$init_role, "<image>\n" . $init_msg];
            }
        }

        if ($this->sep_style == App\Helpers\SeparatorStyle\SeparatorStyle::SINGLE) {
            $ret = $this->system . $this->sep;
            foreach ($messages as list($role, $message)) {
                if ($message) {
                    if (is_array($message)) {
                        list($message, $_, $_) = $message;
                    }
                    $ret .= $role . ": " . $message . $this->sep;
                } else {
                    $ret .= $role . ":";
                }
            }
        } elseif ($this->sep_style == App\Helpers\SeparatorStyle\SeparatorStyle::TWO) {
            $seps = [$this->sep, $this->sep2];
            $ret = $this->system . $seps[0];
            foreach ($messages as $i => list($role, $message)) {
                if ($message) {
                    if (is_array($message)) {
                        list($message, $_, $_) = $message;
                    }
                    $ret .= $role . ": " . $message . $seps[$i % 2];
                } else {
                    $ret .= $role . ":";
                }
            }
        } elseif ($this->sep_style == App\Helpers\SeparatorStyle\SeparatorStyle::MPT) {
            $ret = $this->system . $this->sep;
            foreach ($messages as list($role, $message)) {
                if ($message) {
                    if (is_array($message)) {
                        list($message, $_, $_) = $message;
                    }
                    $ret .= $role . $message . $this->sep;
                } else {
                    $ret .= $role;
                }
            }
        } elseif ($this->sep_style == App\Helpers\SeparatorStyle\SeparatorStyle::LLAMA_2) {
            $wrap_sys = function ($msg) {
                return "<<SYS>>\n{$msg}\n<</SYS>>\n\n";
            };
            $wrap_inst = function ($msg) {
                return "[INST] {$msg} [/INST]";
            };
            $ret = "";

            foreach ($messages as $i => list($role, $message)) {
                if ($i == 0) {
                    assert($message, "first message should not be none");
                    assert($role == $this->roles[0], "first message should come from user");
                }
                if ($message) {
                    if (is_array($message)) {
                        list($message, $_, $_) = $message;
                    }
                    if ($i == 0) {
                        $message = $wrap_sys($this->system) . $message;
                    }
                    if ($i % 2 == 0) {
                        $message = $wrap_inst($message);
                        $ret .= $this->sep . $message;
                    } else {
                        $ret .= " " . $message . " " . $this->sep2;
                    }
                } else {
                    $ret .= "";
                }
            }
            $ret = ltrim($ret, $this->sep);
        } elseif ($this->sep_style == App\Helpers\SeparatorStyle\SeparatorStyle::PLAIN) {
            $seps = [$this->sep, $this->sep2];
            $ret = $this->system;
            foreach ($messages as $i => list($role, $message)) {
                if ($message) {
                    if (is_array($message)) {
                        list($message, $_, $_) = $message;
                    }
                    $ret .= $message . $seps[$i % 2];
                } else {
                    $ret .= "";
                }
            }
        } else {
            throw new Exception("Invalid style: " . $this->sep_style);
        }

        return $ret;
    }

    public function append_message($role, $message)
    {
        $this->messages[] = [$role, $message];
    }

    public function get_images($return_pil = false)
    {
        $images = [];
        foreach (array_slice($this->messages, $this->offset) as $i => list($role, $msg)) {
            if ($i % 2 == 0) {
                if (is_array($msg)) {
                    $msg = $msg[0];
                    $image = $msg[1];
                    $image_process_mode = $msg[2];
                    if ($image_process_mode == "Pad") {
                        $expand2square = function ($pil_img, $background_color = [122, 116, 104]) {
                            list($width, $height) = getimagesizefromstring($pil_img);
                            if ($width == $height) {
                                return $pil_img;
                            } elseif ($width > $height) {
                                $result = imagecreate($width, $width);
                                $background_color = imagecolorallocate($result, $background_color[0], $background_color[1], $background_color[2]);
                                imagefill($result, 0, 0, $background_color);
                                imagecopy($result, $pil_img, 0, ($width - $height) / 2, 0, 0, $width, $height);
                                return $result;
                            } else {
                                $result = imagecreate($height, $height);
                                $background_color = imagecolorallocate($result, $background_color[0], $background_color[1], $background_color[2]);
                                imagefill($result, 0, 0, $background_color);
                                imagecopy($result, $pil_img, ($height - $width) / 2, 0, 0, 0, $width, $height);
                                return $result;
                            }
                        };
                        $image = $expand2square($image);
                    } elseif ($image_process_mode == "Crop") {
                        // Crop logic here
                    } elseif ($image_process_mode == "Resize") {
                        // Resize logic here
                    } else {
                        throw new Exception("Invalid image_process_mode: " . $image_process_mode);
                    }
                    $max_hw = max(imagesx($image), imagesy($image));
                    $min_hw = min(imagesx($image), imagesy($image));
                    $aspect_ratio = $max_hw / $min_hw;
                    $max_len = 800;
                    $min_len = 400;
                    $shortest_edge = min($max_len / $aspect_ratio, $min_len, $min_hw);
                    $longest_edge = $shortest_edge * $aspect_ratio;
                    list($W, $H) = [$longest_edge, $shortest_edge];
                    if (imagesy($image) > imagesx($image)) {
                        list($H, $W) = [$longest_edge, $shortest_edge];
                    } else {
                        list($H, $W) = [$shortest_edge, $longest_edge];
                    }
                    $image = imagescale($image, $W, $H);
                    if ($return_pil) {
                        $images[] = $image;
                    } else {
                        ob_start();
                        imagepng($image);
                        $img_b64_str = base64_encode(ob_get_contents());
                        ob_end_clean();
                        $images[] = $img_b64_str;
                    }
                }
            }
        }
        return $images;
    }

    public function to_gradio_chatbot()
    {
        $ret = [];
        foreach (array_slice($this->messages, $this->offset) as $i => list($role, $msg)) {
            if ($i % 2 == 0) {
                if (is_array($msg)) {
                    $msg = $msg[0];
                    $image = $msg[1];
                    $image_process_mode = $msg[2];
                    list($max_hw, $min_hw) = [max(imagesx($image), imagesy($image)), min(imagesx($image), imagesy($image))];
                    $aspect_ratio = $max_hw / $min_hw;
                    $max_len = 800;
                    $min_len = 400;
                    $shortest_edge = min($max_len / $aspect_ratio, $min_len, $min_hw);
                    $longest_edge = $shortest_edge * $aspect_ratio;
                    list($W, $H) = [$longest_edge, $shortest_edge];
                    if (imagesy($image) > imagesx($image)) {
                        list($H, $W) = [$longest_edge, $shortest_edge];
                    } else {
                        list($H, $W) = [$shortest_edge, $longest_edge];
                    }
                    $image = imagescale($image, $W, $H);
                    ob_start();
                    imagejpeg($image);
                    $img_b64_str = base64_encode(ob_get_contents());
                    ob_end_clean();
                    $img_str = '<img src="data:image/png;base64,' . $img_b64_str . '" alt="user upload image" />';
                    $ret[] = [$img_str, null];
                    $msg = str_replace('<image>', '', $msg);
                    if (strlen($msg) > 0) {
                        $ret[] = [$msg, null];
                    }
                } else {
                    $ret[] = [$msg, null];
                }
            } else {
                $ret[count($ret) - 1][1] = $msg;
            }
        }
        return $ret;
    }

    public function copy()
    {
        return new Conversation(
            $this->system,
            $this->roles,
            array_map(function ($item) {
                return [$item[0], $item[1]];
            }, $this->messages),
            $this->offset,
            $this->sep_style,
            $this->sep,
            $this->sep2,
            $this->version
        );
    }

    public function dict()
    {
        $images = $this->get_images();
        if (count($images) > 0) {
            return [
                "system" => $this->system,
                "roles" => $this->roles,
                "messages" => array_map(function ($item) {
                    return [$item[0], is_array($item[1]) ? $item[1][0] : $item[1]];
                }, $this->messages),
                "offset" => $this->offset,
                "sep" => $this->sep,
                "sep2" => $this->sep2,
            ];
        }
        return [
            "system" => $this->system,
            "roles" => $this->roles,
            "messages" => $this->messages,
            "offset" => $this->offset,
            "sep" => $this->sep,
            "sep2" => $this->sep2,
        ];
    }
}

ConvTemplates::init();

if (isset($argv) && $argv[0] == __FILE__) {
    echo ConvTemplates::$default_conversation->get_prompt();
}
