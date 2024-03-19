<?php
declare(strict_types=1);

namespace App\Services;

class PromptService
{

    public function propertiesKeys(): array
    {
        return [
            'Item Type Keyword' => 'item_name',
            'Product Description' => 'product_description',
            'Bullet Point' => 'bullet_point',
            'Generic Keywords' => 'generic_keyword',
            'Special Features' => 'special_feature',
            'Lifestyle' => 'lifestyle',
            'Subject Character' => 'subject_character',
            'Fit Type' => 'fit_type',
            'Embellishment Feature' => 'embellishment_feature',
            'Style' => 'style',
            'Material' => 'material',
            'Fabric Type' => 'fabric_type',
            'Item Type Name' => 'item_type_name',
            'Color' => 'color',
            'Care Instructions' => 'care_instructions',
            'Target Gender' => 'target_gender',
            'Department Name' => 'department',
            'Occasion Type' => 'occasion_type',
            'Theme' => 'theme',
            'Pattern' => 'pattern',
            'Neck Style' => 'neck',
            'Sleeve Type' => 'sleeve',
            'Closure Type' => 'closure',
            'Sweater Form' => 'sweater_form',
            'Hemline Form' => 'hemline_form',
            'Included Components' => 'included_components',
            'Lining Description' => 'lining_description',
            'Strap Type' => 'strap_type',
            'Occasion' => 'occasion_type',
            'Back Style' => 'back_style',
            'Waist Style' => 'waist_style',
            'Seasons' => 'seasons',
            'Apparel Silhouette' => 'apparel_silhouette',
            'Color Map' => 'color_map',
            'Front Style' => 'front_style',
            'Leg Style' => 'leg',
            'Pocket Description' => 'pocket_description',
            'Fabric Wash' => 'fabric_wash',
            'Sport Type' => 'sport_type',
            'Apparel Closure Orientation' => 'apparel_closure_orientation',
            'Fabric Stretchability' => 'fabric_stretchability',
            'Pants Form Type' => 'pants_form_type',
            'Age Range Description' => 'age_range_description',
            'Water Resistance Level' => 'water_resistance_level',
        ];
    }

}
