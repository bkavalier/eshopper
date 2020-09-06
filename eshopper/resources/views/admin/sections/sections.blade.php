@extends('admin_layouts.admin_layout')
@section('content_admin')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Sections Table</a> </div>
    <h1>Sections</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data table</h5>
            
          </div>
          <input id="myInputSearch" type="text" placeholder="Search..">
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>status</th>
                </tr>
              </thead>
              <tbody  id="mySectionsTable">
              @foreach($sections as $section)
                <tr class="gradeX">
                  <td>{{$section->id}}</td>
                  <td>{{$section->name}}</td>
                  <td class="center">
                  	@if($section->status==1)
                  		<a class="updateSectionStatus" id="section-{{$section->id}}" section_id="{{$section->id}}" href="javascript:void(0)">Active</a>
                  	@else
                  		<a class="updateSectionStatus" id="section-{{$section->id}}" section_id="{{$section->id}}" href="javascript:void(0)">Inactive</a>
                  	@endif
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

