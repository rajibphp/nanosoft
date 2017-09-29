<?php
$success = $this->session->flashdata('success');
if ($success) {
    ?>	
    <div class="box box-info">
        <div class="box-body">
            <div class="callout callout-info">
                <?php
                echo $success;
                ?>
            </div>
        </div><!-- /.box-body -->
    </div>
    <?php
}

$failed = $this->session->flashdata('failed');
if ($failed) {
    ?>	
    <div class="box box-info">
        <div class="box-body">
            <div class="callout callout-warning">
                <?php
                echo $failed;
                ?>
            </div>
        </div><!-- /.box-body -->
    </div>
    <?php
}
?>


    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $title; ?></h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url('export/export/exportDataFormat'); ?>" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-3">Category<sup>*</sup></label>
                        <div class="col-md-9">
                            <select name="category" id="category" class="form-control category">
                                <option selected="" value="all">All</option>
                                <?php 
                                    foreach ($categories as $category){ ?>
                                        <option value="<?php echo $category['id']; ?>">
                                            <?php echo $category['group_name']; ?>
                                        </option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>  
                    
                    <div class="form-group" id="sub_cat_idv" style="display: none;">
                        <label class="control-label col-md-3">Sub Category<sup>*</sup></label>
                        <div class="col-md-9">
                            <select name="sub_category" id="sub_category" class="form-control sub_category">
                                <option selected="" disabled="">All</option>
                            </select>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">Data Format<sup>*</sup></label>
                        <div class="col-md-9">
                            <select name="format" class="form-control" required="">
                                <option value="1">CSV Format</option>
                                <option value="2">TXT Format</option>
                            </select>
                        </div>
                    </div>  
                    
                    <div class="modal-footer clearfix">
                        <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Sure to Export');">
                            Export Numbers
                        </button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- page script -->

<script type="text/javascript">
$(document).ready(function(){
    $(".category").change(function(){
        var id=$(this).val();
        var dataString = 'id='+ id;
        $(".sub_category").find('option').remove();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>directory/directory_controller/get_sub_category",
            data: dataString,
            cache: false,
            success: function(html){
                $("#sub_cat_idv").fadeIn();
                $(".sub_category").html(html);                               
            } 
        });
    });
        
    $(".sub_category").change(function(){
        $("#name_div").fadeIn();
    });
                
});
</script>						 