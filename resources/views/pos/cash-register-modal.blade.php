<style>
    .select2-container{ width: 100% !important;}
</style>
<div class="modal" id="new-register">
    <div class="modal-dialog modal-lg">
        <form id="cash_reg-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Add Cash Register</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body panel panel-default">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Location</label>
                                <select name="register_location" id="register_location" class="form-control js-example-basic-single">
                                    <option value="">Select Warehouse</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cash in Hand</label>
                                <input type="text" required name="cash_in_hand" class="form-control" placeholder="0.00">
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="save_cash_register()">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

</div>
<div class="modal" id="cash-regiter">
    <div class="modal-dialog">
        <form id="cash-register-form" method="post" action="{{ url('sale/pos/cash-register/close') }} ">
            @CSRF
            <input type="hidden" name="cash_register_id" value="0">
            <input type="hidden" id="cash_register_status" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Cash Register Details</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table">
                        <tr class="font-weight-bold">
                            <td>Sale Person</td>
                            <td>
                                <span class="sale_person"></span>
                            </td>
                        </tr>
                        <tr class="font-weight-bold">
                            <td>Location</td>
                            <td>
                                <span class="location"></span>
                            </td>
                        </tr>
                        <tr class="font-weight-bold">
                            <td>Date</td>
                            <td>
                                <span class="date"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Cash in Hand</td>
                            <td>
                                <span class="cash_in_hand"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Cash Sale</td>
                            <td>
                                <input type="hidden" name="cash_payment" value="0">
                                <span class="cash_payment"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Sale Return</td>
                            <td>
                                <input type="hidden" name="total_sale_return" value="0">
                                <span class="total_sale_return"></span>
                            </td>

                        </tr>
                        <tr>
                            <td>Credit Card Sale</td>
                            <td>
                                <input type="hidden" name="credit_card_payment" value="0">
                                <span class="credit_card_payment"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>QR Pay Sale</td>
                            <td>
                                <input type="hidden" name="qr_code_payment" value="0">
                                <span class="qr_code_payment"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Other Sale</td>
                            <td>
                                <input type="hidden" name="other_payment" value="0">
                                <span class="other_payment">0</span>
                            </td>
                        </tr>
                        <tr style="border-bottom: double;border-top: double" class="font-weight-bold">
                            <td>Total Sale</td>
                            <td>
                                <span class="total_sale"></span>
                                <input type="hidden" name="total_sale" value="0">
                            </td>
                        </tr>
                        <tr style="border-bottom: double;border-top: double" class="font-weight-bold">
                            <td>Total Cash </td>
                            <td>
                                <span class="total_cash"></span>
                                <input type="hidden" name="total_cash" value="0">
                            </td>
                        </tr>
                    </table>
                    <!-- Modal footer -->
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="close_register">Close Register</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

</div>

<script>

    $(document).ready(function(){
        get_register_data();
        $('[data-toggle="tooltip"]').tooltip();
        let register_status=$("#register").val();
        if(register_status==3 || register_status==1) {
            @if(request()->is('sale/pos'))
            $("#new-register").modal({backdrop: 'static', keyboard: false});
            @else
            $("#new-register").modal();
            @endif
        }
    });
    function cash_register() {
        const audio = new Audio("{{ URL::asset('public/beep/beep-07.mp3') }}");
        audio.play();
        let register_status=$("#cash_register_status").val();
        if(register_status==0){
            $("#cash-regiter").modal();
        }else if(register_status==3 || register_status==1) {
            get_warehouses();
                $("#new-register").modal();
        }
    }

    function get_warehouses(){
        $.ajax({
            url:"{{ url('/warehouses/user') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"GET",
            success:function (data) {
                $('input[name~="register_location"]').html(data);
                $('#register_location').html(data);

            },error:function(ajaxcontent) {
                ajaxErrorToastr(ajaxcontent);
            }
        });
    }

    function get_register_data(){
        $.ajax({
            url:"{{ url('/sale/pos/cash-register/get_data') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"GET",
            success:function (data) {

                $('#cash_register_status').val(data.status);
                if(typeof data.register !== 'undefined' && data.register){
                    $('input[name~="cash_register_id"]').val(data.register.id);
                    $('.cash_in_hand').text(b_decimals(data.register.cash_in_hand));

                    $('span.cash_payment').text(b_decimals(data.cash_payment));
                    $('input[name~="cash_payment"]').val(data.cash_payment);

                    $('span.credit_card_payment').text(b_decimals(data.credit_card_payment));
                    $('input[name~="credit_card_payment"]').val(data.credit_card_payment);

                    $('span.qr_code_payment').text(b_decimals(data.qr_code_payment));
                    $('input[name~="qr_code_payment"]').val(data.qr_code_payment);

                    $('span.total_sale_return').text(b_decimals(data.total_sale_return));
                    $('input[name~="total_sale_return"]').val(data.total_sale_return);

                    total_sale = Number(data.cash_payment) + Number(data.credit_card_payment) +Number(data.qr_code_payment) - Number(data.total_sale_return);
                    $('span.total_sale').text(b_decimals(total_sale));
                    $('input[name~="total_sale"]').val(total_sale);

                    total_cash = Number(data.cash_payment) - Number(data.total_sale_return);
                    $('span.total_cash').text(b_decimals(total_cash));
                    $('input[name~="total_sale"]').val(total_cash);

                    $('.sale_person').text(data.register.staff.name);
                    $('.location').text(data.register.location.WH_Name);
                    var date_time = new Date(data.register.created_at);
                    let date=data.register.created_at.substring(0,10);
                    let [year, month, day] = date.split('-');
                    date = [day, month, year].join('-');

                    $('.date').text(date+' '+ date_time.getHours() + ":" + date_time.getMinutes() );


                }

            },error:function(ajaxcontent) {
                ajaxErrorToastr(ajaxcontent);
            }
        });
    }

    $("#close_register").click(function(){
        var x = confirm('Are you Sure? Want to Close Register');
        if (!x) {
            return false;
        }
        $("#cash-register-form").submit();
    });


    //save cash register
    function save_cash_register() {
        $('.loader-bg').show();
        $.ajax({
            url:"{{ url('sale/pos/cash-register') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            dataType:"JSON",
            data:$("#cash_reg-form").serialize(),
            success:function (data) {
                $("#cash_reg-form input[name~='id']").val(0);
                ajaxSuccessToastr(data);
                window.location.href='';
            },error:function(ajaxcontent) {
                ajaxErrorToastr(ajaxcontent);
            }
        });
    }
</script>
