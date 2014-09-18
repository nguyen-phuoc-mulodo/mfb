<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>assets/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper" class="container-fluid">

        <?php //include_once 'layout/header.php'; ?>
        <!-- Page Content -->
        <div id="" class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <p class="clearfix"><a href="#" id="add-new-fanpage" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Add new fanpage</a></p>
                </div>        
                <?php foreach ($page_list as $item): ?>
                    <div class="col-md-4 fanpage">
                        <a href="#<?php echo $item['fanpage_id']; ?>"><img class="img-responsive" src="<?php if (!empty($item['cover'])) {echo $item['cover'];} else {echo base_url().'assets/uploads/fanpage.jpg';} ?>" /></a>
                        <a href="#<?php echo $item['fanpage_id']; ?>"><h3><?php echo $item['name']; ?></h3></a>
                    </div><!--/.fanpage-->                
                <?php endforeach; ?>           
            </div>
            <p class="help-block">Page render in: {elapsed_time}s</p>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.js"></script>
</body>

</html>
<?php include_once 'modals/add_new_fanpage.php'; ?>

