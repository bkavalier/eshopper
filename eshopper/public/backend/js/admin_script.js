$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
    }
});


$(document).ready(function(){


$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
    }
});


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
	
	//update-category-status
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
	
//Confirm Deletion of Record Category
	$(".confirmDelete").click(function(){
		var name = $(this).attr("name");
		if(confirm("Are you sure to delete this "+name+"?")){
			return true;
		}
		return false;
	});
	
	
	
	
//Confirm Deletion of image 
$(".categoryImageDelete").click(function(){
		var name = $(this).attr("name");
		if(confirm("Are you sure to delete this "+name+"?")){
			return true;
		}
		return false;
	});
		
//update product status

$(".updateProductStatus").click(function(){
		var status = $(this).text();
		var product_id = $(this).attr("product_id");
		
		$.ajax({
			type:'POST',
			url:'update-product-status',
			data:{status:status,product_id:product_id},
			success:function(resp){
			//alert(resp['status']);
			//alert(resp['section_id']); 
			if(resp['status']==0){
				$("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)'>Inactive</a>");
			}else{
				$("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)'>Active</a>");
			}
			},error:function(){
				alert("Error");
			}		
		});
	});
	
	$(".updateAttributeStatus").click(function(){
		var status = $(this).text();
		var attribute_id = $(this).attr("attribute_id");
		
		$.ajax({
			
    
			type:'POST',
			url:'update-attribute-status',
			data:{status:status,attribute_id:attribute_id},
			success:function(resp){
			alert(resp);
			if(resp['status']==0){
				$("#attribute-"+attribute_id).html("Inactive");
			}else{
				$("#attribute-"+attribute_id).html("Active");
			}
			},error:function(){
				alert("Error");
			}

		});
	});
	
	

	
	//ADD DYNAMICALLY FIELDS
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div style="margin-top:10px;margin-left:2px;"><br><input type="text" name="size[]"/><input type="text" name="sku[]"/><input type="text" name="price[]"/><input type="text" name="stock[]"/><a href="javascript:void(0);" class="remove_button">REMOVE</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
	

});
