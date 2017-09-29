<?php require 'includes/header_start.php'; ?>

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/others/css/bootstrap-datetimepicker.min.css">
<!--<link rel="stylesheet" type="text/css" media="screen" href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">-->

<!-- X-editable css -->
<link type="text/css" href="<?php echo base_url(); ?>assets/plugins/x-editable/css/bootstrap-editable.css" rel="stylesheet">

<!--Morris Chart CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
<link href="<?php echo base_url(); ?>assets/js/for_datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/js/for_datepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet"/>
<link href="<?php echo base_url(); ?>assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/fullcalendar/dist/fullcalendar.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/custombox/css/custombox.min.css" rel="stylesheet">

<script src="<?php echo base_url(); ?>assets/others/js/jquery.min.js" type="text/javascript"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>-->
<!--<script src="<?php echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>assets/others/js/age.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/raphael/raphael-min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/others/css/bootstrap.min.css">
<?php 
    if(!empty($cssFile)){ ?>
        <!--client details page-->
        
        <script src="<?php echo base_url(); ?>assets/others/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/others/js/3.2.1-jquery.min.js"></script>
    <?php }
    if(!empty($combinedCss)){
        echo '<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">';
    }
?>

<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>-->


<?php require 'includes/header_end.php'; ?>

<style type="text/css" media="print">
    @media print{    
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
    @page{
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
</style>
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
                        <h5 class="page-title"><?php echo $title; ?></h5>                     
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

    <!--for modals-->
    <script src="<?php echo base_url(); ?>assets/plugins/custombox/js/custombox.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/custombox/js/legacy.min.js"></script>
    <!--for modals-->

<!--Morris Chart-->

<!-- Validation js (Parsleyjs) -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/parsleyjs/parsley.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();
        });
    </script>

<!-- Page specific js -->
<script src="<?php echo base_url(); ?>assets/pages/jquery.dashboard.js"></script>

<!-- XEditable Plugin -->
    <script src="<?php echo base_url(); ?>assets/plugins/moment/moment.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/x-editable/js/bootstrap-editable.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/pages/jquery.xeditable.js"></script>
    <!--<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>-->
    
    <!--for view data-tables-->
    <!-- Required datatable js -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function () { $('#formId').parsley('isValid');
            $('#datatable').DataTable();            
            //Buttons examples
            var table = $('#datatable-buttons').DataTable({
                lengthChange: true,
                orderable: false,
                buttons: ['copy', 'excel', 'pdf', 'colvis'],
                "ordering": false
            });

            table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        });
    </script>
    <!--for view data-tables-->
    
    
<!--for multiple select options-->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

 <!--Autocomplete--> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/autocomplete/jquery.mockjax.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/autocomplete/jquery.autocomplete.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/autocomplete/countries.js"></script>

<!--this line must be comments out-->
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/pages/jquery.autocomplete.init.js"></script>-->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/pages/jquery.formadvanced.init.js"></script>
<!--for multiple select options-->
    
<?php require 'includes/footer_end.php' ?>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/others/js/validation.js"></script>

<script>   
    $(function() { 
        $('#reservation').daterangepicker({
            format: 'YYYY/MM/DD'
        });
        
        var year = (new Date).getFullYear();
        $('#leaveDates').daterangepicker({
            format: 'YYYY/MM/DD',
            minDate: new Date(year, 0, 1),
            maxDate: new Date(year, 11, 31),
        });

        var today = new Date(); 
        var firstDate = new Date(today.getFullYear(), today.getMonth(0), 1);
        var lastDate = new Date(today.getFullYear(), today.getMonth(0), 31);       
        $('#currentMonth').datepicker({
            format: 'yyyy/mm/dd',
            startDate: firstDate,
//            startDate: '-1m',
            endDate: lastDate
        }).on('changeDate', function(e) {
                $(this).datepicker('hide');
            });
       
        $('#common_date1').datepicker({
            format: 'yyyy/mm/dd',
            endDate: '+0d',
        }).on('changeDate', function(e) {
            $(this).datepicker('hide');
        }); 
        $('#common_date2').datepicker({
            format: 'yyyy/mm/dd',
            endDate: '+0d',
        }).on('changeDate', function(e) {
            $(this).datepicker('hide');
        }); 
               
        $('.common_date1').datepicker({
            format: 'yyyy/mm/dd',
            endDate: '+0d',
        }).on('changeDate', function(e) {
            $(this).datepicker('hide');
        });        
        $('.common_date2').datepicker({
            format: 'yyyy/mm/dd',
            endDate: '+0d',
        }).on('changeDate', function(e) {
            $(this).datepicker('hide');
        });        
    });
    $(function() {
        $('#exp_date').datepicker({
            format: 'yyyy/mm/dd',
            endDate: '+0d',
        }).on('changeDate', function(e) {
            $(this).datepicker('hide');
        });
        $('#pass_drive_exp').datepicker({
            format: 'yyyy/mm/dd',
        }).on('changeDate', function(e) {
            $(this).datepicker('hide');
        });
        $('#checkInDate').datepicker({
            format: 'yyyy/mm/dd',
        }).on('changeDate', function(e) {
            $(this).datepicker('hide');
        });
        $('.commonClass').datepicker({
            format: 'yyyy/mm/dd',
        }).on('changeDate', function(e) {
            $(this).datepicker('hide');
        });
    });   
</script>

<script src="<?php echo base_url(); ?>assets/js/for_datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/for_datepicker/daterangepicker.js" type="text/javascript"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.5/tinymce.min.js'></script>
<script>
    tinymce.init({
        selector: '#note22',
        toolbar: false
    });      
    tinymce.init({
        selector: '#note33',
        toolbar: false
    });    

    $(function() {
        $('#datetimepicker').datetimepicker({
            format: 'hh:mm',
            pickDate: false,
            pick12HourFormat: true,
        });    
        $('#datetimepicker1').datetimepicker({
            format: 'hh:mm',
            pickDate: false,
            pick12HourFormat: true,
        });
        $('#datetimepicker2').datetimepicker({
            format: 'hh:mm',
            pickDate: false,
            pick12HourFormat: true,
        });
    });
</script>