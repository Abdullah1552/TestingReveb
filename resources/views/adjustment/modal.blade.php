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

<div class="modal fade" id="new">

    <div class="modal-dialog modal-md modal-md modal-sm" role="document">

        <div class="modal-content border-none">

            <form id="adjustment-form" enctype="multipart/form-data" >

                <input type="hidden" name="id" value="0">

                @CSRF

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:10px;"> <span aria-hidden="true">−</span> </button>

                    <h5 class="modal-title">Adjustment Details</h5>

                </div>

                <!-- end of modal-header -->

                <div class="modal-body plr30">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="panel panel-default">

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="col-md-4">

                                            <div class="form-group">

                                                <label>Location <sup class="text-danger">*</sup></label>

                                                <select class="js-example-basic-single form-control" name="WHID">

                                                    <option value="">Select Location</option>

                                                    {!! App\Models\WhereHouse::dropdown() !!}

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">

                                                <label>Reference <sup class="text-danger">*</sup></label>

                                                <input type="text" name="reference" required class="form-control">

                                            </div>

                                        </div>

                                        <!-- <div class="col-md-4">

                                            <div class="form-group">

                                                <label>Attach Document</label>

                                                <input type="file" name="attached_document" class="form-control form-control-sm" style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);">

                                            </div>

                                        </div> -->

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

                                            <th>Code</th>

                                            <th>Qty</th>

                                            <th >Action</th>

                                            <th class="fa fa-trash" style="border: none"></th>

                                        </tr>

                                        </thead>

                                        <tbody >

                                        </tbody>

                                        <tfoot class="tfoot" >

                                        <tr></tr>

                                        </tfoot>

                                    </table>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="row">

                                            <div class="col-md-12">

                                                <div class="col-md-12">

                                                    <div class="form-group">

                                                        <label>Note</label>

                                                        <textarea  class="form-control" rows="5" name="inovice_details"></textarea>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-12">

                                            <button type="submit"  class="btn btn-mini btn-primary pull-right">Submit</button>

                                        </div>

                                        <br>

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

