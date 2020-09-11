@extends('admin_layouts.admin_layout')
@section('content_admin')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Add or Edit Product</a></div>
  <h1>{{$title}}</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Form</h5>
        </div>
        <div class="widget-content nopadding">
        @if ($errors->any())
    		<div class="alert alert-danger">
        		<ul>
            		@foreach ($errors->all() as $error)
                	<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>
	@endif
	 @if(Session::has('success_message'))
	     <div class="alert alert-success alert-dismissible show" role="alert">
		{{Session::get('success_message')}}
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    	<span aria-hidden="true">&times;</span>
	  	</button>
	     </div>
	 @endif
         <form @if(empty($productdata['id'])) action="{{url('/admin/add-edit-product')}}" @else action="{{url('/admin/add-edit-product/'.$productdata['id'])}}" @endif method="post" id="productForm" name="productForm" class="form-horizontal" enctype="multipart/form-data">@csrf
          
          <div class="control-group">
              <label class="control-label">Select Product</label>
              <div class="controls">
                <select name="category_id" id="category_id">
                  <option value="">Select</option>
                	@foreach($categories as $section)
                		<optgroup label="{{$section['name']}}"></optgroup>
                		@foreach($section['categories'] as $category)
                		<option value="{{$category['id']}}" @if(!empty(@old('category_id')) && $category['id']==@old('category_id')) selected="" @elseif(!empty($productdata['category_id']) && $productdata['category_id']==$category['id']) selected="" @endif>&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{$category['category_name']}}</option>
                			@foreach($category['subcategories'] as $subcategory)
                			<option value="{{$subcategory['id']}}" @if(!empty(@old('category_id')) && $subcategory['id']==@old('category_id')) selected="" @elseif(!empty($productdata['category_id']) && $productdata['category_id']==$subcategory['id']) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$subcategory['category_name']}}</option>
                			@endforeach
                		@endforeach
                	@endforeach	  
                </select>
              </div>
            </div>
          
          	<div class="control-group">
                  <label for="product_name" class="control-label">Product Name</label>
                  <div class="controls">
                    <input type="text" placeholder="Enter Product Name" @if(!empty($productdata['product_name'])) value="{{ $productdata['product_name'] }}" @else value="{{ old('product_name') }}" @endif id="product_name" name="product_name"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="product_code" class="control-label">Product Code</label>
                  <div class="controls">
                    <input type="text" placeholder="Enter Product Code" @if(!empty($productdata['product_code'])) value="{{ $productdata['product_code'] }}" @else value="{{ old('product_code') }}" @endif id="product_code" name="product_code"/>
                  </div>
                </div>
                
                 <div class="control-group">
                  <label for="product_color" class="control-label">Product Color</label>
                  <div class="controls">
                    <input type="text" placeholder="Enter Product Color" @if(!empty($productdata['product_color'])) value="{{ $productdata['product_color'] }}" @else value="{{ old('product_color') }}" @endif id="product_color" name="product_color"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="product_price" class="control-label">Product Price</label>
                  <div class="controls">
                    <input type="text" placeholder="Enter Product Price" @if(!empty($productdata['product_price'])) value="{{ $productdata['product_price'] }}" @else value="{{ old('product_price') }}" @endif id="product_price" name="product_price"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="product_discount" class="control-label">Product Dicount (%)</label>
                  <div class="controls">
                    <input type="text" placeholder="Enter Product Dicount" @if(!empty($productdata['product_discount'])) value="{{ $productdata['product_discount'] }}" @else value="{{ old('product_price') }}" @endif id="product_discount" name="product_discount"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="product_weight" class="control-label">Product Weight</label>
                  <div class="controls">
                    <input type="text" placeholder="Enter Product Weight" @if(!empty($productdata['product_weight'])) value="{{ $productdata['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif id="product_weight" name="product_weight"/>
                  </div>
                </div>

            
            <div class="control-group">
              <label class="control-label" for="main_image">Product Main Image</label>
              <div class="controls">
                <input type="file" name="main_image" id="main_image"/>
                  	<div style="height:100px;">
              @if(!empty($productdata['main_image'])) <img style="width:50px;margin-top:20px;" src="{{asset('/backend/images/products_images/small/'.$productdata['main_image'])}}"> &nbsp; <a class="productImageDelete" name="productImageDelete" href="{{url('admin/delete-product-image/'.$productdata['id'])}}">Delete Image</a>
              @endif
			</div>
              </div>
              <div>Recommended Image Size : Width:1040px, Heght:1200px</div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="product_image">Product Video</label>
              <div class="controls">
                <input type="file" name="product_image" id="product_image"/>
              </div>
            </div>
            
           
              
                <div class="control-group">
              <label class="control-label" for="description">Product Description</label>
              <div class="controls">
                <textarea class="span11"  name="description" id="description">@if(!empty($productdata['description'])) $productdata['description'] @else {{ old('description') }} @endif</textarea>
              </div>
            </div>
            
             <div class="control-group">
              <label class="control-label" for="wash_care">Wash Care</label>
              <div class="controls">
                <textarea class="span11"  name="wash_care" id="wash_care">@if(!empty($productdata['wash_care'])) $productdata['wash_care'] @else {{ old('wash_care') }} @endif</textarea>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Select Fabric</label>
              <div class="controls">
                <select name="fabric" id="fabric">
                  <option value="">Select</option>
                  @foreach($fabricArray as $fabric)
                  	<option value="{{ $fabric }}" @if(!empty($productdata['fabric']) && $productdata['fabric']==$fabric) selected="" @endif>{{ $fabric }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Select Sleeve</label>
              <div class="controls">
                <select name="sleeve" id="sleeve">
                  <option value="">Select</option>
                  @foreach($sleeveArray as $sleeve)
                  	<option value="{{ $sleeve }}" @if(!empty($productdata['sleeve']) && $productdata['sleeve']==$sleeve) selected="" @endif>{{ $sleeve }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
            
            <div class="control-group">
              <label class="control-label">Select Pattern</label>
              <div class="controls">
                <select name="pattern" id="pattern">
                  <option value="">Select</option>
                  @foreach($patternArray as $pattern)
                  	<option value="{{ $pattern }}" @if(!empty($productdata['pattern']) && $productdata['pattern']==$pattern) selected="" @endif>{{ $pattern }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
            
            <div class="control-group">
              <label class="control-label">Select Fit</label>
              <div class="controls">
                <select name="fit" id="fit">
                  <option value="">Select</option>
                  @foreach($fitArray as $fit)
                  	<option value="{{ $fit }}" @if(!empty($productdata['fit']) && $productdata['fit']==$fit) selected="" @endif>{{ $fit }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Select Ocassion</label>
              <div class="controls">
                <select name="ocassion" id="ocassion">
                  <option value="">Select</option>
                  @foreach($ocassionArray as $ocassion)
                  	<option value="{{ $ocassion }}" @if(!empty($productdata['ocassion']) && $productdata['ocassion']==$ocassion) selected="" @endif>{{ $ocassion }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
            
              <div class="control-group">
              <label class="control-label" for="meta_title">Meta title</label>
              <div class="controls">
                <textarea class="span11"  name="meta_title" id="meta_title" >@if(!empty($productdata['meta_title'])) $productdata['meta_title'] @else {{old('meta_title')}} @endif</textarea>
              </div>
            </div>
            
             <div class="control-group">
                  <label for="meta_description" class="control-label">Meta Description</label>
                  <div class="controls">
                    <textarea class="span11" name="meta_description" id="meta_description">@if(!empty($productdata['meta_description'])) $productdata['meta_description'] @else {{old('meta_description')}} @endif</textarea>
                  </div>
                </div>
                
                 <div class="control-group">
                  <label for="meta_keywords" class="control-label">Meta Keywords</label>
                  <div class="controls">
                    <textarea class="span11" name="meta_keywords" id="meta_keywords">@if(!empty($productdata['meta_keywords'])) {{ $productdata['meta_keywords'] }} @else {{ old('meta_keywords') }} @endif </textarea>
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="is_featured" class="control-label">Featured Item</label>
                  <div class="controls">
			<input type="checkbox" name="is_featured" id="is_featured" value="Yes" @if(!empty($productdata['is_featured']) && $productdata['is_featured']=="Yes") checked="" @endif>
                  </div>
                </div>
                
                
            <div class="form-actions">
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </form>
        </div>
      </div>
     
    </div>
   
  </div>
  
</div></div>

@endsection

