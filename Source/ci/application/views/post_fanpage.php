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
    
    <!-- My Style -->
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

        <?php include_once 'layout/header.php'; ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Geekboy</h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <?php echo form_open_multipart(''); ?>
                    <div class="form-group clearfix">
                        <label class="control-label">Message</label>
                        <div class="">
                            <textarea class="form-control col-md-10" name="message" type="text" rows="5"> </textarea>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="control-label">Publish now</label>
                        <div class="">
                            <label class="radio-inline">
                                <input type="radio" name="publish" id="" value="true" checked=""> Yes
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="publish" id="" value="false"> No
                            </label>                  
                        </div>
                    </div>        
                    <div class="form-group clearfix">
                        <label class="control-label">Time</label>
                        <div class="">
                            <input class ="form-control col-md-10 datetime-picker" name="time" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Image</label>
                        <input type="file" class="form-control" name="image" />
                    </div>
                    <div class="form-group">
                        <input class ="btn btn-primary" type="submit" name="submit" value="submit" />
                    </div>
                <?php echo form_close(); ?>              
            </div>
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

