<!-- Modal -->
<?php echo form_open('fanpage/add_fanpage'); ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add new fanpage</h4>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label>Select a fanpage</label>
                        <select class="form-control" name="fanpage">
                            <?php if (!empty($user_pages)): ?>
                                <?php foreach($user_pages as $item): ?>
                                    <option value="<?php echo $item['id'] ?>" ><?php echo $item['name'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>                            
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" name="submit" class="btn btn-primary" value="Save"/>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php echo form_close(); ?>