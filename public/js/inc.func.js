// JavaScript Document
var currency_decimal=0;

$(document).ready(function(){
  $("input, select").focusin(function(){
    $(this).css("background-color", "black");
	$(this).css("color", "white");
  });
  $("input, select").focusout(function(){
    $(this).css("background-color", "#FFFFFF");
	 $(this).css("color", "black");
  });
});
$(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
  $(this).closest(".select2-container").siblings('select:enabled').select2('open');
	//$(this).css("background-color", "red");
});
// var inputs = $("input,select"); // You can use other elements such as textarea, button etc.
//                                 //depending on input field types you have used
// $("select").on("select2:close",function(){
//     var pos = $(inputs).index(this) + 1;
//     var next = $(inputs).eq(pos);
//     setTimeout( function() {
//         next.focus();
//         if (next.siblings(".select2").length) { //If it's a select
//             next.select2("open");
//         }
//     }); //The delay is required to allow default events to occur
// });
function pagination(total_rec, per_page, cur_page, to, func, paginateClass, id) {
    var arr;
    if(paginateClass!=undefined) {
        arr = paginateClass.split('-');
        arr = arr.slice(-1).pop();
    }
    var total = total_rec;
    get_data = func;
    no_ofPage = Math.ceil(total / per_page);
    if (cur_page >= 5) {
        start_loop = cur_page - 3;
        end_loop = Number(cur_page) + Number(2);
        if (no_ofPage - 1 == cur_page) {
            end_loop = no_ofPage;
        }
        if (cur_page == no_ofPage) {
            end_loop = no_ofPage;
        }
    } else {
        start_loop = 1;
        if (no_ofPage > 5)
            end_loop = 5;
        else
            end_loop = no_ofPage;
    }



    var htmlData = '';
    htmlData += '<ul class="pagination">' +
        '<li class="page-item">' +
        '<a class="page-link" onclick="get_data(1)" aria-label="Previous"><span aria-hidden="true">«</span></a>' +
        '</li>';
    for (i = start_loop; i <= end_loop; i++) {
        if (i == cur_page) {
            htmlData += '<li class="page-item active"><a class="page-link" onclick="get_data(' + i + ', \''+id+'\')">' + i + '</a></li>';
        } else {
            htmlData += '<li class="page-item"><a class="page-link" onclick="get_data(' + i + ', \''+id+'\')">' + i + '</a></li>';
        }
    }
    htmlData += '<li class="page-item">' +
        '<a class="page-link" onclick="get_data(' + no_ofPage + ')" aria-label="Next">' +
        '<span aria-hidden="true">»</span>' +
        '</a>' +
        '</li>' +
        '</ul>';
    if(arr==undefined){
        $(".pagination-panel").html(htmlData);
    }else{
        $("."+paginateClass).html(htmlData);
    }

}
function del_rec(id, route) {
    var x = confirm('Are you Sure?');
    if (!x) {
        return false;
    }
    $.ajax({
        url: route,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $("#" + id).hide();
            $(this).closest('tr').remove();
        },error:function (ajaxcontent){
            ajaxErrorToastr(ajaxcontent);
        }
    })
    if (typeof get_data == "function") {
        get_data();
    }else{
        location.reload();
    }
}
$("#select_all").change(function() {
    if(this.checked) {
        $(".records").prop("checked", true);
    }else{
        $(".records").prop("checked", false);
    }
});

function del_multiple_rec(form_id, route) {
    var x = confirm('Are you Sure?');
    if (!x) {
        return false;
    }
    $.ajax({
        url: route,
        type: 'DELETE',
        data:$('#'+form_id).serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (typeof get_data === "function") {
                get_data();
            }else{
                location.reload();
            }
        },
        error:function (){
            toastr.error("505 Something Went Wrong");
        }
    })
}





function null_val(vl)
{
	if(vl==null)
	{
		return 'N/A';
	}
	else
	{
		return vl;
	}
}
//==================Loader=================
function success_loader()
{
	$("#success-loader").html('<div class="alert alert-success alert-dismissible col-md-4 offset-md-4" style="position:absolute; z-index:1;">'+
                '<button type="button" class="close" data-dismiss="alert">×</button>'+
                '<strong>Success!</strong> your Query Submitted Successfully.'+
              '</div>').css("display","block").delay(3000).fadeOut();
}
function error_loader()
{
	$("#error-loader").html('<div class="alert alert-danger col-md-4 offset-md-4" style="position:absolute; z-index:1;">'+
	 '<button type="button" class="close" data-dismiss="alert">×</button>'+
    '<strong>Alert!</strong> Something Wrong With your query.'+
  '</div>').css("display","block").delay(3000).fadeOut();
}
//number format
function number_format(num)
{
	var numb=num.toLocaleString('en-US', {minimumFractionDigits: 2});
	return numb;
}
//simple format witout 00
function snf(num)
{
	return num.toLocaleString();
}
//purchase status
function purchase_status(status) {
    if(status==0){
        return 'Received';
    }else if(status==1){
        return 'Partial';
    }else if(status==2){
        return 'Pending';
    }else if(status==3){
        return 'Ordered';
    }
}
//transfer status
function transfer_status(status) {
    if(status==1){
        return 'Completed';
    }else if(status==2){
        return 'Pending';
    }else if(status==3){
        return 'Sent';
    }
}
//payment status
function pss(sts) {
    if(sts==1)
    {
        return 'Pending';
    }
    else if(sts==2){
        return 'Partial';
    }
    else if(sts==3){
        return 'Paid';
    }
    else{
        return 'N/A';
    }
}
//sale status
function ss(status) {
    if(status==1){
        return 'Pending';
    }else if(status==2){
        return 'Completed';
    }else{
        return 'N/A';
    }
}


function date_diff( from,to) {
    var from = moment(from);
    var to = moment(to);

    return to.diff(from, "days");
}

//a simple date formatting function
function dateFormat(inputDate, format) {
    //parse the input date
    const date = new Date(inputDate);

    //extract the parts of the date
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();

    //replace the month
    format = format.replace("MM", month.toString().padStart(2,"0"));

    //replace the year
    if (format.indexOf("yyyy") > -1) {
        format = format.replace("yyyy", year.toString());
    } else if (format.indexOf("yy") > -1) {
        format = format.replace("yy", year.toString().substr(2,2));
    }

    //replace the day
    format = format.replace("dd", day.toString().padStart(2,"0"));

    return format;
}


function business_decimal_points() {
    $.ajax({
        url:"/setting/1",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:"GET",
        dataType:"JSON",
        contentType: false,
        cache: false,
        processData: false,
        success:function (data) {
            currency_decimal = data.currency_decimal;
        },error:function (data) {
            alert('Error in currency_decimal AJAX');

        }
    });
}

function b_decimals(val){
    return Number(val).toFixed(currency_decimal);
}

function ajaxErrorToastr(ajaxcontent){
    $('.loader-bg').hide();
    if(ajaxcontent.hasOwnProperty('responseJSON')){
         if( (ajaxcontent.responseJSON.hasOwnProperty('errors') &&  ajaxcontent.responseJSON.errors.length  != 0) || (ajaxcontent.responseJSON.hasOwnProperty('data')  &&  ajaxcontent.responseJSON.data.length  != 0)){
            let errors_obj = (ajaxcontent.responseJSON.data) ? ajaxcontent.responseJSON.data : ajaxcontent.responseJSON.errors;
            if(typeof errors_obj =="string"){
                toastr.error(errors_obj);
            }else {
                $.each(errors_obj, function( index, value ) {
                    $("#payment-form input[name~='" + index + "']").css('border', '1px solid red');
                    toastr.error(value);
                });
            }
        }else if(ajaxcontent.responseJSON.hasOwnProperty('message') && ajaxcontent.responseJSON.message !="" ){
            toastr.error( ajaxcontent.responseJSON.message);
        }else if(ajaxcontent.hasOwnProperty('status')){
            toastr.error(ajaxcontent.statusText+" "+ajaxcontent.status);
        }
            }else if(ajaxcontent.hasOwnProperty('responseText')){
        toastr.error(ajaxcontent.responseText);
            }else if(ajaxcontent.hasOwnProperty('status') && ajaxcontent.hasOwnProperty('statusText') ){
        toastr.error(ajaxcontent.statusText+" "+ajaxcontent.status);
            }else{
        toastr.error("Something went wrong!");
            }
}
function ajaxSuccessToastr(ajaxcontent){
    $('.loader-bg').hide();
    if(ajaxcontent.hasOwnProperty('responseJSON') && ajaxcontent.responseJSON.status == true){
      if(ajaxcontent.responseJSON.hasOwnProperty('message')){
            toastr.success( ajaxcontent.responseJSON.message);
      }
    }else if(ajaxcontent.hasOwnProperty('message') ){
        toastr.success(ajaxcontent.message);
    }else if(ajaxcontent.hasOwnProperty('status') && ajaxcontent.status==200){
        toastr.success("Operation Successful");
    }else{
        toastr.success("Operation Successful");
    }
}



