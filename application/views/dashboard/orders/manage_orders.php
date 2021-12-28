<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">Manage Orders</h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-darkblue">
                    <div class="panel-heading clearfix">
                        <div id="result"></div>
                        <h4 class="panel-title"><?= ucwords($table_title) ?></h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="orders" class="display table table-data-width myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Status</th>
                                        <th>Total ($)</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr> 
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Status</th>
                                        <th>Total ($)</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    
                                </tbody> 
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add Category Modal -->
                <div class="modal fade" id="update-order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close " data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Order Detail</h4>
                            </div>
                            <div class="modal-body">
                            
                                <div class="panel-body">
                                    <span id="order-d">
                                        
                                    </span>
                                    
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="order-item-detail">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12">
                                            <form id="change-status-form">
                                                <span id="order-input-id">

                                                </span>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Status</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control form-select-options" name="order_status" id="order_status" style="padding: 0px !important;">
                                                            <option value="pending">Pending</option>
                                                            <option value="processing">Processing</option>
                                                            <option value="delivered">Delivered</option>
                                                            <option value="cancelled">Cancelled</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                <button type="button" onclick="_product.update_order_status();" class="btn btn-default">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of add category modal -->


                <!-- Update Category Modal -->
                <div class="modal fade" id="update-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close " data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Update Category</h4>
                            </div>
                            <div class="modal-body">
                                <form id="update-category-form">
                                    
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                <button type="button" onclick="_product.update_category();" class="btn btn-default">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Update of add category modal -->
            </div>
        </div><!-- Row -->
    </div>