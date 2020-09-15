<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Session;
use App\Section;
use App\Category;
use Image;
use App\ProductsAttribute;
class ProductsController extends Controller
{


    public function products(){
        Session::put('page','products');
    	$products = Product::with(['category'=>function($query){
    		$query->select('id','category_name');
    	},'section'=>function($query){
    		$query->select('id','name');
    	}])->get();
    	//$products = json_decode(json_encode($products));
    	//echo "<pre>"; print_r($products); die;
    	return view('admin.products.products')->with(compact('products'));
    }
    
    public function updateProductStatus(Request $request){
    	if($request->ajax()){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		if($data['status']=="Active"){
    			$status = 0;
    		}else{
    			$status = 1;
    		}
    		
    		
    		Product::where('id',$data['product_id'])->update(['status'=>$status]);
    		return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
    	}
    }
    
    
     public function deleteProduct($id){	
    	Product::where('id',$id)->delete();
    	$message = 'Product has been deleted succesfully';
    	Session::flash('success_message',$message);
    	return redirect()->back();
    }
    
 public function addEditProduct(Request $request, $id=null){

 	if($id==""){
 		$title= "Add Product";
 		$product = new Product;
 		$productdata = array();
 		$message = "Product added succesfully";
 	}else{
 		$title= "Edit Product";
 		
 		//$productdata = Product::where('id',$id)->first();
 		$productdata = Product::find($id);
 		$productdata = json_decode(json_encode($productdata),true);
 		//echo "<pre>"; print_r($productdata); die;
 		$product = Product::find($id);
 		$message = "product updated successfully";
 		
 	}
 	if($request->isMethod('POST')){
    			$data = $request->all();
    			//echo "<pre>"; print_r($data); die;
    			
    		$rules = [
    			'category_id' => 'required',
    			'product_name' => 'required|regex:/^[\pL\s\-]+$/u|max:25',
    			'product_code' => 'required|regex:/^[\w-]*$/',
    			'product_price' => 'required|numeric',
    			'product_color' => 'required|regex:/^[\pL\s\-]+$/u|max:25',
    			'main_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',

    		];
    		$customMessages = [
    			'category_id.required' => 'Category is required',
    			'product_name.required' => 'Product Name is required',
    			'product_name.regex' => 'Valid product name is required',
    			'product_code.required' => 'Product Code is required',
    			'product_code.regex' => 'Valid Product code is required',
    			'product_price.required' => 'Product Price is required',
    			'product_price.regex' => 'Valid Product Price is required',
    			'product_color.regex' => 'Product Color is required',
    			'product_color.regex' => 'Valid Product Color is required',
    			'main_image.image' => 'Valid Image is required',
    			'main_image.required' => 'Image is required',
    			
    		];
    		$this->validate($request,$rules,$customMessages);
		
		//Upload images		
		if($request->hasFile('main_image')){
			$image_tmp = $request->File('main_image');
			//echo $image_tmp;die;
			if($image_tmp->isValid()){
				//Upload image after resize
				$image_name = $image_tmp->getClientOriginalName();
				$extension = $image_tmp->getClientOriginalExtension();
				$imageName = $image_name.'-'.rand(111,9999).'.'.$extension;
				$large_image_path = '/var/www/html/eshopper/public/backend/images/products_images/large/'.$imageName;
				$medium_image_path = '/var/www/html/eshopper/public/backend/images/products_images/medium/'.$imageName;
				$small_image_path = '/var/www/html/eshopper/public/backend/images/products_images/small/'.$imageName;
				Image::make($image_tmp)->save($large_image_path);//W:1040 H:1200
				Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
				Image::make($image_tmp)->resize(260,300)->save($small_image_path);
				$product->main_image = $imageName;
			}
			
		}
		
		    		
    		if(empty($data['is_featured'])){
    			$is_featured = 0;
    		}else{
    			$is_featured = 1;
    		}
    		if(empty($data['fabric'])){
    			$fabric = "";
    		}
    		if(empty($data['pattern'])){
    			$pattern = "";
    		}
    		if(empty($data['fabric'])){
    			$fabric = "";
    		}
    		if(empty($data['sleeve'])){
    			$sleeve = "";
    		}
    		if(empty($data['fit'])){
    			$fit = "";
    		}
    		if(empty($data['ocassion'])){
    			$ocassion = "";
    		}
    		if(empty($data['sleeve'])){
    			$sleeve = "";
    		}
    		if(empty($data['meta_title'])){
    			$meta_title = "";
    		}
    		if(empty($data['meta_keywords'])){
    			$meta_keywords = "";
    		}
    		if(empty($data['product_discount'])){
    			$product_discount = " ";
    		}
    		if(empty($data['meta_description'])){
    			$meta_description = "";
    		}
    		
    		//Save products 
    		
    		$categoryDetails = Category::find($data['category_id']);
    		//echo "<pre>"; print_r($categoryDetails['section_id']); die;
    		$product->section_id = $categoryDetails['section_id'];
    		$product->category_id = $data['category_id'];
    		$product->product_name = $data['product_name'];
    		$product->product_code = $data['product_code'];
    		$product->product_price = $data['product_price'];
    		$product->product_color = $data['product_color'];
    		$product->product_discount = $data['product_discount'];
    		$product->product_weight = $data['product_weight'];
    		$product->description = $data['description'];
    		$product->wash_care = $data['wash_care'];
    		$product->fabric = $data['fabric'];
    		$product->pattern = $data['pattern'];
    		$product->sleeve = $data['sleeve'];
    		$product->fit = $data['fit'];
    		$product->ocassion = $data['ocassion'];
    		$product->meta_title = $data['meta_title'];
    		$product->meta_keywords = $data['meta_keywords'];
    		$product->meta_description = $data['meta_description'];
    		$product->is_featured = $is_featured;
    		$product->status = 1;
    		$product->save();
    		session::flash('success_message',$message);
    		return redirect('admin/products');
    		}
	//Filter Arrays
	$fabricArray = array('Cotton','Polyester','Wool');
	$sleeveArray = array('Full Sleeve','Half Sleeve','Short Sleeve','Sleeveless');
	$patternArray = array('Checked','Plain','Printed','Self','Solid');
	$fitArray = array('Regular','Slim');
	$ocassionArray = array('Casual','Formal');

	//Sections with Categories and sub categories
	$categories = Section::with('categories')->get();
	$categories = json_decode(json_encode($categories),true);
	//echo "<pre>"; print_r($categories); die;

 	return view('admin.products.add-edit-product')->with(compact('title','fabricArray','sleeveArray','patternArray','fitArray','ocassionArray','categories','productdata'));
 }
 
 
     public function deleteProductImage($id){
    	//Get Product Image
    	$productImage = Product::select('main_image')->where('id',$id)->first();
    	//GET Product IMAGE PATH
    	$small_image_path = "backend/images/products_images/small/";
    	$medium_image_path = "backend/images/products_images/medium/";
    	$large_image_path = "backend/images/products_images/large/";
    	if(file_exists($small_image_path.$productImage->main_image)){
    		unlink($small_image_path.$productImage->main_image);    	
    	}
    	if(file_exists($medium_image_path.$productImage->main_image)){
    		unlink($medium_image_path.$productImage->main_image);    	
    	}
    	if(file_exists($large_image_path.$productImage->main_image)){
    		unlink($large_image_path.$productImage->main_image);    	
    	}
    	//Delete Product image from Categories table
    	Product::where('id',$id)->update(['main_image'=>'']);
    	$message = 'Product image has been deleted succesfully';
    	Session::flash('success_message',$message);
    	//return redirect('admin/categories');
    	return redirect()->back()->with('flash_message_success','Product image has been deleted successfully');
    }
    
    public function addAttributes(Request $request, $id){
    	if($request->isMethod('POST')){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		foreach($data['sku'] as $key => $value){
    			if(!empty($value)){
    				//SKU already exists check
    				$attrCountSKU = ProductsAttribute::where('sku',$value)->count();
    				if($attrCountSKU>0){
    					$message = 'SKU already exists.Please add onother SKU';
    					Session::flash('error_message',$message);
    					return redirect()->back();
    				}
    				//Size Check
    				$attrCountsize = ProductsAttribute::where(['product_id'=>$id, 'size'=>$data['size'][$key]])->count();
    				if($attrCountsize>0){
    					$message = 'Size already exists.Please add onother size';
    					Session::flash('error_message',$message);
    					return redirect()->back();
    				}
    				$attribute = new ProductsAttribute;
    				$attribute->product_id = $id;
    				$attribute->sku = $value;
    				$attribute->size = $data['size'][$key];
    				$attribute->price = $data['price'][$key];
    				$attribute->stock = $data['stock'][$key];
    				$attribute->status = 1;
    				$attribute->save();
    			}
    		}
    		//Success Message
    		
    		$success_message = 'Product Attribute has been added succesfully';
    		Session::flash('success_message',$success_message);
    		return redirect()->back();
    		
    	}
    
    	$productdata = Product::select('id','product_name','product_code','product_color','main_image')->with('attributes')->find($id);
    	$productdata = json_decode(json_encode($productdata),true);
    	//echo "<pre>"; print_r($productdata); die;
    	$title = "Product Attributes";
    	return view('admin.products.add_attributes')->with(compact('productdata','title'));
    
    }
    
    public function editAttributes(Request $request,$id){
   	 if($request->isMethod('post')){
   	 	$data = $request->all();
   	 	//echo "<pre>"; print_r($data); die;
   	 	foreach($data['status'] as $key => $attr){
   	 	if(!empty($attr)){
   	 		ProductsAttribute::where(['id'=>$data['attrId'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
   	 	}
   	 	}
   	 	$message="Product attributes has been added successfully";
   	 	Session::flash('success_message',$message);
    		return redirect()->back();
   	 	
   	 }
   }
   
   
    public function updateAttributeStatus(Request $request){
    	if($request->ajax()){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		if($data['status']=="Active"){
    			$status = 0;
    		}else{
    			$status = 1;
    		}
    		ProductsAttribute::where('id',$data['attribute_id'])->update(['status'=>$status]);
    		return response()->json(['status'=>$status,'attribute_id'=>$data['attribute_id']]);
    	}
    }
   
   
   public function deleteAttribute($id){	
    	ProductsAttribute::where('id',$id)->delete();
    	$message = 'Product has been deleted succesfully';
    	Session::flash('success_message',$message);
    	return redirect()->back();
    }
    
    public function addImages($id){	
    	$productdata = Product::with('images')->select('id','product_name','product_code','product_color','main_image')->find($id);
    	$productdata = json_decode(json_encode($productdata),true);
    	//echo "<pre>"; print_r($productdata); die;
    	return view('admin.products.add_images')->with(compact($productdata));
    }
   
}
