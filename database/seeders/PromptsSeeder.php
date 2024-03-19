<?php

namespace Database\Seeders;

use App\Models\Prompt;
use Illuminate\Database\Seeder;

class PromptsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'key' => 'outerwear',
                'value' => '{
  "Item Type Keyword": "Outerwear",
  "Product Description": "Provide a text description of the product. This information will appear in paragraph form on the detail page of your product",
  "Bullet Point": "Write a brief descriptive text about the product. This text will appear under or next to the product photo.",
  "Generic Keywords": "What are some other terms that people might use to search for this product?",
  "Lifestyle": "Select the lifestyle that best represents the item and its use (Options: Athletic, Casual, Dress, Exotic, Kids Playwear, Maternity, Nursing, Themed, Uniform, Work Utility)",
  "Style": "Provide the style of the product. Style refers to the aesthetic choices of a person or a group of people. It describes the distinctive visual representation of a product",
  "Department Name": "Selectthe gender/age for which this item is intended (Options: Baby Boys, Baby Girls, Boys, Girls, Mens, Unisex, Unisex Baby, Unisex Kids, Womens)",
  "Target Gender": "Provide the target gender for the product (Options: Female, Male, Unisex)",
  "Age Range Description": "Specify an appropriate age range description for the item (Options: Adult, Big Kid, Infant, Little Kid, Toddler)",
  "Material": "Specify the primary materials used for manufacturing the item (Options: Cashmere, Cashmere Blend, Cotton, Cotton Blend, Faux Fur, Faux Leather, Faux Suede, Fur, Leather, Linen, Linen Blend, Nylon, Nylon Blend, Polycotton, Polyester, Polyester Blend, Polyurethane (PU), Polyvinyl Chloride (PVC), Rayon, Rayon Blend, Recycled Polyester, Silk, Silk Blend, Suede, Wool, Wool Blend)",
  "Fabric Type": "List all fabrics used in the product separated by "," with % composition",
  "Item Type Name": "Select from the list a one to two-word phrase that describes the type of item the product is (Options: Anorak, Baby and Toddler Down Alternative Jacket, Baby and Toddler Down Jacket, Baby and Toddler Snow Bib, Baby and Toddler Track Jacket, Cape, Chefs Jacket, Cotton Lightweight Jacket, Denim Jacket, Denim Vest, Down Alternative Coat, Down Coat, Down Vest, Dress Coat, Faux Fur Coat, Faux Leather Jacket, Fleece Jacket, Fleece Vest, Fur Coat, Fur Vest, Insulated Jacket, Jacket, Leather Jacket, Leather Vest, Medical Lab Coat, Parka, Pea Coat, Poncho, Quilted Jacket, Rain Jacket, Rain Pants, Raincoat, Shell Jacket, Skiing Bib, Snow Pants, Snowsuit, Transitional Jacket, Trenchcoat, Varsity Jacket, Warm Up Jacket, Windbreaker, Wool Blend Coat, Wool Coat, Work Utility Outerwear)",
  "Water Resistance Level": "Select the value that best describes the items resistance to water (Options: Not Water Resistant, Water Repellent, Water Resistant, Waterproof)",
  "Subject Character": "Provide the primary character the item represents",
  "Color Map": "Select the most dominant color of the product (Options: Beige, Black, Blue, Bronze, Brown, Clear, Gold, Green, Grey, Metallic, Multicolor, Off White, Orange, Pink, Purple, Red, Silver, Turquoise, White, Yellow)",
  "Color": "Provide the color of the product",
  "Theme": "Select the theme of the product. Very similar to subject, but with more general use cases (Options: Aliens, Animals, Anime, Cartoon, Cartoon-Characters, City, Comedy, Comics, Country, Fantasy, Flag, Geography, Holidays, Meme, Movies, Occasion, Politics, Religion, Sports, Steampunk, Superhero, Tv Shows, Video Game)",
  "Fit Type": "Select the items fit type (Options: Classic, Compression, Fitted, Loose, Modern, Overall, Regular, Relaxed, Skinny, Slim, Snug, Standard, Straight, Stretch, Tailored, Western)",
  "Care Instructions": "Select instructions related to how to care for the item (Options: Dry Clean Only, Hand Wash Only, Machine Wash)",
  "Closure Type": "Select the type of closing mechanism used by the item. The closing type allows a user to fully wear, seal, or close the item (Options: Belted, Buckle, Button, Button Fly, Double Ring, Drawstring, Drawstring Waist, Hook and Bar, Hook and Eye, Hook and Loop, Pull-On, Snap, Tie, Toggle, Zipper, None)"
}
(Return your result in correct and complete JSON format in the same template for all attributes )'
            ],
            [
                'key' => 'sweatshirt',
                'value' => '{"Item Type Keyword": "Sweatshirt",
  "Product Description": "Provide a text description of the product. This information will appear in the detail page of your product",
  "Bullet Point": "Write a brief descriptive text about the product. This text will appear under or next to the product photo",
  "Generic Keywords": "What are some other terms that people might use to search for this product?",
  "Special Features": "Select special features an item has that distinguish it from other, comparable products (Options: Adjustable, Breathable, Fade Resistant, Hoodie, Lightweight, Pill Resistant, Reversible, Stretchable, Tag Free, Thumb Hole Sleeve, Water Resistant, Waterproof, Wrinkle Free)",
  "Lifestyle": "Select the lifestyle that best represents the item and its use (Options: Athletic, Casual, Dress, Exotic, Kids Playwear, Maternity, Nursing, Themed, Uniform, Work Utility)",
  "Subject Character": "Provide the primary character the item represents",
  "Color Map": "Select the most dominant color of the product. (Options: Beige, Black, Blue, Bronze, Brown, Clear, Gold, Green, Grey, Metallic, Multicolor, Off White, Orange, Pink, Purple, Red, Silver, Turquoise, White, Yellow)",
  "Fit Type": "Specify the item\'s fit type (Options: Athletic, Classic, Fitted, Loose, Modern, Oversized, Regular, Relaxed, Skinny, Slim, Snug, Straight, Tailored)",
  "Embellishment Feature": "Description of something extra attached to the item for decorative purposes (Options: Applique, Bead, Bow, Button, Chain, Embroidery, Feather, Fringe, Glitter, Lace, Metal, Piping, Pom Pom, Rhinestone, Ribbon, Ruffle, Sequin, Tassel)",
  "Style": "Provide the style of the product. Style refers to the aesthetic choices of a person or a group of people. It describes the distinctive visual representation of a product",
  "Material": "Select the primary materials used for manufacturing the item (Options: Acrylic, Acrylic Blend, Cashmere, Cotton, Cotton Blend, Faux Fur, Faux Leather, Faux Suede, Fur, Leather, Linen, Neoprene, Nylon, Nylon Blend, Polycotton, Polyester, Polyester Blend, Rayon, Rayon Blend, Recycled Polyester, Recycled Polyester Blend, Silk, Spandex, Suede, Synthetic Rubber, Wool, Wool Blend)",
  "Fabric Type": "List all fabrics used in the product separated by "," with % composition",
  "Item Type Name": "Select from the list a one to two-word phrase that describes the type of item the product is  (Options: Cardigan Sweater, Hooded Sweatshirt, Polo Sweater, Pullover Sweater, Shrug Sweater, Skateboarding Hoodie, Sunsuit, Sweater, Sweater Vest, Sweatshirt)",
  "Color": "Provide the color of the product. You can describe the color in detail.",
  "Care Instructions": "Provide care instructions for the product (Options: Dry Clean Only, Hand Wash Only, Machine Wash)",
  "Target Gender": "Choose the target gender for the product (Options: Female, Male, Unisex)",
  "Department Name": "Provide the gender/age for which this item is intended (Options: baby-boys, baby-girls, boys, girls, mens, unisex-adult, unisex-baby, unisex-child, womens)",
  "Occasion Type": "Specify the occasions the product is best suited for (Options: Anniversary, Baby Shower, Bachelor Party, Bachelorette Party, Baptism, Birthday, Bridal Shower, Christmas, cinco_de_mayo, Club, Date Night, Easter, Father\'s Day, Gender Reveal, Graduation, Grandparent\'s Day, Halloween, Honeymoon, Independence Day, Kwanzaa, maternity, memorial_day, Mother\'s Day, New Year, Ramadan, St. Patrick\'s Day, Thanksgiving, Vacation, Valentine\'s Day, Wedding, women_s_day)",
  "Theme": "Specify the theme of the product (Options: Adventure, Anatomy, Animals, Anime, Birds, Car, Cartoons, Characters, Comic, Drama Series, Fantasy, Flag, Floral, Food & Beverage, Holiday, Horror, Insects, Military, Movies, Music, Musicals, Patriotic, Religious, Space, Sport, Superhero, Video Games)",
  "Pattern": "Provide a description of the item\'s pattern (Options: Animal Print, Argyle, Camouflage, Cartoon, Checkered, Chevron, Dip Dye, Flag, Floral, Fruits, Galaxy, Geometric, Graphic, Hearts, Herringbone, Houndstooth, Letter Print, Marble, Moire, Paisley, Plaid, Polka Dots, Snowflakes, Solid, Stars, Striped, Tie Dye)",
  "Neck Style": "Provide the neck style of the product (Options: Asymmetric Neck, Boat Neck, Choker Neck, Collared Neck, Cowl Neck, Crew Neck, Criss Cross Neck, Halter Neck, Henley Neck, High Neck, Hooded Neck, Jewel Neck, Keyhole Neck, Mandarin Neck, Mock Neck, Notch Neck, Off Shoulder Neck, One Shoulder Neck, Round Neck, Sailor Collar Neck, Scallop Neck, Scoop Neck, Shawl Neck, Slit Neck, Split Neck, Square Neck, Sweetheart Neck, Tie Neck, Turtle Neck, V-Neck)",
  "Sleeve Type": "Provide the item\'s type of sleeve (Options: 3/4 Sleeve, Bell Sleeve, Elbow Sleeve, Flared Sleeve, Half Sleeve, Long Sleeve, Raglan Sleeve, Short Sleeve, Sleeveless)",
  "Closure Type": "Provide the type of closing mechanism used by the item. The closing type allows a user to fully wear, seal, or close the item (Options: Button, Hook and Eye, Lace Up, Magnetic, Pull On, Snap, Zipper)",
  "Sweater Form": "Provide the form of the sweater. The form classifies sweaters based on shared characteristics and shape (Options: cardigan, shrug, sweater_cape, sweater_pullover, sweater_vest)",
  "Hemline Form": "Provide the hemline form of the garment. The hemline is the line at the bottom edge of an apparel garment (Options: banded_hemline, bubble_hemline, curved_hemline, elastic_hemline, fishtail_hemline, flared_hemline, handkerchief_hemline, high_low_hemline, polo_hemline, raw_edge_hemline, ribbed_hemline, ruffled_hemline, sharkbite_hemline, shirttail_hemline, slant_hemline, slit_hemline, step_hemline, straight_hemline, tie_hemline, tiered_bottom_hemline)"
}
(Return your result in correct and complete JSON format in the same template for all attributes )'
            ],
            [
                'key' => 'dresses',
                'value' => '{
  "Item Type Keyword": "Dress",
  "Product Description": "Provide a text description of the product. This information will appear in the detail page of your product",
  "Bullet Point": "Write a brief descriptive text about the product. This text will appear under or next to the product photo",
  "Generic Keywords": "What are some other terms that people might use to search for this product?",
  "Special Features": "Select special features an item has that distinguish it from other, comparable products (Choices: Bra, Breathable, Detachable Strap, Disposable, Elastic, Glow In The Dark, Lightweight, Moisture Wicking, Pocket, Quick Dry, Reversible, Stretchable, Wrinkle Free)",
  "Lifestyle": "Select the lifestyle that best represents the item and its use (Choices: Athletic, Beach, Casual, Club, Cocktail, Daily, Dress, Evening, Exotic, Formal, Kids Playwear, Maternity, Nursing, Party, Prom, Themed, Uniform, Wedding, Work Utility)",
  "Style": "Provide the style of the product. Style refers to the aesthetic choices of a person or a group of people. It describes the distinctive visual representation of a product",
  "Department Name": "Select the gender/age for which this item is intended (Choices: baby-boys, baby-girls, boys, girls, mens, unisex-adult, unisex-baby, unisex-child, womens)",
  "Target Gender": "Select the target gender for the product (Choices: Female, Male, Unisex)",
  "Material": "Specify the primary materials used for manufacturing the item (Choices: Acrylic, Acrylic Blend, Art Silk, Cashmere, Cotton, Cotton Blend, Faux Fur, Faux Leather, Fur, Jute, Latex, Leather, Linen, Linen Blend, Neoprene, Nylon, Nylon Blend, Plastic, Polycotton, Polyester, Polyester Blend, Raw Silk, Rayon, Rayon Blend, Recycled Polyester, Recycled Polyester Blend, Sequined, Silk, Silk Blend, Spandex, Wool)",
  "Fabric Type": "List all fabrics used in the product separated by "," with % composition",
  "Lining Description": "Select the description of the lining. (Choices: Cotton, Nylon, Polyester, Rayon, Silk)",
  "Pattern": "Select a description of the item\'s pattern (Choices: Animal Print, Argyle, Camouflage, Cartoon, Checkered, Chevron, Floral, Fruits, Geometric, Graphic, Hearts, Herringbone, Houndstooth, Leaf, Letter Print, Moire, Paisley, Plaid, Polka Dots, Solid, Stars, Striped, Tie-Dye)",
  "Item Type Name": "Select from the list a one to two-word phrase that describes the type of item the product is(Choices: Bridesmaid Dress, Business Casual Dress, Casual Dress, Casual Night Out Dress, Christening Dress, Cocktail Dress, Dress, Formal Dress, Formal Night Out Dress, Homecoming Dress, Mother Of The Bride Dress, Playwear Dress, Prom Dress, Special Occasion Dress, Tennis Dress, Wedding Dress)",
  "Strap Type": "Select the type of strap for this item (Choices: Spaghetti, Strapless, Tank)",
  "Subject Character": "Provide the primary character the item represents",
  "Color Map": "Select the most dominant color of the product. (Choices: Beige, Black, Blue, Bronze, Brown, Clear, Gold, Green, Grey, Metallic, Multicolor, Off White, Orange, Pink, Purple, Red, Silver, Turquoise, White, Yellow)",
  "Color": "Provide the color of the product",
  "Occasion": "Specify the occasions the product is best suited for (Choices: Anniversary, Baby Shower, Bachelor Party, Bachelorette Party, Baptism, Birthday, Bridal Shower, Christmas, Communion, Diwali, Easter, Engagement, Father\'s Day, Funeral, Graduation, Halloween, Honeymoon, Independence Day, Mother\'s Day, New Baby, New Year, Prom Homecoming, Quinceanera, St. Patrick\'s Day, Thanksgiving, Valentine\'s Day, Wedding)",
  "Theme": "Specify the theme of the product. Very similar to subject, but with more general use cases (Choices: Animal, Cartoon, Fantasy, Floral, Halloween, Horror, Movies, Religious, Sport, Superhero, Wedding)",
  "Care Instructions": "Select instructions related to how to care for the item (Choices: Dry Clean Only, Hand Wash Only, Machine Wash)",
  "Included Components": "Specify the items that are included with this product (Choices:Veil,Necklace,Headband,Hat,Belt)",
  "Back Style": "Provide the item\'s back style (Choices: Backless, Full Back, Racerback, Scoop Neck, Square Neck, U Neck, V Neck)",
  "Embellishment Feature": "Describe something extra attached to the item for decorative purposes(Choices:Applique, Bead, Bow, Braid, Button, Chain, Cord, Embroidery, Feather, Fringe, Glitter, Lace, Metal, Net, Piping, Rhinestone, Ribbon, Ruffle, Sequin, Sheer, Spike, Tassel)",
  "Neck Style": "Select the neck style of the product (Choices: Boat Neck, Collared, Crew Neck, Halter, Henley, High Neck, Mock Neck, Off Shoulder, One Shoulder, Peter Pan, Polo, Round Neck, Shawl Collar, Split Neck, Turtleneck, V-Neck)",
  "Waist Style": "Select the item\'s waist style (Choices: Drop Waist, Empire Waist, High Waist, Low Waist, Mid Rise, Natural Waist)",
  "Seasons": "Specify the season(s) most appropriate for the item (Choices: Fall, Spring, Summer, Winter)",
  "Apparel Silhouette": "Provide the silhouette form that describes the overall outline of the item. (Choices: A-Line, Ball Gown, Bodycon, Empire, Fit & Flare, Jumper, Maxi, Mermaid, Overall, Pencil, Sheath, Shift, Shirt Dress, Skater, Swing, Tank Dress, Trapeze)",
  "Sleeve Type": "Provide the item\'s type of sleeve (Choices: 3/4 Sleeve, Bell Sleeve, Cap Sleeve, Dolman Sleeve, Kimono Sleeve, Long Sleeve, Raglan Sleeve, Short Sleeve, Sleeveless)",
  "Closure Type": "Provide the type of closing mechanism used by the item. The closing type allows a user to fully wear, seal, or close the item. (Choices: Button, Hook & Eye, Pull On, Snap, Tie, Zipper)",
  "Hemline Form": "Provide the hemline form of the garment.  The hemline is the line at the bottom edge of an apparel garment. (Choices: Asymmetrical, High Low, Knee Length, Maxi, Midi, Mini, Tea Length)"
}
(Return your result in correct and complete JSON format in the same template for all attributes )'
            ],
            [
                'key' => 'pants',
                'value' => '{
  "Item Type Keyword": "Pants",
  "Product Description": "Provide a text description of the product. This information will appear in the detail page of your product",
  "Bullet Point": "Write a brief descriptive text about the product. This text will appear under or next to the product photo",
  "Generic Keywords": "What are some other terms that people might use to search for this product?",
  "Special Features": "Select special features that distinguish the product from others (Options: Abrasion Resistant, Adjustable, Anti-Fading, Anti-Pilling, Anti-Slip, Arc Flash Resistant, Breathable, Chemical Resistant, Convertible, Expandable, Gusset, Heavy Duty, Insect Proof, Lightweight, Odorless, Quick Dry, Reflective, Reversible, Ripped, Seamless, Shirt Gripper, Squat Proof, Stain Resistant, Stretchable, Sun Protection, Sweat Wicking, Windproof, Wrinkle Resistant)",
  "Lifestyle": "Specify the lifestyle that best represents the item and its use (Options: Athletic, Casual, Dress, Exotic, Kids Playwear, Maternity, Nursing, Themed, Uniform, Work Utility)",
  "Style": "Provide the style of the product. Style refers to the aesthetic choices of a person or a group of people",
  "Department Name": "Specify the gender/age for which this item is intended (Options: Baby Boys, Baby Girls, Boys, Girls, Mens, Unisex, Unisex Baby, Unisex Kids, Womens)",
  "Target Gender": "Provide the target gender for the product (Options: Female, Male, Unisex)",
  "Material": "Specify the primary materials used for manufacturing the item (Options: Acrylic, Art Silk, Cashmere, Cotton, Cotton Blend, Faux Fur, Faux Leather, Leather, Linen, Linen Blend, Neoprene, Nylon, Nylon Blend, Polycotton, Polyester, Polyester Blend, Polyurethane (PU), Polyvinyl Chloride (PVC), Raw Silk, Rayon, Rayon Blend, Recycled Polyester, Recycled Polyester Blend, Rubber, Silk, Silk Blend, Spandex, Suede, Wool, Wool Blend)",
  "Fabric Type": "List all fabrics separated by ",". Indicate with % composition",
  "Pattern": "Provide a description of the item\'s pattern (Options: Animal Print, Argyle, Camouflage, Cartoon, Checkered, Chevron, Floral, Fruits, Geometric, Hearts, Herringbone, Houndstooth, Letter Print, Moire, Ombre, Paisley, Plaid, Polka Dots, Solid, Stars, Striped, Tie-Dye)",
  "Item Type Name": "Select from the list or provide a customer-facing one to two-word phrase that describes the type of item the product is (Options: Baby and Toddler Footie, Baby and Toddler Layette Set, Bodystocking, Business Casual Pants, Casual Pants, Chefs Pants, Compression Pants, Corduroys, Dress Pants, Golf Pants, Hiking Pants, Jeans, Jumpsuit, Khakis, Leggings, Medical Scrubs Pants, Medical Scrubs Set, Overalls, Pants, Pants Set, Slacks, Suit Pants, Sweatpants, Sweatsuit, Tennis Pants, Track Pants, Tracksuit, Work Utility Coveralls, Work Utility Pants, Work Utility Set, Yoga Pants)",
  "Subject Character": "Provide the primary character the item represents",
  "Color Map": "Select the most dominant color of the product (Options: Beige, Black, Blue, Bronze, Brown, Clear, Gold, Green, Grey, Metallic, Multicolor, Off White, Orange, Pink, Purple, Red, Silver, Turquoise, White, Yellow)",
  "Color": "Provide the color of the product",
  "Occasion": "Select the occasions the product is best suited for (Options: Anniversary, Bachelor Party, Bachelorette Party, Baptism, Birthday, Christmas, Communion, Diwali, Easter, Father\'s Day, Graduation, Halloween, Honeymoon, Independence Day, Mother\'s Day, New Baby, New Year, Prom Homecoming, Quinceanera, St. Patrick\'s Day, Thanksgiving, Valentine\'s Day, Wedding)",
  "Theme": "Select the theme of the product (Options: Alphabet, Bird, Comic, Fantasy, Holiday, Horror, Military, Monster, Movie, Music, Patriotic, Space, Sport)",
  "Fit Type": "Selectthe item\'s fit type (Options: Athletic, Classic, Fitted, Loose, Regular, Relaxed, Skinny, Slim, Snug, Straight, Super Skinny, Tailored, Tapered)",
  "Front Style": "Selectan appropriate style for the front of the item (Options: Flat Front, Pleated Front)",
  "Leg Style": "Select the style of the item\'s leg or legs (Options: Ankle, Boot Cut, Cropped, Cuffed, Flared, Skinny, Stirrup, Straight, Tapered, Trouser, Wide)",
  "Pocket Description": "Select the pocket description (Options: Coin Pocket, Pork Chop Pocket, Seam Pocket, Slant Pocket, Slit Pocket, Straight Pocket, Utility Pocket, Welt Pocket)",
  "Fabric Wash": "Select the item\'s fabric wash (Options: Dark, Light, Medium)",
  "Care Instructions": "Select instructions related to how to care for the item (Options: Dry Clean Only, Hand Wash Only, Machine Wash)",
  "Included Components": "Specify the items that are included with this product",
  "Sport Type": "Select any specific sports with which the item is designed to be used (Options: Alpine Skiing, Auto Racing, Backcountry Skiing, Badminton, Baseball, Basketball, BMX, Bowling, Boxing, Canoeing, Climbing, Cricket, Cycling, Cyclocross, Diving, Equestrian, Fishing, Football, Golf, Gymnastics, Hockey, Ice Skating, Kitesurfing, Lacrosse, Martial Art, Mountain Biking, Mountaineering, Multi-Sport, Paddle Boarding, Paintball, Racing, Racquetball, Rafting, Rock Climbing, Roller Hockey, Roller Skating, Rugby, Running, Sailing, Skateboarding, Snorkeling, Snow Skiing, Snowboarding, Snowmobiling, Soccer, Softball, Squash, Surfing, Swimming, T-Ball, Table Tennis, Tennis, Triathlon, Volleyball, Water Polo, Waterskiing, Windsurfing, Wrestling)",
  "Apparel Closure Orientation": "Represents orientation on the garment where the closure is located (Options: Back, Front, Side)",
  "Fabric Stretchability": "Select whether the product is made of fabric that is stretchable (Options: Non-stretchable, Stretchable)",
  "Closure Type": "Select the type of closing mechanism used by the item (Options: Buckle, Button, Drawstring, Hook and Bar, Hook and Eye, Hook and Loop, Magnetic, Pull On, Snap, Zipper)",
  "Pants Form Type": "Select the form type of pants that describes the common shape and characteristics of pants (Options: Cargo, Chino Pants, Compression, Convertible, Equestrian, Gaucho, Harem, Jeans, Joggers, Leggings, Palazzo, Slacks, Sweatpants, Trackpants, Yoga Pants)"
}
(Return your result in correct and complete JSON format in the same template for all attributes )'
            ],
            [
                'key' => 'sweater',
                'value' => '{
  "Item Type Keyword": "SWEATER",
  "Product Description": "Provide a text description of the product. This information will appear in the detail page of your product",
  "Bullet Point": "Write a brief descriptive text about the product. This text will appear under or next to the product photo",
  "Generic Keywords": "What are some other terms that people might use to search for this product?",
  "Special Features": "Provide any special features an item has that distinguish it from other, comparable products (Breathable, Lightweight, Pill-Resistant, Reversible, Skin Friendly, Strapless, Stretchable, Sun Protection, Sweat-Absorbent, Wrinkle Free)",
  "Lifestyle": "Specify the lifestyle that best represents the item and its use (Athletic, Casual, Dress, Exotic, Kids Playwear, Maternity, Nursing, Themed, Uniform, Work Utility)",
  "Style": "Provide the style of the product. Style refers to the aesthetic choices of a person or a group of people. It describes the distinctive visual representation of a product",
  "Department Name": "Provide the gender/age for which this item is intended (baby-boys, baby-girls, boys, girls, mens, unisex-adult, unisex-baby, unisex-child, womens)",
  "Target Gender": "Provide the target gender for the product (Female, Male, Unisex)",
  "Material": "Specify the primary materials used for manufacturing the item (Acrylic, Acrylic Blend, Cashmere, Cashmere Blend, Cotton, Cotton Blend, Faux Fur, Faux Leather, Faux Suede, Fur, Latex, Leather, Linen, Linen Blend, Neoprene, Nylon, Nylon Blend, Polyacrylic, Polybutylene Terephthalate (PBT), Polycotton, Polyester, Polyester Blend, Raw Silk, Rayon, Rayon Blend, Recycled Polyester, Recycled Polyester Blend, Silk, Silk Blend, Spandex, Suede, Wool, Wool Blend)",
  "Fabric Type": "List all fabrics separated by ",". Indicate with % composition",
  "Item Type Name": "Select from the list or provide a customer-facing one to two-word phrase that describes the type of item the product is (Cardigan Sweater, Hooded Sweatshirt, Polo Sweater, Pullover Sweater, Shrug Sweater, Skateboarding Hoodie, Sunsuit, Sweater, Sweater Vest, Sweatshirt)",
  "Subject Character": "Provide the primary character the item represents",
  "Color Map": "Select the most dominant color of the product (Beige, Black, Blue, Bronze, Brown, Clear, Gold, Green, Grey, Metallic, Multicolor, Off White, Orange, Pink, Purple, Red, Silver, Turquoise, White, Yellow)",
  "Color": "Provide the color of the product",
  "Theme": "Specify the theme of the product(Adventure, Aliens, Anatomy, Animals, Anime, Birds, Botanical, Cartoons, Characters, Comic, Fantasy, Floral, Holiday, Horror, Insects, Military, Monsters, Movies, Music, Patriotic, Romance, Space, Sports, Steampunk, Superheroes, Video Games)",
  "Fit Type": "Specify the item\'s fit type (Classic, Fitted, Loose, Modern, Regular, Relaxed, Slim, Standard, Straight, Tailored)",
  "Care Instructions": "Provide instructions related to how to care for the item (Dry Clean Only, Hand Wash Only, Machine Wash)",
  "Pattern": "Specify the item\'s pattern (Animal Print, Argyle, Camouflage, Cartoon, Checkered, Chevron, Floral, Fruits, Geometric, Graphic, Hearts, Herringbone, Houndstooth, Leaves, Letter Print, Moire, Paisley, Plaid, Polka Dots, Solid, Stars, Striped, Tie-Dye)",
  "Embellishment Feature": "Description of something extra attached to the item for decorative purposes (Applique, Bead, Embroidery, Fringe, Glitter, Lace, Patchwork, Pearls, Piping, Rhinestone, Ribbon, Ruffle, Sequin, Spike, Tassel)",
  "Neck Style": "Provide the neck style of the product (Asymmetric Neck, Boat Neck, Choker Neck, Collared Neck, Cowl Neck, Crew Neck, Criss Cross Neck, Halter Neck, Henley Neck, High Neck, Hooded Neck, Jewel Neck, Keyhole Neck, Mandarin Neck, Mock Neck, Notch Neck, Off Shoulder Neck, One Shoulder Neck, Round Neck, Sailor Collar Neck, Scallop Neck, Scoop Neck, Shawl Neck, Slit Neck, Square Neck, Sweetheart Neck, Tie Neck, Turtle Neck, U-Neck, V-Neck)",
  "Sleeve Type": "Provide the item\'s type of sleeve (3/4 Sleeve, Balloon Sleeve, Batwing Sleeve, Bell Sleeve, Bishop Sleeve, Butterfly Sleeve, Cap Sleeve, Cape Sleeve, Cold Shoulder Sleeve, Cuff Sleeve, Flutter Sleeve, Half Sleeve, Kimono Sleeve, Lantern Sleeve, Leg of Mutton Sleeve, Long Sleeve, Puff Sleeve, Raglan Sleeve, Ruffle Sleeve, Short Sleeve, Sleeveless, Split Sleeve)",
  "Closure Type": "Provide the type of closing mechanism used by the item (Buckle, Button, Drawstring, Hook and Eye, Hook and Loop, Lace Up, Magnetic, Pull On, Snap, Zipper)",
  "Sweater Form": "Provide the form of the sweater (Cardigan, Shrug, Sweater Cape, Sweater Pullover, Sweater Vest)"
}
(Return your result in correct and complete JSON format in the same template for all attributes )'
            ]
        ];

        foreach ($data as $item) {
            Prompt::updateOrCreate(['key' => $item['key']], $item);
        }

    }
}
