<!-- Page Inner -->
<div class="page-inner no-page-title">
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-darkblue">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Products
                            <span class="pull-right text-warning"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
                        </h4>
                    </div>
                    <div class="panel-body dashboard-panel">
                        <div class="browser-stats">
                            <ul class="list-unstyled">
                                <li style="font-size: 1.3em !important;">
                                    <?php if(isset($total_products)): ?>
                                        <span class="text-warning">Total<div class=" pull-right"><?= $total_products ?></div></span>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-darkblue">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Orders
                            <span class="pull-right text-success"><i class="fa fa-slack" aria-hidden="true"></i></span>
                        </h4>
                    </div>
                    <div class="panel-body dashboard-panel">
                        <div class="browser-stats">
                            <ul class="list-unstyled">
                                <li style="font-size: 1.3em !important;">
                                    <?php if(isset($total_orders)): ?>
                                        <span class="text-success">Total<div class=" pull-right"><?= $total_orders ?></div></span>
                                    <?php endif;?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-darkblue">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title ">Users
                            <span class="pull-right text-primary"><i class="fa fa-users" aria-hidden="true"></i></span>
                        </h4>
                    </div>
                    <div class="panel-body dashboard-panel">
                        <div class="browser-stats">
                            <ul class="list-unstyled">
                                <li style="font-size: 1.3em !important;">
                                    <?php if(isset($total_users)): ?>
                                        <span class="text-primary">Total<div class=" pull-right"><?= $total_users ?></div></span> 
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- Row -->

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-darkblue">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Recently Placed Orders</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="orders" class="table myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($last_5_orders) && !empty($last_5_orders)): ?>
                                        <?php $s_no = 1;  ?>
                                        <?php foreach($last_5_orders as $order): ?>
                                            <tr>
                                                <th scope="row"><?= $s_no; ?></th>
                                                <td><?= $order['order_id'] ?></td>
                                                <td><?= ucwords($order['order_status']) ?></td>
                                                <td>$<?= $order['order_total_amount'] ?></td>
                                                <td><?= $order['order_date'] ?></td>
                                                <?php if(isset($order['txConfirmed']) && $order['txConfirmed'] == 1 && isset($order['processed']) && $order['processed'] == 1): ?>
                                                    <td class="text-success">Paid</td>
                                                <?php else: ?>
                                                    <td class="text-danger">Unpaid</td>
                                                <?php endif; ?>
                                                <td>
                                                <a href="javascript:void(0);" onclick="_product.view_order(this);" id="<?= encrypt_id($order['order_id']) ?>" class="text-success" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        <?php $s_no ++;  ?>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        
            
            <!--  Modal -->
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
                                                <input type="hidden" id="act" name="act" value="recent_order">
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

        </div><!-- Row -->
    </div><!-- Main Wrapper -->
