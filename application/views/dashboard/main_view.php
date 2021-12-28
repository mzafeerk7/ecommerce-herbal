<!DOCTYPE html>
<html lang="en">
    
    <!-- head -->
    <?php $this->load->view('dashboard/layouts/head'); ?>
    <body>
        
        <!-- Page Container -->
        <div class="page-container">
            <!-- Page Sidebar -->
            <?php $this->load->view('dashboard/layouts/sidebar'); ?>
            <!-- /Page Sidebar -->
            
            <!-- Page Content -->
            <div class="page-content">
            
                <!-- Page Header -->
                <?php $this->load->view('dashboard/layouts/header'); ?>
                <!-- /Page Header -->
                
                <?php $this->load->view($page_content); ?>
            </div><!-- /Page Content -->
        </div><!-- /Page Container -->
        
        
        <!-- footer -->
        <?php $this->load->view('dashboard/layouts/footer'); ?>
    </body>

</html>