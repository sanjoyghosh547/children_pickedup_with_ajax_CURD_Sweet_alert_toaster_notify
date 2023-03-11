<?php
// phpinfo();
// die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="content">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Children Pickedup Register</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('backend/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"> --}}

    <!-- Responsive styles for this template-->
    <link href="{{ asset('backend/css/responsive.css') }}" rel="stylesheet">
    <!--Own css Style -->
    <link href="{{ asset('backend/css/main.css') }}" rel="stylesheet">
    <!-- library bootstrap -->
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}

</head>

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 admin-main-header">Register Children Pickedup</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">


                            <div class="card shadow mb-4">

                                <div class="card-header shadow mb-4 py-3">
                                    <div class="row align-items-center">
                                        <div class="col-xl-10 col-lg-9 col-md-8 col-sm-8 col-8">
                                            <h6 class="m-0 font-weight-bold text-primary">Register Children Pickedup
                                                Details</h6>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-4"> <a
                                                href="{{ route('children_pickedup_view_data') }}"
                                                class="d-sm-inline-block btn btn-primary shadow-sm product-type-add"
                                                title="Show Records"><i class="fa fa-eye" aria-hidden="true"></i> Show
                                                Records</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <form method="POST" name="registration" id="registration"
                                        enctype="multipart/form-data" class="user">
                                        @csrf
                                        <div class="row">
                                            <!-- start main row  -->
                                            <div class="col-12">
                                                <!--Start main col-12-->
                                                @if (count($errors) > 0)
                                                    <div class="alert alert-danger alert-dismissible fade show"
                                                        role="alert">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <ul class="p-0 m-0" style="list-style: none;">
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <!-- start 1st row start  -->
                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <h5>Child name<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" id="child_name" name="child_name"
                                                                    class="form-control" placeholder="Enter Child Name">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <h5>Date of birth<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="date" id="birthday" name="birthday"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <h5>Class<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="class_name" id="class_name"
                                                                    class="form-control">
                                                                    <option class="dropdown-item" value=""
                                                                        selected="" disabled="">Select Class
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
                                                    </div> <!-- end col md 4 -->


                                                </div>
                                                <!-- start 1st row end  -->

                                                <!-- start 2nd row  -->
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h5>Address <span class="text-danger">*</span>
                                                            </h5>
                                                            <div class="controls">
                                                                <textarea name="address" id="textarea" class="form-control" placeholder="Enter Address"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col md 12 -->

                                                </div>
                                                <!-- start 2nd row end  -->

                                                <!-- start 3rd row  -->
                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <h5>Country<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="country" id="country-dropdown"
                                                                    class="form-control">
                                                                    <option class="dropdown-item" value=""
                                                                        selected="" disabled="">Select Country
                                                                    </option>
                                                                    @foreach ($countries as $country)
                                                                        <option class="dropdown-item"
                                                                            value="{{ $country->id }}">
                                                                            {{ $country->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col md 4 -->

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <h5>State<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select class="form-control" name="state"
                                                                    id="state-dropdown">
                                                                    <option class="dropdown-item" value=""
                                                                        selected="" disabled="">Select State
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end col md 4 -->

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <h5>City<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select id="city-dropdown" name="city"
                                                                    class="form-control">
                                                                    <option class="dropdown-item" value=""
                                                                        selected="" disabled="">Select City
                                                                    </option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div> <!-- end col md 4 -->

                                                </div><!-- start 3rd row end  -->


                                                <!-- start 4th row  -->
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>Zip Code<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="number" id="zip_code" name="zip_code"
                                                                    maxlength="7" class="form-control"
                                                                    placeholder="Enter 7-digit zip code">
                                                            </div>
                                                        </div>
                                                    </div> <!-- end col md 6 -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>Child Photo<span class="text-danger">*</span></h5>

                                                            <div class="controls ch_Photo">
                                                                <input type="file" id="child_photo"
                                                                    name="child_photo" class="form-control"
                                                                    onchange="photo_validation(this)">
                                                                <img src="{{ asset('/upload/photo/No-image-found.jpg') }}"
                                                                    id="mainThmb" width="90px" height="90px"
                                                                    style=" position:relative;top:20px;">

                                                            </div>

                                                        </div>
                                                    </div> <!-- end col md 6 -->

                                                </div>
                                                <!-- start 4th row end  -->

                                                <!-- start 5th row  -->
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h5>Multiple Person Details<span
                                                                    class="text-danger">*</span>
                                                            </h5>
                                                            <div class="controls">
                                                                <!--Add multiple person Start -->
                                                                <table class="table">
                                                                    <thead class="thead-light">
                                                                        <tr>
                                                                            <th scope="col">Person Name</th>
                                                                            <th scope="col">Relation</th>
                                                                            <th scope="col">Contact no</th>
                                                                            <th scope="col"><a href="javascript:;"
                                                                                    class="btn btn-success addRow"> <i
                                                                                        class="fa fa-plus"
                                                                                        aria-hidden="true"></i></a>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="multipersion">
                                                                        <tr>
                                                                            <td>
                                                                                <input type="hidden" id="count"
                                                                                    value="1"
                                                                                    class="form-control">
                                                                                <input type="text"
                                                                                    id="person_name1"
                                                                                    name="person[1][name]"
                                                                                    class="form-control"
                                                                                    placeholder="Enter Person Name"
                                                                                    required>
                                                                            </td>
                                                                            <td>
                                                                                <select name="person[1][relation]"
                                                                                    id="relation1"
                                                                                    class="form-control" required>
                                                                                    <option class="dropdown-item"
                                                                                        value="" selected=""
                                                                                        disabled="">Select Relation
                                                                                    </option>
                                                                                    <option class="dropdown-item"
                                                                                        value="Father">Father</option>
                                                                                    <option class="dropdown-item"
                                                                                        value="Mother">Mother</option>
                                                                                    <option class="dropdown-item"
                                                                                        value="Brother">Brother
                                                                                    </option>
                                                                                    <option class="dropdown-item"
                                                                                        value="Sister">Sister</option>
                                                                                    <option class="dropdown-item"
                                                                                        value="Grand Father">Grand
                                                                                        Father</option>
                                                                                    <option class="dropdown-item"
                                                                                        value="Grand Mother">Grand
                                                                                        Mother</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <input type="tel" id="contact_no1"
                                                                                    name="person[1][contact_no]"
                                                                                    minlength="10" maxlength="10"
                                                                                    class="form-control"
                                                                                    placeholder="Enter 10-digit mobile number"
                                                                                    required>
                                                                            </td>
                                                                            <td><a href="javascript:;"
                                                                                    class="btn btn-danger deleteRow"><i
                                                                                        class="fa fa-minus"
                                                                                        aria-hidden="true"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                                <!--Add multiple person End -->
                                                            </div>
                                                        </div>
                                                    </div> <!-- end col md 12 -->

                                                </div><!-- start 5th row end  -->


                                            </div> <!-- main col-12 end-->
                                        </div> <!-- end main row  -->

                                        <button type="submit" id="registerbtn"
                                            class="btn btn-primary btn-user btn-block">Registration</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- Content Row End-->

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
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>

    <!-- library js validate -->
    {{-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/additional-methods.js"></script>

    <!--Form validation custom script-->
    <script src="{{ asset('backend/js/admin_custom.js') }}"></script>

    <!-- toastr notify  -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}

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

    <script type="text/javascript">
        // add and delete multi row for Person
        $('thead').on('click', '.addRow', function() {
            var count = $('#count').val();
            //alert(count);
            if (count < 6) {
                count = Number(count) + Number(1);

                var tr = '<tr>' +
                    '<td>' +
                    '<input type="text" id="person_name' + count +
                    '" name="person[' + count +
                    '][name]" class="form-control" placeholder="Enter Person Name" required="true">' +
                    '</td>' +
                    '<td>' +
                    '<select name="person[' + count + '][relation]" id="relation' + count +
                    '" class="form-control" required="true">' +
                    '<option class="dropdown-item" value="" selected="" disabled="">Select Relation</option>' +
                    '<option class="dropdown-item" value="Father">Father</option>' +
                    '<option class="dropdown-item" value="Mother">Mother</option>' +
                    '<option class="dropdown-item" value="Brother">Brother</option>' +
                    '<option class="dropdown-item" value="Sister">Sister</option>' +
                    '<option class="dropdown-item" value="Grand Father">Grand Father</option>' +
                    '<option class="dropdown-item" value="Grand Mother">Grand Mother</option>' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<input type="tel" id="contact_no' + count +
                    '" name="person[' + count +
                    '][contact_no]" minlength="10" maxlength="10" class="form-control" placeholder="Enter 10-digit mobile number" required="true">' +
                    '</td>' +
                    '<td><a href="javascript:;" class="btn btn-danger deleteRow"><i class="fa fa-minus" aria-hidden="true"></i></a></td>' +
                    '</tr>';


                $('#multipersion').append(tr);

                $('#count').val(count);
            } else {
                alert("Maximum 6 picked up person can be added.");
            }
        });

        // Remove Multi Row
        $('tbody').on('click', '.deleteRow', function() {
            var count = $('#count').val();
            //alert(count);
            if (count > 1) {
                $(this).parent().parent().remove();
                count = Number(count) - Number(1);
                $('#count').val(count);

            } else {
                alert("Minimum 1 picked up person can be added.");
            }
        });

        // End add and delete multi row for Person

        // JQuery validation fields start
        $(document).ready(function() {

            $("#registration").validate({
                // Specify validation rules
                event: 'blur',
                rules: {

                    child_name: {
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

                    child_name: {
                        required: "Please enter child name",
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


        // Change country dropdown & state operation
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
                                '<option class="dropdown-item" value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html(
                            '<option class="dropdown-item" value="">Select State First</option>'
                        );
                    }
                });

            });

            // Change state dropdown & city operation
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
                                '<option class="dropdown-item" value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            });

        });
    </script>

    <script type="text/javascript">
        // Date of Birth fields validation
        $(document).ready(function() {
            var today = new Date();
            var day = today.getDate() > 9 ? today.getDate() : "0" + today.getDate();
            var month = (today.getMonth() + 1) > 9 ? (today.getMonth() + 1) : "0" + (today.getMonth() + 1);
            var year = today.getFullYear();

            $("#birthday").attr('max', year + "-" + month + "-" + day);

        });



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

        $(document).ready(function() {
            $('#registration').submit(function(e) {
                e.preventDefault(); // Prevent default form submission
                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": true,
                    "positionClass": "toast-top-right"
                };
                var formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                //console.log(formData);
                $.ajax({
                    url: '{{ route('children_details_store') }}',
                    //url: '/children_details_store',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) { // On successful validation
                            location.reload(); // Reloads current page
                            toastr.success(response.message);
                        } else { // If there are errors
                            if (response.errors instanceof Object) {
                                $.each(response.errors, function(key, value) {
                                    toastr.error(value[0], 'Validation Error', {
                                        timeOut: 5000
                                    });
                                });
                            } else if (response.errors instanceof Array) {
                                $.each(response.errors, function(index, value) {
                                    toastr.error(value[0], 'Validation Error', {
                                        timeOut: 5000
                                    });
                                });
                            }
                        }
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

        });
    </script>




</body>

</html>
