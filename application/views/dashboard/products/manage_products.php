<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">Manage Products</h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-darkblue">
                    <div class="panel-heading clearfix">
                        <div id="result"></div>
                        <h4 class="panel-title">Products
                        <span class="pull-right"><a href="<?= base_url().'admin/add-product' ?>" class="btn btn-default btn-addon m-b-xxs" ><i class="fa fa-plus"></i> Add Product</a></span>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="products" class="display table table-data-width myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php if(isset($products) && !empty($products)): ?>
                                        <?php $s_no = 1 ; ?>
                                        <?php foreach($products as $product): ?>
                                            <tr class="product-box" data-id="<?= encrypt_id($product['p_id']) ?>">
                                                <td><?= $s_no; ?></td>
                                                <td><img src="<?= base_url().'assets/img/products/'.$product['p_thumb'] ?>" alt="" style="
                                                    height: 3em;
                                                    width: 3em;
                                                "></td>
                                                <td><?= ucwords($product['p_title']) ?></td>
                                                <td><?= ucwords($product['c_title']) ?></td>
                                                <td>$<?= $product['p_price'] ?></td>
                                                <td>
                                                    <select onchange="_product.change_product_status(this);" class="form-control form-select-options"  id="product_status" style="padding: 0px !important; max-width: 6em">
                                                        <?php if($product['p_status'] == '1'): ?>
                                                            <option selected value="1">Active</option>
                                                            <option  value="0">Inactive</option>
                                                        <?php elseif($product['p_status'] == '0'): ?>
                                                            <option  value="1">Active</option>
                                                            <option selected value="0">Inactive</option>
                                                        <?php endif; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url().'admin/update-product/'.encrypt_id($product['p_id']) ?>" class="text-success" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> / 
                                                    <a href="javascript:void(0);" onclick="_product.delete_product(this);" class="text-danger"><i class="fa fa-times mr-5" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                            <?php $s_no ++ ; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
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