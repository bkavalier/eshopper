@extends('admin_layouts.admin_layout')
@section('content_admin')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Products Table</a> </div>
    <h1>Products</h1>
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
            <a href="{{url('/admin/add-edit-product')}}" style="max-width:150px;float:right;display:inline-block;" class="btn btn-block btn-success">Add Product</a>
            
          </div>
          <input id="myInputSearch" type="text" placeholder="Search..">
          <div class="widget-content nopadding">
            <table id="products" class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Product Image</th>
                  <th>Product Color</th>
                  <th>Category</th>
                  <th>Section</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody  id="mySectionsTable">
              @foreach($products as $product)
              
                <tr class="gradeX">
                  <td>{{$product->id}}</td>
                  <td>{{$product->product_name}}</td>
                  <td>{{$product->product_code}}</td>
                  <td>
                  <?php $product_image_path = "/var/www/html/eshopper/public/backend/images/products_images/small/".$product->main_image; ?>
                  @if(!empty($product->main_image) && file_exists($product_image_path))
                  <img style="width:100px;" src="{{asset('/backend/images/products_images/small/'.$product->main_image)}}">
                  @else
                  <img style="width:100px;" src="{{asset('/backend/images/products_images/small/dummy_image.png')}}">
                  @endif
                  </td>
                  <td>{{$product->product_color}}</td>
                  
                  <td>{{$product->category->category_name}}</td>
                  <td>{{$product->section->name}}</td>
                  <td class="center">
                  	@if($product->status==1)
                  		<a class="updateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}" href="javascript:void(0)">Active</a>
                  	@else
                  		<a class="updateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}" href="javascript:void(0)">Inactive</a>
                  	@endif
                  </td>
                  <td>
                  <a href="{{ url('admin/add-edit-product/'.$product->id) }}">Edit</a>
                  &nbsp;&nbsp;
                  <a class="confirmDelete" name="Product" href="{{ url('admin/delete-product/'.$product->id) }}">Delete</a>
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

