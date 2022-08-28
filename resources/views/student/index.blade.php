@extends('layouts.app')
@section('content')
{{-- Start Student Modal --}}
<div class="modal fade" id="AddStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">


        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddStudentModalLabel">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="saveform_errList"></ul>

                <ul id="save_msgList"></ul>

                <div class="form-group mb-3">
                    <label for="">Full Name</label>
                    <input type="text" required class="name form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Course</label>
                    <input type="text" required class="course form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="text" required class="email form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Phone No</label>
                    <input type="text" required class="phone form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <button type="button" class="btn btn-primary add_student" data-token="{{ csrf_token() }}">Save </button>
            </div>
        </div>
    </div>
</div>
{{-- End Student Modal --}}

{{-- start editStudentModal --}}
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddStudentModalLabel">Edit And Update Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="updateform_errList"></ul>
                <input type="hidden" id="edit_stud_id">
                <div class="form-group mb-3">
                    <label for="">Full Name</label>
                    <input type="text" id="edit_name" required class="name form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Course</label>
                    <input type="text" required id="edit_course" class="course form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="text" required id="edit_email" class="email form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Phone No</label>
                    <input type="text" required id="edit_phone" class="phone form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_student">Update </button>
            </div>
        </div>
    </div>
</div>
{{-- End editStudentModal --}}


{{-- start delete StudentModal --}}
<div class="modal fade" id="DeleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddStudentModalLabel">Delete Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="delete_stud_id">
                <h4>Are You suder You want To dlete this Datat ?</h4>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary delete_student_btn">Yes Delete </button>
            </div>
        </div>
    </div>
</div>
{{-- End delete StudentModal --}}


<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div id="success_message"></div>
            <div class="card">

                <div class="card-header">
                    <h4>Student data
                        <a href="#" data-bs-toggle="modal" data-bs-target="#AddStudentModal"
                            class="btn btn-primary float-end btn-sm">Add Student</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function(){
            fetchstudent();
            function fetchstudent(){
                
                $.ajax({
                    type:"GET",
                    url:"/fetch-student",
                    dataType:"json",
                    success: function (response) {
                        $('tbody').html("");
                        $.each(response.student, function(key , item){
                            $('tbody').append(
                                ' <tr>\
                                <td>'+item.id+' </td>\
                                <td>'+item.name+' </td>\
                                <td>'+item.email+' </td>\
                                <td>'+item.phone+' </td>\
                                <td>'+item.course+' </td>\
                <td><button type="button" value="'+item.id+'" class="edit_student btn btn-primary btn-sm">Edit</button></td>\
                <td><button type="button" value="'+item.id+'"  class="delete_student btn btn-danger btn-sm">Delete</button></td>\
                          </tr>');
                        })
                }
                });

            }
            $(document).on('click', '.add_student', function (e){
     
     $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
     });;
     // console.log("sdvsvsv");
     var data ={
         'name':$('.name').val(),
         'email':$('.email').val(),
         'phone':$('.phone').val(),
         'course':$('.course').val(),
     }

     $.ajax({
         type:"POST",
         url:"{{ route('posts.store') }}",

         data: data,
         dataType:"json",
         success: function (response) {
         if (response.status == 400){
             $('#saveform_errList').html("");
             $('#saveform_errList').addClass("alert alert-danger");
             $.each(response.errors, function(key , err_values){
                 $('#saveform_errList').append('<li>'+err_values+'</li>');
             })
         }
         else{
             $('#save_msgList').html("");
             $('#success_message').addClass('alert alert-success');
             $('#success_message').text(response.message)
             $('#AddStudentModal').find('input').val('');
             $('#AddStudentModal').modal('hide');
             fetchstudent();
         }

          	 	


     }
     });


 });

$(document).on('click','.edit_student',function(e){
    e.preventDefault()
    var stud_id=$(this).val();
    // console.log(stud_id);
    $('#editStudentModal').modal('show');
    $.ajax({
        type:"GET",
        url:"/edit-student/" + stud_id,
        dataType:"json",
        success:function (response){
            // console.log(response);
            if(response.status==400){
                $('#success_message').html("");
                $('#success_message').addClass("alert alert-alert-danger");
                $('#success_message').text(response.message);
            }else{
                $('#edit_name').val(response.student.name);
                $('#edit_email').val(response.student.email);
                $('#edit_phone').val(response.student.phone);
                $('#edit_course').val(response.student.course);
                $('#edit_stud_id').val(stud_id);
            }
        }
    })
})

$(document).on('click','.update_student',function(e){
    e.preventDefault();
    $(this).text("updating..")
    var stud_id =$('#edit_stud_id').val();
    var data ={
        'name':$('#edit_name').val(),
        'email':$('#edit_email').val(), 
        'phone':$('#edit_phone').val(),
        'course':$('#edit_course').val(),
    }
    $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
     });;
    $.ajax({
        type:"PUT",
        url:"/update-student/" + stud_id,
        data:data,
        dataType:"json",
        success:function(response){
            // console.log(response);
            if (response.status == 400) {
                $('#updateform_errList').html("");
                $('#updateform_errList').addClass("alert alert-danger");
                $.each(response.errors, function(key , err_values){
                    $('#updateform_errList').append('<li>'+err_values+'</li>');
                    $('update-student').text("Update")
                })
            }else if (response.status == 404) {
                $('#updateform_errList').html("");
                $('#success_message').addClass("alert alert-alert-success");
                $('#success_message').text(response.message);
                $('update-student').text("Update")
            }else{
                $('#updateform_errList').html("");
                $('#success_message').html("");
                $('#success_message').addClass("alert alert-alert-success");
                $('#success_message').text(response.message);
                $('#editStudentModal').modal('hide');
                $('update-student').text("Update")
                fetchstudent();
            }


        }
    })


})

$(document).on('click','.delete_student',function(e){
    e.preventDefault();
    var stud_id =$(this).val();
    // alert(stud_id);
    $('#delete_stud_id').val(stud_id);
    $('#DeleteStudentModal').modal('show');
})
$(document).on('click','.delete_student_btn',function(e){
    e.preventDefault();
    $(this).text('Deleting');
    var stud_id = $('#delete_stud_id').val();
    $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
     });;
    $.ajax({
        type:"DELETE",
        url:"/delete-student/" + stud_id,
        success:function(response){
            // console.log(response);
            $('#success_message').addClass('alert alert-success');
            $('#success_message').text(response.message);
            $('#DeleteStudentModal').modal('hide');
            $('.delete_student_btn').text('yes Delete');
            fetchstudent();
 
        }

    })
 
})











});

 
</script>
@endsection