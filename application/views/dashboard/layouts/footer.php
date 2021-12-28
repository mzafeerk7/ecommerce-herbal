        <!-- Javascripts -->
        <script src="<?= base_url() ?>dashboard_assets/plugins/jquery/jquery-3.1.0.min.js"></script>
        <script src="<?= base_url() ?>dashboard_assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>dashboard_assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>

        <!-- these are required only for dashboard -->
        <?php $test = false ?>
        <?php if(isset($test) && $test === true): ?>
            <script src="<?= base_url() ?>dashboard_assets/plugins/waves/waves.min.js"></script>
            <script src="<?= base_url() ?>dashboard_assets/plugins/uniform/js/jquery.uniform.standalone.js"></script>
            <script src="<?= base_url() ?>dashboard_assets/plugins/switchery/switchery.min.js"></script>
            <script src="<?= base_url() ?>dashboard_assets/plugins/d3/d3.min.js"></script>
            <script src="<?= base_url() ?>dashboard_assets/plugins/nvd3/nv.d3.min.js"></script>
            <script src="<?= base_url() ?>dashboard_assets/plugins/flot/jquery.flot.min.js"></script>
            <script src="<?= base_url() ?>dashboard_assets/plugins/flot/jquery.flot.time.min.js"></script>
            <script src="<?= base_url() ?>dashboard_assets/plugins/flot/jquery.flot.symbol.min.js"></script>
            <script src="<?= base_url() ?>dashboard_assets/plugins/flot/jquery.flot.resize.min.js"></script>
            <script src="<?= base_url() ?>dashboard_assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
            <script src="<?= base_url() ?>dashboard_assets/plugins/flot/jquery.flot.pie.min.js"></script>
            <script src="<?= base_url() ?>dashboard_assets/plugins/chartjs/chart.min.js"></script>
            <script src="<?= base_url() ?>dashboard_assets/plugins/pace/pace.min.js"></script>

            <script src="<?= base_url() ?>dashboard_assets/js/pages/dashboard.js"></script>
        <?php endif; ?>

        <!-- for datatables -->
        <?php if(isset($datatables_link) && $datatables_link === true): ?>
            <script src="<?= base_url() ?>dashboard_assets/plugins/datatables/js/jquery.datatables.min.js"></script>
            <!-- <script src="<?= base_url() ?>dashboard_assets/js/pages/table-data.js"></script> -->
        <?php endif; ?>

        <script src="<?= base_url() ?>dashboard_assets/js/flatifytheme.min.js"></script>

        <!-- ----------------------------------------------------------------------------------------- -->

        <!-- For confirmation alert -->
        <script src="<?= base_url() ?>dashboard_assets/jquery-confirm/jquery.confirm.min.js"></script>

        <!-- Dropify -->
        <?php if(isset($dropify) && $dropify === true): ?>
            <script src="<?= base_url() ?>dashboard_assets/Dropify/js/dropify.min.js"></script>
        <?php endif; ?>

        <!-- custom links -->
        <script src="<?= base_url() ?>dashboard_assets/ajax/customConfig.js"></script>
        <script src="<?= base_url() ?>dashboard_assets/ajax/product.js"></script>
        <script src="<?= base_url() ?>dashboard_assets/ajax/account.js"></script>

        <!-- for categories -->
        <?php if(isset($categories_link) && $categories_link === true): ?>
            <script>
                $(document).ready(function(){
                    //$('#categories').dataTable();
                    _product.get_categories();
                });
            </script>
        <?php endif; ?>

        <!-- for shipping-->
        <?php if(isset($shipping_link) && $shipping_link === true): ?>
            <script>
                $(document).ready(function(){
                    //$('#categories').dataTable();
                    _product.get_shipping_charges();
                });
            </script>
        <?php endif; ?>

        <!-- for orders -->
        <?php if(isset($orders_link) && $orders_link === true): ?>
            <script>
                $(document).ready(function(){
                    _product.get_orders();
                });
            </script>
        <?php endif; ?>
        
        <!-- for products -->

        <!-- for add product -->
        <?php if(isset($products_link['add_product']) && $products_link['add_product'] === true): ?>
        <script>
            $(document).ready(function(){
                $('.dropify').dropify();

            });
        </script>
        <?php endif; ?>
        <!-- manage products -->
        <?php if(isset($products_link) && $products_link === true): ?>
            <script>
                $(document).ready(function(){
                    $('#products').DataTable();
                });
            </script>
        <?php endif; ?>
        <!-- end of  products -->