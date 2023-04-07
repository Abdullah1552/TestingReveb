function get_ticket_search_records(){
	$('.loader-bg').show();
	$(".get_ticket_search_records").html("<tr><td colspan='9' align='center'>No Record Found</td></tr>");
	$.ajax({
		url:"ajax_call/get_search_sale_rec?type=ticket",
		type:"POST",
		data:$("#search-ticket-form").serialize(),
		dataType:"JSON",
		success: function(data)
		{
			if(data.tr=="" || data==""){
				htmlData="<tr><td colspan='9' align='center'>No Record Found</td></tr>";
			}
			else{
				var htmlData="";
			}
			var j=1;
			for(i in data.tr){
				htmlData+="<tr id='t-"+data.tr[i].id+"'>";
					htmlData+='<td>'+Number(j++)+'</td>';
					htmlData+='<td>'+data.tr[i].trans_acc_name+'</td>';
					htmlData+='<td>'+data.tr[i].airline_code+'-'+data.tr[i].ticket_no+'</td>';
					htmlData+='<td>'+data.tr[i].pass_name+'</td>';
					htmlData+='<td>'+data.tr[i].passport+'</td>';
					htmlData+='<td>'+data.tr[i].airline_pnr+'</td>';
					htmlData+='<td>'+data.tr[i].payable_amount+'</td>';
					htmlData+='<td>'+data.tr[i].receiveable_amount+'</td>';
					htmlData+='<td>';
					if(data.edit=='allow'){
					htmlData+='<button class="btn btn-info btn-mini waves-effect waves-light" onclick="edit_ticket_record('+data.tr[i].id+', \'ticket\', \'record_edit\')"> <i class="fa fa-edit"></i></button>';
					}
				    if(data.tr[i].refund=='yes' && data.ref=='allow'){
						htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_ticket_ref_record('+data.tr[i].id+', \'ticket_ref\', \'refund\')"><i class="fa fa-undo"></i> Refended</button>';	
					}
					else if(data.tr[i].status=='voided'){
						htmlData+=' <button class="btn btn-danger btn-mini waves-effect waves-light"><i class="fa fa-undo"></i> Voided</button>';	
					}
					else{
						if(data.ref=='allow'){
						htmlData+=' <button class="btn btn-warning btn-mini waves-effect waves-light" onclick="edit_ticket_record('+data.tr[i].id+', \'ticket\', \'refund\')"><i class="fa fa-undo"></i> Ref</button>';
						}
					}
					/*htmlData+=' <button class="btn btn-danger btn-mini waves-effect waves-light" onclick="del_inv(\'\', \'ticket_rec\', \'t-'+data.tr[i].id+'\')"> <i class="fa fa-trash"></i></button>';*/
					htmlData+='</td>';
				htmlData+='</tr>';
			}
			$(".get_ticket_search_records").html(htmlData);
			$('.loader-bg').hide();
		},
		cache:false
	});
}
//search hotel recors
function get_hotel_search_records(){
	$('.loader-bg').show();
	$(".get_hotel_search_records").html("<tr><td colspan='10' align='center'>No Record Found</td></tr>");
	$.ajax({
		url:"ajax_call/get_search_sale_rec?type=hotel",
		type:"POST",
		data:$("#search-hotel-form").serialize(),
		dataType:"JSON",
		success: function(data)
		{
			if(data.hr=="" || data==""){
				htmlData="<tr><td colspan='10' align='center'>No Record Found</td></tr>";
			}
			else{
				var htmlData="";
			}
			var j=1;
			for(i in data.hr)
			{
				htmlData+="<tr>";
					htmlData+='<td>'+Number(j++)+'</td>';
					htmlData+='<td>'+data.hr[i].trans_acc_name+'</td>';
					htmlData+='<td>'+data.hr[i].passport+'</td>';
					htmlData+='<td>'+data.hr[i].booking_name+'</td>';
					htmlData+='<td>'+data.hr[i].check_in+'</td>';
					htmlData+='<td>'+data.hr[i].check_out+'</td>';
					htmlData+='<td>'+data.hr[i].conf_no+'</td>';
					htmlData+='<td>'+data.hr[i].payable_amount+'</td>';
					htmlData+='<td>'+data.hr[i].receiveable_amount+'</td>';
					htmlData+='<td>';
					if(data.edit=='allow'){
					htmlData+='<button class="btn btn-info btn-mini waves-effect waves-light" onclick="edit_hotel_invoice('+data.hr[i].id+', \'hotel\', \'record_edit\')"> <i class="fa fa-edit"></i></button>';
					}
					htmlData+='</td>';
				htmlData+='</tr>';
			}
			$(".get_hotel_search_records").html(htmlData);
		},
		cache:false
	});
	$('.loader-bg').hide();
}
//search visa records
function get_visa_search_records(){
	$('.loader-bg').show();
	$(".get_visa_search_records").html("<tr><td colspan='10' align='center'>No Record Found</td></tr>");
	$.ajax({
		url:"ajax_call/get_search_sale_rec?type=visa",
		type:"POST",
		data:$("#search-visa-form").serialize(),
		dataType:"JSON",
		success: function(data)
		{
			if(data.vr=="" || data==""){
				htmlData="<tr><td colspan='10' align='center'>No Record Found</td></tr>";
			}
			else{
				var htmlData="";
			}
			var j=1;
			for(i in data.vr)
			{
				htmlData+="<tr>";
					htmlData+='<td>'+Number(j++)+'</td>';
					htmlData+='<td>'+data.vr[i].trans_acc_name+'</td>';
					htmlData+='<td>'+data.vr[i].passport+'</td>';
					htmlData+='<td>'+data.vr[i].pass_name+'</td>';
					htmlData+='<td>'+data.vr[i].visa_no+'</td>';
					htmlData+='<td>'+data.vr[i].country_name+'</td>';
					htmlData+='<td>'+data.vr[i].payable_amount+'</td>';
					htmlData+='<td>'+data.vr[i].receiveable_amount+'</td>';
					htmlData+='<td>';
					if(data.edit=='allow'){
					htmlData+='<button class="btn btn-info btn-mini waves-effect waves-light" onclick="edit_visa_record('+data.vr[i].id+', \'visa\', \'record_edit\')"> <i class="fa fa-edit"></i></button>';
					}
					htmlData+='</td>';
				htmlData+='</tr>';
			}
			$(".get_visa_search_records").html(htmlData);
		},
		cache:false
	});
	$('.loader-bg').hide();
}
//search transfer records
function get_transfer_search_records(){
	$('.loader-bg').show();
	$(".get_transfer_search_records").html("<tr><td colspan='10' align='center'>No Record Found</td></tr>");
	$.ajax({
		url:"ajax_call/get_search_sale_rec?type=transfer",
		type:"POST",
		data:$("#search-transfer-form").serialize(),
		dataType:"JSON",
		success: function(data)
		{
			if(data.trr=="" || data==""){
				htmlData="<tr><td colspan='10' align='center'>No Record Found</td></tr>";
			}
			else{
				var htmlData="";
			}
			var j=1;
			for(i in data.trr)
			{
				htmlData+="<tr>";
					htmlData+='<td>'+Number(j++)+'</td>';
					htmlData+='<td>'+data.trr[i].trans_acc_name+'</td>';
					htmlData+='<td>'+data.trr[i].passport+'</td>';
					htmlData+='<td>'+data.trr[i].pass_name+'</td>';
					htmlData+='<td>'+data.trr[i].ref_no+'</td>';
					htmlData+='<td>'+data.trr[i].payable_amount+'</td>';
					htmlData+='<td>'+data.trr[i].receiveable_amount+'</td>';
					htmlData+='<td>';
					if(data.edit=='allow'){
					htmlData+='<button class="btn btn-info btn-mini waves-effect waves-light" onclick="edit_transfer_rec('+data.trr[i].id+', \'transfer\', \'record_edit\')"> <i class="fa fa-edit"></i></button>';
					}
					htmlData+='</td>';
				htmlData+='</tr>';
			}
			$(".get_transfer_search_records").html(htmlData);
		},
		cache:false
	});
	$('.loader-bg').hide();
}
//search other records
function get_other_search_records(){
	$('.loader-bg').show();
	$(".get_other_search_records").html("<tr><td colspan='10' align='center'>No Record Found</td></tr>");
	$.ajax({
		url:"ajax_call/get_search_sale_rec?type=other",
		type:"POST",
		data:$("#search-other-form").serialize(),
		dataType:"JSON",
		success: function(data)
		{
			if(data.trr=="" || data==""){
				htmlData="<tr><td colspan='10' align='center'>No Record Found</td></tr>";
			}
			else{
				var htmlData="";
			}
			var j=1;
			for(i in data.trr)
			{
				htmlData+="<tr>";
					htmlData+='<td>'+Number(j++)+'</td>';
					htmlData+='<td>'+data.trr[i].trans_acc_name+'</td>';
					htmlData+='<td>'+data.trr[i].passport+'</td>';
					htmlData+='<td>'+data.trr[i].pass_name+'</td>';
					htmlData+='<td>'+data.trr[i].payable_amount+'</td>';
					htmlData+='<td>'+data.trr[i].receivable_amount+'</td>';
					htmlData+='<td>';
					if(data.edit=='allow'){
					htmlData+='<button class="btn btn-info btn-mini waves-effect waves-light" onclick="edit_other_record('+data.trr[i].id+', \'other\', \'record_edit\')"> <i class="fa fa-edit"></i></button>';
					}
					htmlData+='</td>';
				htmlData+='</tr>';
			}
			$(".get_other_search_records").html(htmlData);
		},
		cache:false
	});
	$('.loader-bg').hide();
}