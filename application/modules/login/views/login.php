<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <meta name="developer" content="Rajib Hossain">
        <!-- App Favicon -->
        <!--<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">-->
        <!-- App title -->
        <title>
            <?php if(isset($title)){ echo $title; }else{ echo "ABH World"; } ?>
        </title>
        <!-- App CSS -->
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css"/>

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
        <script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>       
        <style>
            body  {
                background-image: url("<?php echo base_url();?>assets/me/img/pond.jpg");
            }
        </style>
    </head>
    <body>        
        <div class="row" style="margin-top: 10%">
            <div class="col-md-4"></div>
            <div class="col-md-3">
                <div class="wrapper-page">
                    <div class="account-bg">
                        <div class="card-box m-b-0">
                            <div class="text-xs-center m-t-20">
                                <a href="index.php" class="logo">
                                    <!--<i class="zmdi zmdi-group-work icon-c-logo"></i>-->
                                    <span>Nanosoft</span>
                                </a>
                            </div>
                            <div class="m-t-10 p-10">
                                <div class="row">
                                    <div class="col-xs-12 text-xs-center">
                                        <?php 
                                            $success = $this->session->flashdata('success');
                                            $failed = $this->session->flashdata('failed');
                                            if (isset($success)) {
                                                echo "<p style='text-align: center;color: green; padding-top: 10px;font-size: 16px;'>".
                                                        $success
                                                    ."</p>";
                                            }
                                            if (isset($failed)) {
                                                echo "<p style='text-align: center;color: red; padding-top: 10px;font-size: 16px;'>".
                                                        $failed
                                                    ."</p>";
                                            } 
                                        ?>
                                    </div>
                                </div>
                                <form action="<?php echo site_url('login/loginCheck'); ?>" method="post">
                                    <div class="form-group row">
                                        <div class="col-xs-12">
                                            <input class="form-control" name="name" required="" value="nanosoft" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xs-12">
                                            <input class="form-control" name="password" type="password" readonly="" required="" value="nanosoft">
                                        </div>
                                    </div>
                                    <div class="form-group text-center row m-t-10">
                                        <div class="col-xs-12">
                                            <button class="btn btn-success btn-block waves-effect waves-light" type="submit">
                                                Log In
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </body>
</html>