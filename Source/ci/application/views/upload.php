<html>
<head>
    <title>Upload function</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <?php echo form_open_multipart('upload/upload_photo'); ?>
                <div class="form-group">
                    <label class="control-label">Image</label>
                    <input type="file" class="form-control" name="image" />
                    
                </div>
                <div class="form-group">
                    <input class ="btn btn-primary" type="submit" name="submit" value="submit" />
                </div>
            </form>
        </div><!--/.col-->
    </div> <!--/.row-->
</div>
</body>
</html>