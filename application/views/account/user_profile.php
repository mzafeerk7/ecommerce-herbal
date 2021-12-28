<!-- Breadcumb area Start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="text-capitalize" ><?= $_SESSION['username'] ?></h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li class="current"><a href="<?= base_url().'account/profile' ?>>">My Account</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb area End -->

<!-- Main Content wrapper start -->

<section class="main-content-wrapper">
    <div class="account-wrapper pt--40 pb--80 pt-md--30 pb-md--60">
        <div class="container">
            <div class="user-dashboard-tab">
                <div class="row">
                    <div class="col-lg-2 mb-md--30">
                        <div class="user-dashboard-tab__head nav flex-column" role="tablist" aria-orientation="vertical">
                            <!-- <a class="nav-link active" data-toggle="pill" role="tab" href="#dashboard" aria-controls="dashboard" aria-selected="true">Dashboard</a> -->
                            <a class="nav-link active" data-toggle="pill" role="tab" href="#orders" aria-controls="orders" aria-selected="true">Orders</a>
                            <a class="nav-link" data-toggle="pill" role="tab" href="#accountdetails" aria-controls="accountdetails" aria-selected="true">Settings</a>
                            <a class="nav-link" href="<?= base_url().'account/logout' ?>">Logout</a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="user-dashboard-tab__content tab-content">
                            <!-- <div class="tab-pane fade show" id="dashboard">
                                <p>Hello <strong>John</strong> (not <strong>John</strong>? <a href="login.html">Log out</a>)</p>
                                <p>From your account dashboard. you can easily check & view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details</a>.</p>
                            </div> -->
                            <div class="tab-pane fade  active" id="orders">
                                <div class="account-table table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Shipping</th>
                                                <th>Total</th>
                                                <th>Payment</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($user_orders) && !empty($user_orders)): ?>
                                                <?php $s_no = 1; ?>
                                                <?php foreach($user_orders as $order): ?>
                                                    <tr class="order-box" data-id="<?= encrypt_id($order['order_id']) ?>">
                                                        <td><?= prefix_zero($order['order_id'], 5) ?></td>
                                                        <td class="wide-column"><?= $order['order_date'] ?></td>
                                                        <td class="text-capitalize"><?= $order['order_status'] ?></td>
                                                        <td>$<?= $order['shipping_charges'] ?></td>
                                                        <td class="wide-column">$<?= $order['order_total_amount'] ?></td>

                                                        <td>
                                                            <?php if(isset($order['txConfirmed']) && isset($order['processed']) &&  $order['txConfirmed'] == 1 && $order['processed'] ==1 ): ?>
                                                                Paid
                                                            <?php else: ?>
                                                                <a href="<?= base_url().'account/pay/'.encrypt_id($order['order_id']) ?>" class="text-warning">Click to Pay</a>
                                                            <?php endif;?>
                                                        </td>

                                                        <td><a href="javascript:void(0)" onclick="_product.view_order(this);" class="btn btn-medium btn-style-1">View</a></td>

                                                        
                                                    </tr>
                                                    <?php $s_no ++; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="accountdetails">
                                <div class="account-form bg--2">
                                    <form  id="change_password_form">
                                        <div class="form-row">
                                            <div class="col-12">
                                                <div id="result"></div>
                                                <h4>PASSWORD CHANGE</h4>
                                            </div>
                                        </div>
                                        <div class="form-row mb--20">
                                            <div class="col-12">
                                                <div class="form__group">
                                                    <label for="cur_password" class="form__label">Current Password</label>
                                                    <input type="password" name="cur_password" id="cur_password" class="form__input form__input--2 error">
                                                    <span class="small text-danger"></span>
                                                </div>
                                            </div>
                                        </div>                                             
                                        <div class="form-row mb--20">
                                            <div class="col-12">
                                                <div class="form__group">
                                                    <label for="new_password" class="form__label">New Password</label>
                                                    <input type="password" name="new_password" id="new_password" class="form__input form__input--2 error">
                                                    <span class="small text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mb--20">
                                            <div class="col-12">
                                                <div class="form__group">
                                                    <label for="new_password" class="form__label">Confirm Password</label>
                                                    <input type="password" name="confirm_password" id="confirm_password" class="form__input form__input--2 error">
                                                    <span class="small text-danger"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-12">
                                                <button type="button" onclick="_account.change_password();" class="btn btn-medium btn-style-2">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
  
            <!-- Order detail Modal -->
            <div class="modal fade " id="view-order-detail-modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
                    <div class="modal-content bg--2">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Order Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="account-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>QTY</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="order-items-detail">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- //.modal -->



        </div> <!-- //.container-->   
    </div>
</section>