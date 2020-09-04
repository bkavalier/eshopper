@extends('admin_layouts.admin_layout')
@section('content_admin')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    <a href="{{url('/admin/update-admin-details')}}" class="current">My Profile Edit</a> </div>
    <h1>Admin Details</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-pencil"></i> </span>
            <h5>Update Admin details</h5>
          </div>
          @if(Session::has('error_message'))
	     <div class="alert alert-danger alert-dismissible show" role="alert">
		{{Session::get('error_message')}}
	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    	<span aria-hidden="true">&times;</span>
	  	</button>
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
	 @if ($errors->any())
    		<div class="alert alert-danger">
        		<ul>
            		@foreach ($errors->all() as $error)
                	<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>
	@endif
          <div class="widget-content nopadding">
            <form id="form-wizard" class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{url('/admin/update-admin-details')}}" name="updateAdminDetails">@csrf
              <div id="form-wizard-1" class="step">
              <div class="control-group">
                  <label class="control-label">Admin Name</label>
                  <div class="controls">
                    <input type="text"  value="{{Auth::guard('admin')->user()->name}}" id="admin_name" name="admin_name"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">Admin Mobile</label>
                  <div class="controls">
                    <input type="text"  value="{{Auth::guard('admin')->user()->mobile}}" id="admin_mobile" name="admin_mobile"/>
                  </div>
                </div>
              
                <div class="control-group">
                  <label class="control-label">Email</label>
                  <div class="controls">
                    <input type="text" readonly="" value="{{Auth::guard('admin')->user()->email}}"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">Image</label>
                  <div class="controls">
                    <input id="admin_image" type="file" name="admin_image" />
                    @if(!empty(Auth::guard('admin')->user()->image))
                    	<a href="{{url('backend/images/admin_images/'.Auth::guard('admin')->user()->image)}}">View Image</a>
                    	<input type="hidden" name="current_admin_image" value="Auth::guard('admin')->user()->image)" accept="image/*">	
                    @endif
                  </div>
                </div>
                <span id="chkCurrentPwd"></span>
             
              <div class="form-actions">
                <input id="submit" class="btn btn-primary" type="submit" value="Submit" />
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

