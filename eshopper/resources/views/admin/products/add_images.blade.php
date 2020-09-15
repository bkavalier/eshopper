@extends('admin_layouts.admin_layout')
@section('content_admin')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Add or Edit Product Attributes</a></div>
  <h1>ADD {{$title}}</h1>
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
	  @if(Session::has('error_message'))
	     <div class="alert alert-danger alert-dismissible show" role="alert">
		{{Session::get('error_message')}}
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    	<span aria-hidden="true">&times;</span>
	  	</button>
	     </div>
	 @endif
         <form name="attributeForm" action="{{url('/admin/add-attributes/'.$productdata['id'])}}" method="post"  class="form-horizontal" enctype="multipart/form-data">@csrf
          	<input type="hidden" name="product_id" value="{{$productdata['id']}}">
          	<div class="control-group">
                  <label for="product_name" class="control-label">Product Name</label>
                  <div class="controls">
                    <input type="text" value="{{ $productdata['product_name'] }}" readonly=""/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label for="product_code" class="control-label">Product Code</label>
                  <div class="controls">
                    <input type="text"  value="{{ $productdata['product_code'] }}"  readonly="" />
                  </div>
                </div>
                
                 <div class="control-group">
                  <label for="product_color" class="control-label">Product Color</label>
                  <div class="controls">
                    <input type="text"  value="{{ $productdata['product_color'] }}"   readonly=""/>
                  </div>
                </div>
                
            <div class="control-group">
              <label class="control-label" for="main_image">Product Main Image</label>
              <div class="controls">
           <img style="width:50px;margin-top:20px;" src="{{asset('/backend/images/products_images/small/'.$productdata['main_image'])}}"> 

              </div>
            </div>
            
           <div class="control-group">
		<div class="field_wrapper">
    		<div>
     		   <input id="size" type="text" name="size[]" value="" placeholder="Size"/>
     		   <input id="sku" type="text" name="sku[]" value="" placeholder="SKU"/>
     		   <input id="price" type="text" name="price[]" value="" placeholder="Price"/>
     		   <input id="stock" type="text" name="stock[]" value="" placeholder="Stock"/>
     	 	  <a href="javascript:void(0);" class="add_button" title="Add field">ADD</a>
  	  	</div>
		</div>
            </div>
       
                
            <div class="form-actions">
              <button type="submit" class="btn btn-success">Add Attributes</button>
            </div>
          </form>
       
       <form name="editAttributeForm" id="editAttributeForm" method="post" action="{{url('admin/edit-attributes/'.$productdata['id'])}}" enctype="multipart/form-data" class="form-horizontal">@csrf
       <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Added attributes</h5>
            
          </div>
          <input id="myInputSearch" type="text" placeholder="Search..">
          <div class="widget-content nopadding">
            <table id="products" class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Size</th>
                  <th>SKU</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody  id="mySectionsTable">
              
              @foreach($productdata['attributes'] as $attribute)
              <input type="text" style="display:none;" name="attrId[]" value="{{$attribute['id']}}">
                <tr class="gradeX">
                  <td>{{$attribute['id']}}</td>
                  <td>{{$attribute['size']}}</td>
                  <td>{{$attribute['sku']}}</td>
                  <td>
                  <input type="number" name="price[]" value="{{$attribute['price']}}" required="">
                  </td>
                  <td>
		   <input type="number" name="stock[]" value="{{$attribute['stock']}}" required="">
                  
                  </td>
                  <td>
                  	@if($attribute['status']==1)
                  		<a class="updateAttributeStatus" id="attribute-{{$attribute['id']}}" attribute_id="{{$attribute['id']}}" href="javascript:void(0)">Active</a>
                  	@else
                  		<a class="updateAttributeStatus" id="attribute-{{$attribute['id']}}" attribute_id="{{$attribute['id']}}" href="javascript:void(0)">Inactive</a>
                  	@endif
                  	
                  	&nbsp;&nbsp;
             		<a class="confirmDelete" name="Attribute" href="{{url('admin/delete-attribute/'.$attribute['id'])}}">Delete</a>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
       
       <div class="form-actions">
              <button type="submit" class="btn btn-success">Update Attributes</button>
            </div>
       </form>
          
        </div>
       </div> 
    </div>
   
  </div>
  
</div></div>

@endsection

