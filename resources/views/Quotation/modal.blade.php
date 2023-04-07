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
<div class="modal fade" id="quotation">
    <div class="modal-dialog modal-md modal-md modal-sm" role="document">
        <div class="modal-content border-none">
            <form id="quotation-form" enctype="multipart/form-data" >
                <input type="hidden" name="id" value="0">
                @CSRF
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:10px;"> <span aria-hidden="true">−</span> </button>
                    <h5 class="modal-title">Quotation Details</h5>
                </div>
                <!-- end of modal-header -->
                <div class="modal-body plr30">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input type="text" class="form-control date" name="date" value="<?php echo date('Y-m-d') ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Location *</label>
                                                <select class="js-example-basic-single form-control  clients select2-hidden-accessible"  name="WHID">
                                                    <option value="">Select Location</option>
                                                    {!! App\Models\WhereHouse::dropdown() !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Customer</label>
                                                <select class="js-example-basic-single form-control  clients select2-hidden-accessible" name="customer_id">
                                                    <option value="">Select Customer</option>
                                                    {!! \App\Models\Customer::dropdown() !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Sale Person</label>
                                                <select class="js-example-basic-single form-control  clients select2-hidden-accessible" name="saleperson_id">
                                                    <option value="">Select SalePerson</option>
                                                    {!! \App\Models\SalePerson::dropdown() !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="alighaddon1"><i class="fa fa-barcode"></i> </span>
                                                <input  class="form-control" list="product" name="" id="product_id" placeholder="Please type product code and select" autocomplete="off">
                                                <datalist id="product">
                                                    {!! App\Models\Product::dropdown() !!}
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--row--><br>
                                <div class="panel-heading bg-primary">Order Table*</div>
                                <div class="table-responsive" style="margin-top: 21px">
                                    <table id="myTable" class="table table-hover order-list table-bordered" >
                                        <thead >
                                        <tr style="background: darkgray; color: white">
                                            <th >Name</th>
                                            <th >Code</th>
                                            <th >Quantity</th>
                                            <th class="recieved-product-qty d-none" >Received</th>
                                            {{--<th >Batch No</th>--}}
                                            {{--<th >Expired Date</th>--}}
                                            <th >Net Unit Cost</th>
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
                                            <th id="total-qty" >0</th>
                                            <th class="recieved-product-qty d-none" ></th>
                                            <th ></th>
                                            <th id="total-discount" >0.00</th>
                                            <th id="total-tax" >0.00</th>
                                            <th id="total" >0.00</th>
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
                                                    <option value="no tax">No Tax</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Shipping Cost</label>
                                                <input type="number" id="order_shipping_input" value="0" class="form-control" name="shipping_cost">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Order Discount</label>
                                                <input type="number" value="0" id="order_discount_input" class="form-control " name="discount">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Attach Document</label>
                                                <input type="file"  class="form-control " name="attach_document">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            {{--<div class="col-md-3">--}}
                                                {{--<label>Status</label>--}}
                                                {{--<select class="js-example-basic-single form-control  clients select2-hidden-accessible" name="status">--}}
                                                    {{--<option value="received">Received</option>--}}
                                                    {{--<option value="partial">Partial</option>--}}
                                                    {{--<option value="pending">Pending</option>--}}
                                                    {{--<option value="ordered">Ordered</option>--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label>Note</label>
                                                    <textarea  class="form-control" name="note"></textarea>
                                                </div>
                                            </div>
                                            <button type="submit"  class="btn btn-mini btn-primary m-t-50">Submit</button>

                                        </div>

                                        <table class="table table-bordered " >
                                            <tbody style="user-select: auto;"><tr style="background: darkgray; color: white">
                                                <td style="user-select: auto;"><strong style="user-select: auto;">Items</strong>
                                                    <span class="pull-right" id="item-count" style="user-select: auto;">0(0)</span>
                                                </td>
                                                <td style="user-select: auto;"><strong style="user-select: auto;">Total</strong>
                                                    <span class="pull-right" id="subtotal" style="user-select: auto;">0.00</span>
                                                </td>
                                                <td style="user-select: auto;"><strong style="user-select: auto;">Order Tax</strong>
                                                    <span class="pull-right" id="order_tax" style="user-select: auto;">0.00</span>
                                                </td>
                                                <td style="user-select: auto;"><strong style="user-select: auto;">Order Discount</strong>
                                                    <span class="pull-right" id="order_discount" style="user-select: auto;">0.00</span>
                                                </td>
                                                <td style="user-select: auto;"><strong style="user-select: auto;">Shipping Cost</strong>
                                                    <span class="pull-right" id="shipping_cost" style="user-select: auto;">0.00</span>
                                                </td>
                                                <td><strong style="user-select: auto;">Grand Total</strong>
                                                    <input type="hidden" name="net_total" id="net-total">
                                                    <span class="pull-right g-total-amount asdfasdfasdf12da" id="grand_total">0.00</span>
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
