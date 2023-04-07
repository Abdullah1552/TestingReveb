// JavaScript Document
$("input").on("keyup", function(){
	$(this).css("border-bottom", "1px solid rgba(0, 0, 0, .15)");
});
$("select").on("change", function(){
	$(this).closest('.form-group').find('.select2-selection').css('border-bottom','1px solid rgba(0, 0, 0, .15)');
});
function add_new_root_acc()
{
	var root_acc_name = $('multi_rv_list#root_acc_name').val();
	if(root_aadd_new_clientcc_name == ''){
		$('#root_acc_name').css('border-bottom','1px solid #f00');
		toastr.error('Account name is required.');
		return false;
	}
	$.ajax({
		url:"ajax_call/get_root_accounts",
		type:"POST",
		data:$("#form").serialize(),
		success: function(data)
		{
			if(data==1){
				/*success_loader();*/
				get_root_accounts();
				document.getElementById("form").reset();
				$("#form").closest("button").text('Submit');
				$('#root_acc_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
				toastr.success('Operation successfull.');
			}else { error_loader(); }
		}
	});
}
function edit_root_account(id)
{
	$('#root_acc_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	$.ajax({
		url:"ajax_call/edit_root_account?id="+id,
		dataType:"JSON",
		success:function(data)
		{
			$("#form input[name*='root_acc_name']").val(data.root_acc_name);
			$(".md-input-wrapper > label").css("top","-9px");
			$("#form").find("button").text('Update');
		}
	});
}
function get_root_accounts()
{
	$.ajax({
		url:"ajax_call/get_root_accounts",
		dataType:"JSON",
		success: function(data)
		{
			var htmlData="";
			var j=0;
			for(i in data)
			{
				j++;
				htmlData+="<tr id='"+data[i].id+"'>";
					htmlData+='<td>'+j+'</td>';
					htmlData+='<td>'+data[i].root_acc_name+'</td>';
					 htmlData+='<td><a  class="btn btn-primary btn-icon waves-effect wave-light" onclick="edit_root_account('+data[i].id+')">'+
						'<i class="fa fa-edit"></i></a>'+
						'</td>';
				htmlData+="</tr>";
			}
			$(".get_head_acc").html(htmlData);
		}
	});
}
function fetch_head_acc(thisId, type){
	$.ajax({
		url:"ajax_call/fetch_head_acc?rId="+thisId,
		success: function(data)
		{
			if(type=="new"){
				$("#root_id").html(data);
			 }
			if(type=="update"){
			 $("#rootID").html(data); }
		}
	});
}
function add_acc_cat_name(thisId="", txt)
{
	if(thisId!="") { $("#asset-modal").modal(); fetch_head_acc(thisId); $(".modal-title").text('Add New '+txt) }
	$.ajax({
		url:"ajax_call/get_acc_cat",
		type:"POST",
		data:$("#asset-form").serialize(),
		success: function(data)
		{
			if(data==1) {
				$("#asset-modal").modal('hide');
				//success_loader();
			}
		}
	});
	
	
}
//add sub_cat of acounting system
function add_acc_sub_cat(head_id="",cat_id="", txt)
{
	if(cat_id!="") { $("#acc-sub-cat-modal").modal(); $(".modal-title").text('Add New '+txt);
		$("#acc-sub-cat-form input[name*='head_id']").val(head_id);
		$("#acc-sub-cat-form input[name*='acc_cat_id']").val(cat_id);
	 }
	 $.ajax({
		 url:"ajax_call/get_acc_sub_cat",
		 type:"POST",
		 data:$("#acc-sub-cat-form").serialize(),
		 success: function(data)
		 {
			 
		 }
	 });
}
// add finally account which will effect
function add_new_acc(head_id="", cat_id="", sub_cat_id="", txt){
	if(sub_cat_id!=""){
		$("#new-acc-modal").modal(); $(".modal-title").text('Add New '+txt);
		$("#new-acc-modal input[name*='head_id']").val(head_id);
		$("#new-acc-modal input[name*='acc_cat_id']").val(cat_id);
		$("#new-acc-modal input[name*='acc_sub_cat_id']").val(sub_cat_id);
	}
}
// add new group account
function add_new_head_acc()
{
	$('.loader-bg').show();
	var root_acc = $('#ha_root_id option:selected').val();
	var head_acc = $('#ha_acc_name').val();
	if(head_acc == ''){
		$('#ha_acc_name').css('border-bottom','1px solid #f00');
		toastr.error('Head account name is required.');
		$('.loader-bg').hide();
		return false;
	}
	
	$.ajax({
		url:"ajax_call/get_head_accounts",
		type:"POST",
		data:$("#form").serialize(),
		success: function(data)
		{
			if(data==1){
				get_head_accounts();
				document.getElementById("form").reset();
				$('#ha_acc_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
				/*success_loader();*/
				toastr.success('Operation successfull.');
			}
			$('.loader-bg').hide();
		},
		cache:false,
	});
}
function get_head_accounts()
{
	$.ajax({
		url:"ajax_call/get_head_accounts",
		data:$("#search-from").serialize(),
		type:"POST",
		dataType:"JSON",
		success: function(data)
		{
			var htmlData="";
			var j=0;
			for(i in data)
			{
				j++;
				htmlData+="<tr id='"+data[i].id+"'>";
					htmlData+='<td>'+j+'</td>';
					htmlData+='<td>'+data[i].head_acc_name+'</td>';
					htmlData+='<td>'+data[i].root_acc_name+'</td>';
					 htmlData+='<td><a  class="btn btn-primary btn-icon waves-effect wave-light" onclick="edit_head_account('+data[i].id+')">'+
						'<i class="fa fa-edit"></i></a>'+
						/*' <button type="button" class="btn btn-danger btn-icon waves-effect wave-light" onclick="del_rec(\'../\', \'head_acc\', \''+data[i].id+'\')">'+
						'<i class="fa fa-trash"></i></button>'+*/
						'</td>';
				htmlData+="</tr>";
			}
			$(".get_group_accounts").html(htmlData);
			$("#form").find("button").text('Submit');
		},
		cache:false,
	});
}
function edit_head_account(id)
{
	$('#ha_acc_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	$.ajax({
		url:"ajax_call/edit_head_acc?id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$("#form input[name*='id']").val(data.id);
			$("#form select[name='root_id']>option[value='"+data.root_id+"']").attr("selected","selected");
			$("#form input[name*='head_acc_name']").val(data.head_acc_name);
			$(".md-input-wrapper > label").css("top","-9px");
			$("#form").find("button").text('Update');
			$(".js-example-basic-single").select2();
		}
		});
}
//================================sub head accounts======
function add_sub_head_acc()
{
	$('.loader-bg').show();
	$('#sha_root_id').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #aaa !important');
	$('#root_id').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #aaa !important');
	$('#sha_acc_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	
	var root_id = $('#sha_root_id option:selected').val();
	var head_id = $('#root_id option:selected').val();
	var sha_acc_name = $('#sha_acc_name').val();
	var toast = '';
	var flag = 'false';
	
	if(root_id == '0'){
		$('#sha_root_id').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #f00 !important');
		toast += 'Root account is required.</br>';
		flag = 'true';
	}
	if(head_id == '0'){
		$('#root_id').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #f00 !important');
		toast += 'Head account is required.</br>';
		flag = 'true';
	}
	if(sha_acc_name == ''){
		$('#sha_acc_name').css('border-bottom','1px solid #f00');
		toast += 'Sub head account is required.</br>';
		flag = 'true';
	}
	if(flag == 'true'){
		$('.loader-bg').hide();
		toastr.error(toast);
		return false;
	}
	$.ajax({
		url:"ajax_call/get_sub_head_accounts",
		type:"POST",
		data:$("#form").serialize(),
		success: function(data)
		{
			if(data==1){
				document.getElementById("form").reset();
				/*success_loader();*/
				get_sub_head_acc();
				$('#sha_root_id').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #aaa !important');
				$('#root_id').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #aaa !important');
				$('#sha_acc_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
				toastr.success('Operation successfull.');
			}
			else{
				error_loader();
			}
			$('.loader-bg').hide();
		}
	});
}
function edit_sub_head_acc(id)
{
	$('#sha_root_id').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #aaa !important');
	$('#root_id').closest('.md-input-wrapper').find('.select2-selection').css('cssText','border-bottom:1px solid #aaa !important');
	$('#sha_acc_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	
	$.ajax({
		url:"ajax_call/edit_sub_head_account?id="+id,
		dataType:"JSON",
		success: function(data)
		{
			$(window).scrollTop(0);
			$("#form input[name*='id']").val(id);
			$("#form select[name='root_id']>option[value='"+data.root_id+"']").attr("selected","selected");
			$("#form select[name='head_id']>option[value='"+data.head_id+"']").attr("selected","selected");
			$("#form input[name*='sub_head_acc_name']").val(data.sub_head_acc_name);
			$(".md-input-wrapper > label").css("top","-9px");
			$("#form").find("button").text('Update');
			$(".js-example-basic-single").select2();
		}
	});
}
function get_sub_head_acc()
{
	$.ajax({
		url:"ajax_call/get_sub_head_accounts",
		dataType:"JSON",
		type:"POST",
		data:$("#search-form").serialize(),
		success: function(data)
		{
			var htmlData="";
			var j=0;
			for(i in data)
			{
				j++;
				htmlData+="<tr id='"+data[i].id+"'>";
					htmlData+='<td>'+j+'</td>';
					htmlData+='<td>'+data[i].sub_head_acc_name+'</td>';
					htmlData+='<td>'+data[i].head_acc_name+'</td>';
					htmlData+='<td>'+data[i].root_acc_name+'</td>';
					 htmlData+='<td><a  class="btn btn-primary btn-icon waves-effect wave-light" onclick="edit_sub_head_acc('+data[i].id+')">'+
						'<i class="fa fa-edit"></i></a>'+
						/*' <button type="button" class="btn btn-danger btn-icon waves-effect wave-light" onclick="del_rec(\'../\', \'sub_head\', \''+data[i].id+'\')">'+
						'<i class="fa fa-trash"></i></button>'+*/
						'</td>';
				htmlData+="</tr>";
			}
			//alert(data[i].page);
			$(".get_sub_head_accounts").html(htmlData);
			$("#form").find("button").text('Submit');	
		}
	});
}
// add new account
//fetch sub head accounts 
function fetch_shd_acc(sId, root="")
{
	$.ajax({
		url:""+root+"ajax_call/fetch_shd_acc?sId="+sId,
		success: function(data)
		{
			$("form #subHead_acc").html(data);
		}
	});
}
function add_new_client(accId, head_id, root_id,  txt=""){
	document.getElementById("form").reset();
	$("#form input[name~='cId']").val(0);
	if(accId==1){
	fetch_shd_acc(1);
	}
	else{
		fetch_shd_acc(accId);
	}
	$(".modal-title").text("Add New "+txt);
	if(accId == 23){
		$('#ne_employ_name, #ne_phone, #ne_joining_date').css('border-bottom','1px solid rgba(0,0,0,0.12)');
		$('#ne_head_id').val(head_id);
		$('#ne_root_id').val(root_id);
		$('#ne_acc_id').val(accId);
		$("#employee-modal").modal();
	}else{
		if(accId==2 || accId==3 || accId==4 || accId==7){
			$("#hide_account").show();
			$("#client_type").show();
			
			$('#ana_client_type, #ana_acc_name, #ana_contact_name, #ana_mobile, #ana_business_phone, #ana_business_email, #ana_bank_name, #ana_bank_branch, #ana_bank_account').css('border-bottom','1px solid rgba(0,0,0,0.12)');
			
			$("#new-clientModal .modal-md").css('max-width','1300px');
			$("#new-clientModal .modal-md .modal-body .col-md-4").css('width','33.333333%');
		}
		else{
			$("#client_type").hide();
			$('#ana_acc_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
			
			$("#hide_account").hide();
			$("#new-clientModal .modal-md").css('max-width','400px');
			$("#new-clientModal .modal-md .modal-body .col-md-4").css('width','100%');
		}
		$("#new-clientModal").modal();
		$("#form input[name*='head_id']").val(head_id);
		$("#form input[name*='root_id']").val(root_id);
		$('form #ncm_acc_id').val(accId);
		$("#form").find(".pull-right").text("Submit");
	}
	
}
function save_acc(root="", type="")
{
	$('.loader-bg').show();
	var accId = $('#ncm_acc_id').val();
	if(accId==2 || accId==3 || accId==4 || accId==7){
		var client_type = $('#ana_client_type option:selected').val();
		var account_name = $('#ana_acc_name').val();
		var contact_name = $('#ana_contact_name').val();
		var contact_mobile = $('#ana_mobile').val();
		var business_phone = $('#ana_business_phone').val();
		var business_email = $('#ana_business_email').val();
		var bank_name = $('#ana_bank_name').val();
		var bank_branch = $('#ana_bank_branch').val();
		var bank_account = $('#ana_bank_account').val();
		var toast = '';
		var flag = 'false';
		if(client_type == '0'){
			$('#ana_client_type').css('border-bottom','1px solid #f00');
			toast += 'Client type is required.</br>';
			flag = 'true';
		}
		if(account_name == ''){
			$('#ana_acc_name').css('border-bottom','1px solid #f00');
			toast += 'Account name is required.</br>';
			flag = 'true';
		}
		if(contact_name == ''){
			$('#ana_contact_name').css('border-bottom','1px solid #f00');
			toast += 'Contact name is required.</br>';
			flag = 'true';
		}
		if(contact_mobile == ''){
			$('#ana_mobile').css('border-bottom','1px solid #f00');
			toast += 'Mobile number is required.</br>';
			flag = 'true';
		}
		if(flag == 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}else{
			$('#ana_client_type, #ana_acc_name, #ana_contact_name, #ana_mobile, #ana_business_phone, #ana_business_email, #ana_bank_name, #ana_bank_branch, #ana_bank_account').css('border-bottom','rgba(0,0,0,0.12)');
		}
	}else{
		var account_name = $('#ana_acc_name').val();
		var flag = 'false';
		if(account_name == ''){
			$('#ana_acc_name').css('border-bottom','1px solid #f00');
			toastr.error('Account name is required.');
			flag = 'true';
		}else{
			$('#ana_acc_name').css('border-bottom','1px solid rgba(0,0,0,0.12)');
		}
		if(flag == 'true'){
			$('.loader-bg').hide();
			return false;
		}
	}
	$.ajax({
		url:""+root+"ajax_call/save_account",
		type:"POST",
		data:$("#form").serialize(),
		dataType:"JSON",
		success: function(data)
		{
			if(data.succ==1){
				$("#new-clientModal").modal('hide');
				/*success_loader();*/
				if(type=='client'){
					$("#client_id").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else if(type=="h_client"){
					$("#hotel_client_id").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else if(type=='v_client'){
					$("#visa_client_id").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else if(type=='tr_client'){
					$("#trans_client_id").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else if(type=='tour_client'){
					$("#tour_client_id").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else if(type=='o_client'){
					$("#o_client").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else if(type=='payable'){
					$("#vendor_id").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else if(type=='h_payable'){
					$("#payable_id").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else if(type=='v_payable'){
					$("#v_vendor").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else if(type=='tr_payable'){
					$("#trans_client_id").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else if(type=='o_payable'){
					$("#o_payable").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else if(type=='tt_payable'){
					$("#tt_payable_id").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else if(type=='th_payable'){
					$("#th_payable_id").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else if(type=='tv_payable'){
					$("#tv_payable").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else if(type=='ttr_payable'){
					$("#ttrans_payable_id").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else if(type=='to_payable'){
					$("#to_vendor").append('<option selected value="'+data.tId+'">'+data.trans_acc+'</option>');
				}
				else{
					get_trans_acc();
					//if(path=='add_new_client'){
					//get_clients_acc(p=1);
					//}
				}
				document.getElementById("form").reset();
				toastr.success('Operation successfull.');
			}
			$('.loader-bg').hide();
		}
	});
}
function edit_trans_acc(id)
{
	$(".modal-title").text("Update Trans A/C");
	$.ajax({
		url:"ajax_call/edit_trans_acc?id="+id,
		dataType:"JSON",
		success: function(data)
		{
			var at = data.rec.account_type;
			if(at=='2'){
				$("#hide_account").show();
				$("#client_type").show();
				$("#new-clientModal .modal-md").css('max-width','1300px');
				$("#new-clientModal .modal-md .modal-body .col-md-4").css('width','33.333333%');
				$("#new-clientModal").modal();
			}
			else if(at=='23'){
				$("#employee-modal").modal();
				$("#new-clientModal").modal('hide');
				$("#employee-form input[name*='cId']").val(id);
				$("#employee-form input[name*='root_id']").val(data.rec.root_id);
				$("#employee-form input[name*='head_id']").val(data.rec.head_id);
				$("#employee-form input[name*='account_name']").val(data.rec.trans_acc_name);
				$("#employee-form select[name~='contact_designation']").val(data.emp.designation);
				$("#employee-form input[name~='cnic']").val(data.emp.cnic);
				$("#employee-form input[name~='phone']").val(data.emp.phone);
				$("#employee-form input[name~='reference']").val(data.emp.reference);
				$("#employee-form input[name~='address']").val(data.emp.address);
				$("#employee-form input[name~='joining_date']").val(data.emp.joining_date);
				$("#employee-form input[name~='dob']").val(data.emp.dob);
				$("#employee-form input[name~='dr_cr']").val(data.rec.dr_cr);
				$("#employee-form input[name~='bank_name']").val(data.rec.bank_name);
				$("#employee-form input[name~='bank_branch']").val(data.rec.bank_branch);
				$("#employee-form input[name~='bank_account']").val(data.rec.bank_account);
			}
			else{
				$("#hide_account").hide();
				$("#new-clientModal .modal-md").css('max-width','400px');
				$("#new-clientModal .modal-md .modal-body .col-md-4").css('width','100%');
				$("#new-clientModal").modal();
			}
			$(".md-input-wrapper > label").css("top","-9px");
			fetch_shd_acc(data.rec.account_type);
			$("#form input[name*='cId']").val(id);
			$("#form input[name*='root_id']").val(data.rec.root_id);
			$("#form input[name*='head_id']").val(data.rec.head_id);
			$("#form select[name*='client_type']").val(data.rec.client_type);
			$("#form select[name*='branch_id']").val(data.rec.branch_id);
			$("#form input[name*='account_name']").val(data.rec.trans_acc_name);
			$("#form input[name*='co_employee']").val(data.rec.co_employee);
			$("#form input[name*='opening_balance']").val(data.rec.opening_balance);
			$("#form input[name~='ob_oc']").val(data.rec.ob_oc);
			$("#form select[name*='dr_cr']").val(data.rec.dr_cr);
			$("#form select[name*='cur_type']").val(data.rec.cur_type);
			$("#form input[name*='contact_name']").val(data.rec.contact_name);
			$("#form input[name*='contact_designation']").val(data.rec.contact_designation);
			$("#form input[name*='contact_mobile']").val(data.rec.contact_mobile);
			$("#form input[name*='contact_sec']").val(data.rec.contact2);
			/*$("#form input[name*='contact_sec_designation']").val(data.rec.contact_sec_designation);*/
			$("#form input[name*='contact_comp']").val(data.rec.contact_comp);
			$("#form input[name*='business_phone']").val(data.rec.business_phone);
			$("#form input[name*='business_mobile']").val(data.rec.business_mobile);
			$("#form input[name*='business_email']").val(data.rec.business_email);
			$("#form input[name*='business_address']").val(data.rec.business_address);
			$("#form input[name*='business_country']").val(data.rec.business_country);
			$("#form input[name*='business_website']").val(data.rec.business_website);
			$("#form input[name*='bank_name']").val(data.rec.bank_name);
			$("#form input[name*='bank_branch']").val(data.rec.bank_branch);
			$("#form input[name*='bank_account']").val(data.rec.bank_account);
			$("#form input[name*='credit_limit']").val(data.rec.credit_limit);
			$("#form input[name*='credit_days']").val(data.rec.credit_days);
			$("#form input[name*='ntn']").val(data.rec.ntn);
			$("#form input[name*='strn']").val(data.rec.strn);
			$("#form").find(".pull-right").text("Update");
		}
	});
}
// fetch existing accounts in trans accounts list
$(".trans_acc").on("keyup",function(){
	
	$.ajax({
		url:"ajax_call/fetch_trans_acc?trans_acc_name="+$(this).val(),
		dataType:"JSON",
		success: function(data)
		{
			var htmlData="";
			for(i in data)
			{
				htmlData+='<option value="'+data[i].trans_acc_name+'">';	
			}
			$("#trans_acc").html(htmlData);
		}
	});
});
//employees details.........
function add_employee(formData){
	$('.loader-bg').show();
	
	$('#ne_employ_name, #ne_phone, #ne_joining_date').css('border-bottom','1px solid rgba(0,0,0,0.12)');
	
	$("#employee-modal").modal();
	if(formData=='submit')
	{
		var employ_name = $('#ne_employ_name').val();
		var phone = $('#ne_phone').val();
		var joining_date = $('#ne_joining_date').val();
		var flag = 'false';
		
		if(employ_name == ''){
			$('#ne_employ_name').css('border-bottom','1px solid #f00');
			flag = 'true';
		}
		if(phone == ''){
			$('#ne_phone').css('border-bottom','1px solid #f00');
			flag = 'true';
		}
		if(joining_date == ''){
			$('#ne_joining_date').css('border-bottom','1px solid #f00');
			flag = 'true';
		}
		if(flag == 'true'){
			$('.loader-bg').hide();
			return false;
		}
		$.ajax({
			url:"ajax_call/get_employees",
			type:"POST",
			data:$("#employee-form").serialize(),
			success: function(data)
			{
				if(data==1){
					/*success_loader();*/
					document.getElementById("employee-form").reset();
					$("#employee-modal").modal('hide');
					$("#form").find(".btn-primary").text('Submit');
					get_trans_acc();
					toastr.success('Operation successfull.');
				}
				else{
					error_loader();
				}
				$('.loader-bg').hide();
			}
		});
	}
	$('.loader-bg').hide();
}
function get_trans_acc(p=1){
	$('.loader-bg').show();
	$.ajax({
		url:"ajax_call/get_trans_acc?page="+p,
		dataType:"JSON",
		type:"POST",
		data:$("#search-accounts").serialize(),
		success: function(data){
			//console.log(data['rec']);
			var htmlData=""; j=1;
			for(i in data['rec']){
			htmlData+='<tr id="'+data['rec'][i].cId+'">';
				htmlData+='<td>'+j+'</td>';
				htmlData+='<td>'+data['rec'][i].trans_acc_name+'</td>';
				htmlData+='<td>'+data['rec'][i].sub_head_acc_name+'</td>';
				htmlData+='<td>'+data['rec'][i].head_acc_name+'</td>';
				htmlData+='<td>'+data['rec'][i].root_acc_name+'</td>';
				if(data['rec'][i].locked=='yes'){
					htmlData+='<td>N/A</td>';
				}
				else{
				htmlData+='<td><button type="button" class="btn btn-primary btn-icon waves-effect wave-light" onclick="edit_trans_acc(\''+data['rec'][i].cId+'\')">'+
				'<i class="fa fa-edit"></i>'+
				'</button>'+
				' <button type="button" class="btn btn-danger btn-icon waves-effect wave-light" onclick="del_rec(\'../\', \'trans_acc\', \''+data['rec'][i].cId+'\')"><i class="fa fa-trash"></i></button>'+
					' <a href="print_acc_form_detail?id='+data['rec'][i].cId+'" target="_blank" class="btn btn-default btn-icon waves-effect wave-light"><i class="fa fa-print"></i></a>'+
				'</td>';
				}
				htmlData+='<tr>';
				j++;
			}
			//function pagination(total_rec, cur_page, per_page, clickFunc)
			pagination(data['total'],data['cp'],data['pp'],data['func']);
			$(".get_trans_acc").html(htmlData);
			$('.loader-bg').hide();
		}
	});
}
///accounts =====================ledger
function get_acc_ledger()
{
	$(".get_acc_ledger").html("<tr><td colspan='8' align='center'>No Record</td></tr>");
	$.ajax({
		url:"ajax_call/get_acc_ledger",
		type:"POST",
		data:$("#form").serialize(),
		dataType:"JSON",
		success: function(data)
		{
			var htmlData="";
				htmlData+="<tr>";
					htmlData+='<td colspan="5" align="right">'+data.ob.description+'</td>';
					htmlData+='<td colspan="3" align="center">'+data.ob.ob+'</td>';
				htmlData+="</tr>";
				var j=1;
			for(i in data['rec']){
				htmlData+='<tr>';
					htmlData+='<td>'+(j++)+'</td>';
					htmlData+='<td>'+data['rec'][i].trans_date+'</td>';
					htmlData+='<td>'+data['rec'][i].vt+'</td>';
					if(data['rec'][i].vt=='inv'){
					htmlData+='<td>'+data['rec'][i].inv_id+'</td>';
					}else{
					htmlData+='<td>'+data['rec'][i].trans_code+'</td>';	
					}
					htmlData+='<td>'+data['rec'][i].narration+'</td>';
					htmlData+='<td>'+data['rec'][i].dr+'</td>';
					htmlData+='<td>'+data['rec'][i].cr+'</td>';
					htmlData+='<td>'+data['rec'][i].balance+'</td>';
				htmlData+='</tr>';
			}
			$(".get_acc_ledger").html(htmlData);
		}
	});
}
function multi_rv(dt){
	var rvlength = $('.multi_rv .invoice_list').filter(function(){
		var l = $(this).val();
		if(l == '0'){
			return $(this);
		}
	}).length;
	if(rvlength <= '2'){
		var vl = $(dt).find('option:selected').val();
		$(dt).closest(".modal-body").find("#clone_rv select.invoice_list").find('option[value='+vl+']').hide();
		$(".js-example-basic-single").select2("destroy");
		var contnt=$(dt).closest(".modal-body").find("#clone_rv>div").clone();
		$(dt).closest(".modal-body").find('#multi_rv').append(contnt);
		$(dt).attr('onChange','');	
		$(".js-example-basic-single").select2();
	}
}
function multi_rvm(dt){
	var rvlength = $('.multi_rv .invoice_list').filter(function(){
		var l = $(this).val();
		if(l == '0'){
			return $(this);
		}
	}).length;
	if(rvlength <= '20'){
		var vl = $(dt).find('option:selected').val();
		$(dt).closest(".modal-body").find("#clone_rv select.invoice_list").find('option[value='+vl+']').hide();
		$(".js-example-basic-single").select2("destroy");
		var contnt=$(dt).closest(".modal-body").find("#clone_rv>div").clone();
		$(dt).closest(".modal-body").find('#multi_rv').append(contnt);
		$(dt).attr('onChange','');	
		$(".js-example-basic-single").select2();
	}
}
$(document).on('change','.multi_rv_list, #cur_rate',function() {
	var sum=0;
	g=$(this);
	$('.multi_rv_list').each(function(index){
		sum+=Number($(this).val());
	});
	$('#total_receipt_amount').text(snf(sum));
	$('#total_dr').val(sum);
	get_oc_total();
	//conversion rate
	var cur_rate=$("#cur_rate").val();
	if(cur_rate>0){
		$("#cur_total").val((Number(sum)/Number(cur_rate)).toFixed(3));
	}
});
$(document).on('change','.multi_rv_list_cr',function() {
	var tcr=0;
	g=$(this);
	$('.multi_rv_list_cr').each(function(index){
		tcr+=Number($(this).val());
	});
	//$('#total_receipt_amount').text(snf(sum));
	$('#total_cr').val(tcr);
	get_oc_total();
});
//fetch invoice details against invoice id
$(document).on('change','.invoice_list',function() {
	var inv=$(this).find('option:selected').val();
	bal=$(this).find('option:selected').attr('data-bal');
	$(this).closest('.multi_rv').find('.prev_balance').val(bal);
	let pt=$("#payment_to").find('option:selected').text();
	let pf=$(this).closest('.multi_rv').find(".all_accounts").find('option:selected').text();
	let narration='payment received from '+pf+' in '+pt+' Against Inv#'+inv;
	$(this).closest('.multi_rv').find('.particulars').val(narration);
});

//save receipt voucher
function save_receipt_voucher()
{
	$('#receipt-form button').attr('disabled','disabled');
	$('.loader-bg').show();
	var trans_date = $('#rvm_trans_date').val();
	var client_id = $('#rvm_client_id option:selected').val();
	var receive_amount = $('#rvm_receive_amount').val();
	var tc = $("#receipt-form input[name~='trans_code']").val();
	var toast = '';
	var flag = 'false';
	
	if(trans_date == ''){
		$('#rvm_trans_date').css('border-bottom','1px solid #f00');
		toast += 'Transaction date is required.</br>';
		flag = 'true';
	}
	if(client_id == '0'){
		$('#rvm_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
		toast += 'Client is required.</br>';
		flag = 'true';
	}
	/*if(receive_amount == ''){
		$('#rvm_receive_amount').css('border-bottom','1px solid #f00');
		toast += 'Receive amount is required.</br>';
		flag = 'true';
	}*/
	if(flag == 'true'){
		$('.loader-bg').hide();
		toastr.error(toast);
		return false;
	}
	
	$.ajax({
		url:"ajax_call/save_receipt_voucher",
		data:$("#receipt-form").serializeArray(),
		type:"POST",
		success: function(data)
		{
			$("#receipt-modal").modal('hide');
			$('#receipt-form button').removeAttr('disabled');
			get_receipt_vouchers();
			$('.loader-bg').hide();
			$('#rvm_trans_date, #rvm_receive_amount').css('border-bottom','1px solid rgba(0,0,0,0.12)');
			$('#rvm_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
			if(data==2){
				if(tc == '0'){
					document.getElementById("receipt-form").reset();
				}
				toastr.success('Operation successfull.');
			}
			else{
				toastr.error('Operation Failed.');
			}
		}
	});
}
//save payment voucher
//save receipt voucher
function save_payment_voucher()
{
	$('#payment-form').attr('disabled','disabled');
	$('.loader-bg').show();
	var trans_date = $('#rvm_trans_date').val();
	var client_id = $('#rvm_client_id option:selected').val();
	var receive_amount = $('#rvm_receive_amount').val();
	var toast = '';
	var flag = 'false';
	
	if(trans_date == ''){
		$('#rvm_trans_date').css('border-bottom','1px solid #f00');
		toast += 'Transction date is required.</br>';
		flag = 'true';
	}
	if(client_id == '0'){
		$('#rvm_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
		toast += 'Client is required.</br>';
		flag = 'true';
	}
	/*if(receive_amount == ''){
		$('#rvm_receive_amount').css('border-bottom','1px solid #f00');
		toast += 'Paid amount is required.</br>';
		flag = 'true';
	}*/
	if(flag == 'true'){
		$('.loader-bg').hide();
		toastr.error(toast);
		return false;
	}
	$.ajax({
		url:"ajax_call/save_payment_voucher",
		data:$("#payment-form").serializeArray(),
		type:"POST",
		success: function(data)
		{
			$("#payment-modal").modal('hide');
			$('#payment-form').removeAttr('disabled');
			get_payment_vouchers();
			$('.loader-bg').hide();
			$('#rvm_trans_date, #rvm_receive_amount').css('border-bottom','1px solid rgba(0,0,0,0.12)');
			$('#rvm_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
			if(data==2){
			toastr.success('Operation successfull.');
			$("#payment-form input[name~='id']").val(0);
			document.getElementById("payment-form").reset();
			}
			else{
				toastr.error('Operation Failed.');
			}
		}
	});
}
//get Receipt Vouchers
function get_receipt_vouchers(){
	$('.loader-bg').show();
	$.ajax({
		url:"ajax_call/get_receipt_vouchers",
		dataType:"JSON",
		data:$("#form").serialize(),
		type:"POST",
		success: function(data)
		{
			var htmlData=""; 
			var j=1;
			for(i in data.rec){
				htmlData+='<tr id="'+data.rec[i].trans_code+'">';
					htmlData+='<td>'+j+'</td>';
					htmlData+='<td>'+data.rec[i].trans_code+'</td>';
					htmlData+='<td>'+data.rec[i].trans_date+'</td>';
					htmlData+='<td>'+data.rec[i].details+'</td>';
					htmlData+='<td>'+snf(Number(data.rec[i].rec_amount))+'</td>';
					htmlData+='<td>';
					if(data.edit=='allow'){
					htmlData+='<a style="color:white;" class="btn btn-primary btn-icon waves-effect wave-light" onClick="edit_receipt_voucher('+data.rec[i].trans_code+', \'rv\')" title="View"><i class="fa fa-edit"></i></a>';
					}
					htmlData+=' <a style="color:white;" class="btn btn-success btn-icon waves-effect wave-light" onClick="receipt_voucher_view('+data.rec[i].trans_code+', \'rv\')" title="View"><i class="fa fa-eye"></i></a>'+
					' <a onClick="rv_modal('+data.rec[i].trans_code+')" target="_blank" class="btn btn-info btn-icon waves-effect wave-light" title="Print"><i class="fa fa-print"></i></a>';
				    if(data.dlt=='allow'){
					 htmlData+=' <button type="button" class="btn btn-danger btn-icon waves-effect wave-light" onclick="del_rec(\'../\', \'rv\', \''+data.rec[i].trans_code+'\')"><i class="fa fa-trash"></i></button>';
					}
				htmlData+='</td>';
				htmlData+='</tr>';
				j++;
			}
			$(".get_receipt_vouchers").html(htmlData);
			$('.loader-bg').hide();
		}
	});
}
//get Receipt Vouchers
function get_payment_vouchers(){
	$('.loader-bg').show();
	$.ajax({
		url:"ajax_call/get_payment_vouchers",
		dataType:"JSON",
		data:$("#form").serialize(),
		type:"POST",
		success: function(data)
		{
			var htmlData=""; 
			var j=1;
			for(i in data.rec){
				htmlData+='<tr id="'+data.rec[i].trans_code+'">';
					htmlData+='<td>'+j+'</td>';
				    htmlData+='<td>'+data.rec[i].trans_code+'</td>';
					htmlData+='<td>'+data.rec[i].trans_date+'</td>';
					htmlData+='<td>'+data.rec[i].trans_acc_name+'</td>';
					htmlData+='<td>'+data.rec[i].details+'</td>';
					htmlData+='<td>'+snf(Number(data.rec[i].paid_amount))+'</td>';
				    htmlData+='<td>';
				    if(data.edit=='allow'){
					htmlData+='<a style="color:white;" class="btn btn-primary btn-icon waves-effect wave-light" onClick="edit_payment_voucher('+data.rec[i].trans_code+', \'pv\')" title="View"><i class="fa fa-edit"></i></a>';
					}
					htmlData+=' <a style="color:white;" class="btn btn-success btn-icon waves-effect wave-light" onClick="receipt_voucher_view('+data.rec[i].trans_code+', \'pv\')" title="View"><i class="fa fa-eye"></i></a>'+
					' <a onClick="pv_modal('+data.rec[i].trans_code+')" target="_blank" class="btn btn-info btn-icon waves-effect wave-light" title="View"><i class="fa fa-print"></i></a>';
				 if(data.dlt=='allow'){
					htmlData+=' <button type="button" class="btn btn-danger btn-icon waves-effect wave-light" onclick="del_rec(\'../\', \'pv\', \''+data.rec[i].trans_code+'\')"><i class="fa fa-trash"></i></button>';
				 }
					htmlData+='</td>';
				htmlData+='</tr>';
				j++;
			}
			$(".get_payment_vouchers").html(htmlData);
			$('.loader-bg').hide();
		}
	});
}
// receipt voucher view
function receipt_voucher_view(tc, type){
	$("#receipt-view-voucher-modal").modal();
	$.ajax({
		url:"ajax_call/get_receipt_voucher_view?tc="+tc+"&type="+type,
		dataType:"JSON",
		success: function(data)
		{
			$("#receipt-views .trans_date").text(data.rec.trans_date);
			$("#receipt-views .client_name").text(data.rec.trans_acc_name);
			var htmlData=''; j=1;
			for(i in data.det){
				htmlData+='<tr>';
					htmlData+='<td>'+(j++)+'</td>';
					htmlData+='<td>'+data.det[i].trans_acc_name+'</td>';
				    htmlData+='<td>'+data.det[i].narration+'</td>';
					htmlData+='<td>'+data.det[i].inv_id+'</td>';
					if(data.det[i].dr_cr=='dr'){
					htmlData+='<td>'+snf(Number(data.det[i].amount))+'</td>';	
					}
					else{
					htmlData+='<td>0.00</td>';	
					}
					if(data.det[i].dr_cr=='cr'){
					htmlData+='<td>'+snf(Number(data.det[i].amount))+'</td>';	
					}
					else{
					htmlData+='<td>0.00</td>';	
					}
				htmlData+='</tr>';
			}
			$(".get_receipt_view").html(htmlData);
		}
	});
}
//save journal vouchers
function save_jv_voucher()
{
	$('.loader-bg').show();
	$('#jv-form').attr('disabled','disabled');
	var trans_date = $('#rvm_trans_date').val();
	var client_id = $('#rvm_client_id option:selected').val();
	var receive_amount = $('#rvm_receive_amount').val();
	var toast = '';
	var flag = 'false';
	
	if(trans_date == ''){
		$('#rvm_trans_date').css('border-bottom','1px solid #f00');
		toast += 'Transaction date is required.</br>';
		flag = 'true';
	}
	if(client_id == '0'){
		$('#rvm_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
		toast += 'Client is required.</br>';
		flag = 'true';
	}
	/*if(receive_amount == ''){
		$('#rvm_receive_amount').css('border-bottom','1px solid #f00');
		toast += 'Amount is required.</br>';
		flag = 'true';
	}*/
	if(flag == 'true'){
		$('.loader-bg').hide();
		toastr.error(toast);
		return false;
	}
	$.ajax({
		url:"ajax_call/save_jv",
		data:$("#jv-form").serializeArray(),
		type:"POST",
		success: function(data)
		{
			$("#jv-modal").modal('hide');
			$('#jv-form').removeAttr('disabled');
			get_jv_vouchers();
			$('.loader-bg').hide();
			$('#rvm_trans_date, #rvm_receive_amount').css('border-bottom','1px solid rgba(0,0,0,0.12)');
			$('#rvm_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
			if(data==2){
				toastr.success('Operation successfull.');
				document.getElementById("jv-form").reset();
			}
			else{
				toastr.error('Operation Failed.');
			}
		}
	});
}
//get journal vouchers
function get_jv_vouchers(){
	$('.loader-bg').show();
	$.ajax({
		url:"ajax_call/get_jv_vouchers",
		dataType:"JSON",
		data:$("#form").serialize(),
		type:"POST",
		success: function(data)
		{
			var htmlData=""; 
			var j=1;
			for(i in data.rec){
				htmlData+='<tr id="'+data.rec[i].trans_code+'">';
					htmlData+='<td>'+j+'</td>';
					htmlData+='<td>'+data.rec[i].trans_code+'</td>';
					htmlData+='<td>'+data.rec[i].trans_date+'</td>';
					htmlData+='<td>'+data.rec[i].details+'</td>';
					htmlData+='<td>'+snf(Number(data.rec[i].dr_amount))+'</td>';
					htmlData+='<td>'+snf(Number(data.rec[i].cr_amount))+'</td>';
				    htmlData+='<td>';
				    if(data.edit=='allow'){
					htmlData+='<a style="color:white;" class="btn btn-primary btn-icon waves-effect wave-light" onClick="edit_jv('+data.rec[i].trans_code+', \'jv\')" title="View"><i class="fa fa-edit"></i></a>';
					}
					htmlData+=' <a style="color:white;" class="btn btn-success btn-icon waves-effect wave-light" onClick="receipt_voucher_view('+data.rec[i].trans_code+', \'jv\')" title="View"><i class="fa fa-eye"></i></a>'+
					' <a href="../vouchers/print_jv?vId='+data.rec[i].trans_code+'" target="_blank" class="btn btn-info btn-icon waves-effect wave-light" title="View"><i class="fa fa-print"></i></a>'; 
				    if(data.dlt=='allow'){
					htmlData+=' <button type="button" class="btn btn-danger btn-icon waves-effect wave-light" onclick="del_rec(\'../\', \'jv\', \''+data.rec[i].trans_code+'\')"><i class="fa fa-trash"></i></button>';
					}
				   htmlData+='</td>';
				htmlData+='</tr>';
				j++;
			}
			$(".get_jv_vouchers").html(htmlData);
			$('.loader-bg').hide();
		}
	});
}
//get other currency total dr cr
function get_oc_total(){
	var tdr=0;
	var tcr=0;
	tdr=$("#total_dr").val();
	tcr=$("#total_cr").val();
	ct=$("#cur_rate").val();
	if(tdr>0 && ct>0){
		$("#o_tdr").val((Number(tdr)/Number(ct)).toFixed(3));
	}
	else{
		$("#o_tdr").val(Number(0));
	}
	if(tcr>0 && ct>0){
		$("#o_tcr").val((Number(tcr)/Number(ct)).toFixed(3));
	}else{
		$("#o_tcr").val(Number(0));
	}
}

