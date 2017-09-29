<div class="row">
    <div class="col-xs-10 col-lg-10 col-xl-10">
        <div class="card-box">
            <div class="text-xs-center">
                <h4 class="header-title m-t-0 m-b-20">Yearly Statistics of Students</h4>
                <ul class="list-inline chart-detail-list m-b-0">

                    <li class="list-inline-item">
                        <h6 style="color: #0B62A4;"><i class="zmdi zmdi-triangle-down m-r-5"></i>Male</h6>
                    </li>
                    <li class="list-inline-item">
                        <h6 style="color: #7A92A3;"><i class="zmdi zmdi-triangle-up m-r-5"></i>Female</h6>
                    </li>
                </ul>
            </div>

            <div id="morris-bar-stacked2" style="height: 320px;"></div>

        </div>
    </div><!-- end col-->
</div>
<script type="text/javascript">

    showBar();
    function showBar(){ 
            $.ajax({
                type: 'ajax',
                url: '<?php echo site_url('dashboard/getBar') ?>',
                async: false,
                dataType: 'json',
                success: function(data2){
                    Morris.Bar({
                        element: 'morris-bar-stacked2',
                        data: data2,
                        xkey: 'y',
                        ykeys: ['a', 'b'],
                        labels: ['Male (Max age)', 'Female (Max age)']
                    });
                },
                error: function(){
                    alert('could not get data from database');
                }
            });
        }
    // Morris.Bar({
    //     element: 'morris-bar-stacked2',
    //     data: <?php //echo $statics; ?>,
    //     xkey: 'y',
    //     ykeys: ['a', 'b'],
    //     labels: ['Male (Max age)', 'Female (Max age)']
    // });
</script>


<div class="container" style="width: 75%;">
    <div class="alert alert-success" style="display: none;">
        
    </div>
    <button id="btnAdd" class="btn btn-success btn-sm">Add New</button>
    <table class="table table-bordered" style="margin-top: 20px;">
        <thead>
            <tr>
                <td>ID</td>
                <td>Student Name</td>
                <td>Gender</td>
                <td>Age</td>
                <td>Year</td>
                <td>Updated at</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody id="showStudents">
            
        </tbody>
    </table>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <form id="myForm" action="" method="post" class="form-horizontal">
            <input type="hidden" name="id" value="0">
            <div class="form-group">
                <label for="name" class="label-control col-md-4">Student Name</label>
                <div class="col-md-8">
                    <input id="name" required="" type="text" name="name" class="form-control" placeholder="Rajib Hossain" maxlength="55">
                </div>
            </div>

            <div class="form-group">
                <label class="label-control col-md-4">Gender</label>
                <div class="col-md-8">
                    <label for="female">
                        <input id="female" value="female" type="radio" name="gender"> Female
                    </label>
                    <label for="male" class="label-control col-md-4">
                        <input checked="" id="male" value="male" type="radio" name="gender"> Male
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="age" class="label-control col-md-4">Age</label>
                <div class="col-md-8">
                    <input id="age" required="" type="text" name="age" class="form-control" placeholder="31" maxlength="3">
                </div>
            </div>

            <div class="form-group">
                <label for="year" class="label-control col-md-4">Year</label>
                <div class="col-md-8">
                    <select name="year" id="year" class="form-control">
                        <?php 
                            for($i=2010; $i<= date('Y'); $i++){ 
                                ($i===date('Y') ? $selected = 'selected' : $selected = '');
                                echo '<option selected="'.$selected.'" value="'.$i.'">'.$i.'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnSave" class="btn btn-primary">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        Do you want to delete this record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    $(function(){
        $('#btnAdd').click(function(){
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Add New Student');
            $('#myForm').attr('action', '<?php echo site_url('dashboard/insertStudent'); ?>')
        });

        $('#btnSave').click(function(){
            var url = $('#myForm').attr('action');
            var data = $('#myForm').serialize();
            var name = $('input[name=name]');
            var gender = $('input[name=gender]');
            var age = $('input[name=age]');
            var year = $('input[name=year]');
            var result = '';

            if(name.val()==''){
                name.parent().parent().addClass('has-error');
            }else{
                name.parent().parent().removeClass('has-error');
                result += '1';
            }

            if(age.val()==''){
                age.parent().parent().addClass('has-error');
            }else{
                age.parent().parent().removeClass('has-error');
                result += '2';
            }


            if(result=='12'){
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#myModal').modal('hide');
                            $('#myForm')[0].reset();
                            if(response.type=='add'){
                                var type = 'added'
                            }else if(response.type=='update'){
                                var type = 'updated'
                            }
                            $('.alert-success').html('Student '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
                            $('#morris-bar-stacked2').html('');
                            showBar();
                            showStudents();
                        }else{
                            alert('Error');
                        }
                    },
                    error: function(){
                        alert('could not save');
                    }
                });
            }
        });

        //editing
        $('#showStudents').on('click', '.item-edit', function(){
            var id = $(this).attr('data');
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Edit Student');
            $('#myForm').attr('action', '<?php echo site_url('dashboard/updateStudent'); ?>');
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: '<?php echo site_url('dashboard/editStudent'); ?>',
                data: { id: id },
                async: false,
                dataType: 'json',
                success: function(data){
                    $('input[name=id]').val(data.id);
                    $('input[name=name]').val(data.name);
                    if(data.gender == 'Female'){ 
                        $('#female').attr("checked", 'checked'); 
                    }else{ $('#male').attr("checked", 'checked'); }

                    $('input[name=age]').val(data.age);
                    $('input[name=year]').val(data.year); 

                    $('#year').append('<option selected value="' +  data.year + '">' +  data.year + '</option>'); 
                },
                error: function(){
                    alert('could not edit data');
                }
            });
        });

        //deleting
        $('#showStudents').on('click', '.item-delete', function(){
            var id = $(this).attr('data');
            $('#deleteModal').modal('show');
            $('#deleteModal').find('.modal-title').text('Confirm Delete');
            $('#btnDelete').unbind().click(function(){
                $.ajax({
                    type: 'ajax',
                    method: 'get',
                    url: '<?php echo site_url('dashboard/deleteStudent'); ?>',
                    data: { id: id },
                    async: false,
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#deleteModal').modal('hide');
                            $('.alert-success').html('Student deleted successfully').fadeIn().delay(4000).fadeOut('slow');
                            $('#morris-bar-stacked2').html('');
                            showBar();
                            showStudents();  
                        }else{
                            alert('Error');
                        }     
                    },
                    error: function(){
                        alert('Error deleting');
                    }
                });
            });
        });

        //showing
        
        showStudents();
        function showStudents(){
            $.ajax({
                type: 'ajax',
                url: '<?php echo site_url('dashboard/getStudents') ?>',
                async: false,
                dataType: 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                    '<td>'+data[i].id+'</td>'+
                                    '<td>'+data[i].name+'</td>'+
                                    '<td>'+data[i].gender+'</td>'+
                                    '<td>'+data[i].age+'</td>'+
                                    '<td>'+data[i].year+'</td>'+
                                    '<td>'+data[i].updated_at+'</td>'+
                                    '<td>'+
                                        '<a href="javascript:;" class="btn btn-info btn-sm item-edit" data="'+data[i].id+'">Edit</a>'+
                                        '<a href="javascript:;" class="btn btn-danger btn-sm item-delete" data="'+data[i].id+'">Delete</a>'+
                                    '</td>'+
                                '</tr>';
                    }
                    $('#showStudents').html(html);
                },
                error: function(){
                    alert('could not get data from database');
                }
            });
        }
    });
</script>