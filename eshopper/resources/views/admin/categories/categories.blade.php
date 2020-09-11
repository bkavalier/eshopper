@extends('admin_layouts.admin_layout')
@section('content_admin')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Category Table</a> </div>
    <h1>Categories</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
       @if(Session::has('success_message'))
	     <div class="alert alert-success alert-dismissible show" role="alert">
		{{Session::get('success_message')}}
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    	<span aria-hidden="true">&times;</span>
	  	</button>
	     </div>
	 @endif
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data table</h5>
            <a href="{{url('/admin/add-edit-category')}}" style="max-width:150px;float:right;display:inline-block;" class="btn btn-block btn-success">Add Category</a>
            
          </div>
          <input id="myInputSearch" type="text" placeholder="Search..">
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Section</th>
                  <th>ParentCategory</th>
                  <th>Category</th>
                  <th>URL</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody  id="mySectionsTable">
              @foreach($categories as $category)
              @if(!isset($category->parentcategory->category_name))
              	<?php $parent_category = "Root"; ?>
              	@else
              	<?php $parent_category = $category->parentcategory->category_name; ?>
              @endif
                <tr class="gradeX">
                  <td>{{$category->id}}</td>
                  <td>{{$category->section->name}}</td>
                  <td>{{$parent_category}}</td>
                  <td>{{$category->category_name}}</td>
                  <td>{{$category->url}}</td>
                  <td class="center">
                  	@if($category->status==1)
                  		<a class="updateCategoryStatus" id="category-{{$category->id}}" category_id="{{$category->id}}" href="javascript:void(0)">Active</a>
                  	@else
                  		<a class="updateCategoryStatus" id="category-{{$category->id}}" category_id="{{$category->id}}" href="javascript:void(0)">Inactive</a>
                  	@endif
                  </td>
                  <td>
                  <a href="{{ url('admin/add-edit-category/'.$category->id) }}">Edit</a>
                  &nbsp;&nbsp;
                  <a class="confirmDelete" name="Category" href="{{ url('admin/delete-category/'.$category->id) }}">Delete</a>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

