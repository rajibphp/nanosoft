<div class="row">
    <div class="col-xs-12">
        <div class="card-box">

            <div class="row">
                <form action="<?php echo site_url('user/insertRole'); ?>" enctype="multipart/form-data" method="post" data-parsley-validate>
                    
                    <div class="col-sm-12 col-xs-12 col-md-4">
                       <div class="p-20">                                       
                            <br>
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 form-control-label">
                                    Role Name<span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-6">
                                    <input required="" name="name" type="text" parsley-trigger="change" data-parsley-length="[3, 25]"   placeholder="Admin" class="form-control" id="name">
                                </div>
                            </div> 
                            <br>
                            <div class="form-group row">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <?php 
                                        if($loginRole['addAcl'] != 1){
                                           echo $loginRole[0]['addAcl'];
                                        }else{ ?>   
                                            <button type="submit" onclick="return(confirm('Sure?'));" id="submit" class="btn btn-primary waves-effect waves-light">
                                                Save
                                            </button>
                                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                                Cancel
                                            </button>   
                                    <?php }  
                                    ?>
                                </div>
                            </div>

                       </div>
                    </div>
                    
                    <div class="col-sm-12 col-xs-12 col-md-8">
                        
                        <div class="card-box table-responsive">
                            <center><b style="color: red;">Permission Table</b></center>
                            <table  id="datatable-buttons2" class="table table-striped table-bordered" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th><label for="viewAcl">VIEW</label></th>
                                        <th><label for="addAcl">ADD</label></th>
                                        <th><label for="editAcl">EDIT/UPDATE</lable></th>
                                        <th><label for="deleteAcl">DELETE</label></th>
                                        <th><label for="changeStatus">CHANGE STATUS</label></th>
                                        <th><label for="download">DOWNLOAD</label></th>
                                        <th><label for="approveReject">APPROVE/REJECT</label></th>
                                        <th><label for="allAcl">ALL</label></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input name="viewAcl" type="checkbox" onclick="myFunction($(this).attr('id'));" id="viewAcl" class="viewAcl" value="1">                                     
                                        </td>
                                        <td>
                                            <input name="addAcl" type="checkbox" onclick="myFunction($(this).attr('id'));" id="addAcl" class="addAcl" value="1">                                     
                                        </td>
                                        <td>
                                            <input name="editAcl" type="checkbox" onclick="myFunction($(this).attr('id'));" id="editAcl" class="editAcl" value="1">                                     
                                        </td>
                                        <td>
                                            <input name="deleteAcl" type="checkbox" onclick="myFunction($(this).attr('id'));" id="deleteAcl" class="deleteAcl" value="1">                                     
                                        </td>
                                        <td>
                                            <input name="changeStatus" type="checkbox" onclick="myFunction($(this).attr('id'));" id="changeStatus" class="changeStatus" value="1">                                     
                                        </td>
                                        <td>
                                            <input name="download" type="checkbox" onclick="myFunction($(this).attr('id'));" id="download" class="download" value="1">                                     
                                        </td>
                                        <td>
                                            <input name="approveReject" type="checkbox" onclick="myFunction($(this).attr('id'));" id="approveReject" class="approveReject" value="1">                                     
                                        </td>
                                        <td>
                                            <input name="allAcl" type="checkbox" onclick="myFunction($(this).attr('id'));" id="allAcl" class="allAcl" value="1">                                     
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

               </form> 
            </div>
           
        </div>
    </div><!-- end col-->
</div>

<script type="text/javascript">
    var viewAcl = document.getElementById('viewAcl');
    var addAcl = document.getElementById('addAcl');
    var editAcl = document.getElementById('editAcl');
    var deleteAcl = document.getElementById('deleteAcl');
    var changeStatus = document.getElementById('changeStatus');
    var download = document.getElementById('download');
    var approveReject = document.getElementById('approveReject');
    var allAcl = document.getElementById('allAcl');
    
    $('#submit').click(function() {    
        if(viewAcl.checked || addAcl.checked || editAcl.checked || deleteAcl.checked || changeStatus.checked || download.checked || approveReject.checked){
        }else{
            alert("Select at least one from PERMISSION TABLE");
            return false;      
        }  
    });
    
    function myFunction(id){ 
        if(id=='allAcl'){ 
            if(document.getElementById(id).checked) { 
                $("#viewAcl").prop("checked", true);
                $("#addAcl").prop("checked", true);
                $("#editAcl").prop("checked", true);
                $("#deleteAcl").prop("checked", true);
                $("#changeStatus").prop("checked", true);
                $("#download").prop("checked", true);
                $("#approveReject").prop("checked", true);
                    
            } else {
                $("#viewAcl").prop("checked", false);
                $("#addAcl").prop("checked", false);
                $("#editAcl").prop("checked", false);
                $("#deleteAcl").prop("checked", false);
                $("#changeStatus").prop("checked", false);
                $("#download").prop("checked", false);
                $("#approveReject").prop("checked", false);
            }
            
        }else{            
            if(id!='allAcl'){
                if(viewAcl.checked && addAcl.checked && editAcl.checked && deleteAcl.checked && changeStatus.checked && download.checked && approveReject.checked){
                    $("#allAcl").prop("checked", true);
                }else{
                    $("#allAcl").prop("checked", false);       
                }               
            } 
        }
    }  
    
    $(document).on("blur", "#name", function(e){ 
        var val = $(this).val().trimLeft();
        var fieldId = $("#name");
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('user/chkDupRole'); ?>",
            data: {action: val},
            dataType: 'json',
            success: function(data){ 
               if(data == 1){ 
                   disabledMsg(fieldId);
               }else if(data == 0){
                   enabledMsg(fieldId);
               }
            }  
        });
    });
</script>