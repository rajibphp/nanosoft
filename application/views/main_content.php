<?php require 'includes/header_start.php'; ?>


<script src="<?php echo base_url(); ?>assets/others/js/jquery.min.js" type="text/javascript"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>-->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/others/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/others/css/bootstrap-theme.min.css" crossorigin="anonymous">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
<script src="<?php echo base_url(); ?>assets/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/raphael/raphael-min.js"></script>

<?php 
    if(!empty($cssFile)){ ?>
        <!--client details page-->
        
        <script src="<?php echo base_url(); ?>assets/others/js/bootstrap.min.js"></script>
       
    <?php }

?>

<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>-->


<?php require 'includes/header_end.php'; ?>

<style>
    .ownerLab, .rightAlign{
        text-align: right;
    }
</style>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title" style="color: red;">Assignment Test by Nanosoft for SENIOR PHP DEVELOPER</h4>    
                             <p><br> 
                                <p>Backend: PHP(CodeIgniter/HMVC), MySQL 
                                <br>Frontend: JavaScript(Ajax)<br>
                                <br>Assigned by: Mr. MH Sajib, Nanosoft Limited
                                <br>Developed by: Rajib Hossain
                                <br>Project Duration: 2 days
                            </p>            
                            <h6 align="center">
                                <b style="color: green;">
                                    <?php if(!empty($success = $this->session->flashdata('success'))){ echo $success; } ?>
                                </b> 
                            </h6>                          
                            <h6 align="center">
                                <b style="color: red;">
                                    <?php if(!empty($failed = $this->session->flashdata('failed'))){ echo $failed; } ?>
                                </b>
                            </h6>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>            
            <?php echo $main_content; ?>
        </div>
    </div> <!-- content -->
</div>
<!-- End content-page -->


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->

<?php require 'includes/footer_start.php'; ?>
    
<?php require 'includes/footer_end.php' ?>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/others/js/validation.js"></script>