<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sl = 1;
                        foreach($users as $row){ ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php if($row['empId']>0){ echo 'Employee'; }else{ echo 'General'; } ?> </td>
                                <td>
                                    <?php 
                                        if($row['empId']>0){
                                            echo $row['empName']; 
                                        }else{ 
                                            echo $row['login'];
                                        }
                                    ?>
                                </td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['role']; ?></td>

                                <td>
                                    <?php
                                        if($row['status'] == 0){
                                            echo "<span style='color: red;'>Inactive</span>";
                                        }else{
                                            echo "<span style='color: green;'>Active</span>";
                                        }
                                    ?> 
                                </td>

                                <td>
                                    <?php 
                                        if($row["username"] != "global" && $row["username"] != "demo1"){ 
                                            if($row['roleId']!=1){  
                                                if($loginRole['editAcl'] == 1){ ?>   
                                                    <a href="<?php echo site_url('user/edit/'.$row['id']); ?>">
                                                        <i class="zmdi zmdi-edit"></i> 
                                                    </a>&nbsp;&nbsp;&nbsp;
                                                <?php }
                                                if($loginRole['deleteAcl'] == 1){ ?>   
                                                    <a href="<?php echo site_url('user/delete/'.$row['id']); ?>" onclick="return confirm('Sure to DELETE?');"> 
                                                        <i class="zmdi zmdi-delete" style="color: red;"></i> 
                                                    </a>    
                                                <?php }
                                            }       
                                        }
                                    ?>             
                                </td>
                            </tr>
                        <?php }
                    ?>
                </tbody>
            </table>           
        </div>
    </div>
</div>