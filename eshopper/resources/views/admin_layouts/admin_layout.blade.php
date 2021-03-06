<!DOCTYPE html>
<html lang="en">
<head>
<title>Matrix Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('backend/css/bootstrap-responsive.min.css')}}" />
<link rel="stylesheet" href="{{asset('backend/css/fullcalendar.css')}}" />
<link rel="stylesheet" href="{{asset('backend/css/uniform.css')}}" />
<link rel="stylesheet" href="{{asset('backend/css/select2.css')}}" />
<link rel="stylesheet" href="{{asset('backend/css/matrix-style.css')}}" />
<link rel="stylesheet" href="{{asset('backend/css/matrix-media.css')}}" />
<link href="{{asset('backend/fonts/css/font-awesome.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/jquery.gritter.css')}}" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('backend/js/admin_script.js')}}"></script>
<script>
$(document).ready(function(){
  $("#myInputSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#mySectionsTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</head>
<body>


<!--Header-part-->
@include('admin_layouts.admin_header')
<!--close-top-serch-->
<!--sidebar-menu-->
@include('admin_layouts.admin_slidebar')
<!--sidebar-menu-->

<!--main-container-part-->
@yield('content_admin')
<!--end-main-container-part-->

<!--Footer-part-->

@include('admin_layouts.admin_footer')

<!--end-Footer-part-->

<script src="{{asset('backend/js/excanvas.min.js')}}"></script> 
<script src="{{asset('backend/js/jquery.min.js')}}"></script> 
<script src="{{asset('backend/js/jquery.ui.custom.js')}}"></script> 
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('backend/js/jquery.flot.min.js')}}"></script> 
<script src="{{asset('backend/js/jquery.flot.resize.min.js')}}"></script> 
<script src="{{asset('backend/js/jquery.peity.min.js')}}"></script> 
<script src="{{asset('backend/js/fullcalendar.min.js')}}"></script> 
<script src="{{asset('backend/js/matrix.js')}}"></script> 
<script src="{{asset('backend/js/matrix.dashboard.js')}}"></script> 
<script src="{{asset('backend/js/jquery.gritter.min.js')}}"></script> 
<script src="{{asset('backend/js/matrix.interface.js')}}"></script> 
<script src="{{asset('backend/js/matrix.chat.js')}}"></script> 
<script src="{{asset('backend/js/jquery.validate.js')}}"></script> 
<script src="{{asset('backend/js/matrix.form_validation.js')}}"></script> 
<script src="{{asset('backend/js/jquery.wizard.js')}}"></script> 
<script src="{{asset('backend/js/jquery.uniform.js')}}"></script> 
<script src="{{asset('backend/js/select2.min.js')}}"></script> 
<script src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/js/matrix.popover.js')}}"></script> 
<script src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script> 
<script src="{{asset('backend/js/matrix.js')}}"></script> 
<script src="{{asset('backend/js/matrix.tables.js')}}"></script> 
<!--Check Password -->


<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>


</body>
</html>
