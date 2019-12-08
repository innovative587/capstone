
$(document).ready(function(){

	$("#new_pwd").click(function(){
		var current_pwd = $("#current_pwd").val();
		// alert(current_pwd);
		$.ajax({
			type:'get',
			url:'/admin/check-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				//alert(resp);
				if(resp=="false"){
					$("#chkPwd").html("<font color='red'>Current Password is Incorrect</font>");
				}else if(resp=="true"){
					$("#chkPwd").html("<font color='green'>Current Password is Correct</font>");
				}
			},error:function(){
				alert("Error");
			}
		});
	});

	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	// Add Category Validation
    $("#Add_category").validate({
		rules:{
			category_name:{
				required:true
			},
			description:{
				required:true
			},
			url:{
				required:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	// Add Event Validation
    $("#add_event").validate({
		rules:{
			event_name:{
				required:true
			},
			event_address:{
				required:true
			},
			event_sched:{
				required:true
			},
			description:{
				required:true
			},
			event_fee:{
				number:true
			},
			event_capacity:{
				required:true,
				number:true
			},
			latitude:{
				required:true
			},
			longitude:{
				required:true
			},
			image:{
				required:true,
				extension:"jpg|jpeg|png|ico|bmp",
				max:2048
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});


    // Add Event Validation Owner
    $("#add_event_owner").validate({
		rules:{
			event_name:{
				required:true
			},
			event_address:{
				required:true
			},
			event_sched:{
				required:true
			},
			description:{
				required:true
			},
			event_fee:{
				number:true
			},
			event_capacity:{
				number:true
			},
			latitude:{
				required:true
			},
			longitude:{
				required:true
			},
			image:{
				required:true,
				extension:"jpg|jpeg|png|ico|bmp",
				max:2048
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	// Edita Event Validation
    $("#edit_event").validate({
		rules:{
			event_name:{
				required:true
			},
			event_address:{
				required:true
			},
			event_sched:{
				required:true
			},
			description:{
				required:true
			},
			event_fee:{
				number:true
			},
			event_capacity:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#password_validate").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#delCat").click(function(){
		if(confirm('Are you sure you want to delete this Category?')){
			return true;
		}
		return false;
	});
	
	$("#delEvent").click(function(){
		if(confirm('Are you sure you want to delete this Event?')){
			return true;
		}
		return false;
	});

	$("#delReservation").click(function(){
		if(confirm('Are you sure you want to delete this Reservation?')){
			return true;
		}
		return false;
	});

	$("#delUser").click(function(){
		if(confirm('Are you sure you want to delete this User?')){
			return true;
		}
		return false;
	});

	

	$(document).ready(function(){
	    $('input.timepicker').timepicker({});
	});



	$(document).ready(function(){
	    var maxField = 10; //Input fields increment limitation
	    var addButton = $('.add_button'); //Add button selector
	    var wrapper = $('.field_wrapper'); //Input field wrapper
	    var fieldHTML = '<div style="padding-left: 10px;"><input type="text" name="time[]" id="time" class="span3" placeholder="Time" style="margin-right: 5px;" /><textarea class="span8" name="description[]" id="description" placeholder="Description" style="margin-top: 5px;"></textarea><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
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

	    $('.time').timepicker();
	});
});
