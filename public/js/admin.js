// JavaScript Document

//============ create head account =============

$('#save_company').click(function(){
	$('.loader-bg').show();

	$('#company_name, #ntn_number, #company_address, #contact_person, #contact_mobile, #whats_app, #conaddNew_citytact_email, #account_name, #login_email, #password, #confirm_password').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	$('#head_country').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #aaa !important');
	$('#head_city').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #aaa !important');
	$('#head_role').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #aaa !important');

	var company_name = $('#company_name').val();
	var ntn_number = $('#ntn_number').val();
	var company_address = $('#company_address').val();
	var contact_person = $('#contact_person').val();
	var contact_mobile = $('#contact_mobile').val();
	var whats_app = $('#whats_app').val();
	var contact_email = $('#contact_email').val();
	var head_country = $('#head_country option:selected').val();
	var head_city = $('#head_city option:selected').val();
	var account_name = $('#account_name').val();
	var login_email = $('#login_email').val();
	var password = $('#password').val();
	var confirm_password = $('#confirm_password').val();
	var head_role = $('#head_role option:selected').val();
	var email_regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var flag = 'false';

	if(company_name == ''){
		$('#company_name').css('border-bottom','1px solid #f00');
		flag = 'true';
	}
	if(ntn_number == ''){
		$('#ntn_number').css('border-bottom','1px solid #f00');
		flag = 'true';
	}
	if(company_address == ''){
		$('#company_address').css('border-bottom','1px solid #f00');
		flag = 'true';
	}
	if(contact_person == ''){
		$('#contact_person').css('border-bottom','1px solid #f00');
		flag = 'true';
	}
	if(contact_mobile == ''){
		$('#contact_mobile').css('border-bottom','1px solid #f00');
		flag = 'true';
	}
	if(whats_app == ''){
		$('#whats_app').css('border-bottom','1px solid #f00');
		flag = 'true';
	}
	if(contact_email == ''){
		$('#contact_email').css('border-bottom','1px solid #f00');
		flag = 'true';
	}else{
		if(!email_regex.test(contact_email)){
			$('#contact_email').css('border-bottom','1px solid #f00');
			flag = 'true';
		}
	}
	if(head_country == '0'){
		$('#head_country').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #f00 !important');
		flag = 'true';
	}
	/*if(head_city == '0'){
		$('#head_city').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #f00 !important');
		flag = 'true';
	}*/
	if(account_name == ''){
		$('#account_name').css('border-bottom','1px solid #f00');
		flag = 'true';
	}
	if(login_email == ''){
		$('#login_email').css('border-bottom','1px solid #f00');
		flag = 'true';
	}else{
		if(!email_regex.test(login_email)){
			$('#login_email').css('border-bottom','1px solid #f00');
			flag = 'true';
		}
	}
	/*if(password == ''){
		$('#password').css('border-bottom','1px solid #f00');
		flag = 'true';
	}else if(confirm_password == ''){
		$('#confirm_password').css('border-bottom','1px solid #f00');
		flag = 'true';
	}else{
		if(password != confirm_password){
			$('#password').css('border-bottom','1px solid #f00');
			$('#confirm_password').css('border-bottom','1px solid #f00');
			flag = 'true';
		}
	}*/
	if(head_role == '0'){
		$('#head_role').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #f00 !important');
		flag = 'true';
	}

	if(flag == 'true'){
		$('.loader-bg').hide();
		return false;
	}
	$('.loader-bg').hide();
	$('#save_company_form').submit();
	toastr.success('Operation successfull.');
});

//============ create user =============

$('#save_user').click(function(){
	$('.loader-bg').show();

	$('#user_acc_name, #user_mobile_number, #user_email, #user_password').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	$('#user_role').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #aaa !important');

	var user_acc_name = $('#user_acc_name').val();
	var user_mobile_number = $('#user_mobile_number').val();
	var user_email = $('#user_email').val();
	var user_password = $('#user_password').val();
	var user_role = $('#user_role option:selected').val();
	var email_regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var user_id = $('#user_id').val();
	var toast = '';
	var flag = 'false';

	if(user_acc_name == ''){
		$('#user_acc_name').css('border-bottom','1px solid #f00');
		toast += 'Account name is required.</br>';
		flag = 'true';
	}
	if(user_mobile_number == ''){
		$('#user_mobile_number').css('border-bottom','1px solid #f00');
		toast += 'Mobile number is required.</br>';
		flag = 'true';
	}
	if(user_email == ''){
		$('#user_email').css('border-bottom','1px solid #f00');
		toast += 'Email address is required.</br>';
		flag = 'true';
	}else{
		if(!email_regex.test(user_email)){
			$('#user_email').css('border-bottom','1px solid #f00');
			toast += 'Enter correct email address.</br>';
			flag = 'true';
		}
	}
	if(user_id == ''){
		if(user_password == ''){
			$('#user_password').css('border-bottom','1px solid #f00');
			toast += 'Password is required.</br>';
			flag = 'true';
		}
	}

	if(user_role == '0'){
		$('#user_role').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #f00 !important');
		toast += 'Role is required.</br>';
		flag = 'true';
	}

	if(flag == 'true'){
		$('.loader-bg').hide();
		toastr.error(toast);
		return false;
	}
	$('.loader-bg').hide();
	$('#save_user_form').submit();
	toastr.success('Operation successfull.');
});
function roles(type)
{
	$('.loader-bg').show();
	$('#role_company').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid rgba(0,0,0,0.12)');
	$('#role_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	$("#role-modal").modal();
	if(type=='submit')
	{
		var role_company = $('#role_company option:selected').val();
		var role_name = $('#role_name').val();
		var toast = '';
		var flag = 'false';
		if(role_company == '0'){
			$('#role_company').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #f00 !important');
			toast += 'Select company.</br>';
			flag = 'true';
		}
		if(role_name == ''){
			$('#role_name').css('border-bottom','1px solid #f00');
			toast += 'Enter Menu name.';
			flag = 'true';
		}
		if(flag == 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}
		$.ajax({
			url:"ajax_call/get_roles",
			data:$("#role-form").serialize(),
			type:"POST",
			success:function(data)
			{
				document.getElementById("role-form").reset();
				get_roles();
				$('.loader-bg').hide();
				$('#role_company').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid rgba(0,0,0,0.12)');
				$('#role_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
				$("#role-modal").modal('hide');
				toastr.success('Operation successfull.');
			},
			cache:false,
		});
	}
	$('.loader-bg').hide();
}
function edit_roles(role_id)
{
	$('.loader-bg').show();
	$('#role_company').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid rgba(0,0,0,0.12)');
	$('#role_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	$.ajax({
		url:"ajax_call/edit_roles?role_id="+role_id,
		dataType:"JSON",
		success:function(data)
		{
			$("#role-form input[name='role_id']").val(data.role_id);
			$("#role-form input[name='role_name']").val(data.role_name);
			$("#role-form select[name*='comp_id']").val(data.comp_id);
			$(".md-input-wrapper > label").css("top","-9px");
			$(".js-example-basic-single").select2();
			$("#role-modal").modal();
			$('.loader-bg').hide();
		},
		cache:false,
	});
}
//===========================================menus===========================================
function addMenu()
{
	$('.loader-bg').show();
	$('#menu_name, #menu_sorting').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	var menu_name = $('#menu_name').val();
	var menu_sorting = $('#menu_sorting option:selected').val();
	var toast = '';
	var flag = 'false';
	if(menu_name == ''){
		$('#menu_name').css('border-bottom','1px solid #f00');
		toast += 'Menu name is required.</br>';
		flag = 'true';
	}
	if(menu_sorting == '0'){
		$('#menu_sorting').css('border-bottom','1px solid #f00');
		toast += 'Select Menu sort order.';
		flag = 'true';
	}
	if(flag == 'true'){
		$('.loader-bg').hide();
		toastr.error(toast);
		return false;
	}
	$.ajax({
		url:"ajax_call/get_menus",
		type:"POST",
		data:$("#menu-form").serialize(),
		success: function(data)
		{
			if(data==1){
			document.getElementById("menu-form").reset();
			$("#menu-form").find("button").text('Submit');
			success_loader();
				$('#menu_name, #menu_sorting').css('border-bottom','1px solid rgba(0,0,0,0.12)');
			 }
			if(data==0){
			error_loader(); }
			get_menus();
			$('.loader-bg').hide();
			toastr.success('Operation successfull.');
		},
		cache:false,
	});
}

function get_menus()
{
	var htmlData="";
	$("#loader").modal({ backdrop: 'static'});
	$.ajax({
		url:"ajax_call/get_menus",
		dataType:"JSON",
		success: function(data)
		{
			for(i=0; i<data.length; i++)
			{
				htmlData+='<tr id="'+data[i]['id']+'">';
					htmlData+='<td>'+(Number(i)+1)+'</td>';
					htmlData+='<td>'+data[i]['menu']+'</td>';
					htmlData+='<td>'+null_val(data[i]['pm'])+'</td>';
					htmlData+='<td>N/A</td>';
					htmlData+='<td>'+data[i]['created_at']+'</td>';
					htmlData+='<td><button type="button" class="btn btn-primary btn-icon waves-effect wave-light" onclick="edit_menus('+data[i]['id']+')">'+
						'<i class="fa fa-edit"></i></button>'+
						' <button type="button" class="btn btn-danger btn-icon waves-effect wave-light" onclick="del_rec(\'../\', \'menu\', \''+data[i]['id']+'\')">'+
						'<i class="fa fa-trash"></i></button>'+
						'</td>';
					htmlData+='</tr>';
			}
			$(".get_menus").html(htmlData);
			$("#loader").modal('hide');
		}
	});
}
function edit_menus(menu_id)
{
	$('.loader-bg').show();
	$('#menu_name, #menu_icon_class, #menu_link').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	$.ajax({
		url:"ajax_call/edit_menus?menu_id="+menu_id,
		dataType:"JSON",
		success: function(data)
		{
			$(window).scrollTop(0);
			$("#menu_id").val(menu_id);
			$("#menu-form input[name*='menu_name']").val(data.menu_name);
			$("#menu-form input[name*='menu_link']").val(data.menu_link);
			$("#menu-form select[name*='sort']").val(data.sorting);
			$("#menu-form input[name*='icon_classes']").val(data.icon_classes);
			if(data.parent_menu!=0){
			$("#menu-form select[name*='parent_menu']").val(data.parent_menu); }
			$(".md-input-wrapper > label").css("top","-9px");
			$("#menu-form").find("button").text('Update');
			$('.loader-bg').hide();
		}
	})
}
//====================================Assign roles============================
function assign_roles(formData)
{
	$('.loader-bg').show();
	if(formData == 'form'){
		$('#comp_id').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid rgba(0,0,0,0.12)');
		$('#roleId').css('border-bottom','1px solid rgba(0,0,0,0.12)');
		$('#ms-public-methods').find('.ms-selection ul').css('border-bottom','1px solid #ccc');

		var comp_id = $('#comp_id option:selected').val();
		var roleId = $('#roleId option:selected').val();
		var menus = $('#public-methods').val();
		var toast = '';
		var flag = 'false';
		if(comp_id == '0'){
			$('#comp_id').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #f00 !important');
			toast += 'Select company.</br>';
			flag = 'true';
		}
		if(roleId == '0'){
			$('#roleId').css('border-bottom','1px solid #f00');
			toast += 'Select role.</br>';
			flag = 'true';
		}
		if($.isArray(menus)){
			$('#ms-public-methods').find('.ms-selection ul').css('border-bottom','1px solid #ccc');
		}else{
			$('#ms-public-methods').find('.ms-selection ul').css('border-bottom','1px solid #f00');
			toast += 'Select menu items to assign.';
			flag = 'true';
		}
		if(flag == 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}else{
			$('#comp_id').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid rgba(0,0,0,0.12)');
			$('#roleId').css('border-bottom','1px solid rgba(0,0,0,0.12)');
			$('#ms-public-methods').find('.ms-selection ul').css('border-bottom','1px solid #ccc');
		}
	}else if(formData == 'edit-ar-form'){
		$('#Ecomp_id').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid rgba(0,0,0,0.12)');
		$('#Erole_id').css('border-bottom','1px solid rgba(0,0,0,0.12)');
		$('#custom-headers1').find('.ms-selection ul').css('border-bottom','1px solid #ccc');

		var comp_id = $('#Ecomp_id option:selected').val();
		var roleId = $('#Erole_id option:selected').val();
		var menus = $('#custom-headers1').val();
		var toast = '';
		var flag = 'false';
		if(comp_id == '0'){
			$('#Ecomp_id').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #f00 !important');
			toast += 'Select company.</br>';
			flag = 'true';
		}
		if(roleId == '0'){
			$('#Erole_id').css('border-bottom','1px solid #f00');
			toast += 'Select role.</br>';
			flag = 'true';
		}
		if($.isArray(menus)){
			$('#custom-headers1').find('.ms-selection ul').css('border-bottom','1px solid #ccc');
		}else{
			$('#custom-headers1').find('.ms-selection ul').css('border-bottom','1px solid #f00');
			toast += 'Select menu items to assign.';
			flag = 'true';
		}
		if(flag == 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}else{
			$('#Ecomp_id').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid rgba(0,0,0,0.12)');
			$('#Erole_id').css('border-bottom','1px solid rgba(0,0,0,0.12)');
			$('#custom-headers1').find('.ms-selection ul').css('border-bottom','1px solid #ccc');
		}
	}


	$.ajax({
		url:"ajax_call/get_assign_menu",
		type:"POST",
		data:$("#"+formData).serializeArray(),
		success: function(data)
		{
			if(data==1)
			{
				if(formData=='edit-ar-form'){ $("#edit_assign_role-modal").modal('hide'); }
				get_assign_menus();
				toastr.success('Operation successfull.');
				window.location='../administration/assign_roles';
			}
			$('.loader-bg').hide();
		},
		cache:false,

	});
}
function get_assign_menus()
{
	$("#loader").modal({ backdrop: 'static'});
	$.ajax({
		url:"ajax_call/get_assign_menu",
		dataType:"JSON",
		success: function(data)
		{
			var htlmlData="";
			for(i in data)
			{
				htlmlData+="<tr id='"+data[i].id+"'>";
				 htlmlData+="<td>"+Number(i+1)+"</td>";
				 htlmlData+="<td>"+data[i].role_name+"</td>";
				 htlmlData+="<td>"+data[i].menu+"</td>";
				 htlmlData+="<td>"+data[i].created_at+"</td>";
				 htlmlData+='<td><button type="button" class="btn btn-primary btn-icon waves-effect wave-light" onclick="edit_assign_role('+data[i].id+')">'+
						'<i class="fa fa-edit"></i></button>'+
						' <button type="button" class="btn btn-danger btn-icon waves-effect wave-light" onclick="del_rec(\'../\', \'assign_role\', \''+data[i].id+'\')">'+
						'<i class="fa fa-trash"></i></button>'+
						'</td>';
				htlmlData+="</tr>";

			}
			$(".get_assign_menu").html(htlmlData);
			$("#loader").modal('hide');
		}
	});
}
function edit_assign_role(id)
{
	$("#edit_assign_role-modal").modal();
	$.ajax({
		url:"ajax_call/edit_assign_role?id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#edit-ar-form input[name='assign_role_id']").val(id);
			$("#edit-ar-form select[name='role_id']>option[value='"+data.role_id+"']").attr("selected","selected");
			$("#edit-ar-form select[name='comp_id']>option[value='"+data.comp_id+"']").attr("selected","selected");
			var m=data.menu_id.split(',');
			$.each(m, function( index, value ) {
			  $("#edit-ar-form #thisSelect select>option[value='"+value+"']").attr("selected","selected");
			});
			$("#custom-headers1").multiSelect();
			$(".js-example-basic-single").select2();
		}
	});
}
function get_head_acc()
{
	$.ajax({
		url:"ajax_call/get_head_accList",
		dataType:"JSON",
		success: function(data)
		{
			var htlmlData="";
			for(i in data)
			{
				htlmlData+="<tr id='"+data[i].comp_id+"'>";
				 htlmlData+="<td>"+Number(i+1)+"</td>";
				 htlmlData+="<td>"+data[i].comp_name+"</td>";
				 htlmlData+="<td>"+data[i].contact_person+"</td>";
				 htlmlData+="<td>"+data[i].contact_email+"</td>";
				 htlmlData+="<td><img src='../comp_logo/"+data[i].comp_logo+"' width='50'></td>";
				 htlmlData+='<td><a  class="btn btn-success btn-icon waves-effect wave-light" href="company_details?comp_id='+data[i].comp_id+'" title="View">'+
						'<i class="fa fa-eye"></i></a>'+
						' <a class="btn btn-primary btn-icon waves-effect wave-light" href="create_head_acc?comp_id='+data[i].comp_id+'">'+
						'<i class="fa fa-edit"></i></a>'+
						'</td>';
				htlmlData+="</tr>";

			}
			$(".get_head_acc").html(htlmlData);
			$("#loader").modal('hide');
		},
		cache:false,
	});
}
//get countires list
function add_country()
{
	$('.loader-bg').show();

	$('#country_name, #short_name, #country_code').css('border-bottom','1px solid rgba(0,0,0,0.12)');

	var country_name = $('#country_name').val();
	var country_code = $('#country_code').val();
	var short_name = $('#short_name').val();
	var toast = '';
	var flag = 'false';
	if(country_name == ''){
		$('#country_name').css('border-bottom','1px solid #f00');
		toast += 'Country name is required.</br>';
		flag = 'true';
	}
	if(country_code == ''){
		$('#country_code').css('border-bottom','1px solid #f00');
		toast += 'Country code is required.</br>';
		flag = 'true';
	}
	if(short_name == ''){
		$('#short_name').css('border-bottom','1px solid #f00');
		toast += 'Country short name is required.';
		flag = 'true';
	}

	if(flag == 'true'){
		$('.loader-bg').hide();
		toastr.error(toast);
		return false;
	}
	$.ajax({
		url:"ajax_call/get_countries",
		type:"POST",
		data:$("#form").serialize(),
		success: function(data)
		{
			if(data=="1") { document.getElementById("form").reset();
				success_loader();
				get_countries();
				$("#form").closest("button").text('Submit');
				$('#country_name, #short_name, #country_code').css('border-bottom','1px solid rgba(0,0,0,0.12)');
				toastr.success('Operation successfull.');
			 }
			 else { error_loader(); }
			$('.loader-bg').hide();
		},
		cache:false,
	});
}
function get_countries(p=1)
{
	$("#loader").modal({ backdrop: 'static'});
	$.ajax({
		url:"ajax_call/get_countries?page="+p,
		dataType:"JSON",
		success: function(data)
		{
			var htlmlData="";
			var j=data['start']+1;
			for(i in data['rec'])
			{
				htlmlData+="<tr id='"+data['rec'][i].id+"'>";
				 htlmlData+="<td>"+Number(j++)+"</td>";
				 htlmlData+="<td>"+data['rec'][i].country_name+"</td>";
				  htlmlData+="<td>"+data['rec'][i].country_code+"</td>";
				   htlmlData+="<td>"+data['rec'][i].short_name+"</td>";
				 htlmlData+='<td><button type="button" class="btn btn-primary btn-icon waves-effect wave-light" onclick="edit_country('+data['rec'][i].id+')">'+
						'<i class="fa fa-edit"></i></button>'+
						' <button type="button" class="btn btn-danger btn-icon waves-effect wave-light" onclick="del_rec(\'../\', \'country\', \''+data['rec'][i].id+'\')">'+
						'<i class="fa fa-trash"></i></button>'+
						'</td>';
				htlmlData+="</tr>";
			j++;
			}
			$(".get_countries").html(htlmlData);
			pagination(data['total_rec'],data['cp'],data['pp'],data['func']);
			$("#loader").modal('hide');

		}
	});
}
function edit_country(id)
{
	$('.loader-bg').show();
	$('#country_name, #short_name, #country_code').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	$.ajax({
		url:"ajax_call/edit_country?id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$(window).scrollTop(0);
			$("#form input[name*='id']").val(id);
			$("#form input[name*='country_code']").val(data.country_code);
			$("#form input[name*='country_name']").val(data.country_name);
			$("#form input[name*='short_name']").val(data.short_name);
			$(".md-input-wrapper > label").css("top","-9px");
			$("#form").find("button").text('Update');
			$('.loader-bg').hide();
		}
	});
}
// cities
function add_city()
{
	$('.loader-bg').show();

	$('#city_country').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid rgba(0,0,0,0.12)');
	$('#city_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');

	var city_country = $('#city_country option:selected').val();
	var city_name = $('#city_name').val();
	var toast = '';
	var flag = 'false';
	if(city_country == '0'){
		$('#city_country').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #f00 !important');
		toast += 'Select country.</br>';
		flag = 'true';
	}
	if(city_name == ''){
		$('#city_name').css('border-bottom','1px solid #f00');
		toast += 'City name is required.';
		flag = 'true';
	}
	if(flag == 'true'){
		$('.loader-bg').hide();
		toastr.error(toast);
		return false;
	}
	$.ajax({
		url:"ajax_call/get_cities",
		type:"POST",
		data:$("#form").serialize(),
		success: function(data)
		{
			if(data=="1"){
				document.getElementById("form").reset();
				success_loader();
				get_cities();
				$('#city_country').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid rgba(0,0,0,0.12)');
				$('#city_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
				toastr.success('Operation successfull.');
			}
			else { error_loader(); }
			$('.loader-bg').hide();
		}
	});
}
function edit_city(id)
{
	$('.loader-bg').show();
	$('#city_country').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid rgba(0,0,0,0.12)');
	$('#city_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	$.ajax({
		url:"ajax_call/edit_city?id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#form input[name*='id']").val(id);
			$("#form select[name*='country_code']").val(data.country_code);
			$("#form input[name*='city_name']").val(data.city_name);
			$(".md-input-wrapper > label").css("top","-9px");
			$("#form").find("button").text('Update');
			$(".js-example-basic-single").select2();
			$('.loader-bg').hide();
		}
	});
}
function get_cities()
{
	$("#loader").modal({ backdrop: 'static'});
	$.ajax({
		url:"ajax_call/get_cities",
		dataType:"JSON",
		success: function(data)
		{
			var htlmlData="";
			var j=1;
			for(i in data)
			{
				htlmlData+="<tr id='"+data[i].cityId+"'>";
				 htlmlData+="<td>"+Number(j)+"</td>";
				 htlmlData+="<td>"+data[i].city_name+"</td>";
				 htlmlData+="<td>"+data[i].country_name+"</td>";
				 htlmlData+='<td><button type="button" class="btn btn-primary btn-icon waves-effect wave-light" onclick="edit_city('+data[i].cityId+')">'+
						'<i class="fa fa-edit"></i></button>'+
						' <button type="button" class="btn btn-danger btn-icon waves-effect wave-light" onclick="del_rec(\'../\', \'city\', \''+data[i].cityId+'\')">'+
						'<i class="fa fa-trash"></i></button>'+
						'</td>';
				htlmlData+="</tr>";
			j++;
			}
			$(".get_cities").html(htlmlData);
			$("#loader").modal('hide');
		},
		cache:false,
	});
}
function view_user(id)
{
	$("#view-user").modal();
	$.ajax({
		url:"ajax_call/edit_user?id="+id,
		dataType:"JSON",
		success: function(data)
		{
			var htmlData="";
			htmlData+="<tr><th>Name</th><td>"+data.acc_name+"</td></tr>";
			htmlData+="<tr><th>Department</th><td>"+data.department
			htmlData+="<tr><th>Mobile #</th><td>"+data.mobile_number+"</td></tr>";+"</td></tr>";
			htmlData+="<tr><th>Email</th><td>"+data.email+"</td></tr>";
			htmlData+="<tr><th>DOB</th><td>"+data.dob+"</td></tr>";
			$(".veiwUser").html(htmlData);

		}
	});
}
// get roles against companies
$("#comp_id").on("change", function()
{
	var cId=$(this).val();
	$.ajax({
		url:"ajax_call/get_companies?cId="+cId,
		success: function(data)
		{
			$("#roleId").html(data);
		}
	});
});
$("#Ecomp_id").on("change", function()
{
	var cId=$(this).val();
	$.ajax({
		url:"ajax_call/get_companies?cId="+cId,
		success: function(data)
		{
			$("#Erole_id").html(data);
		}
	});
});
//==========================Ariline GDS===========================
function add_gds()
{
	var gds_name = $('#gds_name').val();

	if(gds_name == ''){
		$('#gds_name').css('border-bottom','1px solid #f00');
		toastr.error('Enter gds name.');
		return false;
	}else{
		$('#gds_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	}
	$.ajax({
		url:"ajax_call/get_gds",
		data:$("#form").serialize(),
		type:"POST",
		success: function(data)
		{
			if(data==1)
			{
				document.getElementById("form").reset();
				success_loader();
				get_gds();
				$("#form").find(".btn").text('Submit');
				toastr.success('Operation successfull.');
			}
			else
			{
				error_loader();
			}
		}
	});
}
function edit_gds(id)
{
	$('#gds_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	$(window).scrollTop(0);
	$.ajax({
		url:"ajax_call/edit_gds?id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#form input[name*='id']").val(id);
			$("#form input[name*='gds_name']").val(data.gds_name);
			$(".md-input-wrapper > label").css("top","-9px");
			$("#form").find("button").text('Update');
		}
	});
}
function get_gds()
{
	$.ajax({
		url:"ajax_call/get_gds",
		dataType:"JSON",
		success: function(data)
		{
			var htmlData=""; j=1;
			for(i in data)
			{
				htmlData+='<tr>';
					htmlData+='<td>'+j+'</td>';
					htmlData+='<td>'+data[i].gds_name+'</td>';
					htmlData+='<td>'+data[i].created_at+'</td>';
					htmlData+='<td><a  class="btn btn-primary btn-icon waves-effect wave-light" onclick="edit_gds('+data[i].id+')">'+
						'<i class="fa fa-edit"></i>'+
						'</a> <button type="button" class="btn btn-danger btn-icon waves-effect wave-light" onclick="del_rec(\'../\', \'user\', \''+data[i].id+'\')">'+
						'<i class="fa fa-trash"></i></button></td>';
				htmlData+='</tr>';
				j++;
			}
			$(".get_gds").html(htmlData);
		}
	});
}
//================new branch=========
function addNew_branch(type="")
{
	$('.loader-bg').show();

	if(type=='submit'){
		var branch_name = $('#branch_name').val();
		var manager_name = $('#manager_name').val();
		var manager_email = $('#manager_email').val();
		var manager_mobile = $('#manager_mobile').val();
		var branch_location = $('#branch_location').val();
		var toast = '';
		var flag = 'false';
		if(branch_name == ''){
			$('#branch_name').css('border-bottom','1px solid #f00');
			toast += 'Branch name is required.</br>';
			flag = 'true';
		}
		if(manager_name == ''){
			$('#manager_name').css('border-bottom','1px solid #f00');
			toast += 'Manager name is required.</br>';
			flag = 'true';
		}
		if(manager_mobile == ''){
			$('#manager_mobile').css('border-bottom','1px solid #f00');
			toast += 'Manager mobile number is required.</br>';
			flag = 'true';
		}
		if(manager_email == ''){
			$('#manager_email').css('border-bottom','1px solid #f00');
			toast += 'Manager email is required.</br>';
			flag = 'true';
		}
		if(branch_location == ''){
			$('#branch_location').css('border-bottom','1px solid #f00');
			toast += 'Branch location is required.';
			flag = 'true';
		}
		if(flag == 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}
		$.ajax({
			url:"ajax_call/get_branches",
			type:"POST",
			data:$("#branch-form").serialize(),
			success: function(data)
			{
				if(data==1){
					document.getElementById("branch-form").reset();
					success_loader();
					get_branches();
					$("#new-branch").modal('hide');
					$('.loader-bg').hide();
					toastr.success('Operation successfull.');
				}
			},
			cache:false,
		});
	}else{
		$('#branch_name, #manager_name, #manager_mobile, #manager_email, #branch_location').css('border-bottom','1px solid rgba(0,0,0,0.15)');
		$('#branch_name').val('');
		$('#manager_name').val('');
		$('#manager_email').val('');
		$('#manager_mobile').val('');
		$('#branch_location').val('');
		$("#new-branch").modal();
	}
	$('.loader-bg').hide();
}
function edit_branch(id)
{
	$('#branch_name, #manager_name, #manager_mobile, #manager_email, #branch_location').css('border-bottom','1px solid rgba(0,0,0,0.15)');
	$.ajax({
		url:"ajax_call/edit_branch?id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#new-branch").modal();
			$("#branch-form input[name~='id']").val(id);
			$("#branch-form input[name~='name']").val(data.name);
			$("#branch-form input[name~='manager_name']").val(data.manager_name);
			$("#branch-form input[name~='manager_mobile']").val(data.manager_mobile);
			$("#branch-form input[name~='manager_email']").val(data.manager_email);
			$("#branch-form input[name~='branch_address']").val(data.branch_address);
			$("#branch-form input[name~='branch_email']").val(data.branch_email);
			$("#branch-form input[name~='branch_phone']").val(data.branch_phone);
		},
		cache:false,
	});
}
function get_branches()
{
	$.ajax({
		url:"ajax_call/get_branches",
		dataType:"JSON",
		success: function(data)
		{
			var htmlData=""; j=1;
			for(i in data){
				htmlData+="<tr id='"+data[i].id+"'>";
					htmlData+='<td>'+j+'</td>';
					htmlData+='<td>'+data[i].name+'</td>';
					htmlData+='<td>'+data[i].manager_name+'</td>';
					htmlData+='<td>'+data[i].manager_mobile+'</td>';
					htmlData+='<td>'+data[i].created_at+'</td>';
					htmlData+='<td>'+data[i].status+'</td>';
					htmlData+='<td><a  class="btn btn-success btn-icon waves-effect wave-light font-white" onclick="view_branch('+data[i].id+')">'+
						'<i class="fa fa-eye"></i></a>'+
					' <a  class="btn btn-primary btn-icon waves-effect wave-light" onclick="edit_branch('+data[i].id+')">'+
						' <i class="fa fa-edit"></i>'+
						'</a> <button type="button" class="btn btn-danger btn-icon waves-effect wave-light" onclick="del_rec(\'../\', \'branch\', \''+data[i].id+'\')">'+
						'<i class="fa fa-trash"></i></button></td>';
				htmlData+="</tr>";
				j++;
			}
			$(".get_branches").html(htmlData);
		},
		cache:false
	});
}
function view_branch(id)
{
	$("#view-branch").modal();
	$.ajax({
		url:"ajax_call/edit_branch?id="+id,
		dataType:"JSON",
		success: function(data)
		{
			var htmlData="";
			htmlData+="<tr><th>Branch Name</th><td>"+data.name+"</td></tr>";
			htmlData+="<tr><th>Manager Name</th><td>"+data.manager_name
			htmlData+="<tr><th>Manager Mobile</th><td>"+data.manager_mobile+"</td></tr>";+"</td></tr>";
			htmlData+="<tr><th>Manager Email</th><td>"+data.manager_email+"</td></tr>";
			htmlData+="<tr><th>Branch Email</th><td>"+data.branch_email+"</td></tr>";
			htmlData+="<tr><th>Branch Phone</th><td>"+data.branch_phone+"</td></tr>";
			htmlData+="<tr><th>Location</th><td>"+data.branch_address+"</td></tr>";
			$(".veiwBranches").html(htmlData);

		}
	});
}
///===========================Airline codes=================
function addNew_airline_code()
{
	$('.loader-bg').show();
	$('#airline_name, #airline_short_name, #airline_code').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	var airline_name = $('#airline_name').val();
	var airline_short_name = $('#airline_short_name').val();
	var airline_code = $('#airline_code').val();
	var toast = '';
	var flag = 'false';
	if(airline_name == ''){
		$('#airline_name').css('border-bottom','1px solid #f00');
		toast += 'Airline name is required.</br>';
		flag = 'true';
	}
	if(airline_short_name == ''){
		$('#airline_short_name').css('border-bottom','1px solid #f00');
		toast += 'Airline short name is required.</br>';
		flag = 'true';
	}
	if(airline_code == ''){
		$('#airline_code').css('border-bottom','1px solid #f00');
		toast += 'Airline code is required.</br>';
		flag = 'true';
	}
	if(flag == 'true'){
		$('.loader-bg').hide();
		toastr.error(toast);
		return false;
	}
	$.ajax({
		url:"ajax_call/get_airline_codes",
		type:"POST",
		data:$("#form").serialize(),
		success: function(data)
		{
			if(data==1){
				document.getElementById("form").reset();
				success_loader();
				get_airline_codes(p=1);
				$('#airline_name, #airline_short_name, #airline_code').css('border-bottom','1px solid rgba(0,0,0,0.12)');
				toastr.success('Operation successfull.');
			}else {
				error_loader();
			}
			$('.loader-bg').hide();
		}
	});
}
function get_airline_codes(p=1)
{
	$.ajax({
		url:"ajax_call/get_airline_codes?page="+p,
		dataType:"JSON",
		data:$("#search-form").serialize(),
		type:"POST",
		success: function(data)
		{
			var htmlData=""; j=data['start']+1;
			for(i in data['rec']){
			htmlData+='<tr id="'+data['rec'][i].id+'">';
				htmlData+='<td>'+j+'</td>';
				htmlData+='<td>'+data['rec'][i].airline_name+'</td>';
				htmlData+='<td>'+data['rec'][i].two_str_code+'</td>';
				htmlData+='<td>'+data['rec'][i].airline_code+'</td>';
				htmlData+='<td>'+data['rec'][i].airline_short_name+'</td>';
				htmlData+='<td>'+data['rec'][i].country+'</td>';
				htmlData+='<td><button type="button" class="btn btn-danger btn-icon" onclick="del_rec(\'../\', \'airline_code\', \''+data['rec'][i].id+'\')"> <i class="fa fa-trash"></i></button></td>';
			htmlData+='</tr>';
			j++;
			}
			$(".get_airline_codes").html(htmlData);
			pagination(data['total'],data['cp'],data['pp'],data['func']);
		}
	});
}
// add hotels
function add_hotel(type)
{

	if(type=='submit'){
		var hotel_name = $('#hhotel_name').val();
		var contact_person = $('#hcontact_person').val();
		var hotel_phone = $('#hhotel_phone').val();
		var country_id = $('#hcountry_id option:selected').val();
		var city_id = $('#hcity_id option:selected').val();
		var hotel_address = $('#hhotel_address').val();
		var toast = '';
		var flag = 'false';
		if(hotel_name == ''){
			$('#hhotel_name').css('border-bottom','1px solid #f00');
			toast += 'Hotel name is required.</br>';
			flag = 'true';
		}
		if(contact_person == ''){
			$('#hcontact_person').css('border-bottom','1px solid #f00');
			toast += 'contact person name is required.</br>';
			flag = 'true';
		}
		if(hotel_phone == ''){
			$('#hhotel_phone').css('border-bottom','1px solid #f00');
			toast += 'Hotel phone number is required.</br>';
			flag = 'true';
		}
		if(hotel_address == ''){
			$('#hhotel_address').css('border-bottom','1px solid #f00');
			toast += 'Hotel address is required.</br>';
			flag = 'true';
		}
		if(flag == 'true'){
			toastr.error(toast);
			return false;
		}
		$.ajax({
			url:"ajax_call/get_hotels",
			type:"POST",
			data:$("#form").serialize(),
			success: function(data)
			{
				if(data==1){
					/*success_loader();*/
					$("#new-hotel").modal('hide');
					document.getElementById("form").reset();
					get_hotels();
					$('#hhotel_name, #hcontact_person, #hhotel_phone, #hhotel_addres').css('border-bottom','rgba(0,0,0,0.15)');
					toastr.success('Operation successfull.');
				}
				else{
					error_loader();
				}
			}
		});
	}else{
		$('#hhotel_name, #hcontact_person, #hhotel_phone, #hhotel_address').css('border-bottom','1px solid rgba(0,0,0,0.15)');
		$("#new-hotel").modal();
	}
}
function edit_hotel(id)
{
	$('#hhotel_name, #hcontact_person, #hhotel_phone, #hhotel_address').css('border-bottom','1px solid rgba(0,0,0,0.15)');
	$.ajax({
		url:"ajax_call/edit_hotel?id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#form input[name~='id']").val(id);
			$("#form input[name~='hotel_name']").val(data['hotel'].hotel_name);
			$("#form input[name~='contact_person']").val(data['hotel'].contact_person);
			$("#form input[name~='phone']").val(data['hotel'].phone);
			$("#form select[name~='country_id']").val(data['hotel'].country_id);
			$("#form select[name~='city_id']").val(data['hotel'].city_id);
			$("#form input[name~='address']").val(data['hotel'].address);
			$(".js-example-basic-single").select2();
			$("#new-hotel").modal();
		}
	});
}
function get_hotels( p=1 )
{
	$.ajax({
		url:"ajax_call/get_hotels?page="+p,
		type:"POST",
		dataType:"JSON",
		success: function(data)
		{
			var htlmlData="";  j=data['start']+1;
			for(i in data['rec']){
				htlmlData+='<tr id="'+data['rec'][i].id+'">';
					htlmlData+='<td>'+j+'</td>';
					htlmlData+='<td>'+data['rec'][i].hotel_name+'</td>';
					htlmlData+='<td>'+data['rec'][i].contact_person+'</td>';
					htlmlData+='<td>'+data['rec'][i].phone+'</td>';
					htlmlData+='<td>'+data['rec'][i].country_name+'</td>';
					htlmlData+='<td>'+data['rec'][i].city_name+'</td>';
					htlmlData+='<td>'+data['rec'][i].status+'</td>';
					htlmlData+='<td><a class="btn btn-primary btn-icon waves-effect wave-light" onclick="edit_hotel('+data['rec'][i].id+')"><i class="fa fa-edit"></i></a>'+
					' <button type="button" class="btn btn-danger btn-icon waves-effect wave-light" onclick="del_rec(\'../\', \'hotel\', \''+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button>'+
					'</td>';
				htlmlData+='</tr>';
				j++;
			}
			$(".get_hotels").html(htlmlData);
			pagination(data['total_rec'],data['cp'],data['pp'],data['func']);
		}
	});
}
$('.country_id').change(function(){
	var country = $(this).val();
	var did = this;
	$.ajax({
		url:"../administration/ajax_call/get_cities",
		type:"POST",
		dataType:"JSON",
		data:{'country_code':country},
		success: function(data)
		{
			if(data != '2'){
				var output = '';
				for(i in data){
					if(data[i].cityId!=undefined){
					output += '<option value="'+data[i].cityId+'">'+data[i].city_name+'</option>'; }
				}
				$(did).parents('.modal-body').find('.city_id').html('<option value="0">Select City</option><option value="other">Other</option>'+output);
			}else{
				$(did).parents('.modal-body').find('.city_id').html('<option value="0">Select City</option><option value="other">Other</option>');
			}
			/*if(data.msg=="1"){
				$('#new-city').modal('hide');
				document.getElementById("city-form").reset();
				toastr.success('Operation successfull.');
				htmlData="<option value='other'>Other</option>";
				for(i in data){
					if(data[i].cityId!=undefined){
						if(data[i].cityId==data.maxId){
						htmlData+="<option selected value='"+data[i].cityId+"'>"+data[i].city_name+"</option>";
						}else{
						htmlData+="<option value='"+data[i].cityId+"'>"+data[i].city_name+"</option>";
						}
					}
				}
				$(".city_id").html(htmlData);
			}
			else { error_loader(); }*/
		}
	});
});
$('#hotel_city').change(function(){
	hotel_city(this);
});
function hotel_city(thisVal){
	var city = $(thisVal).val();
	var country = $(thisVal).parents('.modal-body').find('.country_id').val();
	$('#new_country').val(country);
	if(city == 'other'){
		$('#new-city').modal();
	}
}
function addNew_city(root){
	$.ajax({
		url:root+"ajax_call/get_cities",
		type:"POST",
		dataType:"JSON",
		data:$("#city-form").serialize(),
		success: function(data)
		{
			if(data.msg=="1"){
				$('#new-city').modal('hide');
				document.getElementById("city-form").reset();
				toastr.success('Operation successfull.');
				htmlData="<option value='0'>Select City</option><option value='other'>Other</option>";
				for(i in data){
					if(data[i].cityId!=undefined){
						if(data[i].cityId==data.maxId){
						htmlData+="<option selected value='"+data[i].cityId+"'>"+data[i].city_name+"</option>";
						}else{
						htmlData+="<option value='"+data[i].cityId+"'>"+data[i].city_name+"</option>";
						}
					}
				}
				$(".city_id").html(htmlData);
			}
			else { error_loader(); }
		}
	});
}
function add_hotel_inv(type){
	$('.loader-bg').show();
	if(type=='submit'){
		var vendor_id = $('#hi_vendor_id option:selected').val();
		var hotel_name = $('#hi_hotel_name option:selected').val();
		var confirmation = $('#hi_confirmation').val();
		var checkin = $('.rcheckin').val();
		var checkout = $('.rcheckout').val();
		var toast = '';
		var flag = 'false';
		if(vendor_id == '0'){
			$('#hi_vendor_id').closest('.form-group').find('.select2-selection').css('cssText','border-bottom:1px solid #f00 !important');
			toast += 'Vendor is required.</br>';
			flag = 'true';
		}
		if(hotel_name == '0'){
			$('#hi_hotel_name').closest('.col-md-1').find('.select2-selection').css('cssText','border-bottom:1px solid #f00 !important');
			toast += 'Hotel name is required.</br>';
			flag = 'true';
		}
		if(confirmation == ''){
			$('#hi_confirmation').css('border-bottom','1px solid #f00');
			toast += 'Hotel confirmation number is required.</br>';
			flag = 'true';
		}
		if(checkin == ''){
			$('.rcheckin').css('border-bottom','1px solid #f00');
			toast += 'Check in date is required.</br>';
			flag = 'true'
		}
		if(checkout == ''){
			$('.rcheckout').css('border-bottom','1px solid #f00');
			toast += 'Check out date is required.</br>';
			flag = 'true'
		}
		if(flag == 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}

		$.ajax({
			url:"ajax_call/get_hotel_invList",
			type:"POST",
			data:$("#form").serialize(),
			success: function(data)
			{
				if(data==1){
					$(".er").remove();
					$("#form input[name~='id']").val('');
					/*success_loader();*/
					$("#form input, select").val('');
					$("#form").find(".btn-primary").text('Submit');
					get_hotels(p=1);
					$('.loader-bg').hide();
					$('#hi_vendor_id').closest('.form-group').find('.select2-selection').css('cssText','border-bottom:1px solid #aaa !important');
					$('#hi_hotel_name').closest('.col-md-1').find('.select2-selection').css('cssText','border-bottom:1px solid #aaa !important');
					$('#hi_confirmation, .rcheckin, .rcheckout').css('border-bottom','1px solid rgba(0,0,0,0.15)');
					toastr.success('Operation successfull.');
				}
			},
			cache:false,
		});
	}else{
		$('#hi_vendor_id').closest('.form-group').find('.select2-selection').css('cssText','border-bottom:1px solid #aaa !important');
		$('#hi_hotel_name').closest('.col-md-1').find('.select2-selection').css('cssText','border-bottom:1px solid #aaa !important');
		$('#hi_confirmation, .rcheckin, .rcheckout').css('border-bottom','1px solid rgba(0,0,0,0.15)');
		$("#hotel-Inventory").modal();
		$(".hb").text('Save');
		$('.loader-bg').hide();
	}
}
$(".multi_room").delegate(".rcheckout","change",function(){
	var end=$(this).datepicker("getDate");
	var start=$(this).parents().closest(".remove_room").find(".rcheckin").datepicker("getDate");
	days = (end- start) / (1000 * 60 * 60 * 24);
	tn=Math.round(days);
	$(this).parents().closest(".remove_room").find(".rnights").val(tn);
});
$(".multi_room").delegate(".room_type","change",function(){
	var rt=$(this).val();
		if(rt=='single'){
			$(this).parents().closest(".remove_room").find(".beds").val('1');
		}
		else if(rt=='double'){
			$(this).parents().closest(".remove_room").find(".beds").val('2');
		}
		else if(rt=='triple'){
			$(this).parents().closest(".remove_room").find(".beds").val('3');
		}
		else if(rt=='quad'){
			$(this).parents().closest(".remove_room").find(".beds").val('4');
		}
		else if(rt=='quaint'){
			$(this).parents().closest(".remove_room").find(".beds").val('5');
		}
		else if(rt=='suite'){
			$(this).parents().closest(".remove_room").find(".beds").val('1');
		}
});
$(document).on('change','.remove_room',function() {
	var sum=0;
	g=$(this);
	$(this).each(function(index){
		night=$(this).find(".rnights").val();
		beds=g.find(".beds").val();
		rate=g.find(".rate").val();
		pst=g.find(".pst").val();
		total=Number(rate)*Number(night)*Number(beds)+Number(pst);
		g.find(".total").val(total);
	});
});
function get_hotel_invList(p=1)
{
	$.ajax({
		url:"ajax_call/get_hotel_invList?p="+p,
		dataType:"JSON",
		success: function(data)
		{
			var htmlData=""; j=data['start']+1;
			for(i in data['rec']){
			htmlData+='<tr id="'+data['rec'][i].id+'">';
				htmlData+='<td>'+j+'</td>';
				htmlData+='<td>'+data['rec'][i].hotel_name+'</td>';
				htmlData+='<td>'+data['rec'][i].trans_acc_name+'</td>';
				htmlData+='<td>'+data['rec'][i].confirmation+'</td>';
				htmlData+='<td>'+data['rec'][i].country_name+'</td>';
				htmlData+='<td>'+data['rec'][i].city_name+'</td>';
				htmlData+='<td>'+data['rec'][i].hStatus+'</td>';
				htmlData+='<td><a  class="btn btn-primary btn-icon waves-effect wave-light" onclick="edit_hotel_inv('+data['rec'][i].id+')">'+
						'<i class="fa fa-edit"></i></a> <button type="button" class="btn btn-danger btn-icon" onclick="del_rec(\'../\', \'hotel\', \''+data['rec'][i].id+'\')"> <i class="fa fa-trash"></i></button></td>';
			htmlData+='</tr>';
			j++;
			}
			$(".get_hotel_invList").html(htmlData);
			pagination(data['total'],data['cp'],data['pp'],data['func']);
		}
	});
}

function get_employees(p=1)
{
	$('.loader-bg').show();
	$.ajax({
		url:"ajax_call/get_employees?page="+p,
		dataType:"JSON",
		success: function(data)
		{
			var htmlData=""; j=data['start']+1;
			for(i in data['rec']){
			htmlData+='<tr id="'+data['rec'][i].id+'">';
				htmlData+='<td></td>';
				htmlData+='<td>'+data['rec'][i].emp_name+'</td>';
				htmlData+='<td>'+data['rec'][i].designation+'</td>';
				htmlData+='<td>'+data['rec'][i].joining_date+'</td>';
				htmlData+='<td>'+data['rec'][i].dob+'</td>';
				htmlData+='<td>'+data['rec'][i].status+'</td>';
				htmlData+='<td><a  class="btn btn-primary btn-icon  waves-effect wave-light" onclick="edit_employee('+data['rec'][i].id+')">'+
						'<i class="fa fa-edit"></i></a> <button type="button" class="btn btn-danger btn-icon" onclick="del_rec(\'../\', \'emp\', \''+data['rec'][i].id+'\')"> <i class="fa fa-trash"></i></button></td>';
			htmlData+='</tr>';
			//j++;
			}
			$(".get_employees").html(htmlData);
			pagination(data['total'],data['cp'],data['pp'],data['func']);
			$('.loader-bg').hide();
		}
	});
}
function edit_employee(id)
{
	$('.loader-bg').show();
	$.ajax({
		url:"ajax_call/edit_employee?id="+id,
		dataType:"JSOn",
		success: function(data)
		{
			$("#form input[name~='id']").val(id);
			$("#form input[name~='emp_name']").val(data.emp_name);
			$("#form select[name~='designation']").val(data.designation);
			$("#form input[name~='joining_date']").val(data.joining_date);
			$("#form input[name~='dob']").val(data.dob);
			$("#form input[name~='cnic']").val(data.cnic);
			$("#form input[name~='phone']").val(data.phone);
			$("#form input[name~='reference']").val(data.reference);
			$("#form input[name~='address']").val(data.address);
			$(".md-input-wrapper > label").css("top","-9px");
			$("#form").find(".btn-primary").text('Update');
			$("#employee-modal").modal();
			$('.loader-bg').hide();
		}
	});
}
function fetch_clients(thisVal, root=""){
	var bId=$(thisVal).val();
	$('.loader-bg').show();
	$(thisVal).parents("form, #tour-modal").find(".clients").attr("disabled", "disabled");
	$.ajax({
		url:""+root+"../administration/ajax_call/fetch_clients?bId="+bId,
		dataType:"json",
		success: function(data){
			$(thisVal).parents("form, #tour-modal").find(".clients").html(data).removeAttr("disabled");
			fetch_payable(thisVal, root);
			fetch_bank_cash(thisVal, root);
		},
		complete: function (data) {
      		$('.loader-bg').hide();
     	}
	});
}
function fetch_all_acc(thisVal, root=""){
	var bId=$(thisVal).val();
	$('.loader-bg').show();
	$(thisVal).parents("form").find(".all_accounts").attr("disabled", "disabled");
	$.ajax({
		url:""+root+"../administration/ajax_call/fetch_all_acc?bId="+bId,
		dataType:"json",
		success: function(data){
			$(thisVal).parents("form").find(".all_accounts").html(data).removeAttr("disabled");
		},
		complete: function (data) {
      		$('.loader-bg').hide();
     	}
	});
}
function fetch_clients_vendor(thisVal, root=""){
	var bId=$(thisVal).val();
	$('.loader-bg').show();
	//$(thisVal).parents("form").find(".all_accounts").attr("disabled", "disabled");
	$.ajax({
		url:""+root+"../administration/ajax_call/fetch_clients_vendor?bId="+bId,
		dataType:"json",
		success: function(data){
			$(thisVal).parents("form").find(".clients_vendor").html(data);
		},
		complete: function (data) {
      		$('.loader-bg').hide();
     	}
	});
}
function fetch_payable(thisVal, root=""){
	var bId=$(thisVal).val();
	$('.loader-bg').show();
	$.ajax({
		url:""+root+"../administration/ajax_call/fetch_payable?bId="+bId,
		dataType:"json",
		success: function(data){
			$(thisVal).parents("form, #tour-modal").find(".payable_accounts").html(data);
		},
		complete: function (data) {
      		$('.loader-bg').hide();
     	}
	});
}
function fetch_bank_cash(thisVal, root=""){
	var bId=$(thisVal).val();
	$('.loader-bg').show();
	$.ajax({
		url:""+root+"../administration/ajax_call/fetch_bank_cash?bId="+bId,
		dataType:"json",
		success: function(data){
			$(thisVal).parents(".modal-body").find(".bank_cash").html(data);
			fetch_all_acc(thisVal, root);
		},
		complete: function (data) {
      		$('.loader-bg').hide();
     	}
	});
}
