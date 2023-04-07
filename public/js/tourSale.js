function tour_tab(type, formData)
{
	$('.loader-bg').show();
	if(type === 'ticket'){
		var tour_inv_date = $('#tour_inv_date').val();
		var tour_client_id = $('#tour_client_id option:selected').val();
		var tt_payable_id = $('#tt_payable_id option:selected').val();
		var tt_sectors=$("#tour-ticket-form .sectors").val();
		/*var tt_departure = $('#tt_departure').val();
		var tt_airline_pnr = $('#tt_airline_pnr').val();*/
		var tour_ticket_no = $('#tour_ticket_no').val();
		var tt_fare = $('#tt_fare').val();
		var toast = '';
		var flag = 'false';
		
		if(tour_inv_date === ''){
			$('#tour_inv_date').css('border-bottom','1px solid #f00');
			toast += 'Invoice date is required.</br>';
			flag = 'true';
		}
		if(tour_client_id === '0'){
			$('#tour_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Client is required.</br>';
			flag = 'true';
		}
		if(tour_client_id === 'other'){
			$('#tour_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Client is required.</br>';
			flag = 'true';
		}
		if(tt_payable_id === '0'){
			$('#tt_payable_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Payable is required.</br>';
			flag = 'true';
		}
		if(tt_payable_id === 'other'){
			$('#tt_payable_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Payable is required.</br>';
			flag = 'true';
		}
		if(tt_sectors === ''){
			$('#tour-ticket-form .sectors').css('border-bottom','1px solid #f00');
			toast += 'Sectors required.</br>';
			flag = 'true';
		}
		/*if(tt_departure === ''){
			$('#tt_departure').css('border-bottom','1px solid #f00');
			toast += 'Departure date is required.</br>';
			flag = 'true';
		}
		if(tt_airline_pnr === ''){
			$('#tt_airline_pnr').css('border-bottom','1px solid #f00');
			toast += 'PNR number is required.</br>';
			flag = 'true';
		}*/
		if(tour_ticket_no === ''){
			$('#tour_ticket_no').css('border-bottom','1px solid #f00');
			toast += 'Ticket number is required.</br>';
			flag = 'true';
		}
		else if(tour_ticket_no.length!==15){
			$('#tour_ticket_no').css('border-bottom','1px solid #f00');
			toast += 'Ticket number is not correct.</br>';
			flag = 'true';
		}
		if(tt_fare === ''){
			$('#tt_fare').css('border-bottom','1px solid #f00');
			toast += 'Fare is required.</br>';
			flag = 'true';
		}
		
		if(flag === 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}else{
			$('#tour_inv_date, #tt_departure, #tt_airline_pnr, #tour_ticket_no, #tt_fare').css('border-bottom','1px solid rgba(0,0,0,0.12)');
			$('#tour_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
			$('#tt_payable_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
		}
	}
	else if(type === 'hotel'){
		var tour_inv_date = $('#tour_inv_date').val();
		var tour_client_id = $('#tour_client_id option:selected').val();
		var tour_hotel_id = $('#th_hId option:selected').val();
		var tour_checkin = $('#th_checkin').val();
		var tour_checkout = $('#th_checkout').val();
		var th_payable_id = $('#th_payable_id option:selected').val();
		var th_guest_beds = $('#th_guest_beds').val();
		var th_rate_night = $('#th_rate_night').val();
		var th_basic_amount = $('#th_basic_amount').val();
		var toast = '';
		var flag = 'false';
		
		if(tour_inv_date == ''){
			$('#tour_inv_date').css('border-bottom','1px solid #f00');
			toast += 'Invoice date is required.</br>';
			flag = 'true';
		}
		if(tour_client_id == '0'){
			$('#tour_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Client is required.</br>';
			flag = 'true';
		}
		if(tour_client_id == 'other'){
			$('#tour_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Client is required.</br>';
			flag = 'true';
		}
		if(tour_hotel_id == '0'){
			$('#th_hId').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Hotel is required.</br>';
			flag = 'true';
		}
		if(tour_checkin == ''){
			$('#th_checkin').css('border-bottom','1px solid #f00');
			toast += 'Check in date is required.</br>';
			flag = 'true';
		}
		if(tour_checkout == ''){
			$('#th_checkout').css('border-bottom','1px solid #f00');
			toast += 'Check out date is required.</br>';
			flag = 'true';
		}
		if(th_payable_id == '0'){
			$('#th_payable_id').css('border-bottom','1px solid #f00');
			toast += 'Payable is required.</br>';
			flag = 'true';
		}
		if(th_payable_id == 'other'){
			$('#th_payable_id').css('border-bottom','1px solid #f00');
			toast += 'Payable is required.</br>';
			flag = 'true';
		}
		if(th_guest_beds == ''){
			$('#th_guest_beds').css('border-bottom','1px solid #f00');
			toast += 'Guest beds are required.</br>';
			flag = 'true';
		}
		if(th_rate_night == ''){
			$('#th_rate_night').css('border-bottom','1px solid #f00');
			toast += 'Rate per night is required.</br>';
			flag = 'true';
		}
		if(th_basic_amount == ''){
			$('#th_basic_amount').css('border-bottom','1px solid #f00');
			toast += 'Basic amount is required.</br>';
			flag = 'true';
		}
		
		if(flag == 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}else{
			$('#tour_inv_date, #th_checkin, #th_checkout, #th_payable_id, #th_guest_beds, #th_rate_night, #th_basic_amount').css('border-bottom','1px solid rgba(0,0,0,0.12)');
			$('#tour_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
			$('#th_hId').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
		}
	}
	else if(type == 'visa'){
		var tour_inv_date = $('#tour_inv_date').val();
		var tour_client_id = $('#tour_client_id option:selected').val();
		var tv_country_id = $('#tv_country_id option:selected').val();
		var tv_quantity = $('#tv_quantity').val();
		var tv_rate = $('#tv_rate').val();
		var tv_basic_fare = $('#tv_basic_fare').val();
		var tv_payable = $('#tv_payable option:selected').val();
		var toast = '';
		var flag = 'false';
		
		if(tour_inv_date == ''){
			$('#tour_inv_date').css('border-bottom','1px solid #f00');
			toast += 'Invoice date is required.</br>';
			flag = 'true';
		}
		if(tour_client_id == '0'){
			$('#tour_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Client is required.</br>';
			flag = 'true';
		}
		if(tour_client_id == 'other'){
			$('#tour_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Client is required.</br>';
			flag = 'true';
		}
		if(tv_country_id == '0'){
			$('#tv_country_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Visa country is required.</br>';
			flag = 'true';
		}
		if(tv_quantity == ''){
			$('#tv_quantity').css('border-bottom','1px solid #f00');
			toast += 'Quantity is required.</br>';
			flag = 'true';
		}
		if(tv_rate == ''){
			$('#tv_rate').css('border-bottom','1px solid #f00');
			toast += 'Rate is required.</br>';
			flag = 'true';
		}
		if(tv_payable == ''){
			$('#tv_payable').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Payable is required.</br>';
			flag = 'true';
		}
		if(tv_payable == 'other'){
			$('#tv_payable').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Payable is required.</br>';
			flag = 'true';
		}
		if(tv_basic_fare == ''){
			$('#tv_basic_fare').css('border-bottom','1px solid #f00');
			toast += 'Fare is required.</br>';
			flag = 'true';
		}
		
		if(flag == 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}else{
			$('#tour_inv_date, #tv_quantity, #tv_rate, #tv_basic_fare').css('border-bottom','1px solid rgba(0,0,0,0.12)');
			$('#tour_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
			$('#tv_country_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
		}
	}
	else if(type == 'transfer'){
		var tour_inv_date = $('#tour_inv_date').val();
		var tour_client_id = $('#tour_client_id option:selected').val();
		var ttrans_payable_id = $('#ttrans_payable_id option:selected').val();
		var ttrans_from_date = $('#ttrans_from_date').val();
		var ttrans_to_date = $('#ttrans_to_date').val();
		var ttrans_quantity = $('#ttrans_quantity').val();
		/*var ttrans_rate = $('#ttrans_rate').val();*/
		var ttrans_basic = $('#ttrans_basic').val();
		var toast = '';
		var flag = 'false';
		
		if(tour_inv_date == ''){
			$('#tour_inv_date').css('border-bottom','1px solid #f00');
			toast += 'Invoice date is required.</br>';
			flag = 'true';
		}
		if(tour_client_id == '0' || tour_client_id=='other'){
			$('#tour_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Client is required.</br>';
			flag = 'true';
		}
		if(ttrans_payable_id == '0'){
			$('#ttrans_payable_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Payable is required.</br>';
			flag = 'true';
		}
		if(ttrans_payable_id == 'other'){
			$('#ttrans_payable_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Payable is required.</br>';
			flag = 'true';
		}
		if(ttrans_from_date == ''){
			$('#ttrans_from_date').css('border-bottom','1px solid #f00');
			toast += 'From date is required.</br>';
			flag = 'true';
		}
		if(ttrans_to_date == ''){
			$('#ttrans_to_date').css('border-bottom','1px solid #f00');
			toast += 'To date is required.</br>';
			flag = 'true';
		}
		if(ttrans_quantity == ''){
			$('#ttrans_quantity').css('border-bottom','1px solid #f00');
			toast += 'Quantity is required.</br>';
			flag = 'true';
		}
		/*if(ttrans_rate == ''){
			$('#ttrans_rate').css('border-bottom','1px solid #f00');
			toast += 'Rate is required.</br>';
			flag = 'true';
		}*/
		if(ttrans_basic == ''){
			$('#ttrans_basic').css('border-bottom','1px solid #f00');
			toast += 'Amount is required.</br>';
			flag = 'true';
		}
		
		if(flag == 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}else{
			$('#tour_inv_date, #ttrans_from_date, #ttrans_to_date, #ttrans_quantity, #ttrans_rate, #ttrans_basic').css('border-bottom','1px solid rgba(0,0,0,0.12)');
			$('#tour_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
			$('#ttrans_payable_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
		}
	}
	else if(type=='other'){
		var tour_client_id = $('#tour_client_id option:selected').val();
		var ttrans_payable_id = $('#to_vendor option:selected').val();
		var ttrans_basic = $('#tour-other-form input[name~="basic_fare"]').val();
		var toast = '';
		var flag = 'false';
		if(tour_client_id == '0' || tour_client_id=='other'){
			$('#tour_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Client is required.</br>';
			flag = 'true';
		}
		if(ttrans_payable_id == '0'){
			$('#to_vendor').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Payable is required.</br>';
			flag = 'true';
		}
		if(ttrans_basic == ''){
			$('#tour-other-form input[name~="basic_fare"]').css('border-bottom','1px solid #f00');
			toast += 'Amount is required.</br>';
			flag = 'true';
		}
		if(flag == 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}
	}
	var inv_id=$("#tour-modal input[name~=inv_id]").val();
	var inv_date=$("#tour-modal input[name~='inv_date']").val();
	var due_date=$("#tour-modal input[name~='due_date']").val();
	var branch_id=$("#tour-modal select[name~='branch_id']").val();
	var client_id=$("#tour-modal select[name~='client_id']").val();
	var payment_term=$("#tour-modal select[name~='payment_term']").val();
	var empl_id=$("#tour-modal select[name~='empl_id']").val();
	var remarks=$("#tour-modal input[name~='remarks']").val();
	dataStr='inv_date='+inv_date+'&due_date='+due_date+'&branch_id='+branch_id+'&client_id='+client_id+'&payment_term='+payment_term+'&empl_id='+empl_id+'&remarks='+remarks+"&type="+type+"&inv_id="+inv_id;
	$("#tour-modal .save-rec").html('<i class="fa fa-save"></i> Save');
	
			$.ajax({
				url:"ajax_call/save_tour_inv?"+dataStr,
				type:"POST",
				data:$("#"+formData).serializeArray(),
				dataType:"JSON",
				success: function(data)
				{
					if(data.error!='3'){
					$("#tour-modal input[name~=inv_id]").val(data.inv);
					$("#"+formData+"  input[name~='id']").val('0'); }
					if(type=='ticket'){
						$("#tour-ticket-table").show();
						get_tour_ticket_records('ticket', data.inv);
						 $(".multiple_rec").find("tr:gt(1)").remove();
						 $("#tour-ticket-form .new-rec").show();
						 $("#tour-ticket-form .save-rec, .void-rec").hide();
					}
					else if(type=='hotel'){
						$("#tour-hotel-table").show();
						get_tour_hotel_records('hotel', data.inv);
					}
					else if(type=='visa'){
						$("#tour-visa-table").show();
						get_tour_visa_records('visa', data.inv);
					}
					else if(type=='transfer'){
						$("#tour-transfer-table").show();
						get_tour_transfer_records('transfer', data.inv);
					}
					else if(type=='other'){
						$("#tour-other-table").show();
						get_tour_other_records('other', data.inv);
					}
					tour_pass_det('submit');
					$('.loader-bg').hide();
					if(data.error=='3'){
						toastr.error('Operation Failed.');
						$('.loader-bg').hide();
					}else if(data.error==5){
					$("#duplicate_tkt_alert").modal();
					}else if(data.error==2){
					$("#credit_limit_alert").modal();
					}else{
						toastr.success('Operation successfull.');	
					}
					
				}
			});
	
}
//tour ticket
//get ticket recoreds
function get_tour_ticket_records(type, invId){
	$('.loader-bg').show();
	$.ajax({
		url:"ajax_call/get_sale_invoices?type="+type+"&invId="+invId,
		dataType:"JSON",
		success: function(data)
		{
			var htmlData="";
			var j=1;
			for(i in data['rec'])
			{
				if(data['rec'][i].refund=='yes'){ var bg="btn-danger";}
				else if(data['rec'][i].status=='voided'){ var bg="btn-warning";}
				else { var bg=""; }
				htmlData+='<tr class="'+bg+'" id="t-'+data['rec'][i].id+'">';
					htmlData+='<td>'+Number(j++)+'</td>';
					htmlData+='<td>'+data['rec'][i].passport+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_name+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_mobile+'</td>';
					htmlData+='<td>'+data['rec'][i].payable_amount+'</td>';
					htmlData+='<td>'+data['rec'][i].receiveable_amount+'</td>';
					htmlData+='<td><button class="btn btn-info btn-mini waves-effect waves-light" onclick="edit_tour_ticket_record('+data['rec'][i].id+', \'ticket\')"> <i class="fa fa-edit"></i></button>';
					if(data['rec'][i].refund=='yes'){
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_tour_ticket_ref_record('+data['rec'][i].id+', \'ticket_ref\', \'refund\')"> <i class="fa fa-undo"></i> Ref</button>';
					}
					else{
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_tour_ticket_record('+data['rec'][i].id+', \'ticket\', \'refund\')"> <i class="fa fa-undo"></i> Ref</button>';	
					}
					/*htmlData+=' <button class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'tticket_rec\', \'t-'+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button></td>';*/
				htmlData+='</tr>';
			}
			$(".get_tour_ticket_records").html(htmlData);
			$('.loader-bg').hide();
		}
	});
}
//edit ticket records 
function edit_tour_ticket_record(id, type, btn_type){
	$('.loader-bg').show();
	$("#tour-ticket-form input[name~='refId']").val('0');
	if(btn_type == 'refund'){
		$('#c_charges_div, #s_charges_div').css('display','block');
		$('.refEdit').css('background','#ff5252');
		$('.refText').css('color','#ff5252');
		$("#tour-ticket-form .save-rec").hide();
		$("#tour-ticket-form .ref-rec").show();
		$('.t_payable').closest('.form-group').find('label').html('Rec from Vendor');
		$('.t_receiveable').closest('.form-group').find('label').html('Pay to Customer');
		$('.tprofit').closest('.form-group').find('label').html('Loss');
		$("#tour-modal input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
		$('.refEdit').addClass("refunding");
	}else{
		$('#c_charges_div, #s_charges_div').css('display','none');
		$('.refEdit').css('background','#1aa89d');
		$('.refText').css('color','#1aa89d');
		$("#tour-ticket-form .save-rec").html('<i class="fa fa-save"></i> Update');
		$("#tour-ticket-form .save-rec").show();
		$("#tour-ticket-form .ref-rec").hide();
		$('.t_payable').closest('.form-group').find('label').html('Payable');
		$('.t_receiveable').closest('.form-group').find('label').html('Receiveable');
		$("#tour-modal input[name~='inv_date']").closest('.form-group').find('label').text('Invoice Date');
		$('.tprofit').closest('.form-group').find('label').html('Profit');
		$("#tour-ticket-form .void-rec").show();
		$('.refEdit').removeClass("refunding");
	}
	$.ajax({
		url:"ajax_call/edit_sale_invoice?id="+id+"&type="+type,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#tour-modal input[name~='inv_date']").val(data.inv.si.inv_date);
			$("#tour-modal input[name~='due_date']").val(data.inv.si.due_date);
			$("#tour-modal select[name~='branch_id']").val(data.inv.si.branch_id);
			$("#tour-modal select[name~='client_id']").val(data.inv.si.client_id);
			$("#tour-modal select[name~='payment_term']").val(data.inv.si.payment_term);
			$("#tour-modal select[name~='empl_id']").val(data.inv.si.empl_id);
			$("#tour-modal name[name~='remarks']").val(data.inv.si.remarks);
			// ticket details
			$("#tour-ticket-form input[name~='inv_id']").val(data.inv.si.invId);
			$("#tour-ticket-form input[name~='id']").val(data.inv.det.id);
			$("#tour-ticket-form #ticket_passengers").val(data.inv.det.pass_name);
			/*$("#tour-ticket-form input[name~='name']").val(data.inv.det.pass_name);*/
			$("#tour-ticket-form select[name~='vendor_id']").val(data.inv.det.vendor_id);
			$("#tour-ticket-form input[name~='sectors']").val(data.inv.det.sectors);
			$("#tour-ticket-form select[name~='airline_route']").val(data.inv.det.airline_route);
			$("#tour-ticket-form input[name~='airline_gds']").val(data.inv.det.airline_gds);
			$("#tour-ticket-form input[name~='airline_route']").val(data.inv.det.airline_route);
			$("#tour-ticket-form input[name~='flight_no']").val(data.inv.det.flight_no);
			$("#tour-ticket-form input[name~='departure']").val(data.inv.det.departure);
			$("#tour-ticket-form input[name~='return_date']").val(data.inv.det.return_date);
			$("#tour-ticket-form input[name~='airline_pnr']").val(data.inv.det.airline_pnr);
			$("#tour-ticket-form input[name~='gds_pnr']").val(data.inv.det.gds_pnr);
			$("#tour-ticket-form input[name~='ticket_type']").val(data.inv.det.ticket_type);
			$("#tour-ticket-form input[name~='ticket_no']").val(data.inv.det.airline_code+'-'+data.inv.det.ticket_no);
			$("#tour-ticket-form input[name~='conj_ticket_no']").val(data.inv.det.airline_code+'-'+data.inv.det.conj_ticket_no);
			$("#tour-ticket-form input[name~='base_fare']").val(data.inv.det.base_fare);
			$("#tour-ticket-form input[name~='sp_yi_tax']").val(data.inv.det.sp_yi_tax);
			$("#tour-ticket-form input[name~='rg_cvt_tax']").val(data.inv.det.rg_cvt_tax);
			$("#tour-ticket-form input[name~='yq_tax']").val(data.inv.det.yq_tax);
			$("#tour-ticket-form input[name~='ced_tax']").val(data.inv.det.ced_tax);
			$("#tour-ticket-form input[name~='pb_adv_yq_tax']").val(data.inv.det.pb_adv_tax);
			$("#tour-ticket-form input[name~='xz_tax']").val(data.inv.det.xz_tax);
			$("#tour-ticket-form input[name~='yd_tax']").val(data.inv.det.yd_tax);
			$("#tour-ticket-form input[name~='xt_ur_tax']").val(data.inv.det.xt_ur_tax);
			$("#tour-ticket-form input[name~='other_tax']").val(data.inv.det.other_tax);
			$("#tour-ticket-form input[name~='total_taxes']").val(data.inv.det.total_tax);
			$("#tour-ticket-form input[name~='com_recp']").val(data.inv.det.com_recp);
			$("#tour-ticket-form input[name~='com_rec']").val(data.inv.det.com_rec);
			$("#tour-ticket-form input[name~='com_paidp']").val(data.inv.det.com_paidp);
			$("#tour-ticket-form input[name~='com_paid']").val(data.inv.det.com_paid);
			$("#tour-ticket-form input[name~='wh_air']").val(data.inv.det.wh_air);
			$("#tour-ticket-form input[name~='pst_paid']").val(data.inv.det.pst_paid);
			$("#tour-ticket-form input[name~='psfp']").val(data.inv.det.psfp);
			$("#tour-ticket-form input[name~='psf']").val(data.inv.det.psf);
			$("#tour-ticket-form input[name~='discountp']").val(data.inv.det.discountp);
			$("#tour-ticket-form input[name~='discount']").val(data.inv.det.discount);
			$("#tour-ticket-form input[name~='wh_clientp']").val(data.inv.det.wh_clientp);
			$("#tour-ticket-form input[name~='wh_client']").val(data.inv.det.wh_client);
			$("#tour-ticket-form input[name~='fare_include']").val(data.inv.det.fare_inc);
			$("#tour-ticket-form input[name~='tax_include']").val(data.inv.det.tax_inc);
			$("#tour-ticket-form input[name~='f_agent_amount']").val(data.inv.det.f_agent_amount);
			$("#tour-ticket-form select[name~='f_agent_id']").val(data.inv.det.f_agent_id);
			$("#tour-ticket-form input[name~='s_agent_amount']").val(data.inv.det.s_agent_amount);
			$("#tour-ticket-form select[name~='s_agent_id']").val(data.inv.det.s_agent_id);
			$("#tour-ticket-form input[name~='payable_amount']").val(data.inv.det.payable_amount);
			$("#tour-ticket-form input[name~='receiveable_amount']").val(data.inv.det.receiveable_amount);
			$("#tour-ticket-form input[name~='profit']").val(data.inv.det.profit);
			$("#tour-ticket-form select[name~='cur_type']").val(data.inv.det.cur_type);
			$("#tour-ticket-form input[name~='cur_rate']").val(data.inv.det.cur_rate);
			//calculate currency rate
			var np=Number(data.inv.det.payable_amount)/Number(data.inv.det.cur_rate);
			var nr=Number(data.inv.det.receiveable_amount)/Number(data.inv.det.cur_rate);
			var npro=Number(data.inv.det.profit)/Number(data.inv.det.cur_rate);
			$("#tour-ticket-form input[name~='cur_p']").val(np.toFixed(2));
			$("#tour-ticket-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#tour-ticket-form input[name~='cur_profit']").val(npro.toFixed(2));
			//sector details............
			var htmlData=""; htmlData1="";
			for(i in data['sec_det'])
			{
				if(i<4){
				htmlData+='<tr class="calClass">'+
                        '<td><input type="text" name="sec_in[]" value="'+data['sec_det'][i].sec_in+'"></td>'+
                        '<td><input type="text" name="sec_out[]" value="'+data['sec_det'][i].sec_out+'"></td>'+
                        '<td><input type="text" name="sec_date[]" class="date" value="'+data['sec_det'][i].sec_date+'"></td>'+
                        '<td><input type="text" name="sec_class[]" value="'+data['sec_det'][i].sec_class+'"></td>'+
                        '<td><input type="text" name="sec_time[]" value="'+data['sec_det'][i].sec_time+'"></td>'+
                        '<td><input type="text" name="rate[]" class="rate" value="'+data['sec_det'][i].rate+'"></td>'+
                        '<td><input type="text" name="ex_rate[]" class="er" value="'+data['sec_det'][i].ex_rate+'"></td>';
						if(i==0){
                        htmlData+='<td style="position:relative;"><input type="text" name="bf[]" class="bf" value="'+data['sec_det'][i].bf+'"><button type="button" class="fa fa-plus multiple_rec_app" style="position: absolute;color: #1aa89d; background:none;border:none;right: -8px;bottom: 17px;"></button></td>';
						}
						else{
                        htmlData+='<td style="position:relative;"><input type="text" name="bf[]" class="bf" value="'+data['sec_det'][i].bf+'"><i class="fa fa-times remove" style="position: absolute;color: lightcoral;right: -5;bottom: 24;"><i></td>';
						}
                      htmlData+='</tr>';
				}
				else
				{
					$("#conj-ticket").show();
					htmlData1+='<tr class="calClass">'+
                        '<td><input type="text" name="sec_in[]" value="'+data['sec_det'][i].sec_in+'"></td>'+
                        '<td><input type="text" name="sec_out[]" value="'+data['sec_det'][i].sec_out+'"></td>'+
                        '<td><input type="text" name="sec_date[]" class="date" value="'+data['sec_det'][i].sec_date+'"></td>'+
                        '<td><input type="text" name="sec_class[]" value="'+data['sec_det'][i].sec_class+'"></td>'+
                        '<td><input type="text" name="sec_time[]" value="'+data['sec_det'][i].sec_time+'"></td>'+
                        '<td><input type="text" name="rate[]" class="rate" value="'+data['sec_det'][i].rate+'"></td>'+
                        '<td><input type="text" name="ex_rate[]" class="er multiple_rec_app" value="'+data['sec_det'][i].ex_rate+'"></td>';
						htmlData1+='<td style="position:relative;"><input type="text" name="bf[]" class="bf" value="'+data['sec_det'][i].bf+'"><i class="fa fa-times remove" style="position: absolute;color: lightcoral;right: -5;bottom: 24;"><i></td>';
						htmlData1+='</tr>';
					
				}
			}
			if(data.inv.det.refund=='yes')
			{
				$("#tour-ticket-form #refundDiv").html('<a href="../invoice/credit-note?refId='+data.inv.det.refId+'" target="_blank" class="btn btn-sm btn-danger form-control">Refunded #'+data.inv.det.refId+'</i></a>').show();
				$("#ticket-form input[name~='refId']").val(data.inv.det.refId);
			}
			$("#tour-ticket-form .multiple_rec >tbody:last-child").html(htmlData);
			$("#tour-ticket-form .conj_multiple_rec >tbody:last-child").html(htmlData1);
			$(".js-example-basic-single").select2();
			$('#ticket_passengers').multiselect('destroy');
			$('#ticket_passengers').multiselect();
			$('.loader-bg').hide();
		}
	});
}
//===============Edit ticke Refund details......................
function edit_tour_ticket_ref_record(id, type, btn_type){
	$('.loader-bg').show();
	if(btn_type == 'refund'){
		$('#tour-ticket-form #c_charges_div, #s_charges_div').css('display','block');
		$('#tour-modal .refEdit').css('background','#ff5252');
		$('#tour-modal .refText').css('color','#ff5252');
		$("#tour-ticket-form .save-rec").hide();
		$("#tour-ticket-form .ref-rec").show();
		$('.t_payable').closest('.form-group').find('label').html('Rec from Vendor');
		$('.t_receiveable').closest('.form-group').find('label').html('Pay to Customer');											       $("#tour-modal #tour_inv_date").closest('.form-group').find('label').text('Refund Date');
		$('.tprofit').closest('.form-group').find('label').html('Loss');
	}
	$.ajax({
		url:"ajax_call/edit_sale_invoice?id="+id+"&type="+type,
		dataType:"JSON",
		success: function(data)
		{
			$("#ticket-form .save-rec").html('<i class="fa fa-save"></i> Update');
			//pos inovice dtails
			$("#tour-modal input[name~='inv_date']").val(data.inv.si.inv_date);
			$("#tour-modal input[name~='due_date']").val(data.inv.si.due_date);
			$("#tour-modal select[name~='branch_id']").val(data.inv.si.branch_id);
			$("#tour-modal select[name~='client_id']").val(data.inv.si.client_id);
			$("#tour-modal select[name~='payment_term']").val(data.inv.si.payment_term);
			$("#tour-modal select[name~='empl_id']").val(data.inv.si.empl_id);
			$("#tour-modal name[name~='remarks']").val(data.inv.si.remarks);
			// ticket details
			$("#tour-ticket-form input[name~='id']").val(data.inv.det.id);
			$("#tour-ticket-form input[name~='refId']").val(data.inv.refund.id);
			$("#tour-ticket-form input[name~='passport']").val(data.inv.det.passport);
			$("#tour-ticket-form #ticket_passengers").val(data.inv.det.pass_name);
			$("#tour-ticket-form input[name~='pass_mobile']").val(data.inv.det.pass_mobile);
			$("#tour-ticket-form select[name~='pass_type']").val(data.inv.det.pass_type);
			$("#tour-ticket-form select[name~='vendor_id']").val(data.inv.det.vendor_id);
			$("#tour-ticket-form input[name~='sectors']").val('azeem');
			$("#tour-ticket-form input[name~='airline_gds']").val(data.inv.det.airline_gds);
			$("#tour-ticket-form input[name~='airline_route']").val(data.inv.det.airline_route);
			$("#tour-ticket-form input[name~='flight_no']").val(data.inv.det.flight_no);
			$("#tour-ticket-form input[name~='departure']").val(data.inv.det.departure);
			$("#tour-ticket-form input[name~='return_date']").val(data.inv.det.return_date);
			$("#tour-ticket-form input[name~='airline_pnr']").val(data.inv.det.airline_pnr);
			$("#tour-ticket-form input[name~='gds_pnr']").val(data.inv.det.gds_pnr);
			$("#tour-ticket-form input[name~='ticket_type']").val(data.inv.det.ticket_type);
			$("#tour-ticket-form input[name~='ticket_no']").val(data.inv.det.airline_code+'-'+data.inv.det.ticket_no);
			$("#tour-ticket-form input[name~='conj_ticket_no']").val(data.inv.det.airline_code+'-'+data.inv.det.conj_ticket_no);
			$("#tour-ticket-form input[name~='base_fare']").val(data.inv.refund.base_fare);
			$("#tour-ticket-form input[name~='sp_yi_tax']").val(data.inv.refund.sp_yi_tax);
			$("#tour-ticket-form input[name~='rg_cvt_tax']").val(data.inv.refund.rg_cvt_tax);
			$("#tour-ticket-form input[name~='yq_tax']").val(data.inv.refund.yq_tax);
			$("#tour-ticket-form input[name~='ced_tax']").val(data.inv.refund.ced_tax);
			$("#tour-ticket-form input[name~='pb_adv_yq_tax']").val(data.inv.refund.pb_adv_tax);
			$("#tour-ticket-form input[name~='xz_tax']").val(data.inv.refund.xz_tax);
			$("#tour-ticket-form input[name~='yd_tax']").val(data.inv.refund.yd_tax);
			$("#tour-ticket-form input[name~='xt_ur_tax']").val(data.inv.refund.xt_ur_tax);
			$("#tour-ticket-form input[name~='other_tax']").val(data.inv.refund.other_tax);
			$("#tour-ticket-form input[name~='total_taxes']").val(data.inv.refund.total_tax);
			$("#tour-ticket-form input[name~='com_recp']").val(data.inv.refund.com_recp);
			$("#tour-ticket-form input[name~='com_rec']").val(data.inv.refund.com_rec);
			$("#tour-ticket-form input[name~='com_paidp']").val(data.inv.refund.com_paidp);
			$("#tour-ticket-form input[name~='com_paid']").val(data.inv.refund.com_paid);
			$("#tour-ticket-form input[name~='wh_air']").val(data.inv.refund.wh_air);
			$("#tour-ticket-form input[name~='pst_paid']").val(data.inv.refund.pst_paid);
			$("#tour-ticket-form input[name~='psfp']").val(data.inv.refund.psfp);
			$("#tour-ticket-form input[name~='psf']").val(data.inv.refund.psf);
			$("#tour-ticket-form input[name~='discountp']").val(data.inv.refund.discountp);
			$("#tour-ticket-form input[name~='discount']").val(data.inv.refund.discount);
			$("#tour-ticket-form input[name~='wh_clientp']").val(data.inv.refund.wh_clientp);
			$("#tour-ticket-form input[name~='wh_client']").val(data.inv.refund.wh_client);
			$("#tour-ticket-form input[name~='fare_include']").val(data.inv.refund.fare_inc);
			$("#tour-ticket-form input[name~='tax_include']").val(data.inv.refund.tax_inc);
			$("#tour-ticket-form input[name~='f_agent_amount']").val(data.inv.refund.f_agent_amount);
			$("#tour-ticket-form select[name~='f_agent_id']").val(data.inv.refund.f_agent_id);
			$("#tour-ticket-form input[name~='s_agent_amount']").val(data.inv.refund.s_agent_amount);
			$("#tour-ticket-form select[name~='s_agent_id']").val(data.inv.refund.s_agent_id);
			$("#tour-ticket-form input[name~='payable_amount']").val(data.inv.refund.payable_amount);
			$("#tour-ticket-form input[name~='receiveable_amount']").val(data.inv.refund.receiveable_amount);
			$("#tour-ticket-form input[name~='profit']").val(data.inv.refund.profit);
			$("#tour-ticket-form select[name~='cur_type']").val(data.inv.refund.cur_type);
			$("#tour-ticket-form input[name~='cur_rate']").val(data.inv.refund.cur_rate);
			//calculate currencies rate
			var np=Number(data.inv.refund.payable_amount)/Number(data.inv.refund.cur_rate);
			var nr=Number(data.inv.refund.receiveable_amount)/Number(data.inv.refund.cur_rate);
			var npro=Number(data.inv.refund.profit)/Number(data.inv.refund.cur_rate);
			$("#tour-ticket-form input[name~='cur_p']").val(np.toFixed(2));
			$("#tour-ticket-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#tour-ticket-form input[name~='cur_profit']").val(npro.toFixed(2));
			$("#tour-ticket-form input[name~='service_charges']").val(data.inv.refund.service_charges);
			$("#tour-ticket-form input[name~='cancellation_charges']").val(data.inv.refund.cancellation_charges);
			$("#refund-sectors").html('<strong>Refund Sector:</strong> '+data.inv.refund.ref_sectors+'').show();
			//sector details............
			var htmlData=""; htmlData1="";
			for(i in data['sec_det']){
				if(i<3){
				htmlData+='<tr class="calClass">'+
                        '<td><input type="text" name="sec_in[]" value="'+data['sec_det'][i].sec_in+'"></td>'+
                        '<td><input type="text" name="sec_out[]" value="'+data['sec_det'][i].sec_out+'"></td>'+
                        '<td><input type="text" name="sec_date[]" class="date" value="'+data['sec_det'][i].sec_date+'"></td>'+
                        '<td><input type="text" name="sec_class[]" value="'+data['sec_det'][i].sec_class+'"></td>'+
                        '<td><input type="text" name="sec_time[]" value="'+data['sec_det'][i].sec_time+'"></td>'+
                        '<td><input type="text" name="rate[]" class="rate" value="'+data['sec_det'][i].rate+'"></td>'+
                        '<td><input type="text" name="ex_rate[]" class="er" value="'+data['sec_det'][i].ex_rate+'"></td>';
						if(i==0){
                        htmlData+='<td style="position:relative;"><input type="text" name="bf[]" class="bf" value="'+data['sec_det'][i].bf+'"><button type="button" class="fa fa-plus multiple_rec_app" style="position: absolute;color: #1aa89d; background:none;border:none;right: -8px;bottom: 17px;"></button></td>';
						}
						else{
                        htmlData+='<td style="position:relative;"><input type="text" name="bf[]" class="bf" value="'+data['sec_det'][i].bf+'"><i class="fa fa-times remove" style="position: absolute;color: lightcoral;right: -5;bottom: 24;"><i></td>';
						}
                      htmlData+='</tr>';
				}
				else{
					$("#conj-ticket").show();
					htmlData1+='<tr class="calClass">'+
                        '<td><input type="text" name="sec_in[]" value="'+data['sec_det'][i].sec_in+'"></td>'+
                        '<td><input type="text" name="sec_out[]" value="'+data['sec_det'][i].sec_out+'"></td>'+
                        '<td><input type="text" name="sec_date[]" class="date" value="'+data['sec_det'][i].sec_date+'"></td>'+
                        '<td><input type="text" name="sec_class[]" value="'+data['sec_det'][i].sec_class+'"></td>'+
                        '<td><input type="text" name="sec_time[]" value="'+data['sec_det'][i].sec_time+'"></td>'+
                        '<td><input type="text" name="rate[]" class="rate" value="'+data['sec_det'][i].rate+'"></td>'+
                        '<td><input type="text" name="ex_rate[]" class="er multiple_rec_app" value="'+data['sec_det'][i].ex_rate+'"></td>';
						htmlData1+='<td style="position:relative;"><input type="text" name="bf[]" class="bf" value="'+data['sec_det'][i].bf+'"><i class="fa fa-times remove" style="position: absolute;color: lightcoral;right: -5;bottom: 24;"><i></td>';
						htmlData1+='</tr>';
					
				}
				$("#tour-ticket-form #refundDiv").html('<a href="../invoice/credit-note?refId='+data.inv.det.refId+'" target="_blank" class="btn btn-sm btn-danger form-control">Refunded #'+data.inv.det.refId+'</i></a>').show();
				$("#ticket-form input[name~='refId']").val(data.inv.det.refId);
			}
			$(".multiple_rec >tbody:last-child").html(htmlData);
			$(".conj_multiple_rec >tbody:last-child").html(htmlData1);
			$(".js-example-basic-single").select2();
			$('#ticket_passengers').multiselect('destroy');
			$('#ticket_passengers').multiselect();
			$('.loader-bg').hide();
		}
	});
}
//tour hotel
function get_tour_hotel_records(type, invId)
{
	$('.loader-bg').show();
	$.ajax({
		url:"ajax_call/get_sale_invoices?type="+type+"&invId="+invId,
		dataType:"JSON",
		success: function(data)
		{
			j=1;
			var htmlData="";
			for(i in data['rec']){
				htmlData+='<tr id="h-'+data['rec'][i].id+'">';
					htmlData+='<td>'+j+'</td>';
					htmlData+='<td>'+data['rec'][i].booking_name+'</td>';
					htmlData+='<td>'+data['rec'][i].hotelName+'</td>';
					htmlData+='<td>'+data['rec'][i].check_in+'</td>';
					htmlData+='<td>'+data['rec'][i].check_out+'</td>';
					htmlData+='<td>'+data['rec'][i].payable_amount+'</td>';
					htmlData+='<td>'+data['rec'][i].receiveable_amount+'</td>';
					htmlData+='<td><button class="btn btn-info btn-mini waves-effect waves-light" onclick="edit_tour_hotel_invoice('+data['rec'][i].id+', \'hotel\')"> <i class="fa fa-edit"></i></button>';
					if(data['rec'][i].refund=='yes'){
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_tour_hotel_ref_invoice('+data['rec'][i].id+', \'hotel_ref\', \'refund\')"> <i class="fa fa-undo"></i> Ref</button>'; }
					else
					{
						htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_tour_hotel_invoice('+data['rec'][i].id+', \'hotel\', \'refund\')"> <i class="fa fa-undo"></i> Ref</button>';
					}
					 /*htmlData+=' <button class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'thotel_rec\', \'h-'+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button></td>';*/
				htmlData+='</tr>';
				j++;
			}
			$(".get_tour_hotel_records").html(htmlData);
			$('.loader-bg').hide();
		}
	});
}
function edit_tour_hotel_invoice(id, type, btn_type)
{
	$('.loader-bg').show();
	if(btn_type == 'refund'){
		$('#tour-modal .refEdit').css('background','#ff5252');
		$('#tour-hotel-form .refText').css('color','#ff5252');
		$('#tour-hotel-form .h_np').closest('.form-group').find('label').html('Rec from Vendor');
		$('#tour-hotel-form .h_nr').closest('.form-group').find('label').html('Pay to Customer');
		$('#tour-hotel-form .hProfit').closest('.form-group').find('label').html('Loss');
		$("#tour-modal").find("input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
		$("#tour-hotel-form #c_charges_div, #s_charges_div").css("display", "block");
		$("#tour-hotel-form .save-rec").hide();
		$("#tour-hotel-form .ref-rec").show();
	}else{
		$('.refEdit').css('background','#1aa89d');
		$('.refText').css('color','#1aa89d');
		$("#tour-hotel-form .save-rec").html('<i class="fa fa-save"></i> Update').show();
		$("#tour-hotel-form .ref-rec").hide();
		$('#tour-hotel-form .h_np').closest('.form-group').find('label').html('Payable');
		$('#tour-hotel-form .h_nr').closest('.form-group').find('label').html('Receiveable');
		$('#tour-hotel-form .hProfit').closest('.form-group').find('label').html('Profit');
		$("#tour-modal").find("input[name~='inv_date']").closest('.form-group').find('label').text('Invoice Date');
		$('#tour-hotel-form .tprofit').closest('.form-group').find('label').html('Profit');
		$("#tour-hotel-form input[name~='refId']").val(0);
		$("#tour-hotel-form #c_charges_div, #s_charges_div").hide();
		$("#tour-hotel-form .save-rec").html('<i class="fa fa-save"></i> Update');
		$("#tour-hotel-form .ref-rec").hide();	
	}
	$.ajax({
		url:"ajax_call/edit_sale_invoice?id="+id+"&type="+type,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#tour-modal input[name~='inv_date']").val(data.si.inv_date);
			$("#tour-modal input[name~='due_date']").val(data.si.due_date);
			$("#tour-modal select[name~='branch_id']").val(data.si.branch_id);
			$("#tour-modal select[name~='client_id']").val(data.si.client_id);
			$("#tour-modal select[name~='payment_term']").val(data.si.payment_term);
			$("#tour-modal select[name~='empl_id']").val(data.si.empl_id);
			$("#tour-modal input[name~='remarks']").val(data.si.remarks);
			//=========================
			$("#tour-hotel-form input[name~='inv_id']").val(data.si.invId);
			$("#tour-hotel-form input[name~='id']").val(data.det.id);
			$("#tour-hotel-form #hotel_passengers").val(data.det.booking_name);
			/*$("#tour-hotel-form #hotel_passengers").val(data.det.booking_name).attr("selected");*/
			$("#tour-hotel-form input[name~='group_no']").val(data.det.group_no);
			$("#tour-hotel-form select[name~='hotel_id']").val(data.det.hotel_id);
			$("#tour-hotel-form select[name~='payable_id']").val(data.det.payable_id);
			$("#tour-hotel-form input[name~='conf_no']").val(data.det.conf_no);
			$("#tour-hotel-form input[name~='internal_ref']").val(data.det.internal_ref);
			$("#tour-hotel-form input[name~='room_par']").val(data.det.room_par);
			$("#tour-hotel-form input[name~='guest_beds']").val(data.det.guest_beds);
			$("#tour-hotel-form input[name~='meal']").val(data.det.meal);
			$("#tour-hotel-form input[name~='check_in']").val(data.det.check_in);
			$("#tour-hotel-form input[name~='nights']").val(data.det.nights);
			$("#tour-hotel-form input[name~='check_out']").val(data.det.check_out);
			$("#tour-hotel-form input[name~='qty']").val(data.det.qty);
			$("#tour-hotel-form input[name~='rate_night']").val(data.det.rate_night);
			$("#tour-hotel-form input[name~='room_no']").val(data.det.room_no);
			$("#tour-hotel-form input[name~='particulars']").val(data.det.particulars);
			$("#tour-hotel-form input[name~='basic_amount']").val(data.det.basic_amount);
			$("#tour-hotel-form input[name~='com_recp']").val(data.det.com_recp);
			$("#tour-hotel-form input[name~='com_rec']").val(data.det.com_rec);
			$("#tour-hotel-form input[name~='com_paidp']").val(data.com_paidp);
			$("#tour-hotel-form input[name~='com_paid']").val(data.det.com_paid);
			$("#tour-hotel-form input[name~='wh']").val(data.det.wh);
			$("#tour-hotel-form input[name~='pst_paid']").val(data.det.pst_paid);
			$("#tour-hotel-form input[name~='f_agent_amount']").val(data.det.f_agent_amount);
			$("#tour-hotel-form select[name~='f_agent_id']").val(data.det.f_agent_id);
			$("#tour-hotel-form input[name~='s_agent_amount']").val(data.det.s_agent_amount);
			$("#tour-hotel-form select[name~='s_ageent_id']").val(data.det.s_ageent_id);
			$("#tour-hotel-form input[name~='psf']").val(data.det.psf);
			$("#tour-hotel-form input[name~='discount_per']").val(data.det.discount_per);
			$("#tour-hotel-form input[name~='discount']").val(data.det.discount);
			$("#tour-hotel-form input[name~='pst_rec']").val(data.det.pst_rec);
			$("#tour-hotel-form input[name~='payable_amount']").val(data.det.payable_amount);
			$("#tour-hotel-form input[name~='receiveable_amount']").val(data.det.receiveable_amount);
			$("#tour-hotel-form input[name~='profit']").val(data.det.profit);
			$("#tour-hotel-form select[name~='cur_type']").val(data.det.cur_type);
			$("#tour-hotel-form input[name~='cur_rate']").val(data.det.cur_rate);
			//calculate currency rate
			var np=Number(data.det.payable_amount)/Number(data.det.cur_rate);
			var nr=Number(data.det.receiveable_amount)/Number(data.det.cur_rate);
			var npro=Number(data.det.profit)/Number(data.det.cur_rate);
			$("#tour-hotel-form input[name~='cur_p']").val(np.toFixed(2));
			$("#tour-hotel-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#tour-hotel-form input[name~='cur_profit']").val(npro.toFixed(2));
			if(data.det.refund=='yes'){
				$("#tour-hotel-form #refundDiv").html('<a href="../invoice/hotel_credit-note?refId='+data.det.refId+'" class="btn btn-sm btn-danger form-control" target="_blank">Refunded #'+data.det.refId+'</i></a>').show();
			}
			$(".js-example-basic-single").select2();
			$('#hotel_passengers').multiselect('destroy');
			$('#hotel_passengers').multiselect();
			$('.loader-bg').hide();
		}
	});
}
function edit_tour_hotel_ref_invoice(id, type, btn_type)
{
	$('.loader-bg').show();
	if(btn_type == 'refund'){
		$("#tour-hotel-form .save-rec").hide();
		$("#tour-hotel-form .ref-rec").show();
		$("#tour-hotel-form").parents("#tour-modal").find(".refEdit").first().css('background','rgb(255, 82, 82)');
		$('#tour-hotel-form .refText').css('color','#ff5252');
		$('#tour-hotel-form .h_np').closest('.form-group').find('label').html('Rec from Vendor');
		$('#tour-hotel-form .h_nr').closest('.form-group').find('label').html('Pay to Customer');
		$("#tour-hotel-form input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
		$('#tour-hotel-form #c_charges_div, #s_charges_div').css('display','block');
	}
	$.ajax({
		url:"ajax_call/edit_sale_invoice?id="+id+"&type="+type,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#tour-modal input[name~='inv_date']").val(data.si.inv_date);
			$("#tour-modal input[name~='due_date']").val(data.si.due_date);
			$("#tour-modal select[name~='branch_id']").val(data.si.branch_id);
			$("#tour-modal select[name~='client_id']").val(data.si.client_id);
			$("#tour-modal select[name~='payment_term']").val(data.si.payment_term);
			$("#tour-modal select[name~='empl_id']").val(data.si.empl_id);
			$("#tour-modal name[name~='remarks']").val(data.si.remarks);
			//=========================
			$("#tour-hotel-form input[name~='id']").val(data.det.id);
			$("#tour-hotel-form input[name~='passport']").val(data.det.passport);
			$("#tour-hotel-form input[name~='name']").val(data.det.booking_name);
			$("#tour-hotel-form input[name~='pass_mobile']").val(data.det.pass_mobile);
			$("#tour-hotel-form input[name~='pass_type']").val(data.det.pass_type);
			$("#tour-hotel-form input[name~='group_no']").val(data.det.group_no);
			$("#tour-hotel-form input[name~='hotel_id']").val(data.det.hotel_id);
			$("#tour-hotel-form input[name~='payable_id']").val(data.det.payable_id);
			$("#tour-hotel-form input[name~='conf_no']").val(data.det.conf_no);
			$("#tour-hotel-form input[name~='internal_ref']").val(data.det.internal_ref);
			$("#tour-hotel-form input[name~='room_par']").val(data.det.room_par);
			$("#tour-hotel-form input[name~='guest_beds']").val(data.det.guest_beds);
			$("#tour-hotel-form input[name~='meal']").val(data.det.meal);
			$("#tour-hotel-form input[name~='check_in']").val(data.det.check_in);
			$("#tour-hotel-form input[name~='nights']").val(data.det.nights);
			$("#tour-hotel-form input[name~='check_out']").val(data.det.check_out);
			$("#tour-hotel-form input[name~='qty']").val(data.det.qty);
			$("#tour-hotel-form input[name~='rate_night']").val(data.det.rate_night);
			$("#tour-hotel-form input[name~='room_no']").val(data.det.room_no);
			$("#tour-hotel-form input[name~='particulars']").val(data.det.particulars);
			$("#tour-hotel-form input[name~='basic_amount']").val(data.refund.base_fare);
			$("#tour-hotel-form input[name~='com_recp']").val(data.refund.com_recp);
			$("#tour-hotel-form input[name~='com_rec']").val(data.refund.com_rec);
			$("#tour-hotel-form input[name~='com_paidp']").val(data.refund.com_paidp);
			$("#tour-hotel-form input[name~='com_paid']").val(data.refund.com_paid);
			$("#tour-hotel-form input[name~='wh']").val(data.refund.wh);
			$("#tour-hotel-form input[name~='pst_paid']").val(data.refund.pst_paid);
			$("#tour-hotel-form input[name~='f_agent_amount']").val(data.refund.f_agent_amount);
			$("#tour-hotel-form select[name~='f_agent_id']").val(data.refund.f_agent_id);
			$("#tour-hotel-form input[name~='s_agent_amount']").val(data.refund.s_agent_amount);
			$("#tour-hotel-form select[name~='s_ageent_id']").val(data.refund.s_ageent_id);
			$("#tour-hotel-form input[name~='psf']").val(data.refund.psf);
			$("#tour-hotel-form input[name~='discount_per']").val(data.refund.discount_per);
			$("#tour-hotel-form input[name~='discount']").val(data.refund.discount);
			$("#tour-hotel-form input[name~='pst_rec']").val(data.refund.pst_rec);
			$("#tour-hotel-form input[name~='payable_amount']").val(data.refund.payable_amount);
			$("#tour-hotel-form input[name~='receiveable_amount']").val(data.refund.receiveable_amount);
			$("#tour-hotel-form input[name~='profit']").val(data.refund.profit);
			$("#tour-hotel-form select[name~='cur_type']").val(data.refund.cur_type);
			$("#tour-hotel-form input[name~='cur_rate']").val(data.refund.cur_rate);
			//calculate currencies rate
			var np=Number(data.refund.payable_amount)/Number(data.refund.cur_rate);
			var nr=Number(data.refund.receiveable_amount)/Number(data.refund.cur_rate);
			var npro=Number(data.refund.profit)/Number(data.refund.cur_rate);
			$("#tour-hotel-form input[name~='cur_p']").val(np.toFixed(2));
			$("#tour-hotel-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#tour-hotel-form input[name~='cur_profit']").val(npro.toFixed(2));
			$("#tour-hotel-form input[name~='refId']").val(data.refund.id);
			$("#tour-hotel-form input[name~='canc_charges']").val(data.refund.cancellation_charges);
			$("#tour-hotel-form input[name~='service_charges']").val(data.refund.service_charges);
			$("#tour-hotel-form #refundDiv").html('<a href="../invoice/hotel_credit-note?refId='+data.refund.id+'" class="btn btn-sm btn-danger form-control" target="_blank">Refunded #'+data.refund.id+'</i></a>').show();
			//refund profit loss details
			var np=Number(data.refund.com_rec)+Number(data.refund.f_agent_amount)+Number(data.refund.s_agent_amount)+Number(data.refund.psf)-Number(data.refund.discount)-Number(data.refund.service_charges);
			if(np<0){
				$('#tour-hotel-form .hProfit').closest('.form-group').find('label').html('Profit'); }
			else{
				$('#tour-hotel-form .hProfit').closest('.form-group').find('label').html('Loss');
			}
			//passport details
			var pdHtml="";
			for(i in data['pd']){
				pdHtml+='<div class="remove_pass row"><div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								if(i==0){
								pdHtml+='<labe>Passport#</label>'; }
								pdHtml+='<input type="text" value="'+data['pd'][i].passport+'" class="form-control form-control-sm" name="passport[]">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								if(i==0){
								pdHtml+='<labe>Pax</label>';}
								pdHtml+='<input type="text" value="'+data['pd'][i].name+'" class="form-control form-control-sm" name="pass_name[]">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								if(i==0){
								pdHtml+='<labe>Pass Exp</label>'; }
								pdHtml+='<input type="text" value="'+data['pd'][i].pass_exp+'" class="form-control form-control-sm" name="passport_expiry[]" placeholder="01-01-2019">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								if(i==0){
								pdHtml+='<labe>Phone</label>'; }
								pdHtml+='<input type="text" value="'+data['pd'][i].mobile+'" class="form-control form-control-sm" name="phone[]">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
							  '<div class="form-group">';
								if(i==0){
								pdHtml+='<label>Pass Type</label>';}
								pdHtml+='<select name="passType[]" class="form-control form-control-sm">'+
									'<option value="adult">Adult</option>'+
									'<option value="child">Child</option>'+
									'<option value="infant">Infant</option>'+
								'</select>'+
							  '</div>'+
							'</div>'+
							'<div class="col-md-2 col-custom-8">'+
							  '<div class="form-group">';
								if(i==0){
								pdHtml+='<label>DOB</label>';}
								pdHtml+='<input type="text" name="passDob[]" class="form-control form-control-sm" placeholder="01-01-2019">'+
							  '</div>'+
							'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								if(i==0){
								pdHtml+='<labe>NIC</label>'; }
								pdHtml+='<input type="text" value="'+data['pd'][i].nic+'" class="form-control form-control-sm" name="nic[]">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								if(i==0){
								pdHtml+='<labe>NIC Expiry</label>'+
								'<input type="text" value="'+data['pd'][i].nic_exp+'" class="form-control form-control-sm" name="nic_exp[]" placeholder="01-01-2019"><button type="button" class="btn-primary multi_pass_add" style="position: absolute;right:-11px; bottom:7px;border:0px;"><i class="fa fa-plus"></i></button>';}
								else{
								pdHtml+='<input type="text" value="'+data['pd'][i].nic_exp+'" class="form-control form-control-sm" name="nic_exp[]" placeholder="01-01-2019"><i class="fa fa-times rp_click" style="position: absolute;color:lightcoral;right:-5px; bottom:24px;"></i>';}
								pdHtml+='</div>'+
            				'</div>'+
							'</div>';
			}
			$("#tour-hotel-form .mulit_pass").html(pdHtml);
			$(".js-example-basic-single").select2();
			$('.loader-bg').hide();
		}
	});
}
//tour visa
function get_tour_visa_records(type, invId)
{
	$('.loader-bg').show();
	$.ajax({
		url:"ajax_call/get_sale_invoices?type="+type+"&invId="+invId,
		dataType:"JSON",
		success: function(data)
		{
			var htmlData=""; j=1; var np=0; nr=0;
			for(i in data['rec']){
				htmlData+='<tr id="v-'+data['rec'][i].id+'">';
					htmlData+='<td>'+j+'</td>';
					htmlData+='<td>'+data['rec'][i].passport+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_name+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_mobile+'</td>';
					htmlData+='<td>'+snf(Number(data['rec'][i].payable_amount))+'</td>';
					htmlData+='<td>'+snf(Number(data['rec'][i].receiveable_amount))+'</td>';
					htmlData+='<td><button class="btn btn-info btn-mini waves-effect waves-light" onclick="edit_tour_visa_record('+data['rec'][i].id+', \'visa\')"> <i class="fa fa-edit"></i></button>';
					if(data['rec'][i].refund=="yes"){
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_tour_visa_record('+data['rec'][i].id+', \'visa\', \'refund\')"> <i class="fa fa-undo"></i> Ref</button>';
					}
					else{
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_tour_visa_record('+data['rec'][i].id+', \'visa\', \'refund\')"> <i class="fa fa-undo"></i> Ref</button>';	
					}
					/*htmlData+=' <button type="button" class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'tvisa_rec\', \'v-'+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button></td>';*/
				htmlData+='</tr>';
				np +=Number(data['rec'][i].payable_amount);
				nr +=Number(data['rec'][i].receiveable_amount);
				j++;
			}
			/*htmlData+='<tr>';
				htmlData+='<td colspan="4"></td>';
				htmlData+='<td><strong>'+number_format(np)+'</strong></td>';
				htmlData+='<td colspan="1"><strong>'+number_format(nr)+'</strong></td>';
				htmlData+='<td></td>';
			htmlData+='</tr>';*/
			$(".get_tour_visa_records").html(htmlData);
			$('.loader-bg').hide();
		}
	});
}
function edit_tour_visa_record(id, type, btn_type)
{
	$('.loader-bg').show();
	if(btn_type=='refund'){
		$("#tour-visa-form .ref-rec").show();
		$("#tour-visa-form .save-rec").hide();
		$("#tour-modal .refEdit").css('background','rgb(255, 82, 82)');
		$('#tour-visa-form .refText').css('color','#ff5252');
		$('#tour-visa-form .vpayable').closest('.form-group').find('label').html('Rec from Vendor');
		$('#tour-visa-form .vreceiveable').closest('.form-group').find('label').html('Pay to Customer');
		$("#tour-visa-form input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
		$('#tour-visa-form #c_charges_div, #s_charges_div').css('display','block');
	}
	else{
		$("#tour-visa-form .ref-rec").hide();
		$("#tour-visa-form .save-rec").html('<i class="fa fa-save"> Update</i>').show();
		$("#tour-modal .refEdit").css('background','rgb(26, 168, 157)');
		$('#tour-modal .refText').css('color','rgb(26, 168, 157)');
		$('#tour-visa-form .vpayable').closest('.form-group').find('label').html('Payable');
		$('#tour-visa-form .vreceiveable').closest('.form-group').find('label').html('Receiveable');
		$("#tour-visa-form input[name~='inv_date']").closest('.form-group').find('label').text('Invoice Date');
		$("#tour-visa-form input[name~='profit']").closest('.form-group').find('label').text('Profit');
		$('#tour-visa-form #c_charges_div, #s_charges_div').css('display','none');
		$("#tour-visa-form .save-rec").html('<i class="fa fa-save"></i> Update').show();
	}
	$.ajax({
		url:"ajax_call/edit_sale_invoice?type="+type+"&id="+id,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#tour-modal input[name~='inv_date']").val(data.si.inv_date);
			$("#tour-modal input[name~='due_date']").val(data.si.due_date);
			$("#tour-modal select[name~='branch_id']").val(data.si.branch_id);
			$("#tour-modal select[name~='client_id']").val(data.si.client_id);
			$("#tour-modal select[name~='payment_term']").val(data.si.payment_term);
			$("#tour-modal select[name~='empl_id']").val(data.si.empl_id);
			$("#tour-modal input[name~='remarks']").val(data.si.remarks);
			//visa invoice details
			$("#tour-visa-form input[name~='id']").val(data.vi.id);
			$("#tour-visa-form #visa_passengers").val(data.vi.pass_name);
			$("#tour-visa-form select[name~='visa_type']").val(data.vi.visa_type);
			$("#tour-visa-form select[name~='country_id']").val(data.vi.visa_country);
			$("#tour-visa-form input[name~='visa_no']").val(data.vi.visa_no);
			$("#tour-visa-form input[name~='documents']").val(data.vi.documents);
			$("#tour-visa-form input[name~='online_date']").val(data.vi.online_date);
			$("#tour-visa-form input[name~='qty']").val(data.vi.qty);
			$("#tour-visa-form input[name~='rate']").val(data.vi.rate);
			$("#tour-visa-form input[name~='basic_fare']").val(data.vi.basic_fare);
			$("#tour-visa-form input[name~='pst_paid']").val(data.vi.pst_paid);
			$("#tour-visa-form select[name~='vendor_id']").val(data.vi.vendor_id);
			$("#tour-visa-form input[name~='particulars']").val(data.vi.particulars);
			$("#tour-visa-form input[name~='f_agent_amount']").val(data.vi.f_agent_amount);
			$("#tour-visa-form select[name~='f_agent_id']").val(data.vi.f_agent_id);
			$("#tour-visa-form input[name~='s_agent_name']").val(data.vi.s_agent_name);
			$("#tour-visa-form select[name~='s_agent_id']").val(data.vi.s_agent_id);
			$("#tour-visa-form input[name~='psf']").val(data.vi.psf);
			$("#tour-visa-form input[name~='discountp']").val(data.vi.discountp);
			$("#tour-visa-form input[name~='discount']").val(data.vi.discount);
			$("#tour-visa-form input[name~='pst_rec']").val(data.vi.pst_rec);
			$("#tour-visa-form input[name~='payable_amount']").val(data.vi.payable_amount);
			$("#tour-visa-form input[name~='receiveable_amount']").val(data.vi.receiveable_amount);
			$("#tour-visa-form input[name~='profit']").val(data.vi.profit);
			$("#tour-visa-form select[name~='cur_type']").val(data.vi.cur_type);
			$("#tour-visa-form input[name~='cur_rate']").val(data.vi.cur_rate);
			//calculate currency rate
			var np=Number(data.vi.payable_amount)/Number(data.vi.cur_rate);
			var nr=Number(data.vi.receiveable_amount)/Number(data.vi.cur_rate);
			var npro=Number(data.vi.profit)/Number(data.vi.cur_rate);
			$("#tour-visa-form input[name~='cur_p']").val(np.toFixed(2));
			$("#tour-visa-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#tour-visa-form input[name~='cur_profit']").val(npro.toFixed(2));
			$(".js-example-basic-single").select2();
			$('#visa_passengers').multiselect('destroy');
			$('#visa_passengers').multiselect();
			$('.loader-bg').hide();
		}
	});
}
// tour transfers
function get_tour_transfer_records(type, invId)
{
	$('.loader-bg').show();
	$.ajax({
		url:"ajax_call/get_sale_invoices?type="+type+"&invId="+invId,
		dataType:"JSON",
		success: function(data)
		{
			var htmlData=""; j=1; var np=0; nr=0;
			for(i in data['rec'])
			{
				htmlData+='<tr id="tr-'+data['rec'][i].id+'">';
					htmlData+='<td>'+j+'</td>';
					htmlData+='<td>'+data['rec'][i].passport+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_name+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_mobile+'</td>';
					htmlData+='<td>'+snf(Number(data['rec'][i].payable_amount))+'</td>';
					htmlData+='<td>'+snf(Number(data['rec'][i].receiveable_amount))+'</td>';
					htmlData+='<td><button class="btn btn-info btn-mini waves-effect waves-light" onclick="edit_tour_transfer_rec('+data['rec'][i].id+', \'transfer\')"> <i class="fa fa-edit"></i></button>';
					if(data['rec'][i].refund=='yes'){
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_tour_transfer_ref_rec('+data['rec'][i].id+', \'transfer_ref\', \'\')"> <i class="fa fa-undo"></i> Ref</button>';
					}
					else{
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_tour_transfer_rec('+data['rec'][i].id+', \'transfer\', \'refund\')"> <i class="fa fa-undo"></i> Ref</button>';
					}
					/* htmlData+=' <button class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'ttransfer_rec\', \'tr-'+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button></td>';*/
				htmlData+='</tr>';
				np +=Number(data['rec'][i].payable_amount);
				nr +=Number(data['rec'][i].receiveable_amount);
				j++;
			}
				/*htmlData+='<tr>';
					htmlData+='<td colspan="4"></td>';
					htmlData+='<td><strong>'+number_format(np)+'</strong></td>';
					htmlData+='<td colspan="1"><strong>'+number_format(nr)+'</strong></td>';
					htmlData+='<td></td>';
				htmlData+='</tr>';*/
				$(".get_tour_transfer_records").html(htmlData);
			$('.loader-bg').hide();
		}
	});
}
// edit transfer details...........
function edit_tour_transfer_rec(id, type, btn_type)
{
	$('.loader-bg').show();
	if(btn_type=='refund'){
		$("#tour-transfer-form .ref-rec").show();
		$("#tour-transfer-form .save-rec").hide();
		$("#tour-transfer-form").parents("#tour-modal").find(".refEdit").first().css('background','rgb(255, 82, 82)');
		$('#tour-transfer-form .refText').css('color','#ff5252');
		$('#tour-transfer-form .tr_np').closest('.form-group').find('label').html('Rec from Vendor');
		$('#tour-transfer-form .tr_nr').closest('.form-group').find('label').html('Pay to Customer');
		$("#tour-modal input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
		$('#tour-transfer-form #c_charges_div, #s_charges_div').css('display','block');
		$('#tour-transfer-form .tr_profit').closest('.form-group').find('label').html('Loss');
	}
	else{
		$("#tour-transfer-form .ref-rec").hide();
		$("#tour-transfer-form .save-rec").html('<i class="fa fa-save"> Update</i>').show();
		$("#tour-modal .refEdit").css('background','rgb(26, 168, 157)');
		$('#tour-transfer-form .refText').css('color','rgb(26, 168, 157)');
		$('#tour-transfer-form .tr_np').closest('.form-group').find('label').html('Payable');
		$('#tour-transfer-form .tr_nr').closest('.form-group').find('label').html('Receiveable');
		$("#tour-transfer-form input[name~='inv_date']").closest('.form-group').find('label').text('Invoice Date');
		$('#tour-transfer-form #c_charges_div, #s_charges_div').css('display','none');
	}
	$.ajax({
		url:"ajax_call/edit_sale_invoice?type="+type+"&id="+id,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#tour-modal input[name~='inv_date']").val(data.si.inv_date);
			$("#tour-modal input[name~='due_date']").val(data.si.due_date);
			$("#tour-modal select[name~='branch_id']").val(data.si.branch_id);
			$("#tour-modal select[name~='client_id']").val(data.si.client_id);
			$("#tour-modal select[name~='payment_term']").val(data.si.payment_term);
			$("#tour-modal select[name~='empl_id']").val(data.si.empl_id);
			$("#tour-modal input[name~='remarks']").val(data.si.remarks);
			//transfer details............			
			$("#tour-transfer-form input[name~='id']").val(data.vi.id);
			$("#tour-transfer-form #transfer_passengers").val(data.vi.pass_name);
			$("#tour-transfer-form input[name~='inv_id']").val(data.si.invId);
			$("#tour-transfer-form input[name~='group_no']").val(data.vi.group_no);
			$("#tour-transfer-form input[name~='ref_no']").val(data.vi.ref_no);
			$("#tour-transfer-form input[name~='vehicle_type']").val(data.vi.vehicle_type);
			$("#tour-transfer-form input[name~='from_date']").val(data.vi.from_date);
			$("#tour-transfer-form input[name~='to_date']").val(data.vi.to_date);
			$("#tour-transfer-form input[name~='qty']").val(data.vi.qty);
			$("#tour-transfer-form input[name~='rate']").val(data.vi.rate);
			$("#tour-transfer-form input[name~='basic_fare']").val(data.vi.basic_fare);
			$("#tour-transfer-form select[name~='vendor_id']").val(data.vi.vendor_id);
			$("#tour-transfer-form input[name~='particulars']").val(data.vi.particulars);
			$("#tour-transfer-form input[name~='f_agent_amount']").val(data.vi.f_agent_amount);
			$("#tour-transfer-form select[name~='f_agent_id']").val(data.vi.f_agent_id);
			$("#tour-transfer-form input[name~='s_agent_name']").val(data.vi.s_agent_name);
			$("#tour-transfer-form select[name~='s_agent_id']").val(data.vi.s_agent_id);
			$("#tour-transfer-form input[name~='psf']").val(data.vi.psf);
			$("#tour-transfer-form input[name~='discountp']").val(data.vi.discountp);
			$("#tour-transfer-form input[name~='discount']").val(data.vi.discount);
			$("#tour-transfer-form input[name~='pst_rec']").val(data.vi.pst_rec);
			$("#tour-transfer-form input[name~='payable_amount']").val(data.vi.payable_amount);
			$("#tour-transfer-form input[name~='receiveable_amount']").val(data.vi.receiveable_amount);
			$("#tour-transfer-form input[name~='profit']").val(data.vi.profit);
			$("#tour-transfer-form select[name~='cur_type']").val(data.vi.cur_type);
			$("#tour-transfer-form input[name~='cur_rate']").val(data.vi.cur_rate);
			//calculate currency rate
			var np=Number(data.vi.payable_amount)/Number(data.vi.cur_rate);
			var nr=Number(data.vi.receiveable_amount)/Number(data.vi.cur_rate);
			var npro=Number(data.vi.profit)/Number(data.vi.cur_rate);
			$("#tour-transfer-form input[name~='cur_p']").val(np.toFixed(2));
			$("#tour-transfer-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#tour-transfer-form input[name~='cur_profit']").val(npro.toFixed(2));
			if(data.vi.refund=='yes'){
				$("#tour-transfer-form #refundDiv").html('<a href="../invoice/transfer_credit_note?refId='+data.vi.refId+'" class="btn btn-sm btn-danger form-control" target="_blank">Refunded #'+data.vi.refId+'</i></a>').show();
			}
			$(".js-example-basic-single").select2();
			$('#transfer_passengers').multiselect('destroy');
			$('#transfer_passengers').multiselect();
			$('.loader-bg').hide();
		}
	});
}
function edit_tour_transfer_ref_rec(id, type)
{
	$('.loader-bg').show();
	$("#tour-transfer-form .ref-rec").show();
	$("#tour-transfer-form .save-rec").hide();
	$("#tour-transfer-form").parents("#tour-modal").find(".refEdit").first().css('background','rgb(255, 82, 82)');
	$('#tour-transfer-form .refText').css('color','#ff5252');
	$('#tour-transfer-form .tr_np').closest('.form-group').find('label').html('Rec from Vendor');
	$('#tour-transfer-form .tr_nr').closest('.form-group').find('label').html('Pay to Customer');
	$("#tour-modal input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
	$('#tour-transfer-form #c_charges_div, #s_charges_div').css('display','block');
	$.ajax({
		url:"ajax_call/edit_sale_invoice?type="+type+"&id="+id,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#tour-modal input[name~='inv_date']").val(data.si.inv_date);
			$("#tour-modal input[name~='due_date']").val(data.si.due_date);
			$("#tour-modal select[name~='branch_id']").val(data.si.branch_id);
			$("#tour-modal select[name~='client_id']").val(data.si.client_id);
			$("#tour-modal select[name~='payment_term']").val(data.si.payment_term);
			$("#tour-modal select[name~='empl_id']").val(data.si.empl_id);
			$("#tour-modal input[name~='remarks']").val(data.si.remarks);
			//transfer details............
			$("#tour-transfer-form input[name~='id']").val(data.vi.id);
			$("#tour-transfer-form input[name~='passport']").val(data.vi.passport);
			$("#tour-transfer-form #transfer_passengers").html('<option value="'+data.vi.pass_name+'" selected>'+data.vi.pass_name+'</option>');
			$("#tour-transfer-form input[name~='pass_mobile']").val(data.vi.pass_mobile);
			$("#tour-transfer-form select[name~='pass_type']").val(data.vi.pass_type);
			$("#tour-transfer-form input[name~='dob']").val(data.vi.dob);
			$("#tour-transfer-form select[name~='group_no']").val(data.vi.group_no);
			$("#tour-transfer-form select[name~='ref_no']").val(data.vi.ref_no);
			$("#tour-transfer-form input[name~='qty']").val(data.vi.qty);
			$("#tour-transfer-form input[name~='rate']").val(data.vi.rate);
			$("#tour-transfer-form input[name~='basic_fare']").val(data.refund.base_fare);
			$("#tour-transfer-form select[name~='vendor_id']").val(data.vi.vendor_id);
			$("#tour-transfer-form input[name~='particulars']").val(data.vi.particulars);
			$("#tour-transfer-form input[name~='f_agent_amount']").val(data.refund.f_agent_amount);
			$("#tour-transfer-form select[name~='f_agent_id']").val(data.refund.f_agent_id);
			$("#tour-transfer-form input[name~='s_agent_name']").val(data.refund.s_agent_name);
			$("#tour-transfer-form select[name~='s_agent_id']").val(data.refund.s_agent_id);
			$("#tour-transfer-form input[name~='psf']").val(data.refund.psf);
			$("#tour-transfer-form input[name~='discountp']").val(data.refund.discountp);
			$("#tour-transfer-form input[name~='discount']").val(data.refund.discount);
			$("#tour-transfer-form input[name~='pst_rec']").val(data.refund.pst_rec);
			$("#tour-transfer-form input[name~='payable_amount']").val(data.refund.payable_amount);
			$("#tour-transfer-form input[name~='receiveable_amount']").val(data.refund.receiveable_amount);
			$("#tour-transfer-form input[name~='cancellation_charges']").val(data.refund.cancellation_charges);
			$("#tour-transfer-form input[name~='service_charges']").val(data.refund.service_charges);
			$("#tour-transfer-form input[name~='profit']").val(data.refund.profit);
			$("#tour-transfer-form select[name~='cur_type']").val(data.refund.cur_type);
			$("#tour-transfer-form input[name~='cur_rate']").val(data.refund.cur_rate);
			//calculate currencies rate
			var np=Number(data.refund.payable_amount)/Number(data.refund.cur_rate);
			var nr=Number(data.refund.receiveable_amount)/Number(data.refund.cur_rate);
			var npro=Number(data.refund.profit)/Number(data.refund.cur_rate);
			$("#tour-transfer-form input[name~='cur_p']").val(np.toFixed(2));
			$("#tour-transfer-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#tour-transfer-form input[name~='cur_profit']").val(npro.toFixed(2));
			$("#tour-transfer-form input[name~='refId']").val(data.refund.id);
			$('#tour-transfer-form .tr_profit').closest('.form-group').find('label').html('Loss');
			if(data.vi.refund=='yes')
			{
				$("#tour-transfer-form #refundDiv").html('<a href="../invoice/transfer_credit_note?refId='+data.vi.refId+'" class="btn btn-sm btn-danger form-control" target="_blank">Refunded #'+data.vi.refId+'</i></a>').show();
			}
			else{
				$("#tour-transfer-form #refundDiv").hide();
			}
			$(".js-example-basic-single").select2();
			$('#transfer_passengers').multiselect('destroy');
			$('#transfer_passengers').multiselect();
			$('.loader-bg').hide();
		}
	});
}
// tour others records
function get_tour_other_records(type, invId)
{
	$('.loader-bg').show();
	$.ajax({
		url:"ajax_call/get_sale_invoices?type="+type+"&invId="+invId,
		dataType:"JSON",
		success: function(data)
		{
			var htmlData=""; j=1; var np=0; nr=0;
			for(i in data['rec'])
			{
				htmlData+='<tr id="tr-'+data['rec'][i].id+'">';
					htmlData+='<td>'+j+'</td>';
					htmlData+='<td>'+data['rec'][i].passport+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_name+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_mobile+'</td>';
					htmlData+='<td>'+snf(Number(data['rec'][i].payable_amount))+'</td>';
					htmlData+='<td>'+snf(Number(data['rec'][i].receivable_amount))+'</td>';
					htmlData+='<td><button class="btn btn-info btn-mini waves-effect waves-light" onclick="edit_tour_other_record('+data['rec'][i].id+', \'other\')"> <i class="fa fa-edit"></i></button>';
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_tour_other_record('+data['rec'][i].id+', \'other_ref\', \'refund\')"> <i class="fa fa-undo"></i> Ref</button>';
					 htmlData+=' <button class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'tother\', \'tr-'+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button></td>';
				htmlData+='</tr>';
				/*np +=Number(data['rec'][i].payable_amount);
				nr +=Number(data['rec'][i].receivable_amount);*/
				j++;
			}
				/*htmlData+='<tr>';
					htmlData+='<td colspan="4"></td>';
					htmlData+='<td><strong>'+number_format(np)+'</strong></td>';
					htmlData+='<td colspan="1"><strong>'+number_format(nr)+'</strong></td>';
					htmlData+='<td></td>';
				htmlData+='</tr>';*/
				$(".get_tour_other_records").html(htmlData);
			$('.loader-bg').hide();
		}
	});
}
function edit_tour_other_record(id , type, btn_type)
{
	$('.loader-bg').show();
	if(btn_type=='refund'){
		$("#tour-other-form .ref-rec").show();
		$("#tour-other-form .save-rec").hide();
		$("#tour-other-form").parents("#tour-modal").find(".refEdit").first().css('background','rgb(255, 82, 82)');
		$('#tour-other-form .refText').css('color','#ff5252');
		$('#tour-other-form .tr_np').closest('.form-group').find('label').html('Rec from Vendor');
		$('#tour-other-form .tr_nr').closest('.form-group').find('label').html('Pay to Customer');
		$("#tour-modal input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
		$('#tour-other-form #c_charges_div, #s_charges_div').css('display','block');
		$('#tour-other-form .tr_profit').closest('.form-group').find('label').html('Loss');
	}
	else{
		$("#tour-other-form .ref-rec").hide();
		$("#tour-other-form .save-rec").html('<i class="fa fa-save"> Update</i>').show();
		$("#tour-modal .refEdit").css('background','rgb(26, 168, 157)');
		$('#tour-other-form .refText').css('color','rgb(26, 168, 157)');
		$('#tour-other-form .tr_np').closest('.form-group').find('label').html('Payable');
		$('#tour-other-form .tr_nr').closest('.form-group').find('label').html('Receiveable');
		$("#tour-modal input[name~='inv_date']").closest('.form-group').find('label').text('Invoice Date');
		$('#tour-other-form #c_charges_div, #s_charges_div').css('display','none');
	}
	
	$.ajax({
		url:"ajax_call/edit_sale_invoice?type="+type+"&id="+id,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#tour-modal input[name~='inv_date']").val(data.si.inv_date);
			$("#tour-modal input[name~='due_date']").val(data.si.due_date);
			$("#tour-modal select[name~='branch_id']").val(data.si.branch_id);
			$("#tour-modal select[name~='client_id']").val(data.si.client_id);
			$("#tour-modal select[name~='payment_term']").val(data.si.payment_term);
			$("#tour-modal select[name~='empl_id']").val(data.si.empl_id);
			$("#tour-modal input[name~='remarks']").val(data.si.remarks);
			//other details
			$("#tour-other-form input[name~='inv_id']").val(data.si.inv_id);
			$("#tour-other-form input[name~='id']").val(data.vi.id);
			$("#tour-other-form #other_passengers").val(data.vi.pass_name);
			$("#tour-other-form input[name~='group_no']").val(data.vi.group_no);
			$("#tour-other-form input[name~='pkg_details']").val(data.vi.pkg_details);
			$("#tour-other-form input[name~='rate']").val(data.vi.rate);
			$("#tour-other-form select[name~='vendor_id']").val(data.vi.vendor_id);
			$("#tour-other-form input[name~='basic_fare']").val(data.vi.basic_fare);
			$("#tour-other-form input[name~='f_agent_amount']").val(data.vi.f_agent_amount);
			$("#tour-other-form select[name~='f_agent_id']").val(data.vi.f_agent_id);
			$("#tour-other-form input[name~='s_agent_amount']").val(data.vi.s_agent_amount);
			$("#tour-other-form select[name~='s_agent_id']").val(data.vi.s_agent_id);
			$("#tour-other-form input[name~='psf']").val(data.vi.psf);
			$("#tour-other-form input[name~='discountp']").val(data.vi.discountp);
			$("#tour-other-form input[name~='discount']").val(data.vi.discount);
			$("#tour-other-form input[name~='other_services']").val(data.vi.other_services);
			$("#tour-other-form input[name~='payable_amount']").val(data.vi.payable_amount);
			$("#tour-other-form input[name~='receivable_amount']").val(data.vi.receivable_amount);
			$("#tour-other-form input[name~='profit']").val(data.vi.profit);
			$("#tour-other-form select[name~='cur_type']").val(data.vi.cur_type);
			$("#tour-other-form input[name~='cur_rate']").val(data.vi.cur_rate);
			//calculate currency rate
			var np=Number(data.vi.payable_amount)/Number(data.vi.cur_rate);
			var nr=Number(data.vi.receivable_amount)/Number(data.vi.cur_rate);
			var npro=Number(data.vi.profit)/Number(data.vi.cur_rate);
			$("#tour-other-form input[name~='cur_p']").val(np.toFixed(2));
			$("#tour-other-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#tour-other-form input[name~='cur_profit']").val(npro.toFixed(2));
			$(".js-example-basic-single").select2();
			$('#other_passengers').multiselect('destroy');
			$('#other_passengers').multiselect();
			$('.loader-bg').hide();
		}
	});
}
function save_tour_refund(type, formData)
{
	$('.loader-bg').show();
	var inv_date=$("#tour-modal input[name~='inv_date']").val();
	var client_id=$("#tour-modal select[name~='client_id']").val();
	var branch_id=$("#tour-modal select[name~='branch_id']").val();
	$.ajax({
		url:"ajax_call/save_refund?type="+type+"&inv_date="+inv_date+"&client_id="+client_id+"&branch_id="+branch_id,
		data:$("#"+formData).serializeArray(),
		type:"POST",
		success: function(data)
		{
			var invId=$("#"+formData+" input[name~='inv_id']").val();
			$("#"+formData+" input[name~='id']").val('0');
			$("#"+formData+" input[name~='refId']").val('0');
			if(type=='ticket'){
				get_tour_ticket_records('ticket', invId);
			}
			else if(type=='hotel'){
				get_tour_hotel_records('hotel', invId);
			}
			else if(type=='transfer'){
				get_tour_transfer_records('transfer', invId);
			}
			else if(type=='other'){
				get_tour_other_records('other', invId);
			}
		}
	});
	$('#c_charges_div, #s_charges_div').css('display','none');
	$('.refEdit').css('background','#1aa89d');
	$('.refText').css('color','#1aa89d');
	$("#"+formData+" .ref-rec").hide();
	$('.loader-bg').hide();
	toastr.success('Operation successfull.');
}
