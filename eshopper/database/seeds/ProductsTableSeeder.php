<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsRecords = [
        	['id'=>1, 'category_id'=>17, 'section_id'=>1, 'product_name'=>'Blue Formal Hemd', 'product_code'=>'BT001', 'product_color'=>'Blue',
        	'product_price'=>1500, 'product_discount'=>10, 'product_weight'=>200, 'product_video'=>'', 'main_image'=>'', 'description'=>'Test Product', 'wash_care'=>'', 'fabric'=>'', 'pattern'=>'', 'sleeve'=>'', 'fit'=>'', 'ocassion'=>'', 'meta_title'=>'', 'meta_description'=>'', 'meta_keywords'=>'', 'is_featured'=>'No', 'status'=>1
        	],
        	['id'=>2, 'category_id'=>17, 'section_id'=>1, 'product_name'=>'Red Formal Hemd', 'product_code'=>'RT001', 'product_color'=>'Red',
        	'product_price'=>1500, 'product_discount'=>10, 'product_weight'=>200, 'product_video'=>'', 'main_image'=>'', 'description'=>'Test Product', 'wash_care'=>'', 'fabric'=>'', 'pattern'=>'', 'sleeve'=>'', 'fit'=>'', 'ocassion'=>'', 'meta_title'=>'', 'meta_description'=>'', 'meta_keywords'=>'', 'is_featured'=>'No', 'status'=>1
        	],
        	
        ];
        Product::insert($productsRecords);
    }
}
