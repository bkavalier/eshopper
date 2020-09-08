<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Section;
use Image;
use Session;
class CategoryController extends Controller
{
    public function categories(){
    	Session::put('page','categories');
    	$categories = Category::get();
    	/*$categories = json_decode(json_encode($categories));
    	echo "<pre>"; print_r($categories); die;*/
    	return view('admin.categories.categories')->with(compact('categories'));
    }
    
        public function updateCategoryStatus(Request $request){
    	if($request->ajax()){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		if($data['status']=="Active"){
    			$status = 0;
    		}else{
    			$status = 1;
    		}
    		Category::where('id',$data['category_id'])->update(['status'=>$status]);
    		return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
    	}
    }
    
    public function addEditCategory(Request $request, $id=null){
    	if($id==""){
    		$title = "Add Category";
    		$category = new Category;
    	}else{
    		$title = "Edit Category";
    	}
    	
    	if($request->isMethod('post')){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		
    		//form Validation
    		    		$rules = [
    			'category_name' => 'required|regex:/^[\pL\s\-]+$/u|max:25',
    			'section_id' => 'required',
    			'category_url' => 'required',
    			'category_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    		];
    		$customMessages = [
    			'category_name.required' => 'Category Name is required',
    			'category_name.regex' => 'Valid category name is required',
    			'section_id.required' => 'section id is required',
    			'category_url.required' => 'URL is required',
    			'admin_image.image' => 'Valid Image is required',
    			'admin_image.required' => 'Image is required',
    		];
    		$this->validate($request,$rules,$customMessages);
    		//Upload Image
    		if($request->hasFile('category_image')){
    			$image_tmp = $request->file('category_image');
    			
    			//echo "<pre>"; print_r($image_tmp); die;
    			if($image_tmp->isValid()){
    			        //Get Image Extension
    				$extension = $image_tmp->getClientOriginalExtension();
    				$imageName = rand(111,99999).'.'.$extension;
    				$imagePath = '/var/www/html/eshopper/public/backend/images/category_images/'.$imageName;
    				//echo "<pre>"; print_r($imageName); die;
    				//Upload the image
    				Image::make($image_tmp)->save($imagePath);
    				$category->category_image = $imageName;
    			}
    		}
    		
    		if(empty($data['description'])){
    			$data['description']="";
    		}
    		if(empty($data['meta_title'])){
    			$data['meta_title']="";
    		}
    		if(empty($data['category_discount'])){
    			$data['category_discount']="";
    		}
    		if(empty($data['meta_description'])){
    			$data['meta_description']="";
    		}
    		if(empty($data['meta_keywords'])){
    			$data['meta_keywords']="";
    		}
    		
    		$category->parent_id = $data['parent_id'];
    		$category->section_id = $data['section_id'];
    		//$category->section_id = 1;
    		$category->category_name = $data['category_name'];
    		$category->category_discount = $data['category_discount'];
    		$category->description = $data['description'];
    		$category->url = $data['category_url'];
    		$category->meta_title = $data['meta_title'];
    		$category->meta_description = $data['meta_description'];
    		$category->meta_keywords = $data['meta_keywords'];
    		$category->status = 1;
    		$category->save();
    		Session::flash('success_message','Category added successfully');
    		return redirect('admin/categories');
    	}
    	$getSections = Section::get();
    	return view('admin.categories.add_edit_category')->with(compact('title','getSections'));
    }
    
    public function appendCategoryLevel(Request $request){
    	if($request->ajax()){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		$getCategories = Category::with('subcategories')->where(['section_id'=>$data['section_id'],'parent_id'=>0,'status'=>1])->get();
    	$getCategories = json_decode(json_encode($getCategories),true);
    	     //echo "<pre>"; print_r($getCategories); die;
    	     
    	     return view('admin.categories.append_categories_level')->with(compact('getCategories'));
    	}
    	
    }
}
