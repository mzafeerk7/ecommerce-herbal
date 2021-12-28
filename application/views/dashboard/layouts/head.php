<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicons -->
        <link rel="shortcut icon" href="<?= base_url() ?>assets/img/favicon.png" type="image/x-icon">
        <link rel="apple-touch-icon" href="assets/img/icon.png">
        
        
        <!-- Title -->
        <title>CANNIBABA-Dashboard</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Gudea:400,700" rel="stylesheet">
        <link href="<?= base_url() ?>dashboard_assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>dashboard_assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>dashboard_assets/plugins/icomoon/style.css" rel="stylesheet">

        <!-- for dashboard if required then load it -->
        <?php $check = false; ?>
        <?php if(isset($check) && $check === true): ?>
            <link href="<?= base_url() ?>dashboard_assets/plugins/waves/waves.min.css" rel="stylesheet">
            <link href="<?= base_url() ?>dashboard_assets/plugins/uniform/css/default.css" rel="stylesheet">
            <link href="<?= base_url() ?>dashboard_assets/plugins/switchery/switchery.min.css" rel="stylesheet"/>
            <link href="<?= base_url() ?>dashboard_assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet">  
        <?php endif; ?>

        <!-- for datatables -->
        <?php if(isset($datatables_link) && $datatables_link === true): ?>
            <link href="<?= base_url() ?>dashboard_assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
            <link href="<?= base_url() ?>dashboard_assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>	
        <?php endif; ?>
      
        <!-- Theme Styles -->
        <link href="<?= base_url() ?>dashboard_assets/css/flatifytheme.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>dashboard_assets/css/custom.css" rel="stylesheet">
        
        <!-- dropify -->
        <?php if(isset($dropify) && $dropify === true): ?>
            <link href="<?= base_url() ?>dashboard_assets/dropify/css/dropify.min.css" rel="stylesheet">
        <?php endif; ?>


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!--   my links -->
    </head>