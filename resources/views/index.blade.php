<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud App </title>
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
<link rel="stylesheet" type="text/css" href="datatables.min.css" />
</head>

<body>

    {{-- add new employee modal start --}}
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 bg-light">
                        <div class="row">
                            <div class="col-lg">
                                <label for="fname">First Name</label>
                                <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="col-lg">
                                <label for="lname">Last Name</label>
                                <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="my-2">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Phone" required>
                        </div>
                        <div class="my-2">
                            <label for="post">Post</label>
                            <input type="text" name="post" class="form-control" placeholder="Post" required>
                        </div>
                        <div class="my-2">
                            <label for="avatar">Select Avatar</label>
                            <input type="file" name="avatar" class="form-control" required>
<img src="" class="imgprev22" alt="">
<span> acacasc</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="add_employee_btn" class="btn btn-primary">Add Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- add new employee modal end --}}

    {{-- edit employee modal start --}}
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="emp_id" id="emp_id">
                    <input type="hidden" name="emp_avatar" id="emp_avatar">
                    <div class="modal-body p-4 bg-light">
                        <div class="row">
                            <div class="col-lg">
                                <label for="fname">First Name</label>
                                <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name"
                                    required>
                            </div>
                            <div class="col-lg">
                                <label for="lname">Last Name</label>
                                <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name"
                                    required>
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail"
                                required>
                        </div>
                        <div class="my-2">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" required>
                        </div>
                        <div class="my-2">
                            <label for="post">Post</label>
                            <input type="text" name="post" id="post" class="form-control" placeholder="Post" required>
                        </div>
                        <div class="my-2">
                            <label for="avatar">Select Avatar</label>
<input type="file" name="avatar" id="avatarimg" class="form-control">
                        </div>
                        <div class="mt-2" id="avatar">
<img src="" id="imgprev" alt="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="edit_employee_btn" class="btn btn-success">Update Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit employee modal end --}}
    <div class="container">
        <div class="row my-5">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                        <h3 class="text-light">Manage Employees</h3>
<button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">

    <svg width="25" height="25" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
        <path
            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
    </svg>

    Add New Employee</button>
                    </div>
                    <div class="card-body" id="show_all_employees">
                        <h1 class="text-center text-secondary my-5">Loading...</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
// delete employee ajax request
$(document).on('click', '.deleteIcon', function(e) {
e.preventDefault();
let id = $(this).attr('id');
let csrf = '{{ csrf_token() }}';
Swal.fire({
title: 'Are you sure?',
text: "You won't be able to revert this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delete it!'
}).then((result) => {
if (result.isConfirmed) {
$.ajax({
url: '{{ route('delete') }}',
method: 'delete',
data: {
id: id,
_token: csrf
},
success: function(response) {
console.log(response);
Swal.fire(
'Deleted!',
'Your file has been deleted.',
'success'
)
fetchAllEmployee();
}
});
}
})
});
function showNewImgtoRight(){
const inpFile = document.getElementById("avatarimg");
inpFile.addEventListener("change",function(){
const file = this.files[0];
if (file){
const reader = new FileReader();
reader.addEventListener("load", function(){
const img = document.getElementById("av_22");
/* var image_x = document.getElementById('av_11');
image_x.parentNode.removeChild(image_x); */
document.getElementById("av_11").style.display='none';

img.setAttribute("src", this.result);
});
reader.readAsDataURL(file);
}
})
}
        //fetch all emplyee ajax requst 
        fetchAllEmployee();
showNewImgtoRight();
        function fetchAllEmployee(){
            $.ajax({
                url:'{{route('fetchAll')}}',
                method:'get',
                success:function (res){
                   $('#show_all_employees').html(res);
                   $("table").DataTable({
                    order:[0,'desc']
                   });
 
              
                }
            });
        }
        //add new emplyee ajax reqqust
        $("#add_employee_form").submit(function(e){
            e.preventDefault();
            const fd =new FormData(this);
            $('#add_employee_btn').text('Adding...');
            $.ajax({
                url:'{{route('store')}}',
                method:'post',
                data:fd,
                cache:false,
                processData:false,
                contentType:false,
                success:function(res){
                    if(res.status == 200){
                        Swal.fire(
                            'Added!',
                            'Employee Added Successfully!',
                            'success'
                        )
                        fetchAllEmployee();
                    }
                $("#add_employee_btn").text('Add Employee');
                $("#add_employee_form")[0].reset();
                $("#addEmployeeModal").modal('hide');
                }
            })

            
        });
        //edit emplyee ajax requst 
$(document).on('click','.editIcon',function(e){
e.preventDefault();
let id =$(this).attr('id');
$.ajax({
url:'{{route('edit')}}',
method:'get',
data:{
id:id,
_token:'{{csrf_token()}}'
},
success:function(res){
$('#fname').val(res.first_name);
$('#lname').val(res.last_name);
$('#email').val(res.email);
$('#phone').val(res.phone);
$('#post').val(res.post);
$('#avatar').html(
`<img src="storage/images/${res.avatar}" width="100" id="av_11" class="img-fluid img-thumbnails">
<img src="" width="100" id="av_22" class="img-fluid img-thumbnails">
`);
$('#emp_id').val(res.id);
$('#emp_avatar').val(res.avatar);
                }
            })
        });
//delete emplyee ajax request

        //update emplyee ajax request
        $("#edit_employee_form").submit(function(e){
            e.preventDefault();
            const fd = new FormData(this);

            $("#edit_employee_btn").text('Updating...');
            $.ajax({
                url:'{{route('update')}}',
                method:'post',
                data:fd,
                cache:false,
                processData:false,
                contentType:false,
                success:function(res){
                     if(res.status == 200){
                        Swal.fire(
                            'Updated',
                            'emplyee Updated sucecessfuly ',
                            'success'
                        )
                    fetchAllEmployee();
                     }
                     $('#edit_employee_btn').text('Update emplyee');
                     $("#edit_employee_form")[0].reset();
$("#editEmployeeModal").modal('hide');
                }

            })
        })

    </script>
</body>

</html>