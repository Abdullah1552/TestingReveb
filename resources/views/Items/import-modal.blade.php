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
</style>
<div class="modal fade" id="import-modal">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header refEdit">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:10px;">
                    <span aria-hidden="true">−</span></button>
            </div>
            <!-- end of modal-header -->
            <div class="modal-body plr30 panel panel-default">
                <form id="import-products-form" method="post" action="/items/import-products" enctype="multipart/form-data">
                    @csrf
                    <h3><b>Import Products</b></h3>
                    <ol style="font-size: 11px;font-size: 11px;background-color: #efbfbf;border-color: #efbfbf;color: #f30f19;font-weight: bolder;">
                        <li>Click on the "Download Sample File" button to download sample file.</li>
                        <li>Fill the sample file according to the pattern.</li>
                        <li>Don't change the Column headings.</li>
                        <li>Category Field Must be Written. if it exists in system it will asigned otherwise it will created.</li>
                        @if(woo_state())
                        <li>Soon it will be updated to Wordpress.</li>
                        @endif
                        <li>Upload the completed file.</li>
                        <li>System allows only 1000 rows.</li>
                    </ol>
                    <input type="file" class="form-control" name="file" accept=".csv">

                    <div class="row" style="padding: 13px;">
                        <div class="form-group col-md-12">
                            <a href="/public/sample-downloadable-files/Sample-import-products.csv" target="_blank" class="pull-left"><button type="button" class="btn btn-mini btn-primary"><i class="fa fa-cloud-download "></i> Download Sample File</button></a>
                            <button type="button" class="btn btn-mini btn-white pull-right" data-dismiss="modal" aria-label="Close"><i class="fa fa-close" ></i> Close</button>
                            <button type="submit" class="btn btn-mini btn-success save-rec pull-right"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end of modal-body -->
        </div>
        <!-- end of modal-content -->
    </div>
    <!-- end of modal-dialog -->
</div>
