<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/favicon.png" type="image/x-icon">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Cannibaba-login</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Gudea:400,700" rel="stylesheet">
    <link href="<?= base_url() ?>dashboard_assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>dashboard_assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link href="<?= base_url() ?>dashboard_assets/plugins/icomoon/style.css" rel="stylesheet">
    <link href="<?= base_url() ?>dashboard_assets/plugins/waves/waves.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>dashboard_assets/plugins/uniform/css/default.css" rel="stylesheet"> -->

    <!-- Theme Styles -->
    <link href="<?= base_url() ?>dashboard_assets/css/flatifytheme.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>dashboard_assets/css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>

    <!-- Page Container -->
    <div class="page-container login-page">

        <!-- Page Content -->
        <div class="page-content">

            <!-- Page Inner -->
            <div class="page-inner">
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4 ">
                            <div class="panel panel-darkblue login-box" style="margin-top: 8em; border: 1px solid #394e6f;
    text-align: center;">
                                <div class="panel-body">

                                    <!-- <h2 class="logo-name">Herbal</h2> -->
                                    <div>
                                        <img src="<?= base_url().'dashboard_assets/logo/logo.png' ?>" alt="">
                                    </div>
                                    <!-- <p class="m-t-md">Please login into your account</p> -->
                                    <div id="result"></div>
                                    <form class="m-t-md" id="admin-login-form">
                                        <div class="form-group">
                                            <input type="text" name="username" id="username" class="form-control error" placeholder="Username">
                                            <span class="small text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" class="password form-control error" placeholder="Password">
                                            <span class="small text-danger"></span>
                                        </div>
                                        <button type="button" onclick="_account.login();" class="btn btn-default btn-block">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Main Wrapper -->
            </div><!-- /Page Inner -->
        </div><!-- /Page Content -->
    </div><!-- /Page Container -->


    <!-- Javascripts -->
    <script src="<?= base_url() ?>dashboard_assets/plugins/jquery/jquery-3.1.0.min.js"></script>
    <script src="<?= base_url() ?>dashboard_assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="<?= base_url() ?>dashboard_assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>dashboard_assets/plugins/waves/waves.min.js"></script>
    <script src="<?= base_url() ?>dashboard_assets/plugins/uniform/js/jquery.uniform.standalone.js"></script>
    <script src="<?= base_url() ?>dashboard_assets/plugins/pace/pace.min.js"></script> -->
    <script src="<?= base_url() ?>dashboard_assets/js/flatifytheme.min.js"></script>
    
    <script src="<?= base_url() ?>dashboard_assets/ajax/customConfig.js"></script>
    <script src="<?= base_url() ?>dashboard_assets/ajax/account.js"></script>
</body>

</html>