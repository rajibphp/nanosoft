<div class="row">
    <div class="col-xs-12">
        <div class="card-box">

            <div class="row">
                <form action="<?php echo site_url('user/insert'); ?>" enctype="multipart/form-data" method="post" data-parsley-validate>
                    
                    <div class="col-sm-12 col-xs-12 col-md-5">
                        <div class="p-20">                                       
                            <input type="hidden" id="editId" name="editId" value="<?php echo $login['id']; ?>">
                            <div class="form-group row">
                                <label class="col-sm-4">
                                    Type<span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-6">                               
                                    <input type="radio" name="type" id="employee" value="1" <?php if($login['empId']>0){ echo 'checked'; } ?>>
                                    <label for="employee">Employee</label>
                                    &nbsp;
                                    <input type="radio" name="type" id="general" value="0" <?php if($login['empId']==0){ echo 'checked'; } ?>>
                                    <label for="general">General</label>                       
                                </div>
                            </div> 
                            
                            <div id="empDiv" class="form-group row" style="display: <?php if($login['empId']==0){ echo 'none'; } ?>;">
                                <label for="empId" class="col-sm-4 form-control-label">
                                   Employee<span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-6">
                                    <select id="empId" name="empId" class="c-select form-control select2">
                                        <option selected="" disabled="">---</option>
                                        <?php 
                                            foreach($employees as $emp){ ?>
                                               <option value="<?php echo $emp['id']; ?>" <?php if($emp['id']==$login['empId']){ echo 'selected'; } ?>>
                                                   <?php echo $emp['empName'].' ['.$emp['desig'].']'; ?>
                                               </option> 
                                            <?php } 
                                        ?>                                                                                             
                                    </select>
                                </div>
                            </div>
                            
                            <div id="generalDiv" class="form-group row" style="display: <?php if($login['empId']>0){ echo 'none'; } ?>">
                                <label for="name" class="col-sm-4 form-control-label">
                                    Full Name<span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-6">
                                    <input placeholder="Sunil Shetty" name="name" type="text" parsley-trigger="change" data-parsley-length="[3, 25]" value="<?php echo $login['login']; ?>" class="form-control" id="name">
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="username" class="col-sm-4 form-control-label">
                                    Username<span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-6">
                                    <input required="" name="username" type="text" parsley-trigger="change" data-parsley-length="[5, 25]" value="<?php echo $login['username']; ?>" class="form-control" id="username">
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label for="changePass" class="col-sm-4 form-control-label">
                                    Change Password?
                                </label>
                                <div class="col-sm-6">
                                    <select id="changePass" name="changePass" class="c-select form-control">                                                            
                                        <option value="0">No</option>                                                                                     
                                        <option value="1">Yes</option>                                                                                     
                                    </select>
                                </div>
                            </div> 
                                                           
                            <div id="passDiv" style="display: none;">
                                <div class="form-group row">
                                    <label for="password" class="col-sm-4 form-control-label">
                                       Password<span class="text-danger">*</span>
                                   </label>
                                    <div class="col-sm-6">
                                        <input type="password" name="password" type="text" parsley-trigger="change" id="password" placeholder="Password" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role" class="col-sm-4 form-control-label">
                                    Role<span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-6">
                                    <select id="role" required="" name="role" class="c-select form-control" >
                                        <option selected="" disabled="">Select</option>                                                                                             
                                        <?php 
                                            foreach($roles as $role){
                                                if($role["role"] !="GLOBAL"){ ?>
                                                <option value="<?php echo $role['id']; ?>"
                                                    <?php 
                                                        if($role['id'] == $login['role']){
                                                            echo "selected";
                                                        }                                                                             
                                                    ?>>
                                                    <?php echo $role['role']; ?>
                                                </option> 
                                            <?php } }
                                        ?>                                                                                             
                                    </select>

                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="status" class="col-sm-4 form-control-label">
                                    Status<span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-6">
                                    <select name="status" id="status" class="c-select form-control" required="">                                                            
                                        <?php 
                                            foreach($status as $k=>$val){ ?>
                                                <option value="<?php echo $k; ?>"
                                                    <?php 
                                                        if($k == $login['status']){
                                                            echo "selected";
                                                        }                                                                             
                                                    ?>>
                                                    <?php echo $val; ?>
                                                </option> 
                                            <?php } 
                                        ?>                                                                                   
                                    </select>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <div class="col-sm-8 col-sm-offset-4">
                                   <button type="submit" onclick="return confirm('Sure?');" id="submit" class="btn btn-primary waves-effect waves-light"> 
                                       Update
                                   </button>
                                   <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                       Reset
                                   </button>
                                    <a href="<?php echo site_url('user'); ?>" class="btn btn-dribbble waves-effect m-l-5">
                                       Back
                                   </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-xs-12 col-md-7" style="margin-left: -30px;">
                        <center><b style="color: red;">Access Control List</b></center>
                        <div class="card-box table-responsive" style="height: 350px;">
                            <table  id="datatable-buttons2" class="table table-striped table-bordered" cellspacing="0" width="%">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Menu</th>
                                        <th>Access</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $sl=1;
                                    foreach($menuList as $row){ ?>
                                    <tr>
                                        <td><?php echo $sl++; ?></td>
                                        
                                        <td>
                                            <?php 
                                                echo '<span style="color: green;">'.$row['name'].'</span><br>'; 
                                                if($row['url'] != ''){ ?>
                                                    <?php
                                                        $aclMenuId = ' ';
                                                        foreach($loginAcl as $acl){
                                                            if($acl['menuId']==$row['id']){
                                                                $aclMenuId = $row['id'].'-';
                                                            }
                                                        }
                                                    ?>
                                                    <input type="hidden" id="menuId_<?php echo $row['id'].'-'; ?>" value="<?php echo $aclMenuId; ?>" name="menuId[]">
                                                    <input type="hidden" value="<?php echo $row['id']; ?>" name="mainMenuId[]">
                                                    <?php 
                                                        if($row['parent_id']==0 && $row['is_parent']==0){ 
                                                            $parentId = $row['id'];
                                                        }else{
                                                            $parentId = $row['parent_id'];
                                                        }
                                                    ?>
                                                    <input type="hidden" value="<?php echo $parentId; ?>" name="parentMenuId[]">
                                                <?php }
                                                
                                                foreach($row[0] as $subMenu){  
                                                    echo '<span style="margin-left: 50px">'.$subMenu['title'].'</span><br>'; ?> 
                                                    <?php 
                                                        $aclMenuId2 = '';   
                                                        foreach($loginAcl as $acl){
                                                            if($acl['menuId']==$subMenu['id'] && $acl['mainMenuId']==$subMenu['menuId']){
                                                                $aclMenuId2 = $subMenu['id'];
                                                            }
                                                        }
                                                    ?>
                                                    <input type="hidden" id="menuId_<?php echo $subMenu['id']; ?>" value="<?php echo $aclMenuId2; ?>" name="menuId[]">
                                                    <input type="hidden" value="<?php echo $row['id']; ?>" name="mainMenuId[]">
                                                    <input type="hidden" value="<?php echo $row['parent_id']; ?>" name="parentMenuId[]">
                                            <?php }
                                            ?>
                                        </td>
                                        
                                        <td>
                                            <?php
                                                if($row['url'] != ''){ ?>
                                                    <?php
                                                        $viewAclChecked = ' ';
                                                        $viewAclMenuId = ' ';
                                                        foreach($loginAcl as $acl){
                                                            if($acl['menuId']==$row['id'] && $acl['viewAcl']==$row['id']){
                                                                $viewAclChecked = 'checked';
                                                                $viewAclMenuId = $row['id'].'-'; 
                                                            } 
                                                        }
                                                    ?>
                                                    <input type="checkbox" <?php echo $viewAclChecked; ?> onclick="myFunction($(this).attr('id'));" id="viewAcl_<?php echo $row['id'].'-'; ?>" class="viewAcl" value="<?php echo $row['id']; ?>">
                                                    <input type="hidden" value="<?php echo $viewAclMenuId; ?>" id="viewAcl2_<?php echo $row['id'].'-'; ?>" name="viewAcl[]">
                                                <?php }
                                                
                                                echo '<br>';
                                                foreach($row[0] as $subMenu){ ?>
                                                    <?php 
                                                        $viewAclChecked = '';
                                                        $viewAclMenuId = ' ';
                                                        foreach($loginAcl as $acl){
                                                            if($acl['menuId']==$subMenu['id'] && $acl['mainMenuId']==$subMenu['menuId']){
                                                                $viewAclChecked = 'checked'; 
                                                                $viewAclMenuId = $subMenu['id']; 
                                                            }
                                                        }
                                                    ?>
                                                    <input type="checkbox" <?php echo $viewAclChecked; ?> onclick="myFunction($(this).attr('id'));" id="viewAcl_<?php echo $subMenu['id']; ?>" class="viewAcl" value="<?php echo $subMenu['id']; ?>">
                                                    <input type="hidden" value="<?php echo $viewAclMenuId; ?>" id="viewAcl2_<?php echo $subMenu['id']; ?>" name="viewAcl[]"><br>
                                            <?php }
                                            ?>                                        
                                        </td>
                                    </tr>
                                <?php }
                                ?>
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
    $(document).ready(function(){         
        $("#employee").click(function(){  
           $("#empDiv").show(); 
           $("#generalDiv").hide(); 
           document.getElementById("empId").required = true;
           document.getElementById("name").required = false;
        });
        $("#general").click(function(){  
           $("#empDiv").hide(); 
           $("#generalDiv").show(); 
           document.getElementById("empId").required = false;
           document.getElementById("name").required = true;
        });
    });
    function myFunction(id){
        var id_arr = id.split("_");
        var elementId = id_arr[1];        

        if(document.getElementById(id).checked) {
            $("#menuId_" + elementId).val(elementId);
            
        }else{
            var viewAcl = document.getElementById('viewAcl_' + elementId);
            var allAcl = document.getElementById('allAcl_' + elementId);
            if(viewAcl.checked){
                $("#menuId_" + elementId).val(elementId);
            }else{
                $("#menuId_" + elementId).val(' ');
            }
        }
        
        if(document.getElementById(id).checked) {               
            $("#viewAcl2_" + elementId).val(elementId);
        } else {
            $("#viewAcl2_" + elementId).val(' ');
        } 
    }   
    $(document).on("blur", "#username", function(e){ 
        var val = $(this).val().trimLeft();
        var id = "<?php echo $login['id']; ?>";
        var fieldId = $("#username");
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('user/chkDuplicateUpdate'); ?>",
            data: {action: val, id: id},
            dataType: 'json',
            success: function(data){  
                if(data == 1){ 
                    disabledMsg(fieldId);
                }else{
                    enabledMsg(fieldId);
                }
            }  
        });
     });    
    $(document).ready(function(){                             
        $("#changePass").click(function(){ 
            var val = $(this).val().trimLeft(); 
            if(val == 1){
                $("#passDiv").show();
                document.getElementById("password").required = true;
            }else{
                $("#passDiv").hide();
                document.getElementById("password").required = false;
            }
        });

    });   
</script>