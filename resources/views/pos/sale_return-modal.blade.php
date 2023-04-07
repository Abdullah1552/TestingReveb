<style>
    .modal-body {
        max-height: 100%;
    }
    .modal-header {
        padding: 5px;
        border: 0px;
    }
    .modal-content {
        background: #eee !important;
    }
    @media (min-width: 992px) {
        .modal-md {
            width: 100%;
            max-width: 1300px;
        }
    }
    .col-md-1 {
        width: 12.333333% !important;
    }
    label {
        display: contents !important;
        color: #050505;
    }
    .table input[type="text"] {
        width: 100%;
        padding: 0px;
        font-size: 13px;
        text-transform: uppercase;
    }
    label {
        display: contents !important;
        color: #050505;
    }
    .card-header, .card-block {
        padding: 5px !important;
    }
    .card {
        margin-bottom: 5px !important;
    }
    hr{ margin-top: 0.5rem !important; margin-bottom: 0rem !important;}

</style>
<div class="modal fade" id="sale-return_modal">
    <div class="modal-dialog modal-md modal-md modal-sm" role="document">
        <div class="modal-content border-none">
            <form id="sale-return" enctype="multipart/form-data" >
                <input type="hidden" name="id" value="0">
                @CSRF
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:10px;"> <span aria-hidden="true">−</span> </button>
                    <h5 class="modal-title">Sale Return</h5>
                </div>
                <!-- end of modal-header -->
                <div class="modal-body plr30">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input type="text" class="form-control date" name="date" autocomplete="off" value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Location <sup class="text-danger">*</sup></label>
                                                <select class="js-example-basic-single form-control  clients select2-hidden-accessible"  name="WHID">
                                                    <option value="">Select Location</option>
                                                    {!! App\Models\WhereHouse::dropdown() !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Customer <sup class="text-danger">*</sup></label>
                                                <select class="js-example-basic-single form-control  clients select2-hidden-accessible"  name="customer_id">
                                                    <option value="">Select Customer</option>
                                                    {!! App\Models\Customer::dropdown() !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="alighaddon1"><i class="fa fa-barcode"></i> </span>
                                                <input  class="form-control" list="return_product" name="" id="return_product_id" placeholder="Please type product code and select" autocomplete="off">
                                                <datalist id="return_product">
                                                    {!! App\Models\Product::dropdown() !!}
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--row--><br>
                                <div class="panel-heading bg-primary">Order Table<sup class="text-danger">*</sup></div>
                                <div class="table-responsive" style="margin-top: 21px">
                                    <table id="return_myTable" class="table table-hover order-list table-bordered" >
                                        <thead >
                                        <tr style="background: darkgray; color: white">
                                            <th >Name</th>
                                            <th >Code</th>
                                            <th >Quantity</th>
                                            <th >Unit Price</th>
                                            <th >Discount</th>
                                            <th >Tax</th>
                                            <th >SubTotal</th>
                                            <th class="fa fa-trash" style="border: none"></th>
                                        </tr>
                                        </thead>
                                        <tbody >
                                        </tbody>
                                        <tfoot class="tfoot" >
                                        <tr>

                                            <th colspan="2" >Total</th>
                                            <th id="return_total-qty" >0</th>
                                            <th class="recieved-product-qty d-none" ></th>
                                            <th ></th>
                                            <th id="return_total-discount" >0.00</th>
                                            <th id="return_total-tax" >0.00</th>
                                            <th id="return_total" >0.00</th>
                                            <th class="fa fa-trash" style="border: none"></th>
                                        </tr>

                                        </tfoot>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Order Tax</label>
                                                <select class="js-example-basic-single form-control  clients select2-hidden-accessible" name="order_tax">
                                                    <option>No Tax</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group " style="margin-top: 6px">
                                                <label>Shipping Cost</label>
                                                <input type="number" id="return_order_shipping_input" class="form-control" name="shipping_cost" value="0">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group" style="margin-top: 6px">
                                                <label>Order Discount</label>
                                                <input type="number" id="return_order_discount_input" class="form-control" name="discount" value="0">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Attachment</label><br>
                                                <input type="file" name="attach_document" class="form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Note</label>
                                                <textarea rows="5" class="form-control" style="height: 80px" name="inovice_details"></textarea>
                                            </div>
                                            <button type="submit"  class="btn btn-mini btn-primary m-t-10">Submit</button>

                                        </div>

                                        <table class="table table-bordered " >
                                            <tbody style="user-select: auto;"><tr style="background: darkgray; color: white">
                                                <td style="user-select: auto;"><strong style="user-select: auto;">Items</strong>
                                                    <span class="pull-right" id="return_item-count" style="user-select: auto;">0(0)</span>
                                                </td>
                                                <td style="user-select: auto;"><strong style="user-select: auto;">Total</strong>
                                                    <span class="pull-right" id="return_subtotal" style="user-select: auto;">0.00</span>
                                                </td>
                                                <td style="user-select: auto;"><strong style="user-select: auto;">Order Tax</strong>
                                                    <span class="pull-right" id="return_order_tax" style="user-select: auto;">0.00</span>
                                                </td>
                                                <td style="user-select: auto;"><strong style="user-select: auto;">Order Discount</strong>
                                                    <span class="pull-right" id="return_order_discount" style="user-select: auto;">0.00</span>
                                                </td>
                                                <td style="user-select: auto;"><strong style="user-select: auto;">Shipping Cost</strong>
                                                    <span class="pull-right" id="return_shipping_cost" style="user-select: auto;">0.00</span>
                                                </td>
                                                <td><strong style="user-select: auto;">Grand Total</strong>
                                                    <input type="hidden" name="net_total" id="return_net-total">
                                                    <span class="pull-right g-total-amount asdfasdfasdf12da" id="return_grand_total">0.00</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--col-12-->
                                </div>
                                <!--row-->
                            </div>
                            <!--panel-default-->
                        </div>
                        <!--col-->
                    </div>
                    <!--row-->
                </div>
                <!-- end of modal-body -->
            </form>
        </div>
        <!-- end of modal-content -->
    </div>
    <!-- end of modal-dialog -->
</div>
