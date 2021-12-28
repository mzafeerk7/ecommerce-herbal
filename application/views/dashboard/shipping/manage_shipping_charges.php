<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">Manage</h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-darkblue">
                    <div class="panel-heading clearfix">
                        <div id="result"></div>
                        <h4 class="panel-title">Countries & Shipping Charges
                            <span class="pull-right"><button type="button" class="btn btn-default btn-addon m-b-xxs" data-toggle="modal" data-target="#add-shipping-charge"><i class="fa fa-plus"></i> Add Shipping Charge</button></span>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="shipping" class="display table table-data-width myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Country Title</th>
                                        <th>Shipping Charge($)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Country Title</th>
                                        <th>Shipping Charge($)</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add Country and shipping charge Modal -->
                <div class="modal fade" id="add-shipping-charge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close " data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Add Shipping Charge</h4>
                            </div>
                            <div class="modal-body">
                                <form id="add-shipping-charge-form">
                                    <div class="form-group">
                                        <label for="title">Country Title</label>
                                        <input type="text" class="form-control error" name="title" id="title" placeholder="Title">
                                        <span class="small text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Shipping Charges($)</label>
                                        <input type="integer" class="form-control error" name="charge" id="charge" placeholder="$">
                                        <span class="small text-danger"></span>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                <button type="button" onclick="_product.add_shipping_charges();" class="btn btn-default">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of add category modal -->


                <!-- Update Country and Shipping Modal -->
                <div class="modal fade" id="update-shipping-charge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close " data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Update Shipping Charge</h4>
                            </div>
                            <div class="modal-body">
                                <form id="update-shipping-charge-form">
                                    
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                <button type="button" onclick="_product.update_shipping_charge();" class="btn btn-default">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Update of add category modal -->

            </div>
        </div><!-- Row -->
    </div>