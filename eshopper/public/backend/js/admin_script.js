$(document).ready(function(){
	$("#current_pwd").keyup(function(){
		var current_pwd = $("#current_pwd").val();
		//alert(current_pwd);
		$.ajax({
			type:'POST',
			url:'check-current-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
			//alert(resp);
			  if(resp == "false"){
			  $("#chkCurrentPwd").html("<font color=red>Current Password is INCORRECT</font>");
			  }else if(resp == "true"){
			  $("#chkCurrentPwd").html("<font color=green>Current Password is INCORRECT</font>");
			  }
			},error:function (xhr, ajaxOptions, thrownError) {
     			   alert(xhr.status);
      		     	   alert(thrownError);
      			}
		});
	});
});
