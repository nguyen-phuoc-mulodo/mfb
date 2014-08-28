<?php require_once 'layout/header.php'; ?>
<div class="container-fluid">
  <div class="row">
     <?php require_once 'layout/sidebar.php'; ?> 
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Dashboard</h1>
        
            <?php echo form_open_multipart($action); ?>
                <div class="form-group clearfix">
                    <label class="control-label">Message</label>
                    <div class="">
                        <textarea class="form-control col-md-10" name="message" type="text" rows="5"> </textarea>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label class="control-label">Time</label>
                    <div class="">
                        <input class ="form-control col-md-10 datetime-picker" name="time" type="text"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Image URL</label>
                    <input type="url" class="form-control" name="image" />
                </div>
                <div class="form-group">
                    <input class ="btn btn-primary" type="submit" name="submit" value="submit" />
                </div>
            </form>    
      
    </div>
  </div>
</div>

<?php require_once 'layout/footer.php'; ?>
