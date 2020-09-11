@extends('admin_layouts.admin_layout')
@section('content_admin')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Add or Edit Category</a></div>
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
          <form @if(empty($categorydata['id'])) action="{{url('/admin/add-edit-category')}}" @else action="{{url('/admin/add-edit-category/'.$categorydata['id'])}}" @endif method="post" id="categoryForm" name="categoryForm" class="form-horizontal" enctype="multipart/form-data">@csrf
          
          	<div class="control-group">
                  <label for="category_name" class="control-label">Category Name</label>
                  <div class="controls">
                    <input type="text" placeholder="Enter Category Name" @if(!empty($categorydata['category_name'])) value="{{ $categorydata['category_name'] }}" @else value="{{ old('category_name') }}" @endif id="category_name" name="category_name"/>
                  </div>
                </div>
            
            <div class="control-group">
              <label class="control-label">Select Section</label>
              <div class="controls">
                <select name="section_id" id="section_id">
                  <option value="">Select</option>
                  @foreach($getSections as $section)
                  <option value="{{$section->id}}" @if(!empty($categorydata['section_id']) && $categorydata['section_id']==$section->id) selected @endif>{{$section->name}}</option>  
                  @endforeach
                </select>
              </div>
            </div>
            
            <div id="appendCategoriesLevel">
              @include('admin.categories.append_categories_level')
            </div>
            
            <div class="control-group">
              <label class="control-label" for="category_image">Category Image</label>
              <div class="controls">
                <input type="file" name="category_image" id="category_image"/>
                
              </div>
              <div style="height:100px;">
              @if(!empty($categorydata['category_image'])) <img style="width:50px;margin-top:20px;" src="{{asset('/backend/images/category_images/'.$categorydata['category_image'])}}"> &nbsp; <a class="categoryImageDelete" name="categoryImageDelete" href="{{url('admin/delete-category-image/'.$categorydata['id'])}}">Delete Image</a>
              </div>
              @endif
            </div>
            
            <div class="control-group">
                  <label for="category_discount" class="control-label">Category Discount</label>
                  <div class="controls">
                    <input type="text" @if(!empty($categorydata['category_discount'])) value="{{ $categorydata['category_discount'] }}" @else value="{{ old('category_discount') }}" @endif placeholder="Enter Category Discount" id="category_discount" name="category_discount"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="category_url" class="control-label">Category URL</label>
                  <div class="controls">
                    <input type="text" @if(!empty($categorydata['url'])) value="{{ $categorydata['url'] }}" @else value="{{ old('url') }}" @endif placeholder="Enter Category URL" id="category_url" name="category_url"/>
                  </div>
                </div>
                
                <div class="control-group">
              <label class="control-label" for="description">Category Description</label>
              <div class="controls">
                <textarea class="span11"  name="description" id="description">@if(!empty($categorydata['description'])) $categorydata['description'] @else {{ old('description') }} @endif</textarea>
              </div>
            </div>
            
              <div class="control-group">
              <label class="control-label" for="meta_title">Meta title</label>
              <div class="controls">
                <textarea class="span11"  name="meta_title" id="meta_title">@if(!empty($categorydata['meta_title'])) $categorydata['meta_title'] @else {{old('meta_title')}} @endif</textarea>
              </div>
            </div>
            
             <div class="control-group">
                  <label for="meta_description" class="control-label">Meta Description</label>
                  <div class="controls">
                    <textarea class="span11" name="meta_description" id="meta_description">@if(!empty($categorydata['meta_description'])) $categorydata['meta_description'] @else {{old('meta_description')}} @endif</textarea>
                  </div>
                </div>
                
                 <div class="control-group">
                  <label for="meta_keywords" class="control-label">Meta Keywords</label>
                  <div class="controls">
                    <textarea class="span11" name="meta_keywords" id="meta_keywords" >@if(!empty($categorydata['meta_keywords'])) {{ $categorydata['meta_keywords'] }} @else {{ old('meta_keywords') }} @endif</textarea>
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

