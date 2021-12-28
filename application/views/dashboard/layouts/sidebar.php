<div class="page-sidebar">
                <a class="logo-box" href="<?= base_url().'admin/dashboard' ?>"><span>ADMIN</span><i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
                    <i class="icon-close" id="sidebar-toggle-button-close"></i></a>
                <div class="page-sidebar-inner">
                    <div class="page-sidebar-menu">
                        <ul class="accordion-menu">
                            <li>
                                <a href="<?= base_url().'admin/dashboard' ?>">
                                    <i class="menu-icon fa fa-tachometer"></i><span>Dashboard</span>
                                </a>
                            </li>
                            <li class="menu-divider"></li>
                            <li <?php if(isset($active) && $active === 'categories'){ echo 'class="active-page open"'; } ?>>
                                <a href="<?= base_url().'admin/products/categories' ?>">
                                    <i class="menu-icon icon-inbox logo-menu-email"></i><span>Categories</span>
                                </a>
                            </li>
                            <li class="menu-divider"></li>
                            <li <?php if(isset($active) && $active === 'shipping'){ echo 'class="active-page open"'; } ?>>
                                <a href="<?= base_url().'admin/manage-shipping-charges' ?>">
                                    <i class="menu-icon icon-show_chart"></i><span>Shipping($)</span>
                                </a>
                            </li>
                            <li class="menu-divider"></li>
                            <li <?php if(isset($active) && $active === 'products'){ echo 'class="active-page"'; } ?>>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-format_list_bulleted"></i><span>Products</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="<?= base_url().'admin/manage-products-list' ?>">Manage Products</a></li>
                                    <li><a href="<?= base_url().'admin/add-product' ?>">Add Product</a></li>
                                </ul>
                            </li>
                            <li class="menu-divider"></li>

                            <!-- orders -->
                            <li <?php if(isset($active) && $active === 'orders'){ echo 'class="active-page"'; } ?>>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-layers"></i><span>Orders</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="<?= base_url().'admin/products/orders/all' ?>">All</a></li>
                                    <li><a href="<?= base_url().'admin/products/orders/pending' ?>">Pending</a></li>
                                    <li><a href="<?= base_url().'admin/products/orders/processing' ?>">Processing</a></li>
                                    <li><a href="<?= base_url().'admin/products/orders/delivered' ?>">Delivered</a></li>
                                    <li><a href="<?= base_url().'admin/products/orders/cancelled' ?>">Cancelled</a></li>
                                </ul>
                            </li>
                            <li class="menu-divider"></li>


                            <!-- settings -->
                            <li <?php if(isset($active) && $active === 'settings'){ echo 'class="active-page"'; } ?>>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-gear"></i><span>Settings</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="<?= base_url().'admin/change-password' ?>">Change Password</a></li>
                                    <li><a href="<?= base_url().'admin/logout' ?>">Logout</a></li>
                                </ul>
                            </li>
                            <li class="menu-divider"></li>

                        </ul>
                    </div>
                </div>
            </div>