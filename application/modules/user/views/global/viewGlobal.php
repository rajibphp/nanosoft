<div class="row">
    <div class="col-sm-12">
        <a href="#" data-toggle="modal" class="btn-primary btn-sm" data-target="#myModal">
            <i class="fa fa-plus"></i> Add New 
        </a>        
        <div class="card-box table-responsive">
            <table id="datatable-buttons2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sl = 1; 
                        foreach($listGlobal as $row){ ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td>global</td>
                                <td><?php echo $row['password']; ?></td>
                                <td>
                                    <?php
                                        if($row['status'] == 2){
                                            echo 'Used on: '.$this->common_model->dateFormatFixed($row['used']).' [Client ID: '.$row["clientId"].']';
                                        }else{ echo 'Ready to Use'; } 
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        if($loginRole['deleteAcl'] == 1){ ?>   
                                            <a href="<?php echo site_url('user/deleteGlobal/'.$row['id']); ?>" onclick="return confirm('Sure to DELETE?');"> 
                                                <i class="zmdi zmdi-delete" style="color: red;"></i> 
                                            </a>    
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
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        X
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Add</h4>
                </div>
                <form action="<?php echo site_url('user/insertGlobal'); ?>" method="post" data-parsley-validate>
                    <div class="modal-body">
                        <div class="row">                                   
                            <div class="col-sm-12 col-xs-12 col-md-12">
                                <div class="p-20">                       
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 form-control-label">username</label>
                                    <div class="col-sm-6">
                                        <input value="global" readonly class="form-control" id="name">
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="password" class="col-sm-4 form-control-label">
                                        Password<span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-6">
                                        <input required name="password" value="<?php echo date('ymdis'); ?>" readonly class="form-control" id="password">
                                    </div>
                                </div>
                            </div>
                        </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">
                            Close
                        </button>
                        <button onclick="return(confirm('Sure to ADD?'));" id="submit" type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </form>
            </div>
    </div>
    </div></div>