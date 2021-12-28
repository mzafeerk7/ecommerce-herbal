<!doctype html>
<html class="no-js" lang="zxx">


<!-- head -->
<?php $this->load->view('layouts/head'); ?>

<body>


    <!-- Main Wrapper Start -->
    <div class="wrapper bg--shaft">
        <!-- Header Area Start -->
        <?php $this->load->view('layouts/header'); ?>
        <!-- Header Area End -->


        <!-- Main Content Wrapper Start -->
            <?php $this->load->view($page_content); ?>
        <!-- Main Content Wrapper Start -->

        <!-- Footer Start -->
        <?php $this->load->view('layouts/footer'); ?>
        <!-- Footer End -->

        <!-- Scroll To Top Start -->    
        <a class="scroll-to-top" href="#"><i class="fa fa-angle-double-up"></i></a>
        <!-- Scroll To Top End -->

        

        <!-- Modal Start -->
        <!-- Modal End -->

    </div>
    <!-- Main Wrapper End -->


<!-- footer links -->
<?php $this->load->view('layouts/footer_links'); ?>

</body>


</html>