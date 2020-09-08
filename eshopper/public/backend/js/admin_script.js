$(document).ready(function(){

	//Check Admin password Currect ot incorrect
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
	
	//
	$(".updateSectionStatus").click(function(){
		var status = $(this).text();
		var section_id = $(this).attr("section_id");
		
		$.ajax({
			type:'POST',
			url:'update-section-status',
			data:{status:status,section_id,section_id},
			success:function(resp){
			//alert(resp['status']);
			//alert(resp['section_id']); 
			if(resp['status']==0){
				$("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Inactive</a>");
			}else{
				$("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Active</a>");
			}
			},error:function(){
				alert("Error");
			}		
		});
	});
	
	//
	$(".updateCategoryStatus").click(function(){
		var status = $(this).text();
		var category_id = $(this).attr("category_id");
		
		$.ajax({
			type:'POST',
			url:'update-category-status',
			data:{status:status,category_id,category_id},
			success:function(resp){
			//alert(resp['status']);
			//alert(resp['section_id']); 
			if(resp['status']==0){
				$("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Inactive</a>");
			}else{
				$("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Active</a>");
			}
			},error:function(){
				alert("Error");
			}		
		});
	});
	
	//Append Categories Level
	$("#section_id").change(function(){
	var section_id = $(this).val();
	//alert(section_id);
	$.ajax({
		type:'POST',
		url:'append-categories-level',
		data:{section_id:section_id},	
		success:function(resp){
			alert("ok");
			$("#appendCategoriesLevel").html(resp);	
		},error:function(){
			alert("Error");
		}
	});
});
	
});
