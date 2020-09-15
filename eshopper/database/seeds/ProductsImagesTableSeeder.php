<?php

use Illuminate\Database\Seeder;
use App\ProductsImage;
class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productImageRecords = [
        	['id'=>1, 'product_id'=>2, 'image'=>'orangeHemd.jpeg-2156.jpeg','status'=>1 ],
        ];
        ProductsImage::insert($productImageRecords);
    }
}
