// JavaScript Document
localStorage.clear();
$('input[type=number').focus(function(){
	"use strict";
	 var d=$(this).val();
	if(d === '0'){
		$(this).val('');
	}
});
function max_modal(thisModal){
	$("#"+thisModal).modal();
}
function ticket(invId, type)
{
	$('.loader-bg').show();
	"use strict";
	$('#inv_date, #pass_name, #airline_pnr, #ticket-no, #base_fare, #t_departure').css('border-bottom','1px solid rgba(0,0,0,0.15)');
	$('#client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
	$('#vendor_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
	$('#c_charges_div, #s_charges_div').css('display','none');
	$('.refEdit').css('background','#1aa89d');
	$('.refText').css('color','#1aa89d');
	$('.t_payable').closest('.form-group').find('label').html('Payable');
	$('.t_receiveable').closest('.form-group').find('label').html('Receiveable');
	$("#refundDiv").hide();
	$("#refund-sectors").hide();
	$("#ticket-modal").modal({ backdrop:'static' });
	$("#ticket-form input[name~='inv_date']").closest('.form-group').find('label').html('Invoice Date <sup class="text-danger">*</sup>');
	$("#ticket-form .save-rec").html('<i class="fa fa-save"></i> Save');
	$("#ticket-form .ref-rec").hide();
	$("#ticket-form .tprofit").closest(".form-group").find("label").text('Profit');
	document.getElementById("ticket-form").reset();
	$("#ticket-modal").find(".modal-title").text('TICKET DETAILS');
	$(".void-canc").hide();
	if(invId>0 && type=='edit'){
		$("#ticket-form input[name~='id']").val(0);
		$("#ticket-form input[name~='refId']").val(0);
		$("#ticket-modal").find(".modal-title").text('TICKET DETAILS ('+invId+')');
		fetch_sale_invoice_det(invId, "ticket-form");
		 $(".multiple_rec").find("tr:gt(1)").remove();
		 $("#conj-ticket").hide();
		 $("#ticket-table").hide();
		$("#ticket-form input[name~='inv_id']").val(invId);
		get_ticket_records('ticket', invId);
		$("#ticket-table").show();
	}
	else if(type=='view'){
		$(".refEdit").find(".modal-title").text('TICKET DETAILS ('+invId+')');
		$("#ticket-form input[name~='inv_id']").val(invId);
		$("#ticket-form .save-rec").hide();
		$("#ticket-form .new-rec").hide();
		get_ticket_records('ticket', invId, 'view');
		$("#ticket-table").show();
	}
	else { 
		 document.getElementById("ticket-form").reset();
		 $("#ticket-form input[name~='inv_id']").val(0);
		 $("#ticket-form input[name~='id']").val(0);
		 $("#ticket-form input[name~='refId']").val(0);
		 $(".multiple_rec").find("tr:gt(1)").remove();
		 $("#conj-ticket").hide();
		 $("#ticket-table").hide();
		 $("#ticket-form .save-rec").show();
	}
	$('.loader-bg').hide();
	$(".js-example-basic-single").select2();
	
}
function hotelSale(invId)
{
	$('.loader-bg').show();
	$('#inv_date, #booking_name, #check_in, #check_out, #guest_beds, #rate_night, #basic_amount').css('border-bottom','1px solid rgba(0,0,0,0.15)');
	$('#hotel_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
	$('#hId').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
	$('#payable_id').css('border-bottom','1px solid #aaa');
	$("#hotel-modal").modal({ backdrop:'static' });
	$("#hotel-form .save-rec").html('<i class="fa fa-save"></i> Save').show();
	$("#hotel-form .ref-rec").hide();
	$("#hotel-form #refundDiv").hide();
	$('.refEdit').css('background','#1aa89d');
	$('.refText').css('color','#1aa89d');
	document.getElementById("hotel-form").reset();
	$("#hotel-modal").find(".modal-title").text('HOTEL DETAILS');
	if(invId>0){
		$("#hotel-modal").find(".modal-title").text('HOTEL DETAILS ('+invId+')');
		fetch_sale_invoice_det(invId, "hotel-form");
		$("#hotel-form input[name~='inv_id']").val(invId);
		get_hotel_invoices('hotel', invId);
		$("#hotel-table").show();
	}
	else {
		 $("#hotel-form input[name~='inv_id']").val(0);
		 $("#hotel-form input[name~='id']").val(0);
		$(".remove_pass").not(':first-child').remove();
		 $("#hotel-form input[name~='inv_id']").val(0);
		 $("#hotel-form input[name~='id']").val(0);
		 $("#hotel-table").hide();
	  }
	$('.loader-bg').hide();
	$(".js-example-basic-single").select2();
}
function visaSale(invId)
{
	$('.loader-bg').show();
	$('#inputdefault, #visa_pass_name, #visa_quantity, #rate, #visa_basic_fare').css('border-bottom','1px solid rgba(0,0,0,0.15)');
	$('#visa_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
	$('#country_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
	$("#visa-form .save-rec").show();
	$("#visa-modal").modal({backdrop:'static'});
	$("#visa-form #refundDiv").hide();
	$("#visa-form .refEdit").css('background','rgb(26, 168, 157)');
		$('#visa-form .refText').css('color','rgb(26, 168, 157)');
		$('#visa-form .vpayable').closest('.form-group').find('label').html('Payable');
		$('#visa-form .vreceiveable').closest('.form-group').find('label').html('Receiveable');
		$("#visa-form input[name~='inv_date']").closest('.form-group').find('label').text('Invoice Date');
		$("#visa-form input[name~='profit']").closest('.form-group').find('label').text('Profit');
		document.getElementById("visa-form").reset();
		$("#visa-modal").find(".modal-title").text('VISA DETAILS');
	if(invId>0){
		$("#visa-modal").find(".modal-title").text('VISA DETAILS ('+invId+')');
		fetch_sale_invoice_det(invId, "visa-form");
		$("#visa-form input[name~='inv_id']").val(invId);
		get_visa_records('visa', invId);
		$("#visa-table").show();
		edit_pass_det(invId);
	}
	else {
		$(".remove_pass").not(':first-child').remove();
		 $("#visa-form input[name~='inv_id']").val(0);
		 $("#visa-form input[name~='id']").val(0);
		 $("#visa-table").hide();
	  }
	$('.loader-bg').hide();
	$(".js-example-basic-single").select2();
}
function transferSale(invId)
{
	$('.loader-bg').show();
	$('#trans_inv_date, #trans_pass_name, #trans_from_date, #trans_to_date, #trans_quantity, #trans_rate, #trans_basic_fare').css('border-bottom','1px solid rgba(0,0,0,0.15)');
	$('#trans_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
	$('#trans_vendor_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
	$("#transfer-modal").modal({backdrop:'static'});
	$('#transfer-form .refEdit').css('background','#1aa89d');
	$('#transfer-form .refText').css('color','#1aa89d');
	$('#transfer-form .ref-rec').hide();
	$('#transfer-form .save-rec').show();
	$("#transfer-form input[name~='id']").val(0);
	$("#transfer-form input[name~='refId']").val(0);
	document.getElementById("transfer-form").reset();
	$("#transfer-modal").find(".modal-title").text('TRANSFER DETAILS');
	if(invId>0){
		$("#transfer-modal").find(".modal-title").text('TRANSFER DETAILS ('+invId+')');
		fetch_sale_invoice_det(invId, "transfer-form");
		$("#transfer-form input[name~='inv_id']").val(invId);
		get_transfer_records('transfer', invId);
		$("#transfer-table").show();
		edit_pass_det(invId);
	}
	else {
		$(".remove_pass").not(':first-child').remove();
		 $("#transfer-form input[name~='inv_id']").val(0);
		 $("#transfer-table").hide();		
	  }
	$('.loader-bg').hide();
	$(".js-example-basic-single").select2();
}
function tourSale(invId){
	$('.loader-bg').show();
	 $("#tour-modal #tour_inv_date").closest('.form-group').find('label').text('Invoice Date');
	$('#tour_inv_date, #tt_fare, #tt_departure, #tt_airline_pnr, #tour_ticket_no, #th_checkin, #th_checkout, #th_payable_id, #th_guest_beds, #th_rate_night, #th_basic_amount, #tv_quantity, #tv_rate, #tv_basic_fare, #ttrans_from_date, #ttrans_to_date, #ttrans_quantity, #ttrans_basic').css('border-bottom','1px solid rgba(0,0,0,0.15)');
	$('#tour_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
	$('#tour_client_id').closest('.form-group').find('.js-example-basic-single').val(0);
	$("#tour-modal select[name~='branch_id']").val(1);
	$('#tt_payable_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
	$('#th_hId').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
	$('#tv_country_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
	$('#ttrans_payable_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
	
	$('#tour-modal').modal({backdrop:'static'});
	$('#c_charges_div, #s_charges_div').css('display','none');
	$('.refEdit').css('background','#1aa89d');
	$('.refText').css('color','#1aa89d');
	$('.t_payable').closest('.form-group').find('label').html('Payable');
	$('.t_receiveable').closest('.form-group').find('label').html('Receiveable');
	$("#tour-modal #refundDiv").hide();
	$("#refund-sectors").hide();
	$('.t_payable').closest('.form-group').find('label').html('Payable');
	$('.t_receiveable').closest('.form-group').find('label').html('Receiveable');
	$("#tour-modal input[name~='inv_date']").closest('.form-group').find('label').html('Invoice Date <sup class="text-danger">*</sup>');
	$("#tour-modal .save-rec").html('<i class="fa fa-save"></i> Save');
	$("#tour-modal .ref-rec").hide();
	$("#tour-modal .tprofit").closest(".form-group").find("label").text('Profit');
	document.getElementById("tour-ticket-form").reset();
	$("#tour-modal .multiple_rec").find("tr:gt(1)").remove();
	$("#tour-modal").find(".modal-title").text('TOUR DETAILS');
	$("#tour-modal input[name~='inv_id']").val(0);
	$("#tour-modal").find("input[name~='id']").val(0);
	$("#tour-modal").find("input[name~='refId']").val(0);
	if(invId>0){
			$("#tour-modal").find(".modal-title").text('TOUR DETAILS ('+invId+')');
			fetch_sale_invoice_det(invId, "tour-modal");
			$("#tour-modal input[name~='inv_id']").val(invId);
			$("#tour-ticket-table").show();
			$("#tour-hotel-table").show();
			$("#tour-visa-table").show();
			$("#tour-transfer-table").show();
			$("#tour-other-table").show();
			get_tour_ticket_records('ticket', invId);
			$("#tourTicket").attr("onClick", "get_tour_ticket_records('ticket', "+invId+")");
			$("#tourHotel").attr("onClick", "get_tour_hotel_records('hotel', "+invId+")");
			$("#tourVisa").attr("onClick", "get_tour_visa_records('visa', "+invId+")");
			$("#tourTransfer").attr("onClick", "get_tour_transfer_records('transfer', "+invId+")");
			$("#tourTransfer").attr("onClick", "get_tour_transfer_records('transfer', "+invId+")");
			$("#tourOther").attr("onClick", "get_tour_other_records('other', "+invId+")");
			edit_pass_det(invId);
	}
	else {
		$(".remove_pass").not(':first-child').remove();
		 $("#transfer-table").hide();
		$(".get_tour_ticket_records, .get_tour_transfer_records, .get_tour_visa_records, .get_tour_hotel_records, .get_tour_other_records").html('');
		$("#tourTicket").removeAttr("onClick");
		$("#tourHotel").removeAttr("onClick")
		$("#tourVisa").removeAttr("onClick");
		$("#tourTransfer").removeAttr("onClick");
		$("#tourTransfer").removeAttr("onClick");
		$("#tourOther").removeAttr("onClick");
		//========================================
		$('#ticket_passengers').html('');
		$('#ticket_passengers').multiselect('destroy');
		$('#ticket_passengers').multiselect();
		
		$('#hotel_passengers').html('');
		$('#hotel_passengers').multiselect('destroy');
		$('#hotel_passengers').multiselect();
		
		$('#visa_passengers').html('');
		$('#visa_passengers').multiselect('destroy');
		$('#visa_passengers').multiselect();
		
		$('#transfer_passengers').html('');
		$('#transfer_passengers').multiselect('destroy');
		$('#transfer_passengers').multiselect();
		
		$('#other_passengers').html('');
		$('#other_passengers').multiselect('destroy');
		$('#other_passengers').multiselect();
		$('#tour_hpass-form input[type="text"]').each(function() {
			$(this).val('');
		});
	  }
	  	$("#tour-modal").find(".ref-rec").hide();
		$('.loader-bg').hide();
		$(".js-example-basic-single").select2();
}
function otherSale(invId){
	$('.loader-bg').show();
	$('#other-modal').modal({backdrop:'static'});
	$("#other-modal").find(".modal-title").text('OTHER DETAILS');
	if(invId>0){
		$("#other-modal").find(".modal-title").text('OTHER DETAILS ('+invId+')');
		$("#other-form input[name~='inv_id']").val(invId);
			get_other_records('other', invId);
		$("#other-table").show();
	}
	else {
		 $("#other-form input[name~='inv_id']").val(0);
		 $("#other-form input[name~='id']").val(0);
		 $("#other-table").hide();
	  }
	$('.loader-bg').hide();
}
function awBill()
{
	$("#awBill-modal").modal();
}
function newSale()
{
	$("#newSale-mpdal").modal({ backdrop:'static' });
}
function sale_mode(thisVal)
{
	if(thisVal=='ticket_mode'){
		$("#ticket_mode").show();
		$("#transfer_mode").hide();
		$("#visa-mode").hide();
		$("#hotel_mode").hide();
		
	}else if(thisVal=='hotel_mode'){
		$("#hotel_mode").show();
		$("#ticket_mode").hide();
		$("#transfer_mode").hide();
		$("#visa-mode").hide();
		
	}else if(thisVal=='visa_mode'){
		$("#visa-mode").show();
		$("#hotel_mode").hide();
		$("#ticket_mode").hide();
		$("#transfer_mode").hide();
	}else if(thisVal=='transfer_mode'){
		$("#transfer_mode").show();
		$("#visa-mode").hide();
		$("#ticket_mode").hide();
		$("#hotel_mode").hide();	
	}
}
// new records
function new_sale_record(formId)
{
	$('.modal').animate({ scrollTop: 0 }, 'slow');
	$(".multiple_rec").find("tr:gt(1)").remove();
	$("#"+formId+" input[name~='name']").val('');
	$("#"+formId+" input[name~='pass_name']").val('');
	$("#"+formId+" input[name~='pass_mobile']").val('');
	 $("#tour-modal #tour_inv_date").closest('.form-group').find('label').text('Invoice Date');
	//
	if($('#'+formId).find(".tk").val()){
		tn=$('#'+formId).find(".tk").val().split('-');
		tf=tn[0];
		ts=tn[1];
		tinc=Number(tn[2])+Number(1);
		$('#'+formId).find(".tk").val(tf+'-'+ts+'-'+tinc);
	}
	$('.loader-bg').show();
	$("#"+formId+" .save-rec").show().html('<i class="fa fa-save"></i> Save');
	$("#"+formId+" .void-rec").hide();
	$("#"+formId+" #refundDiv").hide();
	$("#"+formId+" input[name~='id']").val('0');
	$('.tprofit').closest('.form-group').find('label').html('Profit');
	$("#"+formId+" .ref-rec").hide();
	$('.refEdit').css('background','#1aa89d');
	$('.refText').css('color','#1aa89d');
	$('.loader-bg').hide();
}
//select route Automatically when select departure & Return Date
function sel_auto_route(g){
	var thisVal=$(g).val();
	if(thisVal!=""){
	$(g).closest(".modal-body").find("select[name~='airline_route']").val('return');
	}
	else{
		$(g).closest(".modal-body").find("select[name~='airline_route']").val('one');	
	}
}
//Calculation by hotel rate
function hotel_rate(g)
{
	var hr=$(g).closest('.modal-body').find(".hrate_night").val();
	var nights=$(g).closest('.modal-body').find(".hnights").val();
	var beds=$(g).closest('.modal-body').find(".hguest_beds").val();
	nt=Number(hr)*Number(nights)*(beds);
	$(g).closest('.modal-body').find(".ht").val(nt);
	hotel_cal(g);
}
//Hotel Calculation
function hotel_cal(g)
{
	// calculate hotel per night cost
	refId=$("#hotel-form input[name~='refId']").val();
	var total=$(g).closest('.modal-body').find(".ht").val();
	var nights=$(g).closest('.modal-body').find(".hnights").val();
	var hguest_beds=$(g).closest('.modal-body').find(".hguest_beds").val();
	var tc=Number(nights)*Number(hguest_beds);
	/*h_rec(g);
	h_recp(g);
	h_cpaid(g);
	h_cpaidp(g);*/
	var h_return='';
	if($(g).closest("form").find('#c_charges_div').attr('style') == 'display: block;'){
		canc_charges=$(g).closest("form").find(".canc_charges").val();
	}
	else{
		canc_charges=0;
	}
	if($(g).closest("form").find('#c_charges_div').attr('style') =='display: none;'){
	$(g).closest('form').find(".hrate_night").val((Number(total)/tc).toFixed(2)); }
	//service charges
	if($(g).closest("form").find('#c_charges_div').attr('style') == 'display: block;'){
		ser_charges=$(g).closest("form").find(".ser_charges").val();
		h_return='true';
	}
	else{
		ser_charges=0;
		h_return='false';
	}
	var recp=$(g).closest('.modal-body').find(".hrecp").val();
	$(g).closest('.modal-body').find(".hrec").val(Number(total)*(recp)/100);
	var rec=$(g).closest('.modal-body').find(".hrec").val();
	var cp=$(g).closest('.modal-body').find(".hcpaid").val();
	//with holding tax
	var wh=$(g).closest('.modal-body').find(".hwh").val();
	//calculate pst paid
	var pst_paid=$(g).closest('.modal-body').find(".hpst_paid").val();
	// calculate agent amount
	var f_agent_amount=$(g).closest('.modal-body').find(".f_hagent_amount").val();
	var s_agent_amount=$(g).closest('.modal-body').find(".s_hagent_amount").val();
	//calculate psf
	var psf=$(g).closest('.modal-body').find(".hpsf").val();
	//calculate pst received
	var pst_rec=$(g).closest('.modal-body').find(".hpst_rec").val();
	var dis=$(g).closest('.modal-body').find(".hdiscount").val();
	var np=Number(total)-Number(rec)+Number(wh)+Number(pst_paid)-Number(canc_charges)+Number(cp);
	var nr=Number(total)+Number(psf)+Number(pst_rec)-Number(dis)-Number(canc_charges)-Number(ser_charges);
	//calucalte profit
	var nprofit=Number(rec)-Number(wh)-Number(cp)+Number(psf)-Number(dis)-Number(f_agent_amount)-Number(s_agent_amount)-Number(ser_charges);
	$(g).closest('.modal-body').find(".hProfit").val(Math.abs(nprofit));
	//put values
	$(g).closest('.modal-body').find(".h_np").val(np);
	$(g).closest('.modal-body').find(".h_nr").val(nr);
	if(h_return=='true'){
		if(nprofit<0){
			$(g).closest(".modal-body").find(".hProfit").closest(".form-group").find('label').text('Profit');
		}
		else{
			$(g).closest(".modal-body").find(".hProfit").closest(".form-group").find('label').text('Loss');
		}
	}
	else{
		if(nprofit>0){
			$(g).closest(".modal-body").find(".hProfit").closest(".form-group").find('label').text('Profit');
		}
		else{
			$(g).closest(".modal-body").find(".hProfit").closest(".form-group").find('label').text('Loss');
		}
	}
	hotel_currency_cal(g);
}
function hnet_psf(g)
{
	var total=$(g).closest('.modal-body').find(".ht").val();
	var f_hagent_amount=$(g).closest('.modal-body').find(".f_hagent_amount").val();
	var s_hagent_amount=$(g).closest('.modal-body').find(".s_hagent_amount").val();
	var pst_rec=$(g).closest('.modal-body').find(".hpst_rec").val();
	var nr=Number(total)+Number(f_hagent_amount)+Number(s_hagent_amount)+Number(pst_rec);
	var manual_nr=$(g).closest('.modal-body').find(".h_nr").val();
	var netPsf=Number(manual_nr)-Number(nr);
	if(netPsf>0){
		$(g).closest('.modal-body').find(".hpsf").val(netPsf); 
		}
	else{
		$(g).closest('.modal-body').find(".hpsf").val(0); 
		}
	if(netPsf<0){
		$(g).closest('.modal-body').find(".hdiscount").val(Math.abs(netPsf)); 
	}
	else{
	$(g).closest('.modal-body').find(".hdiscount").val(0); 
	}
	var rec=$(g).closest('.modal-body').find(".hrec").val();
	var cp=$(g).closest('.modal-body').find(".hcpaid").val();
	//with holding tax
	var wh=$(g).closest('.modal-body').find(".hwh").val();
	var nprofit=Number(rec)-Number(wh)-Number(cp)+netPsf;
	$(g).closest('.modal-body').find(".hProfit").val(nprofit);
	hotel_cal(g);
}
function h_rec(g)
{
	var total=$(g).closest('.modal-body').find(".ht").val();
	var rec_per=$(g).closest('.modal-body').find(".hrecp").val();
	total_com=Number(total)*Number(rec_per/100);
	$(g).closest('.modal-body').find(".hrec").val(total_com.toFixed(2));
	$(g).closest('.modal-body').find(".h_np").val(Number(total-total_com));
	var cp=$(g).closest('.modal-body').find(".hcpaid").val();
	$(g).closest('.modal-body').find(".hProfit").val(total_com-cp);
	hotel_cal(g);
}
function h_recp(g)
{
	var total=$(g).closest('.modal-body').find(".ht").val();
	var rec=$(g).closest('.modal-body').find(".hrec").val();
	recp=Number(rec*100)/(total);
	$(g).closest('.modal-body').find(".hrecp").val(recp.toFixed(6));
	var cp=$(g).closest('.modal-body').find(".hcpaid").val();
	$(g).closest('.modal-body').find(".h_np").val(Number(total-rec)+Number(cp));
	$(g).closest('.modal-body').find(".hProfit").val(rec-cp);
	hotel_cal(g);
}
function h_cpaid(g)
{
	var total=$(g).closest('.modal-body').find(".ht").val();
	var com=$(g).closest('.modal-body').find(".hcpaid_per").val();
	total_com=Number(total)*Number(com/100);
	$(g).closest('.modal-body').find(".hcpaid").val(total_com);
	var crec=$(g).closest('.modal-body').find(".hrec").val();
	np=$(g).closest('.modal-body').find(".h_np").val(Number(total)+Number(total_com)-Number(crec));
	var p=$(g).closest('.modal-body').find(".hProfit").val();
	$(g).closest('.modal-body').find(".hProfit").val(crec-total_com);
	hotel_cal(g);
}
function h_cpaidp(g)
{
	var total=$(g).closest('.modal-body').find(".ht").val();
	var com=$(g).closest('.modal-body').find(".hcpaid").val();
	tc=Number(com*100)/(total);
	$(g).closest('.modal-body').find(".hcpaid_per").val(tc.toFixed(6));
	$(g).closest('.modal-body').find(".h_np").val(Number(total)+(com));
	var crec=$(g).closest('.modal-body').find(".hrec").val();
	np=$(g).closest('.modal-body').find(".h_np").val(Number(total)+Number(com)-Number(crec));
	var p=$(g).closest('.modal-body').find(".hProfit").val();
	$(g).closest('.modal-body').find(".hProfit").val(Number(crec)-Number(com));
	hotel_cal(g);
}
function h_dis(g)
{
	var total=$(g).closest('.modal-body').find(".ht").val();
	var discount_per=$(g).closest('.modal-body').find(".hdiscountp").val();
	var nd=Number(total)*(discount_per/100);
	$(g).closest('.modal-body').find(".hdiscount").val(nd);
	hotel_cal(g);
}
function h_disp(g)
{
	var total=$(g).closest('.modal-body').find(".ht").val();
	var disp=$(g).closest('.modal-body').find(".hdiscount").val();
	var nd=Number(disp*100)/(total);
	$(g).closest('.modal-body').find(".hdiscountp").val(nd.toFixed(2));
	var psf=$(g).closest('.modal-body').find(".hProfit").val();
	hotel_cal(g);
}
function save_invoice(type, formData){
	$('.loader-bg').show();
	if(type == 'ticket'){
		var invoice_date = $('#inv_date').val();
		var client_id = $('#client_id option:selected').val();
		var pass_name = $('#pass_name').val();
		var payable = $('#vendor_id option:selected').val();
		//var departure = $('#t_departure').val();
		//var pnr = $('#airline_pnr').val();
		var ticket_no = $('#ticket-no').val();
		var fare = $('#base_fare').val();
		var sectors=$(".sectors").val();
		var flag = 'false';
		var toast = '';
		if(invoice_date == ''){
			$('#inv_date').css('border-bottom','1px solid #f00');
			toast += 'Invoice date is required.</br>';
			flag = 'true';
		}
		if(client_id == '0' || client_id=='other'){
			$('#client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Client is required.</br>';
			flag = 'true';
		}
		if(pass_name == ''){
			$('#pass_name').css('border-bottom','1px solid #f00');
			toast += 'Passenger name is required.</br>';
			flag = 'true';
		}
		if(payable == '0' || payable=='other' || payable==null){
			$('#vendor_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Payable is required.</br>';
			flag = 'true';
		}
		if(sectors == ''){
			$('.sectors').css('border-bottom','1px solid #f00');
			toast += 'Sectors Required.</br>';
			flag = 'true';
		}
		/*if(departure == ''){
			$('#t_departure').css('border-bottom','1px solid #f00');
			toast += 'Departure date is required.</br>';
			flag = 'true';
		}
		if(pnr == ''){
			$('#airline_pnr').css('border-bottom','1px solid #f00');
			toast += 'PNR number is required.</br>';
			flag = 'true';
		}*/
		if(ticket_no == ''){
			$('#ticket-no').css('border-bottom','1px solid #f00');
			toast += 'Ticket number is required.</br>';
			flag = 'true';
		}
		else if(ticket_no.length!=15){
			$('#ticket-no').css('border-bottom','1px solid #f00');
			toast += 'Ticket number is not correct.</br>';
			flag = 'true';
		}
		if(fare == ''){
			$('#base_fare').css('border-bottom','1px solid #f00');
			toast += 'Fare is required.</br>';
			flag = 'true';
		}
		if(flag == 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}
	}
	else if(type == 'hotel'){
		var invoice_date = $('#inv_date').val();
		var client_id = $('#hotel_client_id option:selected').val();
		var booking_name = $('#booking_name').val();
		var hotel = $('#hId option:selected').val();
		var check_in = $('#check_in').val();
		var check_out = $('#check_out').val();
		var payable = $('#payable_id option:selected').val();
		var guest_beds = $('#guest_beds').val();
		var rate_night = $('#rate_night').val();
		var amount = $('#basic_amount').val();
		var toast = '';
		var flag = 'false';
		if(invoice_date == ''){
			$('#inv_date').css('border-bottom','1px solid #f00');
			toast += 'Invoice date is required.</br>';
			flag = 'true';
		}
		if(client_id == '0' || client_id==null || client_id=='other'){
			$('#hotel_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Client is required.</br>';
			flag = 'true';
		}
		if(booking_name == ''){
			$('#booking_name').css('border-bottom','1px solid #f00');
			toast += 'Booking name is required.</br>';
			flag = 'true';
		}
		if(hotel == '0'){
			$('#hId').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Hotel is required.</br>';
			flag = 'true';
		}
		if(check_in == ''){
			$('#check_in').css('border-bottom','1px solid #f00');
			toast += 'Check in date is required.</br>';
			flag = 'true';
		}
		if(check_out == ''){
			$('#check_out').css('border-bottom','1px solid #f00');
			toast += 'Check out date is required.</br>';
			flag = 'true';
		}
		if(payable == '0' || payable==null || payable=='other'){
			$('#payable_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Payable is required.</br>';
			flag = 'true';
		}
		if(guest_beds == ''){
			$('#guest_beds').css('#border-bottom','1px solid #f00');
			toast += 'Guest beds is required.</br>';
			flag = 'true';
		}
		if(rate_night == ''){
			$('#rate_night').css('border-bottom','1px solid #f00');
			toast += 'Rate per night is required.</br>';
			flag = 'true';
		}
		if(amount == ''){
			$('#basic_amount').css('border-bottom','1px solid #f00');
			toast += 'Amount is required.</br>';
			flag = 'true';
		}
		
		if(flag == 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}
	}
	else if(type == 'visa'){
		var invoice_date = $('#inputdefault').val();
		var client_id = $('#visa_client_id option:selected').val();
		var pass_name = $('#visa_pass_name').val();
		var country = $('#country_id option:selected').val();
		var quantity = $('#visa_quantity').val();
		var rate = $('#rate').val();
		var amount = $('#visa_basic_fare').val();
		var payable_id=$("#visa-form select[name~='vendor_id']").val();
		var toast = '';
		var flag = 'false';
		if(invoice_date == ''){
			$('#inputdefault').css('border-bottom','1px solid #f00');
			toast += 'Invoice date is required.</br>';
			flag = 'true';
		}
		if(client_id == '0' || client_id==null || client_id=='other'){
			$('#visa_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Client is required.</br>';
			flag = 'true';
		}
		if(pass_name == ''){
			$('#visa_pass_name').css('border-bottom','1px solid #f00');
			toast += 'Passenger name is required.</br>';
			flag = 'true';
		}
		if(country == '0'){
			$('#country_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Visa country is required.</br>';
			flag = 'true';
		}
		if(quantity == ''){
			$('#visa_quantity').css('border-bottom','1px solid #f00');
			toast += 'Quantity is required.</br>';
			flag = 'true';
		}
		if(rate == ''){
			$('#rate').css('border-bottom','1px solid #f00');
			toast += 'Rate is required.</br>';
			flag = 'true';
		}
		if(amount == ''){
			$('#visa_basic_fare').css('border-bottom','1px solid #f00');
			toast += 'Amount is required.</br>';
			flag = 'true';
		}
		if(payable_id == '0' || payable_id==null || payable_id=='other'){
			$("#visa-form select[name~='vendor_id']").closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Payable is required.</br>';
			flag = 'true';
		}
		if(flag == 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}
	}
	else if(type == 'transfer'){
		var invoice_date = $('#trans_inv_date').val();
		var client_id = $('#trans_client_id option:selected').val();
		var pass_name = $('#trans_pass_name').val();
		var payable = $('#trans_vendor_id option:selected').val();
		var from_date = $('#trans_from_date').val();
		var to_date = $('#trans_to_date').val();
		var quantity = $('#trans_quantity').val();
		var rate = $('#trans_rate').val();
		var amount = $('#trans_basic_fare').val();
		var toast = '';
		var flag = 'false';
		if(invoice_date == ''){
			$('#trans_inv_date').css('border-bottom','1px solid #f00');
			toast += 'Invoice date is required.</br>';
			flag = 'true';
		}
		if(client_id == '0' || client_id==null || client_id=='other'){
			$('#trans_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Client is required.</br>';
			flag = 'true';
		}
		if(pass_name == ''){
			$('#trans_pass_name').css('border-bottom','1px solid #f00');
			toast += 'Passenger name is required.</br>';
			flag = 'true';
		}
		if(payable == '0' || payable==null || payable=='other'){
			$('#trans_vendor_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Payble is required.</br>';
			flag = 'true';
		}
		if(from_date == ''){
			$('#trans_from_date').css('border-bottom','1px solid #f00');
			toast += 'From date is required.</br>';
			flag = 'true';
		}
		if(to_date == ''){
			$('#trans_to_date').css('border-bottom','1px solid #f00');
			toast += 'To date is required.</br>';
			flag = 'true';
		}
		if(quantity == ''){
			$('#trans_quantity').css('border-bottom','1px solid #f00');
			toast += 'Quantity is required.</br>';
			flag = 'true';
		}
		if(amount == ''){
			$('#trans_basic_fare').css('border-bottom','1px solid #f00');
			toast += 'Amount is required.</br>';
			flag = 'true';
		}
		
		if(flag == 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}
	}
	else if(type == 'other'){
		var invoice_date = $('#trans_inv_date').val();
		var client_id = $('#o_client option:selected').val();
		var pass_name = $('#o_pn').val();
		var payable = $('#o_payable option:selected').val();
		var amount = $("#other-form input[name~='basic_fare']").val();
		var toast = '';
		var flag = 'false';
		if(client_id == '0' || client_id==null || client_id=='other'){
			$('#o_client').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Client is required.</br>';
			flag = 'true';
		}
		if(pass_name == ''){
			$('#o_pn').css('border-bottom','1px solid #f00');
			toast += 'Passenger name is required.</br>';
			flag = 'true';
		}
		if(payable == '0' || payable==null || payable=='other'){
			$('#o_payable').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #f00');
			toast += 'Payble is required.</br>';
			flag = 'true';
		}
		if(amount == ''){
			$("#other-form input[name~='basic_fare']").css('border-bottom','1px solid #f00');
			toast += 'Amount is required.</br>';
			flag = 'true';
		}
		
		if(flag == 'true'){
			$('.loader-bg').hide();
			toastr.error(toast);
			return false;
		}
	}
	
	$.ajax({
		url:"ajax_call/save_invoice?type="+type,
		data:$("#"+formData).serializeArray(),
		type:"POST",
		dataType:"JSON",
		success: function(data)
		{
			if(data.error!==2){
				var invId=Number(data.inv);
				$("#"+formData+" input[name~='inv_id']").val(invId);
			}
			if(type=='hotel'){
				get_hotel_invoices('hotel', invId); $("#hotel-table").show();
				$('#inv_date, #booking_name, #check_in, #check_out, #guest_beds, #rate_night, #basic_amount').css('border-bottom','1px solid rgba(0,0,0,0.15)');
				$('#hotel_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
				$('#hId').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
				$('#payable_id').css('border-bottom','1px solid #aaa');
				if(data.error!==2){
				$("#hotel-form input[name~='passport'], input[name~='name'], input[name~='pass_mobile'],input[name~='id']").val(''); }
			}
			else if(type=='ticket'){
				get_ticket_records('ticket', invId); $("#ticket-table").show();
				$('#inv_date, #pass_name, #airline_pnr, #ticket-no, #base_fare, #t_departure').css('border-bottom','1px solid rgba(0,0,0,0.15)');
				$('#client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
				$('#vendor_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
				if(data.error!==2){
				$("#ticket-form .new-rec").show();
				$("#ticket-form .void-rec").hide();
				}
				 /*$(".multiple_rec").find("tr:gt(1)").remove();*/
			}
			else if(type=='visa'){
				get_visa_records('visa', data.inv); $("#visa-table").show();
				$('#inputdefault, #visa_pass_name, #visa_quantity, #rate, #visa_basic_fare').css('border-bottom','1px solid rgba(0,0,0,0.15)');
				$('#visa_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
				$('#country_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
				if(data.error!==2){
				$("#visa-form input[name~='id'], input[name~='pass_name'], input[name~='pass_mobile'], input[name~='pass_type'], input[name~='dob'], input[name~='passport']").val(''); }
			}
			else if(type=='transfer')
			{
				get_transfer_records('transfer', invId); $("#transfer-table").show();
				$('#trans_inv_date, #trans_pass_name, #trans_from_date, #trans_to_date, #trans_quantity, #trans_rate, #trans_basic_fare').css('border-bottom','1px solid rgba(0,0,0,0.15)');
				$('#trans_client_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
				$('#trans_vendor_id').closest('.form-group').find('.select2-selection').css('border-bottom','1px solid #aaa');
				if(data.error!==2){
				$("#transfer-form input[name~='id'], input[name~='passport'], input[name~='pass_name'], input[name~='pass_mobile'], input[name~='dob']").val(''); }
			}
			else if(type=='other')
			{
				get_other_records('other', invId); $("#other-table").show();
				if(data.error!==2){
				$("#other-form input[name~='id'], input[name~='passport'], input[name~='pass_name'], input[name~='pass_mobile'], input[name~='dob']").val('0'); }
			}
			if(inv_id>0){
				$("#"+formData+" .save-rec, .ref-rec").hide(); }
			if(data.error==2){
					$("#credit_limit_alert").modal();
			}
			if(data.error==5){
					$("#duplicate_tkt_alert").modal();
			}
			setTimeout(
			  function() 
			  {
				//$("#"+formData+" .save-rec").html('<i class="fa fa-save"></i> Save');
				if(data.error!==2 && data.error!==5){
					toastr.success('Operation successfull.');
					$("#"+formData+" .save-rec").hide();}
					$('.loader-bg').hide();
			  }, 1000);
		}
	});
}
//get ticket recoreds
function get_ticket_records(type, invId, vt= null)
{
	$.ajax({
		url:"ajax_call/get_sale_invoices?type="+type+"&invId="+invId,
		dataType:"JSON",
		success: function(data)
		{
			var htmlData="";
			var j=1;
			for(i in data['rec']){
				if(data['rec'][i].refund=='yes'){ var bg="btn-danger";}
				else if(data['rec'][i].status=='voided'){ var bg="btn-warning";}
				else { var bg=""; }
				var np=Number(data['rec'][i].payable_amount);
				var nr=Number(data['rec'][i].receiveable_amount);
				htmlData+='<tr class="'+bg+'" id="t-'+data['rec'][i].id+'">';
					htmlData+='<td>'+Number(j++)+'</td>';
					htmlData+='<td>'+data['rec'][i].airline_code+'-'+data['rec'][i].ticket_no+' </td>';
					htmlData+='<td>'+data['rec'][i].passport+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_name+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_mobile+'</td>';
					htmlData+='<td>'+np+'</td>';
					htmlData+='<td>'+nr+'</td>';
					htmlData+='<td>';
					if(vt!='view'){
					htmlData+='<button class="btn btn-info btn-mini waves-effect waves-light" onclick="edit_ticket_record('+data['rec'][i].id+', \'ticket\', \'edit\')"> <i class="fa fa-edit"></i></button>';
					if(data['rec'][i].refund=='yes'){
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_ticket_ref_record('+data['rec'][i].id+', \'ticket_ref\', \'refund\')"><i class="fa fa-undo"></i> Ref</button>';
					}
					else if(data['rec'][i].status=='voided'){
					htmlData+='';
					}
					else {
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_ticket_record('+data['rec'][i].id+', \'ticket\', \'refund\')"><i class="fa fa-undo"></i> Ref</button>';	
					}
				}//view condtions
					 htmlData+=' <button class="btn btn-default btn-mini waves-effect waves-light" onclick="edit_ticket_record('+data['rec'][i].id+', \'ticket\', \'view\')"> <i class="fa fa-eye"></i></button>';
					 htmlData+='</td>';
				htmlData+='</tr>';
			}
			$(".get_ticket_records").html(htmlData);
		}
	});
}
//edit ticket records 
function edit_ticket_record(id, type, btn_type)
{
	$('.loader-bg').show();
	$("#ticket-form input[name~='refId']").val('0');
	if(btn_type == 'refund'){
		$('#c_charges_div, #s_charges_div').css('display','block');
		$('.refEdit').css('background','#ff5252');
		$('.refText').css('color','#ff5252');
		$("#ticket-form .save-rec").hide();
		$("#ticket-form .ref-rec").show();
		$('.t_payable').closest('.form-group').find('label').html('Rec from Vendor');
		$('.t_receiveable').closest('.form-group').find('label').html('Pay to Customer');
		$('.tprofit').closest('.form-group').find('label').html('Loss');
		$("#ticket-form input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
		$(".void-rec").hide();
		$("#ticket-modal").modal({ backdrop:'static' });
		$(".refEdit").addClass('refunding');
		$(".void-canc").hide();
	}else{
		$('#c_charges_div, #s_charges_div').css('display','none');
		$('.refEdit').css('background','#1aa89d');
		$('.refText').css('color','#1aa89d');
		$("#ticket-form .save-rec").html('<i class="fa fa-save"></i> Update');
		$("#ticket-form .save-rec").show();
		$("#ticket-form .ref-rec").hide();
		$('.t_payable').closest('.form-group').find('label').html('Payable');
		$('.t_receiveable').closest('.form-group').find('label').html('Receiveable');
		$("#ticket-form input[name~='inv_date']").closest('.form-group').find('label').text('Invoice Date');
		$('.tprofit').closest('.form-group').find('label').html('Profit');
		$("#ticket-form .void-rec").show();
		$(".refEdit").removeClass('refunding');
		$(".void-canc").show();
	}
	$("#refund-sectors").hide();
	if(btn_type == 'view'){
		$("#ticket-form .save-rec, .ref-rec, .void-rec").hide();
	}
	if(btn_type=='record_edit'){
		$("#ticket-modal").modal({ backdrop:'static' });
		$(".new-rec").hide();
		$("#ticket-table").remove();
	}
	$.ajax({
		url:"ajax_call/edit_sale_invoice?id="+id+"&type="+type,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#ticket-modal").find(".modal-title").text('TICKET DETAILS ('+data.inv.det.inv_id+')');
			$("#ticket-form input[name~='inv_id']").val(data.inv.det.inv_id);
			$("#ticket-form input[name~='inv_date']").val(data.inv.si.inv_date);
			$("#ticket-form input[name~='due_date']").val(data.inv.si.due_date);
			$("#ticket-form select[name~='branch_id']").val(data.inv.si.branch_id);
			$("#ticket-form select[name~='client_id']").val(data.inv.si.client_id);
			$("#ticket-form select[name~='payment_term']").val(data.inv.si.payment_term);
			$("#ticket-form select[name~='empl_id']").val(data.inv.si.empl_id);
			$("#ticket-form name[name~='remarks']").val(data.inv.si.remarks);
			// ticket details
			$("#ticket-form input[name~='id']").val(data.inv.det.id);
			$("#ticket-form input[name~='passport']").val(data.inv.det.passport);
			$("#ticket-form input[name~='name']").val(data.inv.det.pass_name);
			$("#ticket-form input[name~='pass_mobile']").val(data.inv.det.pass_mobile);
			$("#ticket-form select[name~='pass_type']").val(data.inv.det.pass_type);
			$("#ticket-form select[name~='vendor_id']").val(data.inv.det.vendor_id);
			$("#ticket-form input[name~='sectors']").val(data.inv.det.sectors);
			$("#ticket-form select[name~='airline_route']").val(data.inv.det.airline_route);
			$("#ticket-form input[name~='airline_gds']").val(data.inv.det.airline_gds);
			$("#ticket-form input[name~='airline_route']").val(data.inv.det.airline_route);
			$("#ticket-form input[name~='flight_no']").val(data.inv.det.flight_no);
			$("#ticket-form input[name~='departure']").val(data.inv.det.departure);
			$("#ticket-form input[name~='return_date']").val(data.inv.det.return_date);
			$("#ticket-form input[name~='airline_pnr']").val(data.inv.det.airline_pnr);
			$("#ticket-form input[name~='gds_pnr']").val(data.inv.det.gds_pnr);
			$("#ticket-form input[name~='ticket_type']").val(data.inv.det.ticket_type);
			$("#ticket-form input[name~='ticket_no']").val(data.inv.det.airline_code+'-'+data.inv.det.ticket_no);
			$("#ticket-form input[name~='conj_ticket_no']").val(data.inv.det.airline_code+'-'+data.inv.det.conj_ticket_no);
			$("#ticket-form input[name~='base_fare']").val(data.inv.det.base_fare);
			$("#ticket-form input[name~='sp_yi_tax']").val(data.inv.det.sp_yi_tax);
			$("#ticket-form input[name~='rg_cvt_tax']").val(data.inv.det.rg_cvt_tax);
			$("#ticket-form input[name~='yq_tax']").val(data.inv.det.yq_tax);
			$("#ticket-form input[name~='ced_tax']").val(data.inv.det.ced_tax);
			$("#ticket-form input[name~='pb_adv_yq_tax']").val(data.inv.det.pb_adv_tax);
			$("#ticket-form input[name~='xz_tax']").val(data.inv.det.xz_tax);
			$("#ticket-form input[name~='yd_tax']").val(data.inv.det.yd_tax);
			$("#ticket-form input[name~='xt_ur_tax']").val(data.inv.det.xt_ur_tax);
			$("#ticket-form input[name~='other_tax']").val(data.inv.det.other_tax);
			$("#ticket-form input[name~='total_taxes']").val(data.inv.det.total_tax);
			$("#ticket-form input[name~='com_recp']").val(data.inv.det.com_recp);
			$("#ticket-form input[name~='com_rec']").val(data.inv.det.com_rec);
			$("#ticket-form input[name~='com_paidp']").val(data.inv.det.com_paidp);
			$("#ticket-form input[name~='com_paid']").val(data.inv.det.com_paid);
			$("#ticket-form input[name~='wh_air']").val(data.inv.det.wh_air);
			$("#ticket-form input[name~='pst_paid']").val(data.inv.det.pst_paid);
			$("#ticket-form input[name~='psfp']").val(data.inv.det.psfp);
			$("#ticket-form input[name~='psf']").val(data.inv.det.psf);
			$("#ticket-form input[name~='other_income']").val(data.inv.det.other_income);
			$("#ticket-form select[name~='income_head']").val(data.inv.det.income_head);
			$("#ticket-form input[name~='discountp']").val(data.inv.det.discountp);
			$("#ticket-form input[name~='discount']").val(data.inv.det.discount);
			$("#ticket-form input[name~='wh_clientp']").val(data.inv.det.wh_clientp);
			$("#ticket-form input[name~='wh_client']").val(data.inv.det.wh_client);
			$("#ticket-form input[name~='void_com']").val(data.inv.det.void_canc);
			$("#ticket-form input[name~='fare_include']").val(data.inv.det.fare_inc);
			$("#ticket-form input[name~='tax_include']").val(data.inv.det.tax_inc);
			$("#ticket-form input[name~='f_agent_amount']").val(data.inv.det.f_agent_amount);
			$("#ticket-form select[name~='f_agent_id']").val(data.inv.det.f_agent_id);
			$("#ticket-form input[name~='s_agent_amount']").val(data.inv.det.s_agent_amount);
			$("#ticket-form select[name~='s_agent_id']").val(data.inv.det.s_agent_id);
			$("#ticket-form input[name~='payable_amount']").val(data.inv.det.payable_amount);
			$("#ticket-form input[name~='receiveable_amount']").val(data.inv.det.receiveable_amount);
			$("#ticket-form input[name~='profit']").val(data.inv.det.profit);
			$("#ticket-form select[name~='cur_type']").val(data.inv.det.cur_type);
			$("#ticket-form input[name~='cur_rate']").val(data.inv.det.cur_rate);
			var np=Number(data.inv.det.payable_amount)/Number(data.inv.det.cur_rate);
			var nr=Number(data.inv.det.receiveable_amount)/Number(data.inv.det.cur_rate);
			var npro=Number(data.inv.det.profit)/Number(data.inv.det.cur_rate);
			$("#ticket-form input[name~='cur_p']").val(np.toFixed(2));
			$("#ticket-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#ticket-form input[name~='cur_profit']").val(npro.toFixed(2));
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
						htmlData1+='<td style="position:relative;"><input type="text" name="bf[]" class="bf" value="'+data['sec_det'][i].bf+'"><button type="button" class="fa fa-plus conj_multiple_rec_app" style="position: absolute;color: #1aa89d;background:none;border:none; right:-8px;bottom:17px;"></button></td>';
						htmlData1+='</tr>';
					
				}
			}
			//show refund button if refund yes
			if(data.inv.det.refund=='yes')
			{
				$("#ticket-form #refundDiv").html('<a href="../invoice/credit-note?refId='+data.inv.det.refId+'" class="btn btn-sm btn-danger form-control" target="_blank">Refunded #'+data.inv.det.refId+'</i></a>').show();
				$("#ticket-form input[name~='refId']").val(data.inv.det.refId);
			}
			else{
				$("#ticket-form #refundDiv").hide();
			}
			
			$(".multiple_rec >tbody:last-child").html(htmlData);
			$(".conj_multiple_rec >tbody:last-child").html(htmlData1);
			$(".js-example-basic-single").select2();
			$('.loader-bg').hide();
			$("#ticket-form").find(".tktbf").text(Number(data.inv.det.base_fare)+Number(data.inv.det.total_tax));
			$("#ticket-form").find(".tktPb").text(Number(data.inv.det.com_rec)+Number(data.inv.det.com_paid)+Number(data.inv.det.wh_air)+Number(data.inv.det.pst_paid));
		}
	});
}
//get hotels records
function get_hotel_invoices(type, invId)
{
	$.ajax({
		url:"ajax_call/get_sale_invoices?type="+type+"&invId="+invId,
		dataType:"JSON",
		success: function(data)
		{
			j=1;
			var htmlData="";
			for(i in data['rec']){
				if(data['rec'][i].refund=='yes'){ var bg="btn-danger";}
				else { var bg=""; }
				htmlData+='<tr class="'+bg+'" id="h-'+data['rec'][i].id+'">';
					htmlData+='<td>'+j+'</td>';
					htmlData+='<td>'+data['rec'][i].passport+'</td>';
					htmlData+='<td>'+data['rec'][i].booking_name+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_mobile+'</td>';
					htmlData+='<td>'+data['rec'][i].payable_amount+'</td>';
					htmlData+='<td>'+data['rec'][i].receiveable_amount+'</td>';
					htmlData+='<td><button class="btn btn-info btn-mini waves-effect waves-light" onclick="edit_hotel_invoice('+data['rec'][i].id+', \'hotel\')"> <i class="fa fa-edit"></i></button>';
					if(data['rec'][i].refund=='yes'){
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_hotel_refund('+data['rec'][i].id+', \'hotel_ref\', \'refund\')"> <i class="fa fa-undo"></i> Ref</button>'; }
					else
					{
						htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_hotel_invoice('+data['rec'][i].id+', \'hotel\', \'refund\')"> <i class="fa fa-undo"></i> Ref</button>';
					}
					 htmlData+=' <button class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'hotel_rec\', \'h-'+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button></td>';
				htmlData+='</tr>';
				j++;
			}
			$(".get_hotel_invoices").html(htmlData);
		}
	});
}
function edit_hotel_invoice(id, type, btn_type)
{
	$('.loader-bg').show();
	if(btn_type == 'refund'){
		$('#hotel-form .refEdit').css('background','#ff5252');
		$('#hotel-form .refText').css('color','#ff5252');
		$('#hotel-form .h_np').closest('.form-group').find('label').html('Rec from Vendor');
		$('#hotel-form .h_nr').closest('.form-group').find('label').html('Pay to Customer');
		$('#hotel-form .hProfit').closest('.form-group').find('label').html('Loss');
		$("#hotel-form input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
		$("#hotel-form #c_charges_div, #s_charges_div").css("display", "block");
		$("#hotel-form .save-rec").hide();
		$("#hotel-form .ref-rec").show();
	}else{
		$('.refEdit').css('background','#1aa89d');
		$('.refText').css('color','#1aa89d');
		$("#hotel-form .save-rec").html('<i class="fa fa-save"></i> Update').show();
		$("#hotel-form .ref-rec").hide();
		$('#hotel-form .h_np').closest('.form-group').find('label').html('Payable');
		$('#hotel-form .h_nr').closest('.form-group').find('label').html('Receiveable');
		$('#hotel-form .hProfit').closest('.form-group').find('label').html('Profit');
		$("#ticket-form input[name~='inv_date']").closest('.form-group').find('label').text('Invoice Date');
		$('#hotel-form .tprofit').closest('.form-group').find('label').html('Profit');
		$("#hotel-form input[name~='refId']").val(0);
		$("#hotel-form #c_charges_div, #s_charges_div").hide();
		$("#hotel-form .save-rec").html('<i class="fa fa-save"></i> Update');
		$("#hotel-form .ref-rec").hide();	
	}
	if(btn_type=='record_edit'){
		$("#hotel-modal").modal({ backdrop:'static' });
		$("#hotel-form .new-rec").hide();
		$("#hotel-table").remove();
	}
	$.ajax({
		url:"ajax_call/edit_sale_invoice?id="+id+"&type="+type,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#hotel-modal").find(".modal-title").text('HOTEL DETAILS ('+data.si.invId+')');
			$("#hotel-form input[name~='inv_id']").val(data.si.invId);
			$("#hotel-form input[name~='inv_date']").val(data.si.inv_date);
			$("#hotel-form input[name~='due_date']").val(data.si.due_date);
			$("#hotel-form select[name~='branch_id']").val(data.si.branch_id);
			$("#hotel-form select[name~='client_id']").val(data.si.client_id);
			$("#hotel-form select[name~='payment_term']").val(data.si.payment_term);
			$("#hotel-form select[name~='empl_id']").val(data.si.empl_id);
			$("#hotel-form name[name~='remarks']").val(data.si.remarks);
			//=========================
			$("#hotel-form input[name~='id']").val(data.det.id);
			$("#hotel-form input[name~='passport']").val(data.det.passport);
			$("#hotel-form input[name~='name']").val(data.det.booking_name);
			$("#hotel-form input[name~='pass_mobile']").val(data.det.pass_mobile);
			$("#hotel-form input[name~='pass_type']").val(data.det.pass_type);
			$("#hotel-form input[name~='group_no']").val(data.det.group_no);
			$("#hotel-form select[name~='hotel_id']").val(data.det.hotel_id);
			$("#hotel-form select[name~='payable_id']").val(data.det.payable_id);
			$("#hotel-form input[name~='conf_no']").val(data.det.conf_no);
			$("#hotel-form input[name~='internal_ref']").val(data.det.internal_ref);
			$("#hotel-form input[name~='room_par']").val(data.det.room_par);
			$("#hotel-form input[name~='guest_beds']").val(data.det.guest_beds);
			$("#hotel-form input[name~='meal']").val(data.det.meal);
			$("#hotel-form input[name~='check_in']").val(data.det.check_in);
			$("#hotel-form input[name~='nights']").val(data.det.nights);
			$("#hotel-form input[name~='check_out']").val(data.det.check_out);
			$("#hotel-form input[name~='qty']").val(data.det.qty);
			$("#hotel-form input[name~='rate_night']").val(data.det.rate_night);
			$("#hotel-form input[name~='room_no']").val(data.det.room_no);
			$("#hotel-form input[name~='particulars']").val(data.det.particulars);
			$("#hotel-form input[name~='basic_amount']").val(data.det.basic_amount);
			$("#hotel-form input[name~='com_recp']").val(data.det.com_recp);
			$("#hotel-form input[name~='com_rec']").val(data.det.com_rec);
			$("#hotel-form input[name~='com_paidp']").val(data.com_paidp);
			$("#hotel-form input[name~='com_paid']").val(data.det.com_paid);
			$("#hotel-form input[name~='wh']").val(data.det.wh);
			$("#hotel-form input[name~='pst_paid']").val(data.det.pst_paid);
			$("#hotel-form input[name~='f_agent_amount']").val(data.det.f_agent_amount);
			$("#hotel-form select[name~='f_agent_id']").val(data.det.f_agent_id);
			$("#hotel-form input[name~='s_agent_amount']").val(data.det.s_agent_amount);
			$("#hotel-form select[name~='s_ageent_id']").val(data.det.s_ageent_id);
			$("#hotel-form input[name~='psf']").val(data.det.psf);
			$("#hotel-form input[name~='discount_per']").val(data.det.discount_per);
			$("#hotel-form input[name~='discount']").val(data.det.discount);
			$("#hotel-form input[name~='pst_rec']").val(data.det.pst_rec);
			$("#hotel-form input[name~='payable_amount']").val(data.det.payable_amount);
			$("#hotel-form input[name~='receiveable_amount']").val(data.det.receiveable_amount);
			$("#hotel-form input[name~='profit']").val(data.det.profit);
			$("#hotel-form select[name~='cur_type']").val(data.det.cur_type);
			$("#hotel-form input[name~='cur_rate']").val(data.det.cur_rate);
			var np=Number(data.det.payable_amount)/Number(data.det.cur_rate);
			var nr=Number(data.det.receiveable_amount)/Number(data.det.cur_rate);
			var npro=Number(data.det.profit)/Number(data.det.cur_rate);
			$("#hotel-form input[name~='cur_p']").val(np.toFixed(2));
			$("#hotel-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#hotel-form input[name~='cur_profit']").val(npro.toFixed(2));
			//passport details
			var pdHtml="";
			for(i in data['pd']){
				pdHtml+='<div class="remove_pass"><div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								if(i==0){
								pdHtml+='<labe>Passport#</label>'; }
								pdHtml+='<input type="text" value="'+data['pd'][i].passport+'" class="form-control form-control-sm" name="passport[]">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								if(i==0){
								pdHtml+='<labe>Passanger Name</label>';}
								pdHtml+='<input type="text" value="'+data['pd'][i].name+'" class="form-control form-control-sm" name="pass_name[]">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								if(i==0){
								pdHtml+='<labe>Passport Expiry</label>'; }
								pdHtml+='<input type="text" value="'+data['pd'][i].pass_exp+'" class="form-control form-control-sm dob" name="passport_expiry[]">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								if(i==0){
								pdHtml+='<labe>Phone No</label>'; }
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
								pdHtml+='<input type="text" name="passDob[]" class="form-control form-control-sm dob">'+
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
								'<input type="text" value="'+data['pd'][i].nic_exp+'" class="form-control form-control-sm" name="nic_exp[]"><button type="button" class="btn-primary multi_pass_add" style="position: absolute;right:-11px; bottom:7px;border:0px;"><i class="fa fa-plus"></i></button>';}
								else{
								pdHtml+='<input type="text" value="'+data['pd'][i].nic_exp+'" class="form-control form-control-sm" name="nic_exp[]"><i class="fa fa-times rp_click" style="position: absolute;color:lightcoral;right:-5px; bottom:24px;"></i>';}
								pdHtml+='</div>'+
            				'</div>'+
							'</div>';
							//show refund button if refund yes
			if(data.det.refund=='yes')
			{
				$("#hotel-form #refundDiv").html('<a href="../invoice/hotel_credit-note?refId='+data.det.refId+'" class="btn btn-sm btn-danger form-control" target="_blank">Refunded #'+data.det.refId+'</i></a>').show();
			}
			else{
				$("#hotel-form #refundDiv").hide();
				}	
			}
			if(data['pd']==null)
			{
				pdHtml+='<div class="remove_pass"><div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								pdHtml+='<labe>Passport#</label>';
								pdHtml+='<input type="text" class="form-control form-control-sm" name="passport[]">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								pdHtml+='<labe>Passanger Name</label>';
								pdHtml+='<input type="text" class="form-control form-control-sm" name="pass_name[]">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								pdHtml+='<labe>Passport Expiry</label>';
								pdHtml+='<input type="text" class="form-control form-control-sm dob" name="passport_expiry[]">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								pdHtml+='<labe>Phone No</label>'; 
								pdHtml+='<input type="text" class="form-control form-control-sm" name="phone[]">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
							  '<div class="form-group">';
								pdHtml+='<label>Pass Type</label>';
								pdHtml+='<select name="passType[]" class="form-control form-control-sm">'+
									'<option value="adult">Adult</option>'+
									'<option value="child">Child</option>'+
									'<option value="infant">Infant</option>'+
								'</select>'+
							  '</div>'+
							'</div>'+
							'<div class="col-md-2 col-custom-8">'+
							  '<div class="form-group">';
								pdHtml+='<label>DOB</label>';
								pdHtml+='<input type="text" name="passDob[]" class="form-control form-control-sm dob">'+
							  '</div>'+
							'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								pdHtml+='<labe>NIC</label>'; 
								pdHtml+='<input type="text" class="form-control form-control-sm" name="nic[]">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								pdHtml+='<labe>NIC Expiry</label>'+
								'<input type="text" class="form-control form-control-sm" name="nic_exp[]"><button type="button" class="btn-primary multi_pass_add" style="position: absolute;right:-11px; bottom:7px;border:0px;"><i class="fa fa-plus"></i></button>';
								pdHtml+='</div>'+
            				'</div>'+
							'</div>';
			}
			$(".mulit_pass").html(pdHtml);
			$(".js-example-basic-single").select2();
			$('.loader-bg').hide();
		}
	});
}
function count_nights(id)
{
       var start= moment($("#"+id+" .hcheckin").val(),'DD-MM-YYYY');
    	var end= moment($("#"+id+" .hcheckout").val(), 'DD-MM-YYYY');
   		days = (end- start) / (1000 * 60 * 60 * 24);
		tn=Math.round(days);
		if(tn>0){
       $("#"+id+" .hnights").val(tn);
		}
}
// add pax details in  hotels
function pass_det(type)
{
	$("#pass-det").modal({backdrop:'static'});
	var dt = $("#hpass-form").serializeArray();
	if(type=='submit'){
		$.ajax({
			url:"ajax_call/h_pass_session",
			type:"POST",
			data:dt,
			success: function(data)
			{
				$('#hotel-form .hguest_beds').val($('#hpass-form .remove_pass').length);
				$("#pass-det").modal('hide');
			}
		});
	}
}
function tour_pass_det(type)
{
	if(type == 'submit'){
		var form_data = $("#tour_hpass-form").serializeArray();
		var d = '';
		var name = [];
		var type = [];
		for(i in form_data){
			if(form_data[i]['name'] == 'pass_name[]'){
				name.push(form_data[i]['value']);
			}
			if(form_data[i]['name'] == 'passType[]'){
				type.push(form_data[i]['value']);
			}
		}
		for(i in name){
			d += "<option value='"+name[i]+"'>"+name[i]+" ("+type[i]+")</option>";
		}
		//save passanger in session
		$.ajax({
			url:"ajax_call/h_pass_session",
			type:"POST",
			data:form_data,
			success: function(data)
			{
				
			}
		});
		$('#ticket_passengers').html(d);
		$('#ticket_passengers').multiselect('destroy');
		$('#ticket_passengers').multiselect();
		
		$('#hotel_passengers').html(d);
		$('#hotel_passengers').multiselect('destroy');
		$('#hotel_passengers').multiselect();
		
		$('#visa_passengers').html(d);
		$('#visa_passengers').multiselect('destroy');
		$('#visa_passengers').multiselect();
		
		$('#transfer_passengers').html(d);
		$('#transfer_passengers').multiselect('destroy');
		$('#transfer_passengers').multiselect();
		
		$('#other_passengers').html(d);
		$('#other_passengers').multiselect('destroy');
		$('#other_passengers').multiselect();
		
		$("#tour-pass-det").modal('hide');
	}
	else
	{
		$("#tour-pass-det").modal({backdrop:'static'});
	}
}
function edit_pass_det(invId){
	$.ajax({
			url:"ajax_call/h_pass_session?invId="+invId,
			dataType:"JSON",
			success: function(data)
			{
				//$(".mulit_pass").html(data);
				var jsonDom = data['dom'];
				var jsonName = data['names'];
				var output = '';
				var names = '';
				for(i in jsonDom){
					var type = '';
					if(jsonDom[i].pass_type == 'adult'){
						type = '<option value="adult" selected>Adult</option><option value="child">Child</option><option value="infant">Infant</option>';
					}else if(jsonDom[i].pass_type == 'child'){
						type = '<option value="adult">Adult</option><option value="child" selected>Child</option><option value="infant">Infant</option>';
					}else if(jsonDom[i].pass_type == 'infant'){
						type = '<option value="adult">Adult</option><option value="child">Child</option><option value="infant" selected>Infant</option>';
					}
					output+='<div class="remove_pass row"><div class="col-md-2 col-custom-8"><div class="form-group"><label>Passport#</label><input type="text" value="'+jsonDom[i].passport+'" class="form-control form-control-sm fetch_pp_det" name="passport[]"></div></div><div class="col-md-2 col-custom-8"><div class="form-group"><label>Pax</label><input type="text" class="form-control form-control-sm pass_name" name="pass_name[]" value="'+jsonDom[i].name+'"></div></div><div class="col-md-2 col-custom-8"><div class="form-group"><label>Pass Exp</label><input type="text" class="form-control form-control-sm passport_expiry" name="passport_expiry[]" value="'+jsonDom[i].pass_exp+'" placeholder="01-01-2019"></div></div><div class="col-md-2 col-custom-8"><div class="form-group"><label>Phone</label><input type="text" name="phone[]" class="form-control form-control-sm pass_mobile" value="'+jsonDom[i].mobile+'"></div></div><div class="col-md-2 col-custom-8"><div class="form-group"><label>Pass Type</label><select name="passType[]" class="form-control form-control-sm pass_type">'+type+'</select></div></div><div class="col-md-2 col-custom-8"><div class="form-group"><label>DOB</label><input type="text" name="dob[]" class="form-control form-control-sm" placeholder="01-01-2019"></div></div><div class="col-md-2 col-custom-8"><div class="form-group"><label>NIC</label><input name="nic[]" class="form-control form-control-sm nic"></div></div><div class="col-md-2 col-custom-8"><div class="form-group"><label>NIC Expiry</label><input type="text" class="form-control form-control-sm nic_exp" name="nic_exp[]">';
					if(i==0){
					output+='<button type="button" class="multi_pass_add btn-primary" style="position: absolute;right:-25px; bottom:7px; border:none;"><i class="fa fa-plus"></i></button>';
					}else{
					output+='<i class="fa fa-times rp_click" style="position: absolute;color:lightcoral;right:-5px; bottom:24px;"></i>';
					}
					output+='</div></div></div>';
					names+='<option value="'+jsonName[i].name+'">'+jsonName[i].name+' ('+jsonName[i].pass_type+')</option>';
				}
				if(data['dom']==null){
					type = '<option value="adult">Adult</option><option value="child">Child</option><option value="infant">Infant</option>';
					output+='<div class="remove_pass row"><div class="col-md-2 col-custom-8"><div class="form-group"><label>Passport#</label><input type="text" value="" class="form-control form-control-sm fetch_pp_det" name="passport[]"></div></div><div class="col-md-2 col-custom-8"><div class="form-group"><label>Pax</label><input type="text" class="form-control form-control-sm pass_name" name="pass_name[]" value=""></div></div><div class="col-md-2 col-custom-8"><div class="form-group"><label>Pass Exp</label><input type="text" class="form-control form-control-sm passport_expiry" name="passport_expiry[]" value="" placeholder="01-01-2019"></div></div><div class="col-md-2 col-custom-8"><div class="form-group"><label>Phone</label><input type="text" name="phone[]" class="form-control form-control-sm pass_mobile" value=""></div></div><div class="col-md-2 col-custom-8"><div class="form-group"><label>Pass Type</label><select name="passType[]" class="form-control form-control-sm pass_type">'+type+'</select></div></div><div class="col-md-2 col-custom-8"><div class="form-group"><label>DOB</label><input type="text" name="dob[]" class="form-control form-control-sm" placeholder="01-01-2019"></div></div><div class="col-md-2 col-custom-8"><div class="form-group"><label>NIC</label><input name="nic[]" class="form-control form-control-sm nic"></div></div><div class="col-md-2 col-custom-8"><div class="form-group"><label>NIC Expiry</label><input type="text" class="form-control form-control-sm nic_exp" name="nic_exp[]"><button type="button" class="multi_pass_add btn-primary" style="position: absolute;right:-25px; bottom:7px; border:none;"><i class="fa fa-plus"></i></button></div></div></div>';
				}
				$(".mulit_pass").html(output);
				
				$('#ticket_passengers').html(names);
				$('#ticket_passengers').multiselect('destroy');
				$('#ticket_passengers').multiselect();
				
				$('#hotel_passengers').html(names);
				$('#hotel_passengers').multiselect('destroy');
				$('#hotel_passengers').multiselect();
				
				$('#visa_passengers').html(names);
				$('#visa_passengers').multiselect('destroy');
				$('#visa_passengers').multiselect();
				
				$('#transfer_passengers').html(names);
				$('#transfer_passengers').multiselect('destroy');
				$('#transfer_passengers').multiselect();
				
				$('#other_passengers').html(names);
				$('#other_passengers').multiselect('destroy');
				$('#other_passengers').multiselect();
			}
		});
	
}
function ticket_print_format(id=0){
	$('#ticket-sel-inv').modal();
	$("#ticket-sel-inv select[name~='inv_format']").prop('selectedIndex',0);
	if(id==0 || id==''){
		var inv_id=$("#ticket-form input[name~='inv_id']").val();
	}else{
		var inv_id=id;
	}
	$("#ticket-sel-inv input[name~='inv_id']").val(inv_id);
}

function hotel_print_format(id=0){
	$('#hotel-sel-inv').modal();
	$("#hotel-sel-inv select[name~='inv_format']").prop('selectedIndex',0);
	if(id==0 || id==''){
	var inv_id=$("#hotel-form input[name~='inv_id']").val();
	}else{
	 var inv_id=id;
	}
	$("#hotel-sel-inv input[name~='inv_id']").val(inv_id);
}
function visa_print_format(id=0){
	$('#visa-sel-inv').modal();
	$("#visa-sel-inv select[name~='inv_format']").prop('selectedIndex',0);
	if(id==0 || id==''){
	var inv_id=$("#visa-form input[name~='inv_id']").val();
	}else{
		var inv_id=id;
	}
	$("#visa-sel-inv input[name~='inv_id']").val(inv_id);
}
function transfer_print_format(id=0){
	$('#transfer-sel-inv').modal();
	$("#transfer-sel-inv select[name~='inv_format']").prop('selectedIndex',0);
	if(id==0 || id==''){
	var inv_id=$("#transfer-form input[name~='inv_id']").val();
	}else{
		var inv_id=id;
	}
	$("#transfer-sel-inv input[name~='inv_id']").val(inv_id);
}
function tour_print_format(id=0){
	$('#tour-sel-inv').modal();
	$("#tour-sel-inv select[name~='inv_format']").prop('selectedIndex',0);
	if(id==0 || id==''){
	var inv_id=$("#tour-modal input[name~='inv_id']").val();
	}else{
		var inv_id=id;
	}
	$("#tour-sel-inv input[name~='inv_id']").val(inv_id);
}
function other_print_format(id=0){
	$('#other-sel-inv').modal();
	$("#other-sel-inv select[name~='inv_format']").prop('selectedIndex',0);
	if(id==0 || id==''){
	var inv_id=$("#other-form input[name~='inv_id']").val();
	}else{
		var inv_id=id;
	}
	$("#other-sel-inv input[name~='inv_id']").val(inv_id);
}
$(document).on('click','.rp_click',function() {
 	$(this).parents().closest(".remove_pass").remove();
});
$(".mulit_pass").delegate(".multi_pass_add", "click", function(){
	//var trec=$(".remove_pass").length;
	var trec = $(this).closest('.mulit_pass').find('.remove_pass').length;
	var chr=$(this).val().length;
	if(trec<100){
		$('.dob').daterangepicker('remove');
	$(this).closest('.mulit_pass').append('<div class="remove_pass row"><div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">'+
								'<input type="text" value="" class="form-control form-control-sm fetch_pp_det" name="passport[]">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
							  '<div class="form-group">'+
								'<input type="text" class="form-control form-control-sm pass_name" name="pass_name[]">'+
							  '</div>'+
							'</div>'+
							'<div class="col-md-2 col-custom-8">'+
							  '<div class="form-group">'+
								'<input type="text" class="form-control form-control-sm passport_expiry" name="passport_expiry[]" placeholder="01-01-2019">'+
							  '</div>'+
							'</div>'+
							'<div class="col-md-2 col-custom-8">'+
							  '<div class="form-group">'+
								'<input type="text" name="phone[]" class="form-control form-control-sm pass_mobile">'+
							  '</div>'+
							'</div>'+
							'<div class="col-md-2 col-custom-8">'+
							  '<div class="form-group">'+
								'<select name="passType[]" class="form-control form-control-sm pass_type">'+
									'<option value="adult">Adult</option>'+
									'<option value="child">Child</option>'+
									'<option value="infant">Infant</option>'+
								'</select>'+
							  '</div>'+
							'</div>'+
							'<div class="col-md-2 col-custom-8">'+
							  '<div class="form-group">'+
								'<input type="text" name="dob[]" class="form-control form-control-sm" placeholder="01-01-2019">'+
							  '</div>'+
							'</div>'+
							'<div class="col-md-2 col-custom-8">'+
							  '<div class="form-group">'+
								'<input name="nic[]" class="form-control form-control-sm nic">'+
							  '</div>'+
							'</div>'+
							'<div class="col-md-2 col-custom-8">'+
								'<div class="form-group">'+
									'<input type="text" class="form-control form-control-sm nic_exp" name="nic_exp[]" placeholder="01-01-2019"><i class="fa fa-times rp_click" style="position: absolute;color:lightcoral;right:-5px; bottom:24px;"><i>'+
								'</div>'+
							'</div></div><div class="clearfix"></div>');
	}
	$(".fetch_pp_det").on("change",function(){
		var pp=$(this).val();
		var g=$(this);
		(g).closest(".col-custom-8").siblings().find(".pass_name").val('');
		(g).closest(".col-custom-8").siblings().find(".pass_mobile").val('');
		(g).closest(".col-custom-8").siblings().find(".pass_type").val('');
		(g).closest(".col-custom-8").siblings().find(".dob").val('');
		(g).closest(".col-custom-8").siblings().find(".passport_expiry").val('');
		(g).closest(".col-custom-8").siblings().find(".nic").val('');
		(g).closest(".col-custom-8").siblings().find(".nic_exp").val('');
		$.ajax({
			url:"ajax_call/fetch_pp_det?pp="+pp,
			dataType:"JSON",
			success: function(data)
			{
				
				(g).closest(".col-custom-8").siblings().find(".pass_name").val(data.name);
				(g).closest(".col-custom-8").siblings().find(".pass_mobile").val(data.mobile);
				(g).closest(".col-custom-8").siblings().find(".pass_type").val(data.pass_type);
				(g).closest(".col-custom-8").siblings().find(".dob").val(data.dob);
				(g).closest(".col-custom-8").siblings().find(".passport_expiry").val(data.pass_exp);
				(g).closest(".col-custom-8").siblings().find(".nic").val(data.nic);
				(g).closest(".col-custom-8").siblings().find(".nic_exp").val(data.nic_exp);
			}
		});
	});	
});
$(document).on('click','.remove',function() {
	var sum=0;
	var net_total=0;
	g = $(this);
	var v = $(this).closest('.calClass').find(".bf").val();
	$(this).closest('.modal-body').find(".bf").each(function(e){
		sum+=Number($(this).val());			
	});
	g.closest(".calClass").hide(500);
	if(sum>0){
	g.closest('.modal-body').find(".ticket_bf").val(Number(sum) - Number(v)); 
	ticket_cal(g);
	t_psf_rec(g);}
	setTimeout(function(){
		g.closest(".calClass").remove();
	}, 1000);
});
$(".multiple_rec").delegate(".multiple_rec_app","click", function(){
	//var trec=$(".multiple_rec .calClass").length;
	var trec = $(this).closest('.multiple_rec').find('.calClass').length;
	$('.date').datepicker('remove');
	if(trec < 4){
	$(this).closest('.modal-body').find(".multiple_rec >tbody").append('<tr class="calClass">'+
                        '<td><input type="text" name="sec_in[]"></td>'+
                        '<td><input type="text" name="sec_out[]"></td>'+
                        '<td><input type="text" name="sec_date[]" class="date"></td>'+
                        '<td><input type="text" name="sec_class[]"></td>'+
                        '<td><input type="text" name="sec_time[]"></td>'+
                        '<td><input type="text" name="rate[]" class="rate"></td>'+
                        '<td><input type="text" name="ex_rate[]" class="er"></td>'+
                        '<td style="position:relative;"><input type="text" name="bf[]" class="bf"><i class="fa fa-times remove" style="position: absolute;color:lightcoral;right:-5px; bottom:24px;"><i></td>'+
                      '</tr>');
	}
	else{
		$(this).closest('.modal-body').find(".conj-ticket").show();
		console.log($(this).closest('.modal-body').find(".tk").val());
		tn=$(this).closest('.modal-body').find(".tk").val().split('-');
		tf=tn[0];
		ts=tn[1];
		tinc=Number(tn[2])+Number(1);
		$(this).closest('.modal-body').find(".conj-tk").val(tf+'-'+ts+'-'+tinc);
		$(".conj_multiple_rec >tbody:last-child").html('<tr class="calClass">'+
                        '<td><input type="text" name="sec_in[]"></td>'+
                        '<td><input type="text" name="sec_out[]" ></td>'+
                        '<td><input type="text" name="sec_date[]" class="date"></td>'+
                        '<td><input type="text" name="sec_class[]"></td>'+
                        '<td><input type="text" name="sec_time[]"></td>'+
                        '<td><input type="text" name="rate[]" class="rate"></td>'+
                        '<td><input type="text" name="ex_rate[]" class="er"></td>'+
                        '<td style="position:relative;"><input type="text" name="bf[]" class="bf"><button type="button" class="fa fa-plus conj_multiple_rec_app" style="position: absolute;color: #1aa89d;background:none;border:none; right:-8px;bottom:17px;"></button></td>'+
                      '</tr>');
	}
	$('.date').datepicker({
        todayBtn: false,
        clearBtn: false,
        keyboardNavigation: false,
        forceParse: false,
        todayHighlight: true,
		autoclose:true,
        format: 'dd-mm-yyyy'
    });
});
$(".conj_multiple_rec").delegate(".conj_multiple_rec_app","click", function(){
	//var trec=$(".conj_multiple_rec_app").length;
	var trec = $(this).closest('.conj_multiple_rec').find('.calClass').length;
	if(trec >= 1 && trec <= 3){
		$('.date').datepicker('remove');
	$(".conj_multiple_rec >tbody:last-child").append('<tr class="calClass">'+
                        '<td><input type="text" name="sec_in[]"></td>'+
                        '<td><input type="text" name="sec_out[]" ></td>'+
                        '<td><input type="text" name="sec_date[]" class="date"></td>'+
                        '<td><input type="text" name="sec_class[]"></td>'+
                        '<td><input type="text" name="sec_time[]"></td>'+
                        '<td><input type="text" name="rate[]" class="rate"></td>'+
                        '<td><input type="text" name="ex_rate[]" class="er conj_multiple_rec_app"></td>'+
                        '<td style="position:relative;"><input type="text" name="bf[]" class="bf"><i class="fa fa-times remove" style="position: absolute;color:lightcoral;right:-5px; bottom:24px;"><i></td>'+
                      '</tr>');
		$('.date').datepicker({
			todayBtn: false,
			clearBtn: false,
			keyboardNavigation: false,
			forceParse: false,
			todayHighlight: true,
			autoclose:true,
			format: 'dd-mm-yyyy'
		});
	}
});
$(document).ready(function () {
    $(".ticket-no").keyup(function () {
		if ($(this).val().length == 3) {
			$(this).val($(this).val() + "-");
				var trec=$(this).closest(".modal-body").find('.multiple_rec_app').length;
				if(trec <= 1){
					$('.date').datepicker('remove');
				$(this).closest(".modal-body").find(".multiple_rec > tbody").html('<tr class="calClass">'+
					'<td><input type="text" name="sec_in[]"></td>'+
					'<td><input type="text" name="sec_out[]"></td>'+
					'<td><input type="text" name="sec_date[]" class="date"></td>'+
					'<td><input type="text" name="sec_class[]"></td>'+
					'<td><input type="text" name="sec_time[]"></td>'+
					'<td><input type="text" name="rate[]" class="rate"></td>'+
					'<td><input type="text" name="ex_rate[]" class="er"></td>'+
					'<td style="position:relative;"><input type="text" name="bf[]" class="bf"><button type="button" class="fa fa-plus multiple_rec_app" style="position: absolute;color: #1aa89d;background:none;border:none; right:-8px;bottom:17px;"></button></td>'+
								  '</tr>');
									}
				$('.date').datepicker({
					todayBtn: false,
					clearBtn: false,
					keyboardNavigation: false,
					forceParse: false,
					todayHighlight: true,
					autoclose:true,
					format: 'dd-mm-yyyy'
				});
			
		}
		else if ($(this).val().length == 8) {
			$(this).val($(this).val()+ "-");
		}
   });
});
$(document).ready(function () {
    $(".sectors").keyup(function () {
		var str =$(this).val();
		$(this).val(str.replace(' ', '-'));
	})
});
$(document).on('change','.calClass',function() {
	var sum=0;
	g=$(this);
	$(this).each(function(index){
		rate=$(this).find(".rate").val();
		er=g.find(".er").val();
		total=Number(rate)*Number(er);
		g.find(".bf").val(total);
	});
	$(this).closest('.modal-body').find(".bf").each(function(e){
		sum+=Number($(this).val());			
	});
	if(sum>0){
	g.closest('.modal-body').find(".ticket_bf").val(sum); }
	ticket_cal(g);
});
function del_inv(path, type, divId){
	id=divId.split('-');
	x=confirm("Are you Sure?");
	if(!x)
		{
			return true;
		}
	$("#"+divId).load(''+path+'del_rec?type='+type+'&id='+id[1]);
	$("#"+divId).hide();
	
}
// fetch room list agains hotel selection 
function fetch_hRoom(g)
{
	var hId=$(g).closest("form").find("select[name~='hotel_id']").val();
	var ht=$(g).closest("form").find("#ht").val();
	if(ht==''){
		$("#selRoom").html("<option value=''>Select Room</option>");
		checkin=$(g).closest("form").find("input[name~='check_in']").val();
		checkout=$(g).closest("form").find("input[name~='check_out']").val();
		$.ajax({
			url:"ajax_call/fetch_hRoom?hId="+hId,
			dataType:"JSON",
			data:{"checkin":checkin, "checkout":checkout},
			type:"GET",
			success: function(data)
			{
				
				var htmlData="<option value=''>Select Room</option>";
				for(i in data)
				{
					htmlData+='<option value="'+data[i].room_no+'">'+data[i].room_no+'</option>';
				}
				$("#hotel-form").find("#selRoom").html(htmlData);
			}
		});
	}
}
// check Room availability using date filteration
function sel_room(thisVal, formData){
	var hId=$("#hId").val();
	var rn=thisVal;
	$.ajax({
		url:"ajax_call/fetch_hotel_det?hId="+hId+"&rn="+rn,
		dataType:"JSON",
		success: function(data)
		{
			$("#"+formData +" input[name~='rate_night']").val(data['rate']);
			$("#"+formData +" input[name~='guest_beds']").val(data['beds']);
			var hnights=$("#"+formData+" input[name~='nights']").val();
			var beds=$("#"+formData+" input[name~='guest_beds']").val();
			var rate=$("#"+formData+" input[name~='rate_night']").val();
			nt=Number(hnights)*Number(beds)*Number(rate);
			if(parseInt(hnights) > parseInt(data['nights']))
			{
				alert("Only "+data['nights']+" Nights Available..please Select other Room");
			}
			$(".ht").val(nt);
			hotel_cal();
		}
	});
};
// Add Manual hotel modal
function manual_hotel(thisVal, hotel)
{
	if(thisVal=='other'){
		$("#manual-hotel").modal( { backdrop: 'static' });
		//$("form").closest("#ht").val('other');
		$(hotel).closest("form").find("#ht").val('other');
	}
	if(thisVal=='submit'){
		hl=$("#manual-hotel-form input[name='hotel_name']").val();
		$.ajax({
			url:"ajax_call/save_manual_hotel",
			type:"POST",
			data:$("#manual-hotel-form").serialize(),
			dataType:"JSON",
			success: function(data)
			{
				$("#hId").append('<option selected value="'+data.id+'">'+data.hotel_name+'</option>');
				$("#th_hId").append('<option selected value="'+data.id+'">'+data.hotel_name+'</option>');
				//$("#selRoom").html('<option value="'+data.room_no+'">'+data.room_no+'</option>');
			}
		});
		
	}
}
///===================================fetch pos invoices when you are using to pos portion
function fetch_ticket_sale_invoices()
{
	$('.loader-bg').show();
	$.ajax({
		url:"fetch_sale_invoices/get_sale_invoices?type=ticket",
		type:"POST",
		data:$("#search_ticket_form").serialize(),
		dataType:"JSON",
		success: function(data)
		{
			var htmlData="";
			for(i in data['rec']){
				htmlData+='<tr>';
					htmlData+='<td>'+(Number(i)+1)+'</td>';
					htmlData+='<td>'+data['rec'][i].invId+'</td>';
					htmlData+='<td>'+data['rec'][i].inv_date+'</td>';
					htmlData+='<td>'+data['rec'][i].Client_name+'</td>';
					htmlData+='<td>'+(data['rec'][i].payable_amount)+'</td>';
					htmlData+='<td>'+data['rec'][i].receiveable_amount+'</td>';
					htmlData+='<td>'+data['rec'][i].dis+'</td>';
					htmlData+='<td>'+data['rec'][i].profit+'</td>';		
					htmlData+='<td><button type="button" class="btn btn-info btn-mini waves-effect waves-light" onclick="ticket('+data['rec'][i].invId+', \'edit\')"> <i class="fa fa-edit"></i></button>'+
					' <button type="button" class="btn btn-default btn-mini waves-effect waves-light" onclick="ticket('+data['rec'][i].invId+', \'view\')"> <i class="fa fa-eye"></i></button>'+
					' <button type="button" class="btn btn-default btn-mini waves-effect waves-light" onclick="ticket_print_format('+data['rec'][i].invId+')"> <i class="fa fa-print"></i></button>';
					 <!--htmlData+=' <button class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'hotel\', \'h-'+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button></td>';-->
				htmlData+='<tr>';	
			}
			$(".fetch_ticket_sale_invoices").html(htmlData);
			$('.loader-bg').hide();
		}
	});
}
function fetch_hotel_sale_invoices(type)
{
	$('.loader-bg').show();
	$.ajax({
		url:"fetch_sale_invoices/get_sale_invoices?type="+type,
		type:"POST",
		data:$("#search-hotel-form").serialize(),
		dataType:"JSON",
		success: function(data)
		{
			var htmlData="";
			for(i in data['rec']){
				htmlData+='<tr>';
					htmlData+='<td>'+(Number(i)+1)+'</td>';
					htmlData+='<td>'+data['rec'][i].invId+'</td>';
					htmlData+='<td>'+data['rec'][i].inv_date+'</td>';
					htmlData+='<td>'+data['rec'][i].Client_name+'</td>';
					htmlData+='<td>'+(data['rec'][i].payable_amount)+'</td>';
					htmlData+='<td>'+data['rec'][i].receiveable_amount+'</td>';
					htmlData+='<td>'+data['rec'][i].dis+'</td>';
					htmlData+='<td>'+data['rec'][i].profit+'</td>';	
				    htmlData+='<td>';
					htmlData+='<button type="button" class="btn btn-info btn-mini waves-effect waves-light" onclick="hotelSale('+data['rec'][i].invId+')"> <i class="fa fa-edit"></i></button>';
				    htmlData+=' <button type="button" class="btn btn-default btn-mini waves-effect waves-light" onclick="hotel_print_format('+data['rec'][i].invId+')"> <i class="fa fa-print"></i></button>';
					 /*htmlData+=' <button class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'hotel\', \'h-'+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button></td>';*/
				htmlData+='</td><tr>';	
			}
			$(".fetch_hotel_sale_invoices").html(htmlData);
			$('.loader-bg').hide();
		}
	});
}
//=========================Ticket calculation
function ticket_cal(g)
{
	var void_com=0;
	refId=$("#ticket-form input[name~='refId']").val();
	ref=$(g).closest(".modal").find(".refEdit").hasClass('refunding');
	var bf=$(g).closest('.modal-body').find(".ticket_bf").val();
	var total_tx=$(g).closest('.modal-body').find(".total_taxes").val();
	var return_t = '';
	if(ref==false){
	var com_recp=$(g).closest('.modal-body').find(".t_com_recp").val();}
	var cp=$(g).closest('.modal-body').find(".t_com_paid").val();
	var twh=$(g).closest('.modal-body').find(".t_wh").val();
	var pst_paid=$(g).closest('.modal-body').find(".t_pst_paid").val();
	if(ref==false){
	var psfp=$(g).closest('.modal-body').find(".t_psfp").val();}
	var dis=$(g).closest('.modal-body').find(".t_dis").val();
	var whc=$(g).closest('.modal-body').find(".t_whc").val();
	var tfi=$(g).closest('.modal-body').find(".tfi").val();
	var t_taxi=$(g).closest('.modal-body').find(".t_taxi").val();
	var f_agent_amount=$(g).closest(".modal-body").find(".f_agent_amount").val();
	var s_agent_amount=$(g).closest(".modal-body").find(".s_agent_amount").val();
	var other_income=$(g).closest('.modal-body').find('.other_income').val();
	void_com=$(g).closest('.modal-body').find('.void_com').val();
	if(ref==false){
		$(g).closest('.modal-body').find(".t_com_rec").val((Number(bf)*Number(com_recp)/100).toFixed(2));
		$(g).closest('.modal-body').find(".t_psf").val((Number(bf)*Number(psfp)/100).toFixed(2));}
		var com_rec=$(g).closest('.modal-body').find(".t_com_rec").val();
		var psf=$(g).closest('.modal-body').find(".t_psf").val(); 
	//cancellation charges
	if($(g).closest(".modal-body").find('#c_charges_div').attr('style') == 'display: block;'){
		canc_charges=$(g).closest(".modal-body").find(".canc_charges").val();
		return_t = 'true';
	}
	else{
		canc_charges=0;
		return_t = 'false';
	}
	//service charges
	if($(g).closest(".modal-body").find('#c_charges_div').attr('style') == 'display: block;'){
		ser_charges=$(g).closest(".modal-body").find(".ser_charges").val();
	}
	else{
		ser_charges=0;
	}
	var np=Number(bf)+Number(total_tx)-Number(com_rec)+Number(cp)+Number(twh)+Number(pst_paid)-Number(canc_charges)-Number(other_income);
	var nr=Number(bf)+Number(total_tx)+Number(psf)-Number(dis)+Number(whc)+Number(tfi)+Number(t_taxi)-Number(canc_charges)-Number(ser_charges)+Number(void_com);
	var tProfit=Number(psf)-Number(dis)+Number(tfi)+Number(com_rec)-Number(twh)-Number(f_agent_amount)-Number(s_agent_amount)-Number(ser_charges)+Number(t_taxi)-Number(cp)+Number(whc)-Number(pst_paid)+Number(void_com)+Number(other_income);
	if(return_t == 'true'){
		if(tProfit<0){
			$(g).closest(".modal-body").find(".tprofit").closest(".form-group").find('label').text('Profit');
		}
		else{
			$(g).closest(".modal-body").find(".tprofit").closest(".form-group").find('label').text('Loss');
		}
	}else{
		if(tProfit>=0){
			$(g).closest(".modal-body").find(".tprofit").closest(".form-group").find('label').text('Profit');
		}
		else{
			$(g).closest(".modal-body").find(".tprofit").closest(".form-group").find('label').text('Loss');
		}
	}
	$(g).closest(".modal-body").find(".tktbf").text(Number(bf)+Number(total_tx));
	$(g).closest(".modal-body").find(".tktPb").text(Number(com_rec)+Number(cp)+Number(twh)+Number(pst_paid));
	///
	$(g).closest('.modal-body').find(".t_payable").val(Number(np));
	$(g).closest('.modal-body').find(".t_receiveable").val(Number(nr));
	$(g).closest('.modal-body').find(".tprofit").val(Math.abs(tProfit).toFixed(2));
	ticket_currency_cal(g);
}
function total_txs(g)
{
	var spyi_tax=$(g).closest('.modal-body').find(".spyi_tax").val();
	var rg_tax=$(g).closest('.modal-body').find(".rg_tax").val();
	var yq_tax=$(g).closest('.modal-body').find(".yq_tax").val();
	var ced_tax=$(g).closest('.modal-body').find(".ced_tax").val();
	var pb_tax=$(g).closest('.modal-body').find(".pb_tax").val();
	var xz_tax=$(g).closest('.modal-body').find(".xz_tax").val();
	var td_tax=$(g).closest('.modal-body').find(".td_tax").val();
	var xt_tax=$(g).closest('.modal-body').find(".xt_tax").val();
	var other_tax=$(g).closest('.modal-body').find(".other_tax").val();
	var t=Number(spyi_tax)+Number(rg_tax)+Number(yq_tax)+Number(ced_tax)+Number(pb_tax)+Number(xz_tax)+Number(td_tax)+Number(xt_tax)+Number(other_tax)	;
	$(g).closest('.modal-body').find(".total_taxes").val(Number(t));
	ticket_cal(g);
	ticket_currency_cal(g);
}
function t_com_recp(g)
{
	var ticket_bf=$(g).closest('.modal-body').find(".ticket_bf").val();
	var t_com_recp=$(g).closest('.modal-body').find(".t_com_recp").val();
	var ncom_rec=Number(ticket_bf)*Number(t_com_recp)/100;
	$(g).closest('.modal-body').find(".t_com_rec").val(Number(ncom_rec).toFixed(2));
	ticket_cal(g);
	ticket_currency_cal(g);
}
function t_com_rec(g)
{
	var ticket_bf=$(g).closest('.modal-body').find(".ticket_bf").val();
	var t_com_rec=$(g).closest('.modal-body').find(".t_com_rec").val();
	var ncom_rec=Number(t_com_rec)*100/Number(ticket_bf);
	var psf=$(g).closest('.modal-body').find(".t_psf").val();
	var np=Number(t_com_rec)+Number(psf);
	$(g).closest('.modal-body').find(".t_com_recp").val(Number(ncom_rec).toFixed(6));
	ticket_cal(g);
	ticket_currency_cal(g);
}
function t_com_paidp(g)
{
	var ticket_bf=$(g).closest('.modal-body').find(".ticket_bf").val();
	var t_com_paidp=$(g).closest('.modal-body').find(".t_com_paidp").val();
	var ncom_paid=Number(ticket_bf)*Number(t_com_paidp)/100;
	$(g).closest('.modal-body').find(".t_com_paid").val(Number(ncom_paid));
	ticket_cal(g);
	ticket_currency_cal(g);
}
function t_com_paid(g)
{
	var ticket_bf=$(g).closest('.modal-body').find(".ticket_bf").val();
	var t_com_paid=$(g).closest('.modal-body').find(".t_com_paid").val();
	var ncom_paid=Number(t_com_paid)*100/Number(ticket_bf);
	$(g).closest('.modal-body').find(".t_com_paidp").val(Number(ncom_paid).toFixed(6));
	ticket_cal(g);
	ticket_currency_cal(g);
}
function t_psfp(g)
{
	var ticket_bf=$(g).closest('.modal-body').find(".ticket_bf").val();
	var t_psfp=$(g).closest('.modal-body').find(".t_psfp").val();
	var npsf=Number(ticket_bf)*Number(t_psfp)/100;
	$(g).closest('.modal-body').find(".t_psf").val(Number(npsf));
	ticket_cal(g);
	ticket_currency_cal(g);
}
function t_psf(g)
{
	var ticket_bf=$(g).closest('.modal-body').find(".ticket_bf").val();
	var t_psf=$(g).closest('.modal-body').find(".t_psf").val();
	var npsf=Number(t_psf)*100/Number(ticket_bf);
	$(g).closest('.modal-body').find(".t_psfp").val(Number(npsf).toFixed(6));
	ticket_cal(g);
	ticket_currency_cal(g);
}
//psf on base of receiveable amount
function t_psf_rec(g)
{
	var void_com=0;
	var bf=$(g).closest('.modal-body').find(".ticket_bf").val();
	var total_tx=$(g).closest('.modal-body').find(".total_taxes").val();
	var f_agent_amount=$(g).closest(".modal-body").find(".f_agent_amount").val();
	var s_agent_amount=$(g).closest(".modal-body").find(".s_agent_amount").val();
	var nr=Number(bf)+Number(total_tx)+Number(f_agent_amount)+Number(s_agent_amount);
	var manual_nr=$(g).closest('.modal-body').find(".t_receiveable").val();
	var netPsf=Number(manual_nr)-Number(nr);
	var void_com=$(g).closest('.modal-body').find(".void_com").val();
	var other_income=$(g).closest('.modal-body').find(".other_income").val();
	if(netPsf>0){
		$(g).closest(".modal-body").find(".t_psf").val(netPsf);
		$(g).closest(".modal-body").find(".t_psfp").val((Number(netPsf)*(100)/Number(nr)).toFixed(6));
	}
	else{
		$(g).closest(".modal-body").find(".t_psf").val(0);
	}
	if(netPsf<0){
		$(g).closest(".modal-body").find(".t_dis").val(Math.abs(netPsf));
	}
	else{
		$(g).closest(".modal-body").find(".t_dis").val(0);
	}
	var rec=$(g).closest(".modal-body").find(".t_com_rec").val();
	var wh=$(g).closest('.modal-body').find(".t_wh").val();
	var pst_paid=$(g).closest('.modal-body').find(".t_pst_paid").val();
	var whc=$(g).closest(".modal-body").find(".t_whc").val();
	var nprofit=Number(rec)-Number(wh)+Number(netPsf)+Number(whc)-Number(pst_paid)+Number(void_com)+Number(other_income);
	/*var p=$(g).closest(".modal-body").find(".tprofit").val();
	var cr=$(g).closest(".modal-body").find(".t_com_rec").val();
	var npsf=Number(nr)-Number(np)-Number(p);
	$(g).closest(".modal-body").find(".t_psf").val(npsf);*/
	$(g).closest(".modal-body").find(".tprofit").val(Number(nprofit));
	if(nprofit>0){
		$(g).closest(".modal-body").find(".tprofit").closest(".form-group").find('label').text('Profit');
	}
	if(nprofit<0){
		$(g).closest(".modal-body").find(".tprofit").closest(".form-group").find('label').text('Loss');
	}
	ticket_currency_cal(g);
}
function t_disp(g)
{
	var ticket_bf=$(g).closest('.modal-body').find(".ticket_bf").val();
	var t_disp=$(g).closest('.modal-body').find(".t_disp").val();
	var ndis=Number(ticket_bf)*Number(t_disp)/100;
	$(g).closest('.modal-body').find(".t_dis").val(Number(ndis));
	ticket_cal(g);
	ticket_currency_cal(g);
}
function t_dis(g)
{
	var ticket_bf=$(g).closest('.modal-body').find(".ticket_bf").val();
	var t_dis=$(g).closest('.modal-body').find(".t_dis").val();
	var ndis=Number(t_dis)*100/ticket_bf;
	$(g).closest('.modal-body').find(".t_disp").val(Number(ndis).toFixed(2));
	ticket_cal(g);
	ticket_currency_cal(g);
}
//with holding client
function t_whcp(g)
{
	var tdis=$(g).closest('.modal-body').find(".t_dis").val();
	var t_whp=$(g).closest('.modal-body').find(".t_whcp").val();
	var nwh=Number(tdis)*Number(t_whp)/100;
	$(g).closest('.modal-body').find(".t_whc").val(Number(nwh));
	ticket_cal(g);
	ticket_currency_cal(g);
}
function t_whc(g)
{
	var tdis=$(g).closest('.modal-body').find(".t_dis").val();
	var t_wh=$(g).closest('.modal-body').find(".t_whc").val();
	var nwh=Number(t_wh)*100/Number(tdis);
	$(g).closest('.modal-body').find(".t_whcp").val(Number(nwh).toFixed(2));
	ticket_cal(g);
	ticket_currency_cal(g);
}
//============================================visa calcualtion===========================
function visa_cal(g)
{
	var nd=0;
	var visa_qty=$(g).closest('.modal-body').find(".visa_qty").val();
	var visa_rate=$(g).closest('.modal-body').find(".visa_rate").val();
	var netbf=Number(visa_qty)*Number(visa_rate);
	$(g).closest('.modal-body').find(".vbase_fare").val(netbf);
	var bf=$(g).closest('.modal-body').find(".vbase_fare").val();
	var pst_paid=$(g).closest('.modal-body').find(".vpst_paid").val();
	var dis=$(g).closest('.modal-body').find(".vdis").val();
	var pst=$(g).closest('.modal-body').find(".vpst").val();
	var f_agnt=$(g).closest('form').find(".f_agent_amount").val();
	var s_agnt=$(g).closest('form').find(".s_agent_amount").val();
	var psf=$(g).closest('form').find(".vpsf").val();
	//cancellation charges
	if($(g).closest(".modal-body").find('#c_charges_div').attr('style') == 'display: block;'){
		canc_charges=$(g).closest(".modal-body").find(".canc_charges").val();
		return_t = 'true';
	}
	else{
		canc_charges=0;
		return_t = 'false';
	}
	//service charges
	if($(g).closest(".modal-body").find('#c_charges_div').attr('style') == 'display: block;'){
		ser_charges=$(g).closest(".modal-body").find(".ser_charges").val();
	}
	else{
		ser_charges=0;
	}
	var nprofit=Number(psf)-Number(dis)-Number(f_agnt)-Number(s_agnt)-Number(ser_charges);
	if(return_t == 'true'){
		if(nprofit<0){
			$(g).closest(".modal-body").find(".vprofit").closest(".form-group").find('label').text('Profit');
		}
		else{
			$(g).closest(".modal-body").find(".vprofit").closest(".form-group").find('label').text('Loss');
		}
	}else{
		if(nprofit>0){
			$(g).closest(".modal-body").find(".vprofit").closest(".form-group").find('label').text('Profit');
		}
		else{
			$(g).closest(".modal-body").find(".vprofit").closest(".form-group").find('label').text('Loss');
		}
	}
	var np=Number(bf)+Number(pst)-Number(canc_charges);
	var nr=Number(bf)+Number(psf)+Number(pst)-Number(dis)-Number(canc_charges);
	$(g).closest('.modal-body').find(".vpayable").val(np);
	$(g).closest('.modal-body').find(".vreceiveable").val(nr);
	$(g).closest('.modal-body').find(".vprofit").val(Math.abs(nprofit));
	visa_currency_cal(g);
}
function visa_rec(g){
	var bf=$(g).closest(".modal-body").find(".vbase_fare").val();
	var f_agnt=$(g).closest(".modal-body").find(".f_agent_amount").val();
	var s_agnt=$(g).closest(".modal-body").find(".s_agent_amount").val();
	var pst_rec=$(".vpst").closest(".modal-body").val();
	var nr=Number(bf)+Number(f_agnt)+Number(s_agnt)+Number(pst_rec);
	manual_rec=$(g).closest(".modal-body").find(".vreceiveable").val();
	netPsf=Number(manual_rec)-Number(nr);
	if(netPsf>0){
		$(g).closest(".modal-body").find(".vpsf").val(netPsf);
	}
	else{
		$(g).closest(".modal-body").find(".vpsf").val(0);
	}
	if(netPsf<0){
		$(g).closest(".modal-body").find(".vdis").val(Math.abs(Number(netPsf)));
	}
	else{
		$(g).closest(".modal-body").find(".vdis").val(0);
	}
	$(g).closest(".modal-body").find(".vprofit").val(netPsf);
	if(netPsf>0){
		$(g).closest(".modal-body").find(".vprofit").closest(".form-group").find('label').text('Profit');
	}
	if(netPsf<0){
		$(g).closest(".modal-body").find(".vprofit").closest(".form-group").find('label').text('Loss');
	}
	visa_currency_cal(g);
}
function vdis(g)
{
	var bf=$(g).closest('.modal-body').find(".vbase_fare").val();
	var disp=$(g).closest('.modal-body').find(".vdisp").val();
	var ndis=Number(bf)*Number(disp)/100;
	$(g).closest('.modal-body').find(".vdis").val(ndis);
	visa_cal(g);
}
function vdisp(g)
{
	var bf=$(g).closest('.modal-body').find(".vbase_fare").val();
	var dis=$(g).closest('.modal-body').find(".vdis").val();
	var ndis=Number(dis)*Number(100)/Number(bf);
	$(g).closest('.modal-body').find(".vdisp").val(ndis.toFixed(2));
	visa_cal(g);
}
$('#ticket_passengers').multiselect();
$('#hotel_passengers').multiselect();
$('#visa_passengers').multiselect();
$('#transfer_passengers').multiselect();
$('#other_passengers').multiselect();
function get_visa_records(type, invId)
{
	$.ajax({
		url:"ajax_call/get_sale_invoices?type="+type+"&invId="+invId,
		dataType:"JSON",
		success: function(data)
		{
			var htmlData=""; j=1; var np=0; nr=0; tnp=0; tnr=0;
			for(i in data['rec']){
				if(data['rec'][i].refund=='yes'){ var bg="btn-danger";}
				else { var bg=""; }
				var np=Number(data['rec'][i].payable_amount);
				var nr=Number(data['rec'][i].receiveable_amount);
				htmlData+='<tr class="'+bg+'" id="v-'+data['rec'][i].id+'">';
					htmlData+='<td>'+j+'</td>';
					htmlData+='<td>'+data['rec'][i].passport+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_name+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_mobile+'</td>';
					htmlData+='<td>'+snf(np)+'</td>';
					htmlData+='<td>'+snf(nr)+'</td>';
					htmlData+='<td><button class="btn btn-info btn-mini waves-effect waves-light" onclick="edit_visa_record('+data['rec'][i].id+', \'visa\')"> <i class="fa fa-edit"></i></button>';
					if(data['rec'][i].refund=='yes'){
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_visa_refund('+data['rec'][i].id+', \'visa_ref\')"> <i class="fa fa-undo"></i> Ref</button>';
					}
					else{
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_visa_record('+data['rec'][i].id+', \'visa\', \'refund\')"> <i class="fa fa-undo"></i> Ref</button>';
					}
					 /*htmlData+=' <button type="button" class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'visa_rec\', \'v-'+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button></td>';*/
				htmlData+='</tr>';
				tnp +=Number(data['rec'][i].payable_amount);
				tnr +=Number(data['rec'][i].receiveable_amount);
				j++;
			}
			/*htmlData+='<tr>';
				htmlData+='<td colspan="4"></td>';
				htmlData+='<td><strong>'+number_format(tnp)+'</strong></td>';
				htmlData+='<td colspan="2"><strong>'+number_format(tnr)+'</strong></td>';
				htmlData+='<td></td>';
			htmlData+='</tr>';*/
			$(".get_visa_records").html(htmlData);
		},
		cache:false,
	});
}
function edit_visa_record(id, type, btn_type)
{
	$('.loader-bg').show();
	if(btn_type=='refund'){
		$("#visa-form .ref-rec").show();
		$("#visa-form .save-rec").hide();
		$("#visa-form .refEdit").css('background','rgb(255, 82, 82)');
		$('#visa-form .refText').css('color','#ff5252');
		$('#visa-form .vpayable').closest('.form-group').find('label').html('Rec from Vendor');
		$('#visa-form .vreceiveable').closest('.form-group').find('label').html('Pay to Customer');
		$("#visa-form input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
		$('#visa-form #c_charges_div, #s_charges_div').css('display','block');
	}
	else{
		$("#visa-form .ref-rec").hide();
		$("#visa-form .save-rec").html('<i class="fa fa-save"> Update</i>').show();
		$("#visa-form .refEdit").css('background','rgb(26, 168, 157)');
		$('#visa-form .refText').css('color','rgb(26, 168, 157)');
		$('#visa-form .vpayable').closest('.form-group').find('label').html('Payable');
		$('#visa-form .vreceiveable').closest('.form-group').find('label').html('Receiveable');
		$("#visa-form input[name~='inv_date']").closest('.form-group').find('label').text('Invoice Date');
		$("#visa-form input[name~='profit']").closest('.form-group').find('label').text('Profit');
		$('#visa-form #c_charges_div, #s_charges_div').css('display','none');
		$("#visa-form .save-rec").html('<i class="fa fa-save"></i> Update').show();
	}
	if(btn_type=='record_edit'){
		$("#visa-modal").modal();
		$("#visa-table").remove();
		$("#visa-form .new-rec").hide();
	}
	$.ajax({
		url:"ajax_call/edit_sale_invoice?type="+type+"&id="+id,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#visa-modal").find(".modal-title").text('VISA DETAILS ('+data.vi.inv_id+')');
			$("#visa-form input[name~='inv_id']").val(data.vi.inv_id);
			$("#visa-form input[name~='inv_date']").val(data.si.inv_date);
			$("#visa-form input[name~='due_date']").val(data.si.due_date);
			$("#visa-form select[name~='branch_id']").val(data.si.branch_id);
			$("#visa-form select[name~='client_id']").val(data.si.client_id);
			$("#visa-form select[name~='payment_term']").val(data.si.payment_term);
			$("#visa-form select[name~='empl_id']").val(data.si.empl_id);
			$("#visa-form input[name~='remarks']").val(data.si.remarks);
			//visa invoice details
			$("#visa-form input[name~='id']").val(data.vi.id);
			$("#visa-form input[name~='passport']").val(data.vi.passport);
			$("#visa-form input[name~='pass_name']").val(data.vi.pass_name);
			$("#visa-form input[name~='pass_mobile']").val(data.vi.pass_mobile);
			$("#visa-form select[name~='pass_type']").val(data.vi.pass_type);
			$("#visa-form input[name~='dob']").val(data.vi.dob);
			$("#visa-form select[name~='visa_type']").val(data.vi.visa_type);
			$("#visa-form input[name~='visa_no']").val(data.vi.visa_no);
			$("#visa-form select[name~='country_id']").val(data.vi.visa_country);
			$("#visa-form input[name~='documents']").val(data.vi.documents);
			$("#visa-form input[name~='online_date']").val(data.vi.online_date);
			$("#visa-form input[name~='qty']").val(data.vi.qty);
			$("#visa-form input[name~='rate']").val(data.vi.rate);
			$("#visa-form input[name~='basic_fare']").val(data.vi.basic_fare);
			$("#visa-form input[name~='pst_paid']").val(data.vi.pst_paid);
			$("#visa-form select[name~='vendor_id']").val(data.vi.vendor_id);
			$("#visa-form input[name~='particulars']").val(data.vi.particulars);
			$("#visa-form input[name~='f_agent_amount']").val(data.vi.f_agent_amount);
			$("#visa-form select[name~='f_agent_id']").val(data.vi.f_agent_id);
			$("#visa-form input[name~='s_agent_name']").val(data.vi.s_agent_name);
			$("#visa-form select[name~='s_agent_id']").val(data.vi.s_agent_id);
			$("#visa-form input[name~='psf']").val(data.vi.psf);
			$("#visa-form input[name~='discountp']").val(data.vi.discountp);
			$("#visa-form input[name~='discount']").val(data.vi.discount);
			$("#visa-form input[name~='pst_rec']").val(data.vi.pst_rec);
			$("#visa-form input[name~='payable_amount']").val(data.vi.payable_amount);
			$("#visa-form input[name~='receiveable_amount']").val(data.vi.receiveable_amount);
			$("#visa-form input[name~='profit']").val(data.vi.profit);
			$("#visa-form select[name~='cur_type']").val(data.vi.cur_type);
			$("#visa-form input[name~='cur_rate']").val(data.vi.cur_rate);
			var np=Number(data.vi.payable_amount)/Number(data.vi.cur_rate);
			var nr=Number(data.vi.receiveable_amount)/Number(data.vi.cur_rate);
			var npro=Number(data.vi.profit)/Number(data.vi.cur_rate);
			$("#visa-form input[name~='cur_p']").val(np.toFixed(2));
			$("#visa-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#visa-form input[name~='cur_profit']").val(npro.toFixed(2));
			if(data.vi.refund=="yes"){
			$("#visa-form #refundDiv").html('<a href="../invoice/credit-note?refId='+data.vi.refId+'" target="_blank" class="btn btn-sm btn-danger form-control">Refunded #'+data.vi.refId+'</i></a>').show();
			}
			$(".js-example-basic-single").select2();
			$('.loader-bg').hide();
		}
	});
}
//fetch visa pos invoices===============================================
function fetch_visa_sale_invoices()
{
	$('.loader-bg').show();
	$.ajax({
		url:"fetch_sale_invoices/get_sale_invoices?type=visa",
		data:$("#search-visa-form").serialize(),
		type:"POST",
		dataType:"JSON",
		success: function(data)
		{
			var htmlData="";
			for(i in data['rec']){
				htmlData+='<tr>';
					htmlData+='<td>'+(Number(i)+1)+'</td>';
					htmlData+='<td>'+data['rec'][i].invId+'</td>';
					htmlData+='<td>'+data['rec'][i].inv_date+'</td>';
					htmlData+='<td>'+data['rec'][i].Client_name+'</td>';
					htmlData+='<td>'+(data['rec'][i].payable_amount)+'</td>';
					htmlData+='<td>'+data['rec'][i].receiveable_amount+'</td>';
					htmlData+='<td>'+data['rec'][i].dis+'</td>';
					htmlData+='<td>'+data['rec'][i].profit+'</td>';	
				    htmlData+='<td>';
					htmlData+='<button type="button" class="btn btn-info btn-mini waves-effect waves-light" onclick="visaSale('+data['rec'][i].invId+')"> <i class="fa fa-edit"></i></button>';
				    htmlData+=' <button type="button" class="btn btn-default btn-mini waves-effect waves-light" onclick="visa_print_format('+data['rec'][i].invId+')"> <i class="fa fa-print"></i></button>';
					/*htmlData+='<button class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'hotel\', \'h-'+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button></td>';*/
				htmlData+='</td><tr>';	
			}
			$(".fetch_visa_sale_invoices").html(htmlData);
			$('.loader-bg').hide();
		}
	});
}
//=================================Transfer details......................
function transfer_cal(g)
{
	var bf=$(g).closest('.modal-body').find(".tr_bf").val();
	var psf=$(g).closest('.modal-body').find(".tr_psf").val();
	var pst=$(g).closest('.modal-body').find(".tr_pst").val();
	//var sr_ch=$(g).closest('.modal-body').find(".tr_ser_char").val();
	var dis=$(g).closest('.modal-body').find(".tr_dis").val();
	var f_agnt=$(g).closest('form').find(".f_agent_amount").val();
	var s_agnt=$(g).closest('form').find(".s_agent_amount").val();
	//cancellation charges
	if($(g).closest("form").find('#c_charges_div').attr('style') == 'display: block;'){
		canc_charges=$(g).closest("form").find(".canc_charges").val();
	}
	else{
		canc_charges=0;
	}
	//service charges
	var tr_return='';
	if($(g).closest("form").find('#s_charges_div').attr('style') == 'display: block;'){
		ser_charges=$(g).closest("form").find(".ser_charges").val();
		tr_return='true';
	}
	else{
		ser_charges=0;
		tr_return='false';
	}
	var np=Number(bf)-Number(canc_charges);
	var npsf=Number(psf)-Number(dis)-Number(f_agnt)-Number(s_agnt)-Number(ser_charges);
	var nr=Number(bf)+Number(psf)+Number(pst)-Number(dis)-Number(canc_charges)-Number(ser_charges);
	if(tr_return=='true'){
		if(npsf<0){
				$(g).closest("form").find(".tr_profit").closest(".form-group").find('label').text('Profit');
			}
			else{
				$(g).closest("form").find(".tr_profit").closest(".form-group").find('label').text('Loss');
			}
	}
	else
	{
		if(npsf>0){
				$(g).closest("form").find(".tr_profit").closest(".form-group").find('label').text('Profit');
			}
			else{
				$(g).closest("form").find(".tr_profit").closest(".form-group").find('label').text('Loss');
			}
	}
	$(g).closest('.modal-body').find(".tr_np").val(np)
	$(g).closest('.modal-body').find(".tr_nr").val(nr);
	$(g).closest('.modal-body').find(".tr_profit").val(Number(Math.abs(npsf)));
	transfer_currency_cal(g);
}
function transfer_rec(g){
	var bf=$(g).closest(".modal-body").find(".tr_bf").val();
	var f_agnt=$(g).closest(".modal-body").find(".f_agent_amount").val();
	var s_agnt=$(g).closest(".modal-body").find(".s_agent_amount").val();
	var pst_rec=$(g).closest(".modal-body").find(".tr_pst").val();
	var nr=Number(bf)+Number(f_agnt)+Number(s_agnt)+Number(pst_rec);
	manual_rec=$(g).closest(".modal-body").find(".tr_nr").val();
	var netPsf=Number(manual_rec)-Number(nr);
	if(netPsf>0){
		$(g).closest(".modal-body").find(".tr_psf").val(netPsf);
	}
	else{
		$(g).closest(".modal-body").find(".tr_psf").val(0);
	}
	if(netPsf<0){
		$(g).closest(".modal-body").find(".tr_dis").val(Math.abs(Number(netPsf)));
	}
	else{
		$(g).closest(".modal-body").find(".tr_dis").val(0);
	}
	if(netPsf>0){
		$(g).closest(".modal-body").find(".tr_profit").closest(".form-group").find('label').text('Profit');
	}
	if(netPsf<0){
		$(g).closest(".modal-body").find(".tr_profit").closest(".form-group").find('label').text('Loss');
	}
	$(g).closest(".modal-body").find(".tr_profit").val(netPsf);
	transfer_currency_cal(g);
	
}
// calculation of discount percentage
function tr_disp(g)
{
	var bf=$(g).closest('.modal-body').find(".tr_bf").val();
	var disp=$(g).closest('.modal-body').find(".tr_disp").val();
	var nd=Number(bf)*Number(disp)/100;
	$(g).closest('.modal-body').find(".tr_dis").val(nd);
	transfer_cal(g);
}
function tr_dis(g)
{
	var bf=$(g).closest('.modal-body').find(".tr_bf").val();
	var dis=$(g).closest('.modal-body').find(".tr_dis").val();
	var nd=Number(dis)*Number(100)/Number(bf);
	$(g).closest('.modal-body').find(".tr_disp").val(nd.toFixed(2));
	transfer_cal(g);
}
function get_transfer_records(type, invId)
{
	$.ajax({
		url:"ajax_call/get_sale_invoices?type="+type+"&invId="+invId,
		dataType:"JSON",
		success: function(data)
		{
			var htmlData=""; j=1; var np=0; nr=0;
			for(i in data['rec'])
			{
				if(data['rec'][i].refund=='yes'){ var bg="btn-danger";}
				else { var bg=""; }
				htmlData+='<tr class="'+bg+'" id="tr-'+data['rec'][i].id+'">';
					htmlData+='<td>'+j+'</td>';
					htmlData+='<td>'+data['rec'][i].passport+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_name+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_mobile+'</td>';
					htmlData+='<td>'+snf(data['rec'][i].payable_amount)+'</td>';
					htmlData+='<td>'+snf(data['rec'][i].receiveable_amount)+'</td>';
					htmlData+='<td><button class="btn btn-info btn-mini waves-effect waves-light" onclick="edit_transfer_rec('+data['rec'][i].id+', \'transfer\')"> <i class="fa fa-edit"></i></button>';
					if(data['rec'][i].refund=='yes'){
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_transfer_refund('+data['rec'][i].id+', \'transfer_ref\')"> <i class="fa fa-undo"></i> Ref</button>';
					}
					else{
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_transfer_rec('+data['rec'][i].id+', \'transfer\', \'refund\')"> <i class="fa fa-undo"></i> Ref</button>';
					}
					 /*htmlData+=' <button class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'transfer_rec\', \'tr-'+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button></td>';*/
				htmlData+='</tr>';
				np +=Number(data['rec'][i].payable_amount);
				nr +=Number(data['rec'][i].receiveable_amount);
				j++;
			}
				/*htmlData+='<tr>';
					htmlData+='<td colspan="4"></td>';
					htmlData+='<td><strong>'+number_format(np)+'</strong></td>';
					htmlData+='<td colspan="2"><strong>'+number_format(nr)+'</strong></td>';
					htmlData+='<td></td>';
				htmlData+='</tr>';*/
				$(".get_transfer_records").html(htmlData);
		}
	});
}
// edit transfer details...........
function edit_transfer_rec(id, type, btn_type)
{
	$('.loader-bg').show();
	if(btn_type=='refund'){
		$("#transfer-form .ref-rec").show();
		$("#transfer-form .save-rec").hide();
		$("#transfer-form .refEdit").css('background','rgb(255, 82, 82)');
		$('#transfer-form .refText').css('color','#ff5252');
		$('#transfer-form .tr_np').closest('.form-group').find('label').html('Rec from Vendor');
		$('#transfer-form .tr_nr').closest('.form-group').find('label').html('Pay to Customer');
		$("#transfer-form input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
		$('#transfer-form #c_charges_div, #s_charges_div').css('display','block');
	}
	else{
		$("#transfer-form .ref-rec").hide();
		$("#transfer-form .save-rec").html('<i class="fa fa-save"> Update</i>').show();
		$("#transfer-form .refEdit").css('background','rgb(26, 168, 157)');
		$('#transfer-form .refText').css('color','rgb(26, 168, 157)');
		$('#transfer-form .tr_np').closest('.form-group').find('label').html('Payable');
		$('#transfer-form .tr_nr').closest('.form-group').find('label').html('Receiveable');
		$("#transfer-form input[name~='inv_date']").closest('.form-group').find('label').text('Invoice Date');
		$('#transfer-form #c_charges_div, #s_charges_div').css('display','none');
	}
	if(btn_type=='record_edit'){
		$("#transfer-modal").modal();
		$("#transfer-table").remove();
		$("#transfer-form .new-rec").hide();
	}
	$.ajax({
		url:"ajax_call/edit_sale_invoice?type="+type+"&id="+id,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#transfer-modal").find(".modal-title").text('TRANSFER DETAILS ('+data.vi.inv_id+')');
			$("#transfer-form input[name~='inv_id']").val(data.vi.inv_id);
			$("#transfer-form input[name~='inv_date']").val(data.si.inv_date);
			$("#transfer-form input[name~='due_date']").val(data.si.due_date);
			$("#transfer-form select[name~='branch_id']").val(data.si.branch_id);
			$("#transfer-form select[name~='client_id']").val(data.si.client_id);
			$("#transfer-form select[name~='payment_term']").val(data.si.payment_term);
			$("#transfer-form select[name~='empl_id']").val(data.si.empl_id);
			$("#transfer-form input[name~='remarks']").val(data.si.remarks);
			//transfer details............
			$("#transfer-form input[name~='id']").val(data.vi.id);
			$("#transfer-form input[name~='passport']").val(data.vi.passport);
			$("#transfer-form input[name~='pass_name']").val(data.vi.pass_name);
			$("#transfer-form input[name~='pass_mobile']").val(data.vi.pass_mobile);
			$("#transfer-form select[name~='pass_type']").val(data.vi.pass_type);
			$("#transfer-form input[name~='dob']").val(data.vi.dob);
			$("#transfer-form input[name~='group_no']").val(data.vi.group_no);
			$("#transfer-form input[name~='ref_no']").val(data.vi.ref_no);
			$("#transfer-form input[name~='vehicle_type']").val(data.vi.vehicle_type);
			$("#transfer-form input[name~='from_date']").val(data.vi.from_date);
			$("#transfer-form input[name~='to_date']").val(data.vi.to_date);
			/*$("#transfer-form input[name~='qty']").val(data.vi.qty);*/
			$("#transfer-form input[name~='rate']").val(data.vi.rate);
			$("#transfer-form input[name~='basic_fare']").val(data.vi.basic_fare);
			$("#transfer-form select[name~='vendor_id']").val(data.vi.vendor_id);
			$("#transfer-form input[name~='particulars']").val(data.vi.particulars);
			$("#transfer-form input[name~='f_agent_amount']").val(data.vi.f_agent_amount);
			$("#transfer-form select[name~='f_agent_id']").val(data.vi.f_agent_id);
			$("#transfer-form input[name~='s_agent_name']").val(data.vi.s_agent_name);
			$("#transfer-form select[name~='s_agent_id']").val(data.vi.s_agent_id);
			$("#transfer-form input[name~='psf']").val(data.vi.psf);
			$("#transfer-form input[name~='discountp']").val(data.vi.discountp);
			$("#transfer-form input[name~='discount']").val(data.vi.discount);
			$("#transfer-form input[name~='pst_rec']").val(data.vi.pst_rec);
			$("#transfer-form input[name~='payable_amount']").val(data.vi.payable_amount);
			$("#transfer-form input[name~='receiveable_amount']").val(data.vi.receiveable_amount);
			$("#transfer-form input[name~='profit']").val(data.vi.profit);
			$("#transfer-form select[name~='cur_type']").val(data.vi.cur_type);
			$("#transfer-form input[name~='cur_rate']").val(data.vi.cur_rate);
			var np=Number(data.vi.payable_amount)/Number(data.vi.cur_rate);
			var nr=Number(data.vi.receiveable_amount)/Number(data.vi.cur_rate);
			var npro=Number(data.vi.profit)/Number(data.vi.cur_rate);
			$("#transfer-form input[name~='cur_p']").val(np.toFixed(2));
			$("#transfer-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#transfer-form input[name~='cur_profit']").val(npro.toFixed(2));
			if(data.vi.refund=='yes')
			{
				$("#transfer-form #refundDiv").html('<a href="../invoice/transfer_credit_note?refId='+data.vi.refId+'" class="btn btn-sm btn-danger form-control" target="_blank">Refunded #'+data.vi.refId+'</i></a>').show();
			}
			else{
				$("#hotel-form #refundDiv").hide();
			}
			$(".js-example-basic-single").select2();
			$('.loader-bg').hide();
		}
	});
}
//other invoices........
function other_cal(g)
{
	var bf=$(g).closest('.modal-body').find(".obf").val();
	var psf=$(g).closest('.modal-body').find(".opsf").val();
	var dis=$(g).closest('.modal-body').find(".odis").val();
	var os=$(g).closest('.modal-body').find(".oos").val();
	var f_agnt=$(g).closest("form").find(".f_agent_amount").val();
	var s_agnt=$(g).closest("form").find(".s_agent_amount").val();
	var np=Number(bf);
	var nr=Number(bf)+Number(psf)+Number(os)-Number(dis);
	var npsf=Number(psf)-Number(dis)-Number(f_agnt)-Number(s_agnt);
	$(g).closest('form').find(".opayable").val(np);
	$(g).closest('form').find(".oreceiveable").val(nr);
	if(npsf=>0){
			$(g).closest("form").find(".oprofit").closest(".form-group").find('label').text('Profit');
		}
		else{
			$(g).closest("form").find(".oprofit").closest(".form-group").find('label').text('Loss');
		}
		$(g).closest('form').find(".oprofit").val(Math.abs(npsf));
		other_currency_cal(g);
}
//calculate other psf on change receivable amount
function other_psf(g){
	thisVal=$(g).val();
	var f_agnt=$(g).closest("form").find(".f_agent_amount").val();
	var s_agnt=$(g).closest("form").find(".s_agent_amount").val();
	var dis=$(g).closest('.modal-body').find(".odis").val();
	var pb=$(g).closest('form').find(".opayable").val();
	npsf=Number(thisVal)-Number(pb)-Number(f_agnt)-Number(s_agnt)-Number(dis);
	if(npsf>=0){
			$(g).closest("form").find(".oprofit").closest(".form-group").find('label').text('Profit');
	}
	else{
			$(g).closest("form").find(".oprofit").closest(".form-group").find('label').text('Loss');
	}
	$(g).closest('.modal-body').find(".opsf").val(npsf);
	$(g).closest('form').find(".oprofit").val(Math.abs(npsf));
	
}
function other_disp(g)
{
	var bf=$(g).closest('.modal-body').find(".obf").val();
	var dis=Number(bf)*Number($(g).val())/100;
	$(g).closest('.modal-body').find(".odis").val(dis);
	other_cal(g);
}
function other_dis(g)
{
	var bf=$(g).closest('.modal-body').find(".obf").val();
	var dis=Number($(g).val())*Number(100)/Number(bf);
	$(g).closest('form').find(".odisp").val(dis.toFixed(2));
	other_cal(g);
}
function fetch_transfer_sale_invoices(){
	$('.loader-bg').show();
	$.ajax({
		url:"fetch_sale_invoices/get_sale_invoices?type=transfer",
		type:"POST",
		data:$("#search-transfer-form").serialize(),
		dataType:"JSON",
		success: function(data)
		{
			var htmlData="";
			for(i in data['rec']){
				htmlData+='<tr>';
					htmlData+='<td>'+(Number(i)+1)+'</td>';
					htmlData+='<td>'+data['rec'][i].invId+'</td>';
					htmlData+='<td>'+data['rec'][i].inv_date+'</td>';
					htmlData+='<td>'+data['rec'][i].Client_name+'</td>';
					htmlData+='<td>'+(data['rec'][i].payable_amount)+'</td>';
					htmlData+='<td>'+data['rec'][i].receiveable_amount+'</td>';
					htmlData+='<td>'+data['rec'][i].dis+'</td>';
					htmlData+='<td>'+data['rec'][i].profit+'</td>';	
				    htmlData+='<td>';
					htmlData+='<button type="button" class="btn btn-info btn-mini waves-effect waves-light" onclick="transferSale('+data['rec'][i].invId+')"> <i class="fa fa-edit"></i></button>';
				    htmlData+=' <button type="button" class="btn btn-default btn-mini waves-effect waves-light" onclick="transfer_print_format('+data['rec'][i].invId+')"> <i class="fa fa-print"></i></button>';
					 /*htmlData+='<button class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'hotel\', \'h-'+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button></td>';*/
				htmlData+='</td><tr>';	
			}
			$(".fetch_transfer_sale_invoices").html(htmlData);
			$('.loader-bg').hide();
		}
	});
}
function fetch_tour_sale_invoices(type)
{
	$('.loader-bg').show();
	$.ajax({
		url:"fetch_sale_invoices/get_sale_invoices?type=tour",
		dataType:"JSON",
		data:$("#tour-fetch-form").serialize(),
		type:"POST",
		success: function(data)
		{
			var htmlData="";
			var j=1;
			for(i in data['rec']){
				htmlData+='<tr>';
					htmlData+='<td>'+(Number(i)+1)+'</td>';
					htmlData+='<td>'+data['rec'][i].invId+'</td>';
					htmlData+='<td>'+data['rec'][i].inv_date+'</td>';
					htmlData+='<td>'+data['rec'][i].Client_name+'</td>';
					htmlData+='<td>'+(data['rec'][i].payable_amount)+'</td>';
					htmlData+='<td>'+data['rec'][i].receiveable_amount+'</td>';
					htmlData+='<td>'+data['rec'][i].dis+'</td>';
					htmlData+='<td>'+data['rec'][i].profit+'</td>';	
				    htmlData+='<td>';
					htmlData+='<button type="button" class="btn btn-info btn-mini waves-effect waves-light" onclick="tourSale('+data['rec'][i].invId+')"> <i class="fa fa-edit"></i></button>';
				    htmlData+=' <button type="button" class="btn btn-default btn-mini waves-effect waves-light" onclick="tour_print_format('+data['rec'][i].invId+')"> <i class="fa fa-print"></i></button>';
					 /*htmlData+=' <button class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'hotel\', \'h-'+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button></td>';*/
				htmlData+='</td><tr>';	
			}
			$(".fetch_tour_sale_invoices").html(htmlData);
			$('.loader-bg').hide();
		}
	});
}
//other sales
function get_other_records(type, invId)
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
				if(data['rec'][i].refund=='yes'){ var bg="btn-danger";}
				else { var bg=""; }
				htmlData+='<tr class="'+bg+'" id="o-'+data['rec'][i].id+'">';
					htmlData+='<td>'+j+'</td>';
					htmlData+='<td>'+data['rec'][i].passport+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_name+'</td>';
					htmlData+='<td>'+data['rec'][i].pass_mobile+'</td>';
					htmlData+='<td>'+snf(Number(data['rec'][i].payable_amount))+'</td>';
					htmlData+='<td>'+snf(Number(data['rec'][i].receivable_amount))+'</td>';
					htmlData+='<td><button class="btn btn-info btn-mini waves-effect waves-light" onclick="edit_other_record('+data['rec'][i].id+', \'other\')"> <i class="fa fa-edit"></i></button>';
					if(data['rec'][i].refund=='yes')
					{
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_other_refund('+data['rec'][i].id+', \'other_ref\', \'refund\')"> <i class="fa fa-undo"></i> Ref</button>';
					}
					else
					{
					htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_other_record('+data['rec'][i].id+', \'other\', \'refund\')"> <i class="fa fa-undo"></i> Ref</button>';
					}
					 /*htmlData+=' <button class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'other\', \'o-'+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button></td>';*/
				htmlData+='</tr>';
				np +=Number(data['rec'][i].payable_amount);
				nr +=Number(data['rec'][i].receivable_amount);
				j++;
			}
				/*htmlData+='<tr>';
					htmlData+='<td colspan="4"></td>';
					htmlData+='<td><strong>'+number_format(np)+'</strong></td>';
					htmlData+='<td colspan="1"><strong>'+number_format(nr)+'</strong></td>';
					htmlData+='<td></td>';
				htmlData+='</tr>';*/
				$(".get_other_records").html(htmlData);
			$('.loader-bg').hide();
		}
	});
}
function edit_other_record(id, type, btn_type)
{
	if(btn_type=='refund'){
		$("#other-form .ref-rec").show();
		$("#other-form .save-rec").hide();
		$("#other-form .refEdit").css('background','rgb(255, 82, 82)');
		$('#other-form .refText').css('color','#ff5252');
		$('#other-form .opayable').closest('.form-group').find('label').html('Rec from Vendor');
		$('#other-form .oreceiveable').closest('.form-group').find('label').html('Pay to Customer');
		$("#other-form input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
		$("#other-form .oprofit").closest('.form-group').find('label').text('Loss');
		$('#other-form #c_charges_div, #s_charges_div').css('display','block');
	}
	else{
		$("#other-form .ref-rec").hide();
		$("#other-form .save-rec").html('<i class="fa fa-save"> Update</i>').show();
		$("#other-form .refEdit").css('background','rgb(26, 168, 157)');
		$('#other-form .refText').css('color','rgb(26, 168, 157)');
		$('#other-form .opayable').closest('.form-group').find('label').html('Payable');
		$('#other-form .oreceiveable').closest('.form-group').find('label').html('Receiveable');
		$("#other-form input[name~='inv_date']").closest('.form-group').find('label').text('Invoice Date');
		$("#other-form .oprofit").closest('.form-group').find('label').text('Profit');
		$('#other-form #c_charges_div, #s_charges_div').css('display','none');
	}
	if(btn_type=='record_edit'){
		$('#other-modal').modal();
		$("#other-table").remove();
		$("#other-form .new-rec").hide();
	}
	$.ajax({
		url:"ajax_call/edit_sale_invoice?type="+type+"&id="+id,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#other-modal").find(".modal-title").text('OTHER DETAILS ('+data.vi.inv_id+')');
			$("#other-form input[name~='inv_id']").val(data.vi.inv_id);
			$("#other-form input[name~='inv_date']").val(data.si.inv_date);
			$("#other-form input[name~='due_date']").val(data.si.due_date);
			$("#other-form select[name~='branch_id']").val(data.si.branch_id);
			$("#other-form select[name~='client_id']").val(data.si.client_id);
			$("#other-form select[name~='payment_term']").val(data.si.payment_term);
			$("#other-form select[name~='empl_id']").val(data.si.empl_id);
			$("#other-form input[name~='remarks']").val(data.si.remarks);
			//other details
			$("#other-form input[name~='id']").val(data.vi.id);
			$("#other-form input[name~='passport']").val(data.vi.passport);
			$("#other-form input[name~='pass_name']").val(data.vi.pass_name);
			$("#other-form slect[name~='pass_type']").val(data.vi.pass_type);
			$("#other-form slect[name~='pass_mobile']").val(data.vi.pass_mobile);
			$("#other-form slect[name~='dob']").val(data.vi.dob);
			$("#other-form input[name~='group_no']").val(data.vi.group_no);
			$("#other-form input[name~='pkg_details']").val(data.vi.pkg_details);
			$("#other-form input[name~='rate']").val(data.vi.rate);
			$("#other-form select[name~='vendor_id']").val(data.vi.vendor_id);
			$("#other-form input[name~='basic_fare']").val(data.vi.basic_fare);
			$("#other-form input[name~='f_agent_amount']").val(data.vi.f_agent_amount);
			$("#other-form select[name~='f_agent_id']").val(data.vi.f_agent_id);
			$("#other-form input[name~='s_agent_amount']").val(data.vi.s_agent_amount);
			$("#other-form select[name~='s_agent_id']").val(data.vi.s_agent_id);
			$("#other-form input[name~='psf']").val(data.vi.psf);
			$("#other-form input[name~='discountp']").val(data.vi.discountp);
			$("#other-form input[name~='discount']").val(data.vi.discount);
			$("#other-form input[name~='other_services']").val(data.vi.other_services);
			$("#other-form input[name~='payable_amount']").val(data.vi.payable_amount);
			$("#other-form input[name~='receivable_amount']").val(data.vi.receivable_amount);
			$("#other-form input[name~='profit']").val(data.vi.profit);
			$("#other-form select[name~='cur_type']").val(data.vi.cur_type);
			$("#other-form input[name~='cur_rate']").val(data.vi.cur_rate);
			var np=Number(data.vi.payable_amount)/Number(data.vi.cur_rate);
			var nr=Number(data.vi.receivable_amount)/Number(data.vi.cur_rate);
			var npro=Number(data.vi.profit)/Number(data.vi.cur_rate);
			$("#other-form input[name~='cur_p']").val(np.toFixed(2));
			$("#other-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#other-form input[name~='cur_profit']").val(npro.toFixed(2));
			if(data.vi.refund=='yes'){
			$("#other-form #refundDiv").html('<a href="../invoice/transfer_credit_note?refId='+data.vi.refId+'" class="btn btn-sm btn-danger form-control" target="_blank">Refunded #'+data.vi.refId+'</i></a>').show();
			}
			else{
				$("#other-form #refundDiv").hide();
			}
			$(".js-example-basic-single").select2();
		}
		});
}
function fetch_other_sale_invoices(type)
{
	$('.loader-bg').show();
	$.ajax({
		url:"fetch_sale_invoices/get_sale_invoices?type=other",
		type:"POST",
		data:$("#search-other-form").serialize(),
		dataType:"JSON",
		success: function(data)
		{
			var htmlData="";
			for(i in data['rec']){
				htmlData+='<tr>';
					htmlData+='<td>'+(Number(i)+1)+'</td>';
					htmlData+='<td>'+data['rec'][i].invId+'</td>';
					htmlData+='<td>'+data['rec'][i].inv_date+'</td>';
					htmlData+='<td>'+data['rec'][i].Client_name+'</td>';
					htmlData+='<td>'+(data['rec'][i].payable_amount)+'</td>';
					htmlData+='<td>'+data['rec'][i].receiveable_amount+'</td>';
					htmlData+='<td>'+data['rec'][i].dis+'</td>';
					htmlData+='<td>'+data['rec'][i].profit+'</td>';
				    htmlData+='<td>';
					htmlData+='<button type="button" class="btn btn-info btn-mini waves-effect waves-light" onclick="otherSale('+data['rec'][i].invId+')"> <i class="fa fa-edit"></i></button>';
				    htmlData+=' <button type="button" class="btn btn-default btn-mini waves-effect waves-light" onclick="other_print_format('+data['rec'][i].invId+')"> <i class="fa fa-print"></i></button>';
					 /*htmlData+=' <button class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'hotel\', \'h-'+data['rec'][i].id+'\')"><i class="fa fa-trash"></i></button></td>';*/
				htmlData+='</td><tr>';	
			}
			$(".fetch_other_sale_invoices").html(htmlData);
		}
	}).done(function(){ $('.loader-bg').hide(); });
}
//======================================Refund Details===========================
function save_refund(type, formData)
{
	$('.loader-bg').show();
	var inv_date=$("#tour-modal input[name~='inv_date']").val();
	var client_id=$("#tour-modal select[name~='client_id']").val();
	$.ajax({
		url:"ajax_call/save_refund?type="+type,
		data:$("#"+formData).serializeArray(),
		type:"POST",
		dataType:"JSON",
		success: function(data)
		{
			var invId=$("#"+formData+" input[name~='inv_id']").val();
			$("#"+formData+" input[name~='refId']").val('0');
			if(type=='ticket'){
				get_ticket_records('ticket', invId);
				var invId=$("#ticket-form input[name~='id']").val('0');
				$("#ticket-form #refundDiv").html('<a href="../invoice/credit-note?refId='+data.refId+'" target="_blank" class="btn btn-sm btn-danger form-control">Refunded #'+data.refId+'</i></a>').show();
			}
			else if(type=='hotel'){
				get_hotel_invoices('hotel', invId);
				var invId=$("#hotel-form input[name~='id']").val('0');
				$("#hotel-form #refundDiv").html('<a href="../invoice/hotel_credit-note?refId='+data.refId+'" class="btn btn-sm btn-danger form-control" target="_blank">Refunded #'+data.refId+'</i></a>').show();
			}
			else if(type=='visa'){
				get_visa_records('visa', invId);
				var invId=$("#visa-form input[name~='id']").val('0');
				$("#transfer-form #refundDiv").html('<a href="../invoice/transfer_credit_note?refId='+data.refId+'" class="btn btn-sm btn-danger form-control" target="_blank">Refunded #'+data.refId+'</i></a>').show();
			}
			else if(type=='transfer'){
				get_transfer_records('transfer', invId);
				var invId=$("#transfer-form input[name~='id']").val('0');
				$("#transfer-form #refundDiv").html('<a href="../invoice/transfer_credit_note?refId='+data.refId+'" class="btn btn-sm btn-danger form-control" target="_blank">Refunded #'+data.refId+'</i></a>').show();
			}
			setTimeout(
			  function(){
				$("#"+formData+" .ref-rec").hide();
				$('#c_charges_div, #s_charges_div').css('display','none');
				$('.refEdit').css('background','#1aa89d');
				$('.refText').css('color','#1aa89d');
				$('.loader-bg').hide();
				toastr.success('Operation successfull.');
			  }, 1000);
		}
	});
}
function edit_ticket_ref_record(id, type, btn_type){
	$('.loader-bg').show();
	if(btn_type=='refund'){
		$('#ticket-form #c_charges_div, #s_charges_div, .void-rec').css('display','block');
		$('.refEdit').css('background','#ff5252');
		$('.refEdit').addClass('refunding');
		$('.refText').css('color','#ff5252');
		$("#ticket-form .save-rec").hide();
		$("#ticket-form .ref-rec").show();
		$("#ticket-form .void-rec").hide();
		$('.t_payable').closest('.form-group').find('label').html('Rec from Vendor');
		$('.t_receiveable').closest('.form-group').find('label').html('Pay to Customer');		$("#ticket-form input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
		$('.tprofit').closest('.form-group').find('label').html('Loss');
		$("#ticket-modal").modal({ backdrop:'static' });
		$(".refEdit").addClass('refunding');
	}
	$.ajax({
		url:"ajax_call/edit_sale_invoice?id="+id+"&type="+type,
		dataType:"JSON",
		success: function(data)
		{
			$("#ticket-form .save-rec").html('<i class="fa fa-save"></i> Update');
			//pos inovice dtails
			$("#ticket-form input[name~='inv_date']").val(data.inv.refund.refund_date);
			$("#ticket-form input[name~='due_date']").val(data.inv.si.due_date);
			$("#ticket-form select[name~='branch_id']").val(data.inv.si.branch_id);
			$("#ticket-form select[name~='client_id']").val(data.inv.si.client_id);
			$("#ticket-form select[name~='payment_term']").val(data.inv.si.payment_term);
			$("#ticket-form select[name~='empl_id']").val(data.inv.si.empl_id);
			$("#ticket-form name[name~='remarks']").val(data.inv.si.remarks);
			// ticket details
			$("#ticket-form input[name~='id']").val(data.inv.det.id);
			$("#ticket-form input[name~='passport']").val(data.inv.det.passport);
			$("#ticket-form input[name~='name']").val(data.inv.det.pass_name);
			$("#ticket-form input[name~='pass_mobile']").val(data.inv.det.pass_mobile);
			$("#ticket-form select[name~='pass_type']").val(data.inv.det.pass_type);
			$("#ticket-form select[name~='vendor_id']").val(data.inv.det.vendor_id);
			$("#ticket-form input[name~='sectors']").val(data.inv.det.sectors);
			$("#ticket-form input[name~='airline_gds']").val(data.inv.det.airline_gds);
			$("#ticket-form input[name~='airline_route']").val(data.inv.det.airline_route);
			$("#ticket-form input[name~='flight_no']").val(data.inv.det.flight_no);
			$("#ticket-form input[name~='departure']").val(data.inv.det.departure);
			$("#ticket-form input[name~='return_date']").val(data.inv.det.return_date);
			$("#ticket-form input[name~='airline_pnr']").val(data.inv.det.airline_pnr);
			$("#ticket-form input[name~='gds_pnr']").val(data.inv.det.gds_pnr);
			$("#ticket-form input[name~='ticket_type']").val(data.inv.det.ticket_type);
			$("#ticket-form input[name~='ticket_no']").val(data.inv.det.airline_code+'-'+data.inv.det.ticket_no);
			$("#ticket-form input[name~='conj_ticket_no']").val(data.inv.det.airline_code+'-'+data.inv.det.conj_ticket_no);
			$("#ticket-form input[name~='base_fare']").val(data.inv.refund.base_fare);
			$("#ticket-form input[name~='sp_yi_tax']").val(data.inv.refund.sp_yi_tax);
			$("#ticket-form input[name~='rg_cvt_tax']").val(data.inv.refund.rg_cvt_tax);
			$("#ticket-form input[name~='yq_tax']").val(data.inv.refund.yq_tax);
			$("#ticket-form input[name~='ced_tax']").val(data.inv.refund.ced_tax);
			$("#ticket-form input[name~='pb_adv_yq_tax']").val(data.inv.refund.pb_adv_tax);
			$("#ticket-form input[name~='xz_tax']").val(data.inv.refund.xz_tax);
			$("#ticket-form input[name~='yd_tax']").val(data.inv.refund.yd_tax);
			$("#ticket-form input[name~='xt_ur_tax']").val(data.inv.refund.xt_ur_tax);
			$("#ticket-form input[name~='other_tax']").val(data.inv.refund.other_tax);
			$("#ticket-form input[name~='total_taxes']").val(data.inv.refund.total_tax);
			$("#ticket-form input[name~='com_recp']").val(data.inv.refund.com_recp);
			$("#ticket-form input[name~='com_rec']").val(data.inv.refund.com_rec);
			$("#ticket-form input[name~='com_paidp']").val(data.inv.refund.com_paidp);
			$("#ticket-form input[name~='com_paid']").val(data.inv.refund.com_paid);
			$("#ticket-form input[name~='wh_air']").val(data.inv.refund.wh_air);
			$("#ticket-form input[name~='pst_paid']").val(data.inv.refund.pst_paid);
			$("#ticket-form input[name~='psfp']").val(data.inv.refund.psfp);
			$("#ticket-form input[name~='psf']").val(data.inv.refund.psf);
			$("#ticket-form input[name~='discountp']").val(data.inv.refund.discountp);
			$("#ticket-form input[name~='discount']").val(data.inv.refund.discount);
			$("#ticket-form input[name~='wh_clientp']").val(data.inv.refund.wh_clientp);
			$("#ticket-form input[name~='wh_client']").val(data.inv.refund.wh_client);
			$("#ticket-form input[name~='fare_include']").val(data.inv.refund.fare_inc);
			$("#ticket-form input[name~='tax_include']").val(data.inv.refund.tax_inc);
			$("#ticket-form input[name~='f_agent_amount']").val(data.inv.refund.f_agent_amount);
			$("#ticket-form select[name~='f_agent_id']").val(data.inv.refund.f_agent_id);
			$("#ticket-form input[name~='s_agent_amount']").val(data.inv.refund.s_agent_amount);
			$("#ticket-form select[name~='s_agent_id']").val(data.inv.refund.s_agent_id);
			$("#ticket-form input[name~='payable_amount']").val(data.inv.refund.payable_amount);
			$("#ticket-form input[name~='receiveable_amount']").val(data.inv.refund.receiveable_amount);
			$("#ticket-form input[name~='profit']").val(data.inv.refund.profit);
			$("#ticket-form select[name~='cur_type']").val(data.inv.refund.cur_type);
			$("#ticket-form input[name~='cur_rate']").val(data.inv.refund.cur_rate);
			//calculate currency rate
			var np=Number(data.inv.refund.payable_amount)/Number(data.inv.refund.cur_rate);
			var nr=Number(data.inv.refund.receiveable_amount)/Number(data.inv.refund.cur_rate);
			var npro=Number(data.inv.refund.profit)/Number(data.inv.refund.cur_rate);
			$("#ticket-form input[name~='cur_p']").val(np.toFixed(2));
			$("#ticket-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#ticket-form input[name~='cur_profit']").val(npro.toFixed(2));
			$("#ticket-form input[name~='service_charges']").val(data.inv.refund.service_charges);
			$("#ticket-form input[name~='cancellation_charges']").val(data.inv.refund.cancellation_charges);
			$("#refund-sectors").html('<strong>Refund Sector:</strong> '+data.inv.refund.ref_sectors+'').show();
			//sector details............
			var htmlData=""; htmlData1="";
			for(i in data['sec_det'])
			{
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
			$("#ticket-form #refundDiv").html('<a href="../invoice/credit-note?refId='+data.inv.det.refId+'" target="_blank" class="btn btn-sm btn-danger form-control">Refunded #'+data.inv.det.refId+'</i></a>').show();
			$("#ticket-form input[name~='refId']").val(data.inv.det.refId);
			$("#ticket-form input[name~='inv_id']").val(data.inv.det.inv_id);
			$(".multiple_rec >tbody:last-child").html(htmlData);
			$(".conj_multiple_rec >tbody:last-child").html(htmlData1);
			$(".js-example-basic-single").select2();
			$('.loader-bg').hide();
		}
	});
}
//edit hotel refund
function edit_hotel_refund(id, type, btn_type)
{
	if(btn_type == 'refund'){
		$("#hotel-form .save-rec").hide();
		$("#hotel-form .ref-rec").show();
		$("#hotel-form .refEdit").css('background','rgb(255, 82, 82)');
		$('#hotel-form .refText').css('color','#ff5252');
		$('#hotel-form .h_np').closest('.form-group').find('label').html('Rec from Vendor');
		$('#hotel-form .h_nr').closest('.form-group').find('label').html('Pay to Customer');
		$("#hotel-form input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
		$('#hotel-form #c_charges_div, #s_charges_div').css('display','block');
	}
	$.ajax({
		url:"ajax_call/edit_sale_invoice?id="+id+"&type="+type,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#hotel-form input[name~='refund_date']").val(data.si.refund_date);
			$("#hotel-form input[name~='due_date']").val(data.si.due_date);
			$("#hotel-form select[name~='branch_id']").val(data.si.branch_id);
			$("#hotel-form select[name~='client_id']").val(data.si.client_id);
			$("#hotel-form select[name~='payment_term']").val(data.si.payment_term);
			$("#hotel-form select[name~='empl_id']").val(data.si.empl_id);
			$("#hotel-form name[name~='remarks']").val(data.si.remarks);
			//=========================
			$("#hotel-form input[name~='id']").val(data.det.id);
			$("#hotel-form input[name~='passport']").val(data.det.passport);
			$("#hotel-form input[name~='name']").val(data.det.booking_name);
			$("#hotel-form input[name~='pass_mobile']").val(data.det.pass_mobile);
			$("#hotel-form input[name~='pass_type']").val(data.det.pass_type);
			$("#hotel-form input[name~='group_no']").val(data.det.group_no);
			$("#hotel-form input[name~='hotel_id']").val(data.det.hotel_id);
			$("#hotel-form select[name~='payable_id']").val(data.det.payable_id);
			$("#hotel-form input[name~='conf_no']").val(data.det.conf_no);
			$("#hotel-form input[name~='internal_ref']").val(data.det.internal_ref);
			$("#hotel-form input[name~='room_par']").val(data.det.room_par);
			$("#hotel-form input[name~='guest_beds']").val(data.det.guest_beds);
			$("#hotel-form input[name~='meal']").val(data.det.meal);
			$("#hotel-form input[name~='check_in']").val(data.det.check_in);
			$("#hotel-form input[name~='nights']").val(data.det.nights);
			$("#hotel-form input[name~='check_out']").val(data.det.check_out);
			$("#hotel-form input[name~='qty']").val(data.det.qty);
			$("#hotel-form input[name~='rate_night']").val(data.det.rate_night);
			$("#hotel-form input[name~='room_no']").val(data.det.room_no);
			$("#hotel-form input[name~='particulars']").val(data.det.particulars);
			$("#hotel-form input[name~='basic_amount']").val(data.refund.base_fare);
			$("#hotel-form input[name~='com_recp']").val(data.refund.com_recp);
			$("#hotel-form input[name~='com_rec']").val(data.refund.com_rec);
			$("#hotel-form input[name~='com_paidp']").val(data.refund.com_paidp);
			$("#hotel-form input[name~='com_paid']").val(data.refund.com_paid);
			$("#hotel-form input[name~='wh']").val(data.refund.wh);
			$("#hotel-form input[name~='pst_paid']").val(data.refund.pst_paid);
			$("#hotel-form input[name~='f_agent_amount']").val(data.refund.f_agent_amount);
			$("#hotel-form select[name~='f_agent_id']").val(data.refund.f_agent_id);
			$("#hotel-form input[name~='s_agent_amount']").val(data.refund.s_agent_amount);
			$("#hotel-form select[name~='s_ageent_id']").val(data.refund.s_ageent_id);
			$("#hotel-form input[name~='psf']").val(data.refund.psf);
			$("#hotel-form input[name~='discount_per']").val(data.refund.discount_per);
			$("#hotel-form input[name~='discount']").val(data.refund.discount);
			$("#hotel-form input[name~='pst_rec']").val(data.refund.pst_rec);
			$("#hotel-form input[name~='payable_amount']").val(data.refund.payable_amount);
			$("#hotel-form input[name~='receiveable_amount']").val(data.refund.receiveable_amount);
			$("#hotel-form input[name~='profit']").val(data.refund.profit);
			$("#hotel-form select[name~='cur_type']").val(data.refund.cur_type);
			$("#hotel-form input[name~='cur_rate']").val(data.refund.cur_rate);
			//calculate currency rate
			var np=Number(data.refund.payable_amount)/Number(data.refund.cur_rate);
			var nr=Number(data.refund.receiveable_amount)/Number(data.refund.cur_rate);
			var npro=Number(data.refund.profit)/Number(data.refund.cur_rate);
			$("#hotel-form input[name~='cur_p']").val(np.toFixed(2));
			$("#hotel-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#hotel-form input[name~='cur_profit']").val(npro.toFixed(2));
			$("#hotel-form input[name~='refId']").val(data.refund.id);
			$("#hotel-form input[name~='canc_charges']").val(data.refund.cancellation_charges);
			$("#hotel-form input[name~='service_charges']").val(data.refund.service_charges);
			$("#hotel-form #refundDiv").html('<a href="../invoice/hotel_credit-note?refId='+data.refund.id+'" class="btn btn-sm btn-danger form-control" target="_blank">Refunded #'+data.refund.id+'</i></a>').show();
			//refund profit loss details
			var np=Number(data.refund.com_rec)+Number(data.refund.f_agent_amount)+Number(data.refund.s_agent_amount)+Number(data.refund.psf)-Number(data.refund.discount)-Number(data.refund.service_charges);
			if(np<0){
				$('#hotel-form .hProfit').closest('.form-group').find('label').html('Profit'); }
			else{
				$('#hotel-form .hProfit').closest('.form-group').find('label').html('Loss');
			}
			//passport details
			var pdHtml="";
			for(i in data['pd']){
				pdHtml+='<div class="remove_pass"><div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								if(i==0){
								pdHtml+='<labe>Passport#</label>'; }
								pdHtml+='<input type="text" value="'+data['pd'][i].passport+'" class="form-control form-control-sm" name="passport[]">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								if(i==0){
								pdHtml+='<labe>Passanger Name</label>';}
								pdHtml+='<input type="text" value="'+data['pd'][i].name+'" class="form-control form-control-sm" name="pass_name[]">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								if(i==0){
								pdHtml+='<labe>Passport Expiry</label>'; }
								pdHtml+='<input type="text" value="'+data['pd'][i].pass_exp+'" class="form-control form-control-sm" name="passport_expiry[]" placeholder="01-01-2019">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								if(i==0){
								pdHtml+='<labe>Phone No</label>'; }
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
								pdHtml+='<input type="text" value="'+data['pd'][i].nic+'" class="form-control form-control-sm" name="nic[]" placeholder="01-01-2019">'+
								'</div>'+
            				'</div>'+
							'<div class="col-md-2 col-custom-8">'+
              					'<div class="form-group">';
								if(i==0){
								pdHtml+='<labe>NIC Expiry</label>'+
								'<input type="text" value="'+data['pd'][i].nic_exp+'" class="form-control form-control-sm" name="nic_exp[]" placeholder="01-01-2019"><button type="button" class="btn-primary multi_pass_add" style="position: absolute;right:-11px; bottom:7px;border:0px;"><i class="fa fa-plus"></i></button>';}
								else{
								pdHtml+='<input type="text" value="'+data['pd'][i].nic_exp+'" class="form-control form-control-sm" name="nic_exp[]"><i class="fa fa-times rp_click" style="position: absolute;color:lightcoral;right:-5px; bottom:24px;"></i>';}
								pdHtml+='</div>'+
            				'</div>'+
							'</div>';
			}
			$(".mulit_pass").html(pdHtml);
			$(".js-example-basic-single").select2();
			
		}
	});
}
//edit visa refund
function edit_visa_refund(id, type, btn_type)
{
	$("#visa-form .ref-rec").show();
	$("#visa-form .save-rec").hide();
	$("#visa-form .refEdit").css('background','rgb(255, 82, 82)');
	$('#visa-form .refText').css('color','#ff5252');
	$('#visa-form .vpayable').closest('.form-group').find('label').html('Rec from Vendor');
	$('#visa-form .vreceiveable').closest('.form-group').find('label').html('Pay to Customer');
	$("#visa-form input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
	$("#visa-form input[name~='profit']").closest('.form-group').find('label').text('Loss');
	$('#visa-form #c_charges_div, #s_charges_div').css('display','block');
	$.ajax({
		url:"ajax_call/edit_sale_invoice?type="+type+"&id="+id,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#visa-form input[name~='inv_date']").val(data.si.inv_date);
			$("#visa-form input[name~='due_date']").val(data.si.due_date);
			$("#visa-form select[name~='branch_id']").val(data.si.branch_id);
			$("#visa-form select[name~='client_id']").val(data.si.client_id);
			$("#visa-form select[name~='payment_term']").val(data.si.payment_term);
			$("#visa-form select[name~='empl_id']").val(data.si.empl_id);
			$("#visa-form input[name~='remarks']").val(data.si.remarks);
			//visa invoice details
			$("#visa-form input[name~='id']").val(data.vi.id);
			$("#visa-form input[name~='refId']").val(data.vi.refId);
			$("#visa-form input[name~='passport']").val(data.vi.passport);
			$("#visa-form input[name~='pass_name']").val(data.vi.pass_name);
			$("#visa-form input[name~='pass_mobile']").val(data.vi.pass_mobile);
			$("#visa-form select[name~='pass_type']").val(data.vi.pass_type);
			$("#visa-form input[name~='dob']").val(data.vi.dob);
			$("#visa-form select[name~='visa_type']").val(data.vi.visa_type);
			$("#visa-form input[name~='visa_no']").val(data.vi.visa_no);
			$("#visa-form input[name~='documents']").val(data.vi.documents);
			$("#visa-form input[name~='online_date']").val(data.vi.online_date);
			$("#visa-form input[name~='qty']").val(data.vi.qty);
			$("#visa-form input[name~='rate']").val(data.vi.rate);
			$("#visa-form input[name~='basic_fare']").val(data.refund.base_fare);
			$("#visa-form input[name~='pst_paid']").val(data.refund.pst_paid);
			$("#visa-form select[name~='vendor_id']").val(data.vi.vendor_id);
			$("#visa-form input[name~='particulars']").val(data.vi.particulars);
			$("#visa-form input[name~='f_agent_amount']").val(data.refund.f_agent_amount);
			$("#visa-form select[name~='f_agent_id']").val(data.refund.f_agent_id);
			$("#visa-form input[name~='s_agent_name']").val(data.refund.s_agent_name);
			$("#visa-form select[name~='s_agent_id']").val(data.refund.s_agent_id);
			$("#visa-form input[name~='psf']").val(data.refund.psf);
			$("#visa-form input[name~='discountp']").val(data.refund.discountp);
			$("#visa-form input[name~='discount']").val(data.refund.discount);
			$("#visa-form input[name~='pst_rec']").val(data.refund.pst_rec);
			$("#visa-form input[name~='payable_amount']").val(data.refund.payable_amount);
			$("#visa-form input[name~='receiveable_amount']").val(data.refund.receiveable_amount);
			$("#visa-form input[name~='profit']").val(data.refund.profit);
			$("#visa-form select[name~='cur_type']").val(data.refund.cur_type);
			$("#visa-form input[name~='cur_rate']").val(data.refund.cur_rate);
			//calculate currency rate
			var np=Number(data.refund.payable_amount)/Number(data.refund.cur_rate);
			var nr=Number(data.refund.receiveable_amount)/Number(data.refund.cur_rate);
			var npro=Number(data.refund.profit)/Number(data.refund.cur_rate);
			$("#visa-form input[name~='cur_p']").val(np.toFixed(2));
			$("#visa-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#visa-form input[name~='cur_profit']").val(npro.toFixed(2));
			$("#visa-form input[name~='service_charges']").val(data.refund.service_charges);
			$("#visa-form #refundDiv").html('<a href="../invoice/credit-note?refId='+data.refund.id+'" target="_blank" class="btn btn-sm btn-danger form-control">Refunded #'+data.refund.id+'</i></a>').show();
			$(".js-example-basic-single").select2();
		}
	});
}
// edit refund transfer details...........
function edit_transfer_refund(id, type)
{
	$("#transfer-form .ref-rec").show();
		$("#transfer-form .save-rec").hide();
		$("#transfer-form .refEdit").css('background','rgb(255, 82, 82)');
		$('#transfer-form .refText').css('color','#ff5252');
		$('#transfer-form .tr_np').closest('.form-group').find('label').html('Rec from Vendor');
		$('#transfer-form .tr_nr').closest('.form-group').find('label').html('Pay to Customer');
		$("#transfer-form input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
		$('#transfer-form #c_charges_div, #s_charges_div').css('display','block');
	$.ajax({
		url:"ajax_call/edit_sale_invoice?type="+type+"&id="+id,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#transfer-form input[name~='inv_date']").val(data.si.inv_date);
			$("#transfer-form input[name~='due_date']").val(data.si.due_date);
			$("#transfer-form select[name~='branch_id']").val(data.si.branch_id);
			$("#transfer-form select[name~='client_id']").val(data.si.client_id);
			$("#transfer-form select[name~='payment_term']").val(data.si.payment_term);
			$("#transfer-form select[name~='empl_id']").val(data.si.empl_id);
			$("#transfer-form input[name~='remarks']").val(data.si.remarks);
			//transfer details............
			$("#transfer-form input[name~='id']").val(data.vi.id);
			$("#transfer-form input[name~='passport']").val(data.vi.passport);
			$("#transfer-form input[name~='pass_name']").val(data.vi.pass_name);
			$("#transfer-form input[name~='pass_mobile']").val(data.vi.pass_mobile);
			$("#transfer-form select[name~='pass_type']").val(data.vi.pass_type);
			$("#transfer-form input[name~='dob']").val(data.vi.dob);
			$("#transfer-form input[name~='group_no']").val(data.vi.group_no);
			$("#transfer-form input[name~='ref_no']").val(data.vi.ref_no);
			$("#transfer-form input[name~='vehicle_type']").val(data.vi.vehicle_type);
			$("#transfer-form input[name~='from_date']").val(data.vi.from_date);
			$("#transfer-form input[name~='to_date']").val(data.vi.to_date);
			/*$("#transfer-form input[name~='qty']").val(data.vi.qty);*/
			$("#transfer-form input[name~='rate']").val(data.vi.rate);
			$("#transfer-form input[name~='basic_fare']").val(data.refund.base_fare);
			$("#transfer-form select[name~='vendor_id']").val(data.vi.vendor_id);
			$("#transfer-form input[name~='particulars']").val(data.vi.particulars);
			$("#transfer-form input[name~='f_agent_amount']").val(data.refund.f_agent_amount);
			$("#transfer-form select[name~='f_agent_id']").val(data.refund.f_agent_id);
			$("#transfer-form input[name~='s_agent_name']").val(data.refund.s_agent_name);
			$("#transfer-form select[name~='s_agent_id']").val(data.refund.s_agent_id);
			$("#transfer-form input[name~='psf']").val(data.refund.psf);
			$("#transfer-form input[name~='discountp']").val(data.refund.discountp);
			$("#transfer-form input[name~='discount']").val(data.refund.discount);
			$("#transfer-form input[name~='pst_rec']").val(data.refund.pst_rec);
			$("#transfer-form input[name~='payable_amount']").val(data.refund.payable_amount);
			$("#transfer-form input[name~='receiveable_amount']").val(data.refund.receiveable_amount);
			$("#transfer-form input[name~='service_charges']").val(data.refund.service_charges);
			$("#transfer-form input[name~='profit']").val(data.refund.profit);
			$("#transfer-form select[name~='cur_type']").val(data.refund.cur_type);
			$("#transfer-form input[name~='cur_rate']").val(data.refund.cur_rate);
			//calculate currency rate
			var np=Number(data.refund.payable_amount)/Number(data.refund.cur_rate);
			var nr=Number(data.refund.receiveable_amount)/Number(data.refund.cur_rate);
			var npro=Number(data.refund.profit)/Number(data.refund.cur_rate);
			$("#transfer-form input[name~='cur_p']").val(np.toFixed(2));
			$("#transfer-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#transfer-form input[name~='cur_profit']").val(npro.toFixed(2));
			$("#transfer-form input[name~='refId']").val(data.refund.id);
			$('#transfer-form .tr_profit').closest('.form-group').find('label').html('Loss');
			if(data.vi.refund=='yes')
			{
				$("#transfer-form #refundDiv").html('<a href="../invoice/transfer_credit_note?refId='+data.vi.refId+'" class="btn btn-sm btn-danger form-control" target="_blank">Refunded #'+data.vi.refId+'</i></a>').show();
			}
			else{
				$("#hotel-form #refundDiv").hide();
			}
			$(".js-example-basic-single").select2();
		}
	});
}
function edit_other_refund(id, type)
{
	$("#other-form .ref-rec").show();
		$("#other-form .save-rec").hide();
		$("#other-form .refEdit").css('background','rgb(255, 82, 82)');
		$('#other-form .refText').css('color','#ff5252');
		$('#other-form .opayable').closest('.form-group').find('label').html('Rec from Vendor');
		$('#other-form .oreceiveable').closest('.form-group').find('label').html('Pay to Customer');
		$("#other-form input[name~='inv_date']").closest('.form-group').find('label').text('Refund Date');
		$("#other-form .oprofit").closest('.form-group').find('label').text('Loss');
		$('#other-form #c_charges_div, #s_charges_div').css('display','block');
	$.ajax({
		url:"ajax_call/edit_sale_invoice?type="+type+"&id="+id,
		dataType:"JSON",
		success: function(data)
		{
			//pos inovice dtails
			$("#other-form input[name~='inv_date']").val(data.si.inv_date);
			$("#other-form input[name~='due_date']").val(data.si.due_date);
			$("#other-form select[name~='branch_id']").val(data.si.branch_id);
			$("#other-form select[name~='client_id']").val(data.si.client_id);
			$("#other-form select[name~='payment_term']").val(data.si.payment_term);
			$("#other-form select[name~='empl_id']").val(data.si.empl_id);
			$("#other-form input[name~='remarks']").val(data.si.remarks);
			//other details
			$("#other-form input[name~='id']").val(data.vi.id);
			$("#other-form input[name~='passport']").val(data.vi.passport);
			$("#other-form input[name~='pass_name']").val(data.vi.pass_name);
			$("#other-form slect[name~='pass_type']").val(data.vi.pass_type);
			$("#other-form slect[name~='pass_mobile']").val(data.vi.pass_mobile);
			$("#other-form slect[name~='dob']").val(data.vi.dob);
			$("#other-form input[name~='group_no']").val(data.vi.group_no);
			$("#other-form input[name~='pkg_details']").val(data.vi.pkg_details);
			$("#other-form input[name~='rate']").val(data.vi.rate);
			$("#other-form select[name~='vendor_id']").val(data.vi.vendor_id);
			$("#other-form input[name~='refId']").val(data.refund.id);
			$("#other-form input[name~='basic_fare']").val(data.refund.base_fare);
			$("#other-form input[name~='f_agent_amount']").val(data.refund.f_agent_amount);
			$("#other-form select[name~='f_agent_id']").val(data.refund.f_agent_id);
			$("#other-form input[name~='s_agent_amount']").val(data.refund.s_agent_amount);
			$("#other-form select[name~='s_agent_id']").val(data.refund.s_agent_id);
			$("#other-form input[name~='psf']").val(data.refund.psf);
			$("#other-form input[name~='discountp']").val(data.refund.discountp);
			$("#other-form input[name~='discount']").val(data.refund.discount);
			$("#other-form input[name~='other_services']").val(data.refund.other_services);
			$("#other-form input[name~='payable_amount']").val(data.refund.payable_amount);
			$("#other-form input[name~='receivable_amount']").val(data.refund.receiveable_amount);
			$("#other-form input[name~='profit']").val(data.refund.profit);
			$("#other-form select[name~='cur_type']").val(data.refund.cur_type);
			$("#other-form input[name~='cur_rate']").val(data.refund.cur_rate);
			//calculate currency rate
			var np=Number(data.refund.payable_amount)/Number(data.refund.cur_rate);
			var nr=Number(data.refund.receiveable_amount)/Number(data.refund.cur_rate);
			var npro=Number(data.refund.profit)/Number(data.refund.cur_rate);
			$("#other-form input[name~='cur_p']").val(np.toFixed(2));
			$("#other-form input[name~='cur_r']").val(nr.toFixed(2));
			$("#other-form input[name~='cur_profit']").val(npro.toFixed(2));
			$("#other-form #refundDiv").html('<a href="../invoice/transfer_credit_note?refId='+data.refund.id+'" class="btn btn-sm btn-danger form-control" target="_blank">Refunded #'+data.refund.id+'</i></a>').show();
			
			$(".js-example-basic-single").select2();
		}
		});
}
//=====================fetch passprot details............
$(".fetch_pp_det").on("change",function(){
	var pp=$(this).val();
	var g=$(this);
	$.ajax({
		url:"ajax_call/fetch_pp_det?pp="+pp,
		dataType:"JSON",
		success: function(data)
		{
			//main passport details
			$(g).closest(".modal-body").find(".pass_name").val(data.name);
			$(g).closest(".modal-body").find(".pass_mobile").val(data.mobile);
			$(g).closest('.modal-body').find(".pass_type").val(data.pass_type).attr("selected");
			$(g).closest('.modal-body').find(".dob").val(data.dob);
			//========
			$(g).closest(".col-custom-8").next().find(".pass_name").val(data.name);
			$(g).closest('.col-custom-8').next().find(".pass_mobile").val(data.mobile);
			$(g).closest('.col-custom-8').next().find(".passport_expiry").val(data.pass_exp);
			$(g).closest('.col-custom-8').next().find(".pass_type").val(data.pass_type).attr("selected");
			$(g).closest('.col-custom-8').next().find(".dob").val(data.dob);
			$(g).closest('.col-custom-8').next().find(".nic").val(data.nic);
			$(g).closest('.col-custom-8').next().find(".nic_exp").val(data.nic_exp);
		}
	});
});
//calculate currency rate while positng pos
function ticket_currency_cal(g)
{
	var np=$(g).closest(".modal-body").find(".t_payable").val();
	var nr=$(g).closest(".modal-body").find(".t_receiveable").val();
	var nprofit=$(g).closest(".modal-body").find(".tprofit").val();
	var cur_rate=$(g).closest(".modal-body").find(".cur_rate").val();
	var net_cur_np=Number(np)/Number(cur_rate);
	var net_cur_nr=Number(nr)/Number(cur_rate);
	var net_cur_nprofit=Number(nprofit)/Number(cur_rate);
	$(g).closest(".modal-body").find(".cur_p").val(Number(net_cur_np).toFixed(2));
	$(g).closest(".modal-body").find(".cur_r").val(Number(net_cur_nr).toFixed(2));
	$(g).closest(".modal-body").find(".cur_profit").val(Number(net_cur_nprofit).toFixed(2));
}
function hotel_currency_cal(g)
{
	var np=$(g).closest("form").find(".h_np").val();
	var nr=$(g).closest("form").find(".h_nr").val();
	var nprofit=$(g).closest("form").find(".hProfit").val();
	var cur_rate=$(g).closest("form").find(".cur_rate").val();
	var net_cur_np=Number(np)/Number(cur_rate);
	var net_cur_nr=Number(nr)/Number(cur_rate);
	var net_cur_nprofit=Number(nprofit)/Number(cur_rate);
	$(g).closest("form").find(".cur_p").val(Number(net_cur_np).toFixed(2));
	$(g).closest("form").find(".cur_r").val(Number(net_cur_nr).toFixed(2));
	$(g).closest("form").find(".cur_profit").val(Number(net_cur_nprofit).toFixed(2));
}
function visa_currency_cal(g)
{
	var np=$(g).closest("form").find(".vpayable").val();
	var nr=$(g).closest("form").find(".vreceiveable").val();
	var nprofit=$(g).closest("form").find(".vprofit").val();
	var cur_rate=$(g).closest("form").find(".cur_rate").val();
	var net_cur_np=Number(np)/Number(cur_rate);
	var net_cur_nr=Number(nr)/Number(cur_rate);
	var net_cur_nprofit=Number(nprofit)/Number(cur_rate);
	$(g).closest("form").find(".cur_p").val(Number(net_cur_np).toFixed(2));
	$(g).closest("form").find(".cur_r").val(Number(net_cur_nr).toFixed(2));
	$(g).closest("form").find(".cur_profit").val(Number(net_cur_nprofit).toFixed(2));
}
function transfer_currency_cal(g)
{
	var np=$(g).closest("form").find(".tr_np").val();
	var nr=$(g).closest("form").find(".tr_nr").val();
	var nprofit=$(g).closest("form").find(".tr_profit").val();
	var cur_rate=$(g).closest('form').find(".cur_rate").val();
	var net_cur_np=Number(np)/Number(cur_rate);
	var net_cur_nr=Number(nr)/Number(cur_rate);
	var net_cur_nprofit=Number(nprofit)/Number(cur_rate);
	$(g).closest("form").find(".cur_p").val(Number(net_cur_np).toFixed(2));
	$(g).closest("form").find(".cur_r").val(Number(net_cur_nr).toFixed(2));
	$(g).closest("form").find(".cur_profit").val(Number(net_cur_nprofit).toFixed(2));
}
function other_currency_cal(g)
{
	var np=$(g).closest("form").find(".opayable").val();
	var nr=$(g).closest("form").find(".oreceiveable").val();
	var nprofit=$(g).closest("form").find(".oprofit").val();
	var cur_rate=$(g).closest('form').find(".cur_rate").val();
	var net_cur_np=Number(np)/Number(cur_rate);
	var net_cur_nr=Number(nr)/Number(cur_rate);
	var net_cur_nprofit=Number(nprofit)/Number(cur_rate);
	$(g).closest("form").find(".cur_p").val(Number(net_cur_np).toFixed(2));
	$(g).closest("form").find(".cur_r").val(Number(net_cur_nr).toFixed(2));
	$(g).closest("form").find(".cur_profit").val(Number(net_cur_nprofit).toFixed(2));
}