<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Role Name</th>
                        <th>Permission Table</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sl = 1;
                        foreach($roles as $row){ ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>

                                <td><?php echo $row['role']; ?> </td>
                                <td>
                                    <?php
                                        if($row['viewAcl']==1){
                                            echo 'VIEW ';
                                        }
                                        if($row['addAcl']==1){
                                            echo '&nbsp;&nbsp;&nbsp;&nbsp; ADD  ';
                                        }
                                        if($row['editAcl']==1){
                                            echo '&nbsp;&nbsp;&nbsp;&nbsp;  EDIT/UPDATE ';
                                        }
                                        if($row['deleteAcl']==1){
                                            echo '&nbsp;&nbsp;&nbsp;&nbsp;  DELETE ';
                                        }
                                        if($row['changeStatus']==1){
                                            echo '&nbsp;&nbsp;&nbsp;&nbsp;  CHANGE STATUS ';
                                        }
                                        if($row['download']==1){
                                            echo '&nbsp;&nbsp;&nbsp;&nbsp;  DOWNLOAD ';
                                        }
                                        if($row['approveReject']==1){
                                            echo '&nbsp;&nbsp;&nbsp;&nbsp;  APPROVE/REJECT ';
                                        }
                                        if($row['allAcl']==1){
                                            echo '&nbsp;&nbsp;&nbsp;&nbsp;  ALL';
                                        }
                                    ?> 
                                </td>
                                <td> 
                                    <?php
                                        if($row["role"] != "GLOBAL" && $row["role"] != "DEMO"){ 
                                            if($loginRole['editAcl'] == 1){ ?>   
                                                <a href="<?php echo site_url('user/editRole/'.$row['id']); ?>">
                                                     <i class="zmdi zmdi-edit"></i> 
                                                 </a>&nbsp;&nbsp;&nbsp;
                                               <?php }

                                               if($loginRole['deleteAcl'] == 1){ ?>   
                                                    <a href="<?php echo site_url('user/deleteRole/'.$row['id']); ?>" onclick="return confirm('Sure to delete?');"> 
                                                        <i class="zmdi zmdi-delete" style="color: red;"></i> 
                                                    </a>      
                                            <?php }
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