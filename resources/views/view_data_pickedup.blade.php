<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Children Pickedup Register</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('backend/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <!-- Custom styles for this page -->
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Responsive styles for this template-->
    <link href="{{ asset('backend/css/responsive.css') }}" rel="stylesheet">

    <!--Own css Style -->
    <link href="{{ asset('backend/css/main.css') }}" rel="stylesheet">

    {{-- <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" /> --}}

</head>

{{-- add new child modal start --}}
<div class="modal fade" id="addChildModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Child</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" name="add_child_form" id="add_child_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="col-lg">
                            <label for="fname">First Name<span class="text-danger">*</span></label>
                            <input type="text" name="fname" class="form-control" placeholder="First Name">
                        </div>
                        <div class="col-lg">
                            <label for="lname">Last Name<span class="text-danger">*</span></label>
                            <input type="text" name="lname" class="form-control" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="dbirth">Date of birth<span class="text-danger">*</span></label>
                            <input type="date" id="birthday" name="birthday" class="form-control">
                        </div>
                        <div class="col-lg">
                            <label for="phone">Class<span class="text-danger">*</span></label>
                            <select name="class_name" id="class_name" class="form-control">
                                <option class="dropdown-item" value="" selected="" disabled="">Select Class
                                </option>
                                <option class="dropdown-item" value="I">I
                                </option>
                                <option class="dropdown-item" value="II">II
                                </option>
                                <option class="dropdown-item" value="III">III
                                </option>
                                <option class="dropdown-item" value="IV">IV
                                </option>
                                <option class="dropdown-item" value="V">V
                                </option>
                                <option class="dropdown-item" value="VI">VI
                                </option>
                                <option class="dropdown-item" value="VII">VII
                                </option>
                                <option class="dropdown-item" value="VIII">VIII
                                </option>
                                <option class="dropdown-item" value="IX">IX
                                </option>
                                <option class="dropdown-item" value="X">X
                                </option>
                                <option class="dropdown-item" value="XI">XI
                                </option>
                                <option class="dropdown-item" value="XII">XII
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="my-2">
                        <label for="address">Address <span class="text-danger">*</span></label>
                        <textarea name="address" id="textarea" class="form-control" placeholder="Enter Address"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg">

                            <label for="country">Country<span class="text-danger">*</span></label>
                            <select name="country" id="country-dropdown" class="form-control">
                                <option class="dropdown-item" value="" selected="" disabled="">Select
                                    Country </option>
                                @foreach ($countries as $country)
                                    <option class="dropdown-item" value="{{ $country->id }}">
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-lg">
                            <label for="state">State<span class="text-danger">*</span></label>
                            <select class="form-control" name="state" id="state-dropdown">
                                <option class="dropdown-item" value="" selected="" disabled="">Select
                                    State
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="city">City<span class="text-danger">*</span></label>
                        <select id="city-dropdown" name="city" class="form-control">
                            <option class="dropdown-item" value="" selected="" disabled="">Select City
                            </option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-lg">

                            <label for="zipcode">Zip Code<span class="text-danger">*</span></label>
                            <input type="number" id="zip_code" name="zip_code" maxlength="7"
                                class="form-control" placeholder="Enter 7-digit zip code">

                        </div>
                        <div class="col-lg ch_Photo">
                            <label for="childphoto">Child Photo<span class="text-danger">*</span></label>

                            <input type="file" id="child_photo" name="child_photo" class="form-control"
                                onchange="photo_validation(this)">

                            <img src="{{ asset('/upload/photo/No-image-found.jpg') }}" id="mainThmb" width="90px"
                                height="90px" style=" position:relative;top:20px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add_child_btn" class="btn btn-primary">Add Child</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add new child modal end --}}


{{-- edit child modal start --}}
<div class="modal fade" id="editChildModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Child Details</h5>
                <button type="button" class="btn-close close_btn" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="#" method="POST" id="edit_child_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="child_id" id="child_id">
                <input type="hidden" name="old_child_photo" id="child_photo1">
                <div class="modal-body p-4 bg-light">

                    <div class="row">
                        <div class="col-lg">
                            <label for="fname">First Name<span class="text-danger">*</span></label>
                            <input type="text" name="fname" id="fname" class="form-control"
                                placeholder="First Name">
                        </div>
                        <div class="col-lg">
                            <label for="lname">Last Name<span class="text-danger">*</span></label>
                            <input type="text" name="lname" id="lname" class="form-control"
                                placeholder="Last Name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="birthday">Date of birth<span class="text-danger">*</span></label>
                            <input type="date" id="birthday1" name="birthday" class="form-control">
                        </div>
                        <div class="col-lg">
                            <label for="phone">Class<span class="text-danger">*</span></label>
                            <select name="class_name" id="class_name1" class="form-control">
                                <option class="dropdown-item" value="" selected="" disabled="">Select
                                    Class
                                </option>
                                <option class="dropdown-item" value="I">I
                                </option>
                                <option class="dropdown-item" value="II">II
                                </option>
                                <option class="dropdown-item" value="III">III
                                </option>
                                <option class="dropdown-item" value="IV">IV
                                </option>
                                <option class="dropdown-item" value="V">V
                                </option>
                                <option class="dropdown-item" value="VI">VI
                                </option>
                                <option class="dropdown-item" value="VII">VII
                                </option>
                                <option class="dropdown-item" value="VIII">VIII
                                </option>
                                <option class="dropdown-item" value="IX">IX
                                </option>
                                <option class="dropdown-item" value="X">X
                                </option>
                                <option class="dropdown-item" value="XI">XI
                                </option>
                                <option class="dropdown-item" value="XII">XII
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="my-2">
                        <label for="address">Address <span class="text-danger">*</span></label>
                        <textarea name="address" id="address1" class="form-control" placeholder="Enter Address"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg">

                            <label for="country">Country<span class="text-danger">*</span></label>
                            <select name="country" id="country-dropdown1" class="form-control">
                                <option class="dropdown-item" value="" selected="" disabled="">Select
                                    Country </option>
                                @foreach ($countries as $country)
                                    <option class="dropdown-item" value="{{ $country->id }}">
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-lg">
                            <label for="state">State<span class="text-danger">*</span></label>
                            <select class="form-control" name="state" id="state-dropdown1">
                                <option class="dropdown-item" value="" selected="" disabled="">Select
                                    State
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="city">City<span class="text-danger">*</span></label>
                        <select id="city-dropdown1" name="city" class="form-control">
                            <option class="dropdown-item" value="" selected="" disabled="">Select City
                            </option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-lg">

                            <label for="zipcode">Zip Code<span class="text-danger">*</span></label>
                            <input type="number" id="zip_code1" name="zip_code" maxlength="7"
                                class="form-control" placeholder="Enter 7-digit zip code">

                        </div>
                        <div class="col-lg ch_Photo">
                            <label for="childphoto">Child Photo</label>

                            <input type="file" id="child_photo1" name="new_child_photo" class="form-control"
                                onchange="photo_validation1(this)">
                        </div>

                    </div>
                    <div class="mt-2 text-center" id="avatar">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="edit_child_btn" class="btn btn-success">Update Child</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- edit child modal end --}}


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 admin-main-header">Children Pickedup CURD Operation using Ajax,noify toaster ,
                        sweet alert</h1>
                    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row align-items-center">
                                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-8 col-8">
                                    <h6 class="m-0 font-weight-bold text-primary">Children Pickedup Details</h6>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-4"> <a
                                        href="{{ route('children_register') }}"
                                        class="d-sm-inline-block btn btn-primary shadow-sm" title="Add Data"><i
                                            class="fa fa-plus" aria-hidden="true"></i> Single Page Register</a></div>

                                <button class="d-sm-inline-block btn btn-light shadow-sm" data-bs-toggle="modal"
                                    data-bs-target="#addChildModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                    Add New
                                    Child</button>
                            </div>
                        </div>
                        <div class="card-body" id="show_all_employees">
                            <h1 class="text-center text-secondary my-5">Loading...</h1>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Children Pickedup</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>




    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    {{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script> --}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>


    <!-- Core plugin JavaScript-->
    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script> --}}

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>

    <!-- library js validate -->
    {{-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/additional-methods.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))

            var type = "{{ Session::get('alert-type', 'info') }}"

            switch (type) {

                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(function() {

            // add new child ajax request
            $("#add_child_form").submit(function(e) {
                e.preventDefault();

                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": true,
                    "positionClass": "toast-top-right"
                };

                const fd = new FormData(this);

                $("#add_child_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('store') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {

                        if (response.status == 200) {
                            Swal.fire(
                                'Added!',
                                'Child Details Added Successfully!',
                                'success'
                            )

                            toastr.success(response.message);
                            fetchAllEmployees();

                        } else {

                            toastr.error(response.message, {
                                timeOut: 5000
                            });
                        }


                        $("#add_child_btn").text('Add Employee');
                        $("#add_child_form")[0].reset();
                        location.reload(); // Reloads current page
                        $("#addChildModal").modal('hide');

                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, value) {
                            // loop through the validation errors and display them with toastr
                            toastr.error(value[0], {
                                timeOut: 5000
                            });
                        });
                    }

                });
            });

            // edit child ajax request
            $(document).on('click', '.editIcon', function(e) {
                e.preventDefault();

                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('edit') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {

                        //console.log(response);
                        // console.log(response.child);
                        // console.log(response.countries);
                        // console.log(response.states);
                        // console.log(response.cities);


                        let fullName = response.child.child_name;
                        let nameArray = fullName.split(" ");
                        let firstName = nameArray[0];
                        let lastName = nameArray[1];

                        $("#fname").val(firstName);
                        $("#lname").val(lastName);
                        $("#birthday1").val(response.child.date_of_birth);
                        $("#class_name1").val(response.child.class);
                        $("#address1").val(response.child.address);


                        //For Country
                        $('#country-dropdown1').html(
                            '<option class="dropdown-item" value="" selected="" disabled="">Select Country</option>'
                        );

                        $.each(response.countries, function(index, value) {
                            var selected = value.id == response.child.country ?
                                'selected' : '';

                            $("#country-dropdown1").append(
                                '<option class="dropdown-item" value="' + value
                                .id +
                                '" ' + selected + '>' + value.name +
                                '</option>');
                        });
                        $('#state-dropdown1').html(
                            '<option class="dropdown-item" value="">Select Country First</option>'
                        );

                        //For state
                        $('#state-dropdown1').html(
                            '<option class="dropdown-item" value="" selected="" disabled="">Select State</option>'
                        );

                        $.each(response.states, function(index, value) {

                            var selected = value.id == response.child.state ?
                                'selected' : '';

                            $("#state-dropdown1").append(
                                '<option class="dropdown-item" value="' + value
                                .id +
                                '" ' + selected + '>' + value.name +
                                '</option>');
                        });
                        $('#city-dropdown1').html(
                            '<option class="dropdown-item" value="">Select State First</option>'
                        );


                        //For city
                        $('#city-dropdown1').html(
                            '<option class="dropdown-item" value="" selected="" disabled="">Select City</option>'
                        );

                        $.each(response.cities, function(index, value) {

                            var selected = value.id == response.child.city ?
                                'selected' : '';

                            $("#city-dropdown1").append(
                                '<option class="dropdown-item" value="' + value
                                .id +
                                '" ' + selected + '>' + value.name +
                                '</option>');
                        });

                        $("#zip_code1").val(response.child.zip_code);
                        $("#avatar").html(
                            `<img src="${response.child.child_photo}" width="100" class="img-fluid img-thumbnail">`
                        );
                        $("#child_id").val(response.child.id);
                        $("#child_photo1").val(response.child.child_photo);

                    }
                });
            });


            $('.close_btn').on('click', function(event) {
                location.reload(); // Reloads current page
            });

            // update child ajax request
            $("#edit_child_form").submit(function(e) {
                e.preventDefault();

                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": true,
                    "positionClass": "toast-top-right"
                };

                const fd = new FormData(this);
                $("#edit_child_btn").text('Updating...');
                $.ajax({
                    url: '{{ route('update') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {

                        if (response.status == 200) {
                            Swal.fire(
                                'Updated!',
                                'Child Details Updated Successfully!',
                                'success'
                            )

                            toastr.success(response.message);
                            fetchAllEmployees();

                        } else {
                            toastr.error(response.message, {
                                timeOut: 5000
                            });
                        }

                        $("#edit_child_btn").text('Update Child');
                        $("#edit_child_form")[0].reset();
                        location.reload(); // Reloads current page
                        $("#editChildModal").modal('hide');
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, value) {
                            // loop through the validation errors and display them with toastr
                            toastr.error(value[0], {
                                timeOut: 5000
                            });
                        });
                    }

                });
            });

            // delete child ajax request
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
                                fetchAllEmployees();
                            }
                        });
                    }
                })
            });

            // fetch all child ajax request
            fetchAllEmployees();

            function fetchAllEmployees() {
                $.ajax({
                    url: '{{ route('fetchAll') }}',
                    method: 'get',
                    success: function(response) {
                        $("#show_all_employees").html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                    }
                });
            }
        });


        // Add form --- Change country dropdown & state operation
        $(document).ready(function() {
            $('#country-dropdown').on('change', function() {
                var country_id = this.value;
                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{ url('get-states-by-country') }}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#state-dropdown').html(
                            '<option class="dropdown-item" value="" selected="" disabled="">Select State</option>'
                        );
                        $.each(result.states, function(key, value) {
                            $("#state-dropdown").append(
                                '<option class="dropdown-item" value="' + value
                                .id +
                                '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html(
                            '<option class="dropdown-item" value="">Select State First</option>'
                        );
                    }
                });

            });

            //Add form --- Change state dropdown & city operation
            $('#state-dropdown').on('change', function() {
                var state_id = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{ url('get-cities-by-state') }}",
                    type: "POST",
                    data: {
                        state_id: state_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#city-dropdown').html(
                            '<option class="dropdown-item" value="" selected="" disabled="">Select City</option>'
                        );
                        $.each(result.cities, function(key, value) {
                            $("#city-dropdown").append(
                                '<option class="dropdown-item" value="' + value
                                .id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            });

        });

        //Add form --- Date of Birth fields validation
        $(document).ready(function() {
            var today = new Date();
            var day = today.getDate() > 9 ? today.getDate() : "0" + today.getDate();
            var month = (today.getMonth() + 1) > 9 ? (today.getMonth() + 1) : "0" + (today.getMonth() + 1);
            var year = today.getFullYear();

            $("#birthday").attr('max', year + "-" + month + "-" + day);

        });

        //Add Form --- photo upload validation
        function photo_validation(input, x) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var FileSize = input.files[0].size / 1024 / 1024; // in MB
                var FileType = input.files[0].type;
                var ext = $('#child_photo').val().split('.').pop().toLowerCase();
                //alert(FileSize);
                //alert(ext);
                if ($.inArray(ext, ['JPEG', 'PNG', 'JPG', 'png', 'jpg', 'jpeg']) == -1) {
                    alert('You are only allowed to upload jpeg, jpg or png image.!');
                    $("#child_photo").val('');
                } else {
                    if (FileSize < 1) {
                        alert('Maximum file size 1MB can be upload');
                        $(input).val('');
                    }
                }

                //image preview
                if (input.files.length > 0) {

                    reader.onload = function(e) {
                        $('#mainThmb').attr('src', e.target.result).width(90).height(90);
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    // If no file is uploaded, show a default image
                    $('#mainThmb').attr('src', "/upload/photo/No-image-found.jpg").width(90).height(90);
                }



            }
        }


        // Edit form --- Change country dropdown & state operation
        $(document).ready(function() {
            $('#country-dropdown1').on('change', function() {
                var country_id = this.value;
                $("#state-dropdown1").html('');
                $.ajax({
                    url: "{{ url('get-states-by-country') }}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#state-dropdown1').html(
                            '<option class="dropdown-item" value="" selected="" disabled="">Select State</option>'
                        );
                        $.each(result.states, function(key, value) {
                            $("#state-dropdown1").append(
                                '<option class="dropdown-item" value="' + value
                                .id +
                                '">' + value.name + '</option>');
                        });
                        $('#city-dropdown1').html(
                            '<option class="dropdown-item" value="">Select State First</option>'
                        );
                    }
                });

            });

            //edit form --- Change state dropdown & city operation
            $('#state-dropdown1').on('change', function() {
                var state_id = this.value;
                $("#city-dropdown1").html('');
                $.ajax({
                    url: "{{ url('get-cities-by-state') }}",
                    type: "POST",
                    data: {
                        state_id: state_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#city-dropdown1').html(
                            '<option class="dropdown-item" value="" selected="" disabled="">Select City</option>'
                        );
                        $.each(result.cities, function(key, value) {
                            $("#city-dropdown1").append(
                                '<option class="dropdown-item" value="' + value
                                .id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            });

        });

        //Edit form ---- Date of Birth fields validation
        $(document).ready(function() {
            var today = new Date();
            var day = today.getDate() > 9 ? today.getDate() : "0" + today.getDate();
            var month = (today.getMonth() + 1) > 9 ? (today.getMonth() + 1) : "0" + (today.getMonth() + 1);
            var year = today.getFullYear();

            $("#birthday1").attr('max', year + "-" + month + "-" + day);

        });

        //Edit form --- photo upload validation
        function photo_validation1(input, x) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var FileSize = input.files[0].size / 1024 / 1024; // in MB
                var FileType = input.files[0].type;
                var ext = $('#child_photo1').val().split('.').pop().toLowerCase();
                //alert(FileSize);
                //alert(ext);
                if ($.inArray(ext, ['JPEG', 'PNG', 'JPG', 'png', 'jpg', 'jpeg']) == -1) {
                    alert('You are only allowed to upload jpeg, jpg or png image.!');
                    $("#child_photo1").val('');
                } else {
                    if (FileSize < 1) {
                        alert('Maximum file size 1MB can be upload');
                        $(input).val('');
                    }
                }

                //image preview
                // if (input.files.length > 0) {

                //     reader.onload = function(e) {
                //         $('#mainThmb').attr('src', e.target.result).width(90).height(90);
                //     };
                //     reader.readAsDataURL(input.files[0]);
                // } else {
                //     // If no file is uploaded, show a default image
                //     $('#mainThmb').attr('src', "/upload/photo/No-image-found.jpg").width(90).height(90);
                // }



            }
        }


        // JQuery validation fields start
        $(document).ready(function() {

            $("#add_child_form").validate({
                // Specify validation rules
                event: 'blur',
                rules: {

                    fname: {
                        required: true,
                    },
                    lname: {
                        required: true,
                    },
                    birthday: {
                        required: true,
                        date: true,
                    },
                    class_name: {
                        required: true,
                    },
                    address: {
                        required: true,
                        maxlength: 150,
                    },
                    country: {
                        required: true,
                    },
                    state: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },
                    zip_code: {
                        required: true,
                        digits: true
                    },
                    child_photo: {
                        required: true,
                        extension: "jpg,jpeg,png",
                    },


                },
                messages: {

                    fname: {
                        required: "Please enter first name",
                    },
                    lname: {
                        required: "Please enter last name",
                    },
                    birthday: {
                        required: "Please select date of birth",
                    },
                    class_name: {
                        required: "Please select class",
                    },
                    address: {
                        required: "Please enter your address",
                        maxlength: "Address field accept only 150 characters",
                    },
                    country: {
                        required: "Please select your country",
                    },
                    state: {
                        required: "Please select your state",
                    },
                    city: {
                        required: "Please select your city",
                    },
                    zip_code: {
                        required: "Please enter 7-digit zip code",
                        minlength: 7,
                    },

                    child_photo: {
                        required: "Please upload child photo",
                        extension: "You're only allowed to upload jpeg, jpg or png image.",
                    },

                },



            });

        });

        // JQuery validation fields end

        // JQuery validation fields start
        $(document).ready(function() {

            $("#edit_child_form").validate({
                // Specify validation rules
                event: 'blur',
                rules: {

                    fname: {
                        required: true,
                    },
                    lname: {
                        required: true,
                    },
                    birthday: {
                        required: true,
                        date: true,
                    },
                    class_name: {
                        required: true,
                    },
                    address: {
                        required: true,
                        maxlength: 150,
                    },
                    country: {
                        required: true,
                    },
                    state: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },
                    zip_code: {
                        required: true,
                        digits: true
                    },
                    new_child_photo: {
                        extension: "jpg,jpeg,png",
                    },


                },
                messages: {

                    fname: {
                        required: "Please enter first name",
                    },
                    lname: {
                        required: "Please enter last name",
                    },
                    birthday: {
                        required: "Please select date of birth",
                    },
                    class_name: {
                        required: "Please select class",
                    },
                    address: {
                        required: "Please enter your address",
                        maxlength: "Address field accept only 150 characters",
                    },
                    country: {
                        required: "Please select your country",
                    },
                    state: {
                        required: "Please select your state",
                    },
                    city: {
                        required: "Please select your city",
                    },
                    zip_code: {
                        required: "Please enter 7-digit zip code",
                        minlength: 7,
                    },

                    new_child_photo: {
                        extension: "You're only allowed to upload jpeg, jpg or png image.",
                    },

                },



            });

        });

        // JQuery validation fields end
    </script>


</body>

</html>
