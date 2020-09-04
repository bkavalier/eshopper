@extends('admin_layouts.admin_layout')
@section('content_admin')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    <a href="{{url('/admin/settings')}}" class="current">Settings</a> </div>
    <h1>Update Password</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-pencil"></i> </span>
            <h5>Password Settings</h5>
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
          <div class="widget-content nopadding">
            <form id="form-wizard" class="form-horizontal" method="post" action="{{url('/admin/update-current-pwd')}}" name="updatePasswordForm">@csrf
              <div id="form-wizard-1" class="step">
              <div class="control-group">
                  <label class="control-label">Admin Name</label>
                  <div class="controls">
                    <input type="text" readonly="" value="{{Auth::guard('admin')->user()->name}}" id="admin_name" name="admin_name"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">Admin Mobile</label>
                  <div class="controls">
                    <input type="text" readonly="" value="{{Auth::guard('admin')->user()->mobile}}"/>
                  </div>
                </div>
              
                <div class="control-group">
                  <label class="control-label">Email</label>
                  <div class="controls">
                    <input type="text" readonly="" value="{{Auth::guard('admin')->user()->email}}"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">Current Password</label>
                  <div class="controls">
                    <input id="current_pwd" type="password" name="current_pwd" />
                  </div>
                </div>
                <span id="chkCurrentPwd"></span>
                <div class="control-group">
                  <label class="control-label">New Password</label>
                  <div class="controls">
                    <input id="new_pwd" type="password" name="new_pwd" required=""/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Confirm Password</label>
                  <div class="controls">
                    <input id="confirm_pwd" type="password" name="confirm_pwd" required="" />
                  </div>
                </div>
              </div>
             
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

