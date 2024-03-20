<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pacpay Admin Panel</title>

    <!-- Custom fonts for this template-->
    {{-- Tabs --}}
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css') }}"
        rel="stylesheet" media="screen" />

    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" media="screen" />
    <!-- Custom styles for this template-->

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Country Code -->
    {{-- <link href="{{ asset('css/intlTelInput.css') }}" rel="stylesheet">
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet"> --}}

    {{-- Crop Image --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css"> --}}

    {{-- Crop Image --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        {{-- <x- sidebar /> --}}
        @include('sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                {{-- <x- header /> --}}
                @include('header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Billers</h5>
                            <button type="submit" class="btn-fill btn" id='submit_button'
                                style="float:right; margin-top: -20px;">Add Biller</button>
                        </div>

                        {{-- Transaction Report --}}
                        <section class="header">
                            <div class="container py-4">
                                <div class="tab">
                                    <button class="tablinks" id="defaultOpen" data-is_active="1">Active
                                        User</button>
                                    <button class="tablinks" data-is_active="0">InActive User</button>

                                </div>
                                <script>
                                    $('.tablinks').on('click', function() {
                                        document.getElementById('TransReport').style.display = "block";
                                        $('.tablinks').removeClass('activeWallet');
                                        $(this).addClass('activeWallet');
                                        fetch_data($(this).data('is_active'));
                                    })
                                </script>
                                <div>
                                    {{-- @if ($userDetails->user_type_id == 2 or $useDetails->user_type_id == 4 or $userDetails->user_type_id == 5) --}}
                                    <div id="TransReport" class="tabcontent">
                                        <div class="card-body">

                                            <form name='filterdate' id='filterdate'>
                                                <div class="col-12 col-sm-6 col-md-6 input-group input-daterange">
                                                    <input type="text" name="from_date" id="from_date" readonly
                                                        class="form-control" placeholder="From Date" />&nbsp;&nbsp;
                                                    <div class="input-group-addon">to</div> &nbsp;&nbsp;
                                                    <input type="text" name="to_date" id="to_date" readonly
                                                        class="form-control" placeholder="To Date" />

                                                    &nbsp;&nbsp;
                                                    <button type="button" name="filter" id="filter"
                                                        class="btn btn-info btn-sm filter">Filter
                                                    </button>
                                                </div>
                                            </form>

                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%"
                                                    cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Date</th>
                                                            <th class="text-center">Biller Name</th>
                                                            <th class="text-center">Biller Category Name</th>
                                                            <th class="text-center">Logo</th>
                                                            <th class="text-center" id="billers">Biller Fields
                                                            </th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- @endif --}}


                                </div>

                            </div>
                        </section>


                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Pacpay 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
            <div id="loader"></div>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="{{ asset('#page-top') }}">
        <i class="fas fa-angle-up"></i> </a>

    {{-- Add Biller --}}
    <div class="modal fade" id="biller_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Biller</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addNewBiller' id='addNewBiller' enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <div class="input-group">
                                        <input type="text" name="mobile_no" class="form-control" id="mobile_no">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <input type="email" name="email" class="form-control" id="email"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <div class="input-group">
                                        <input type="text" name="username" class="form-control" id="username"
                                            value="$" pattern="^[$].{8,}"
                                            title="Must start with $ sign followed by at least 8 or more characters"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" id="password"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="password_confirmation" required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Biller Name</label>
                                    <div class="input-group">
                                        <input type="text" name="biller_name" class="form-control"
                                            id="biller_name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Select Service Category</label>
                                    <select class="select2 form-control custom-select" name="biller_category_id"
                                        id="biller_category_id" required>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4 text-center">
                                        <div id="cropie-demo" style="width:250px"></div>
                                    </div>
                                    <label>Upload Logo</label>
                                    <div class="input-group">
                                        <input type="file" name="biller_img" class="form-control" id="upload"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Add Fields</label>
                                    <a href="javascript:void(0);" class="add_button" style="margin:0px"
                                        title="Add more fields"><img src="" /><i
                                            class="material-icons">add</i></a>
                                    <div class="fields">
                                        <div class="form-group">
                                            <label>Placeholder</label>
                                            <div class="input-group">
                                                <input type="text" name="biller_fields[fields][0][name]"
                                                    value="" class="form-control"
                                                    title="Placeholder(e.g. Mobile No, Biller No.)" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Validate</label>
                                            <input type="checkbox" name="biller_fields[fields][0][check_regex]"
                                                id="checkbox1" class="checkboxClass" value=0>
                                        </div>
                                        <div class="form-group" style="display: none;" id="regex">
                                            <label>Regex</label>
                                            <div class="input-group">
                                                <input type="text" name="biller_fields[fields][0][regex]"
                                                    value="" class="form-control"
                                                    title="To validate placeholder" />

                                            </div>
                                            <a href="https://regex-generator.olafneumann.org/?sampleText=1458795647&flags=i&onlyPatterns=false&matchWholeLine=false&selection="
                                                target="_blank" style="margin:0px" title="Add more fields">Generate
                                                Regex</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                </div>
                <input type="hidden" name="user_type_id" value="5">
                <input type="hidden" name="device_name" value="web">
                <div style="text-align:center; padding:5%">
                    <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                        data-user-id="" style="font-weight:500;">Add</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
                </form>
                <div id='response'></div>
            </div>

            <div class="modal-footer">

            </div>
        </div>
    </div>

    <!-- Edit Biller Modal-->
    <div class="modal fade" id="edit_billers_form" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Biller</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='editBiller' id='editBiller'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Biller Name</label>
                                    <div class="input-group">
                                        <input type="text" name="biller_name" class="form-control"
                                            id="billerName" required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Biller Category</label>
                                    <select name="biller_category_id" id="billerCategory"
                                        class="select2 form-control custom-select" required>
                                    </select>
                                </div>
                                <br />
                                <label>Biller Fields</label>
                                {{-- <label>Add Fields</label>
                                <a href="javascript:void(0);" class="add_button" style="margin:0px"
                                    title="Add more fields"><img src="" /><i class="material-icons">add</i></a> --}}
                                <div id="appendfields">
                                </div>
                            </div>

                        </div>
                        <div style="text-align:center; padding:5%">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-biller-id="" style="font-weight:500;">Update</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>


                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- Biller transaction details Modal-->
    <div class="modal fade" id="billers_transaction_form" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 1000px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Biller Report</h5>
                    {{-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button> --}}
                </div>
                <div class="modal-body">
                    <form name='billerTrans' id='billerTrans'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Biller Name</label>
                                    <div class="input-group">
                                        <input type="text" name="biller_name" class="form-control" id="billerNm"
                                            disabled="">

                                    </div>
                                </div>

                                <div class="card-body" style="width: 700px;">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTableBillerTrans" width="100%"
                                            cellspacing="0">
                                            <h2>Transactions</h2>
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Created At</th>
                                                    <th class="text-center">Bill Payment ID</th>
                                                    <th class="text-center">Amount</th>
                                                    <th class="text-center">User</th>
                                                </tr>
                                            </thead>

                                            <tbody class="tablebody">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div style="text-align:center; padding:5%">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>


                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- Add Funds Model-->
    <div class="modal fade" id="add_funds_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Funds</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addFunds' id='addFunds'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <div class="input-group">
                                        <input type="text" name="amount" class="form-control" id="amount"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Transaction Pin</label>
                                    <div class="input-group">
                                        <input type="text" name="transaction_pin" class="form-control"
                                            id="transaction_pin" required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <div class="input-group">
                                        <input type="text" name="description" class="form-control"
                                            id="description" required>

                                    </div>
                                </div>


                            </div>

                            <br><br>

                        </div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-user-id="" style="font-weight:500;">Add</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>

                    </form>


                </div>

                <div class="modal-footer">
                    <div id='response'></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Biller Logo-->
    <div class="modal fade" id="upload_biller_logo_form" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Biller Logo</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <div class="col-md-4 text-center">
                                        <div id="cropie-demo" style="width:250px"></div>
                                    </div>
                                    <label>Upload Logo</label>
                                    <div class="input-group">
                                        <input type="file" name="image" class="image" id="upload" required>
                                    </div>

                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div style="text-align:center">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel
                            </button>
                        </div>

                    </form>
                    <div id='response'></div>

                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" src="" height="500px" width="500px">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    {{-- <button type="button" class="btn btn-primary" id="crop">Upload</button> --}}
                    <button type="button" class="btn btn-primary btn-rounded btn-fw"
                        id='upload_biller_submit_button' data-biller-id="" style="font-weight:500;">Upload
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    {{-- {{-- country code --}}
    <script src="js/intlTelInput.js"></script>

    {{-- Crop Image --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>

    <script type="text/javascript">
        function fetch_data(isActive) {
            //  console.log("IsActive: " + isActive);
            //Biller List
            $('#dataTable').DataTable().clear().destroy();
            $('#dataTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "bLengthChange": false,
                "processing": true,
                "serverSide": true,
                "searching": false,
                "ajax": {
                    url: '{{ url('api/biller') }}',
                    data: function(d) {
                        d.request_origin = 'web',
                            d.is_active = isActive
                    }
                },

                columnDefs: [{

                    targets: 5,
                    render: function(data, type, row, meta) {

                        if (row.is_active == 1) {

                            return '<td class="text-center"><button title="Edit Biller Details" data-billerid="' +
                                row.id +
                                '" class="bank_entry btn" style="color: rgb(30, 50, 250);"><i class="fa fa-edit fa-lg"></i></button><button title="Upload Biller Logo" data-billerid="' +
                                row.id +
                                '" class="biller_logo btn" style="color: rgb(30, 50, 250);"><i class="fa fa-upload"></i></button><button title="Transaction Details" data-billerid="' +
                                row.id +
                                '" class="biller_transaction btn" style="color: rgb(0,128,0);"><i class="fa fa-list"></i></button><a title="Edit" href="{{ url('api/user') }}/' +
                                row.user_id +
                                '/edit" style="color: rgb(30, 50, 250);"><i class="fas fa-fw fa-user"></i></a><button title="Add Funds" data-userid="' +
                                row.user_id +
                                '" class="add_funds_entry" style="color: rgb(0,128,0); border: none; background: none; width="100px";"><i class="fa fa-money fa-lg"></i></button><button title="Disable Biller" data-billerid= "' +
                                row
                                .id +
                                '"  class="btn disable_biller btn-block" style="background-color: rgb(95,158,160); color: rgb(255,255,255); width: 80px;" >Disable </button></td>';
                        } else {
                            return '<td class="text-center"><button title="Edit Biller Details" data-billerid="' +
                                row.id +
                                '" class="bank_entry btn" style="color: rgb(30, 50, 250);"><i class="fa fa-edit fa-lg"></i></button><button title="Upload Biller Logo" data-billerid="' +
                                row.id +
                                '" class="biller_logo btn" style="color: rgb(30, 50, 250);"><i class="fa fa-upload"></i></button><button title="Transaction Details" data-billerid="' +
                                row.id +
                                '" class="biller_transaction btn" style="color: rgb(0,128,0);"><i class="fa fa-list"></i></button><a title="Edit" href="{{ url('api/user') }}/' +
                                row.user_id +
                                '/edit" style="color: rgb(30, 50, 250);"><i class="fas fa-fw fa-user"></i></a><button title="Add Funds" data-userid="' +
                                row.user_id +
                                '" class="add_funds_entry" style="color: rgb(0,128,0); border: none; background: none; width="100px";"><i class="fa fa-money fa-lg"></i></button><button title="Enable Biller" data-billerid= "' +
                                row
                                .id +
                                '"  class="btn enable_biller btn-fill-approve btn-block" style="background-color: rgb(0,128,0); width: 80px;" >Enable</button></td>';
                        }
                    }

                }],
                "columns": [{
                        data: 'created_at',
                        className: "created_at",
                        render: function(data, type, row, meta) {
                            return moment.utc(data).local().format('DD/MM/YYYY HH:mm a');
                        }

                    },
                    {
                        data: 'biller_name',
                        className: "biller_name",
                    },
                    {
                        data: 'biller_category.category_name',
                        className: "biller_category",
                    },
                    {
                        "render": function(data, type, JsonResultRow, meta) {
                            return '<img src="' + JsonResultRow.biller_img_url +
                                '"height="75" width="75" alt="Logo">';
                        }
                    },
                    {
                        "render": function(data, type, JsonResultRow, meta) {
                            //console.log(JsonResultRow.biller_fields.fields);
                            var fields = '<table class="table tbl">';
                            $.each(JsonResultRow.biller_fields.fields, function(key, value) {
                                fields += '<tr><td>' + value.name + '</td><td>' +
                                    value
                                    .regex + '</td></tr>';
                            })
                            fields += '</table>';
                            //console.log(fields);
                            return fields;
                        }

                    }
                ]

            });
        }

        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
            //previously active menu item 
            $('#bill_payment').addClass('active');

            //Default Active Tab
            document.getElementById("defaultOpen").click();

            //country code
            /* var input = document.querySelector("#mobile_no");
            window.intlTelInput(input, {

                utilsScript: "js/utils.js",
            }); */

            /*  Crop Image */
            /* $uploadCrop = $('#cropie-demo').croppie({
                enableExif: true,
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'circle'
                },
                boundary: {
                    width: 300,
                    height: 300
                }
            });
            $('#upload').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function() {
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
            }); */

            var spinner = $('#loader');

            /* var IsActive = $(this).data('is_active');
            console.log("IsActive: " + IsActive); */





            function getImg(data, type, full, meta) {
                //
                return '<img  src="your image path(imgsrc )" />';
            }

            //Get User ID
            $("#dataTable").on('click', '.add_funds_entry', function() {

                $('#add_funds_form').modal('show');


                $('#submit_button').attr('data-user-id', $(this).data('userid'));
            });
            //Add funds
            $('#addFunds').on('submit', function(e) {
                e.preventDefault();
                spinner.show();

                var formFields = $('#addFunds').serialize();
                var send_to = $('#submit_button').data('user-id');
                // console.log("Bank Id: " + send_to);

                $.ajax({
                    url: 'api/send-funds',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields + '&is_wallet_refill=1&send_to=' + send_to,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        //console.log("ttttt");
                        if (data.error_code == 0) {
                            //  console.log(data);
                            spinner.hide();
                            $('#add_funds_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            }).then(okay => {
                                if (okay) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            swal(data.meta.message, "error");
                        }
                        spinner.hide();
                        $('#addFunds').closest('form').find(
                            "input[type=text], textarea").val(
                            "");

                    },
                    error: function(data) {

                        if (data.status === 422) {
                            var errors = $.parseJSON(data.responseText);
                            $.each(errors, function(key, value) {
                                // console.log(key+ " " +value);
                                $('#response').addClass(
                                    "alert alert-danger");

                                if ($.isPlainObject(value)) {
                                    $.each(value, function(key, value) {
                                        // console.log(key + " " +
                                        //     value);
                                        $('#response').show()
                                            .append(value +
                                                "<br/>");
                                        spinner.hide();
                                    });
                                } else {
                                    $('#response').show().append(value +
                                        "<br/>"); //this is my div with messages

                                    spinner.hide();
                                }
                            });
                        }

                    }



                });
            });



            //Disable Biller
            $("#dataTable").on('click', '.disable_biller', function() {
                //d.preventDefault();

                var BillerId = $(this).data('billerid');
                // console.log("PromotionId: " + BillerId);

                Swal.fire({
                    title: "Do you want to Disable this Biller?",
                    text: "",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        //   console.log("Result: " + result.value);
                        $.ajax({
                            url: '{{ url('api/biller') }}/' + BillerId,
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'is_active': 0
                            },
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                // console.log("ttttt");
                                if (data.error_code == 0) {
                                    // console.log(data);

                                    $('#dataTable').DataTable().ajax.reload();
                                    Swal.fire({
                                        title: "" + data.meta.message,
                                        icon: 'success',
                                        showCloseButton: true
                                    })
                                } else {
                                    swal(data.meta.message, "error");
                                }


                            },
                            error: function(data) {
                                if (data.status === 422) {
                                    var errors = $.parseJSON(data.responseText);
                                    $.each(errors, function(key, value) {
                                        // console.log(key+ " " +value);
                                        $('#response').addClass(
                                            "alert alert-danger");

                                        if ($.isPlainObject(value)) {
                                            $.each(value, function(key, value) {
                                                // console.log(key + " " +
                                                //     value);
                                                $('#response').show()
                                                    .append(value +
                                                        "<br/>");

                                                alert("Error:" +
                                                    value);
                                            });


                                        } else {
                                            $('#response').show().append(value +
                                                "<br/>"
                                            ); //this is my div with messages
                                        }
                                    });
                                }
                            }
                        });
                    }
                });
            });
            //Enable Biller
            $("#dataTable").on('click', '.enable_biller', function() {
                var BillerId = $(this).data('billerid');
                //console.log("PromotionId: " + BillerId);

                Swal.fire({
                    title: "Do you want to Enable this Voucher?",
                    text: "",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        //console.log("Result: " + result.value);
                        $.ajax({
                            url: '{{ url('api/biller') }}/' + BillerId,
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'is_active': 1
                            },
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                //console.log("ttttt");
                                if (data.error_code == 0) {
                                    //console.log(data);

                                    $('#dataTable').DataTable().ajax.reload();
                                    Swal.fire({
                                        title: "" + data.meta.message,
                                        icon: 'success',
                                        showCloseButton: true
                                    })
                                } else {
                                    swal(data.meta.message, "error");
                                }
                            },
                            error: function(data) {

                                if (data.status === 422) {
                                    var errors = $.parseJSON(data.responseText);
                                    $.each(errors, function(key, value) {
                                        // console.log(key+ " " +value);
                                        $('#response').addClass(
                                            "alert alert-danger");

                                        if ($.isPlainObject(value)) {
                                            $.each(value, function(key, value) {
                                                // console.log(key + " " +
                                                //     value);
                                                $('#response').show()
                                                    .append(value +
                                                        "<br/>");

                                            });
                                        } else {
                                            $('#response').show().append(value +
                                                "<br/>"
                                            ); //this is my div with messages
                                        }
                                    });
                                }
                            }
                        });
                    }
                });
            });

            /*         Crop Image */
            var $modal = $('#modal');
            var image = document.getElementById('image');
            var cropper;
            $("body").on("change", ".image", function(e) {
                var files = e.target.files;
                var done = function(url) {
                    image.src = url;
                    $modal.modal('show');
                };
                var reader;
                var file;
                var url;
                if (files && files.length > 0) {
                    file = files[0];
                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function(e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });
            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 0,
                    viewMode: 3,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });
            //Upload image
            var Biller_Id = null;
            $("#dataTable").on('click', '.biller_logo', function() {
                //console.log("inside biller logo model");
                var billerId = $(this).data('billerid');
                Biller_Id = billerId;
                //console.log("BillerIDDD: ", billerId);

                $('#upload_biller_logo_form').modal('show');

                $('#upload_biller_submit_button').attr('data-biller-id', $(this).data('billerid'));
            });
            $("#upload_biller_submit_button").click(function() {
                /*  e.preventDefault(); */
                spinner.show();
                //console.log("BilllerIDDDDD: " + Biller_Id);
                /*  var send_to = $('#upload_biller_submit_button').data('user-id');
                 console.log("send_to Id: " + send_to); */
                canvas = cropper.getCroppedCanvas({
                    width: 160,
                    height: 160,
                });
                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        console.log("imgUploadLogo: " + base64data);

                        $.ajax({
                            url: '{{ url('api/biller') }}/' + Biller_Id,
                            type: 'patch',
                            dataType: 'JSON',
                            data: {
                                'biller_img_base64': base64data
                            },
                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                //console.log("ttttt");
                                if (data.error_code == 0) {
                                    // console.log(data);
                                    spinner.hide();
                                    $('#add_profile_form').modal('hide');
                                    $('#dataTable').DataTable().ajax.reload();
                                    Swal.fire({
                                        title: "" + data.meta.message,
                                        icon: 'success',
                                        showCloseButton: true
                                    }).then(okay => {
                                        if (okay) {
                                            window.location.reload();
                                        }
                                    });
                                } else {
                                    swal(data.meta.message, "error");
                                }


                            },
                            error: function(data) {

                                if (data.status === 422) {
                                    var errors = $.parseJSON(data.responseText);
                                    $.each(errors, function(key, value) {
                                        // console.log(key+ " " +value);
                                        $('#response').addClass(
                                            "alert alert-danger");

                                        if ($.isPlainObject(value)) {
                                            $.each(value, function(key,
                                                value) {
                                                // console.log(key +
                                                //     " " +
                                                //     value);
                                                $('#response')
                                                    .show()
                                                    .append(value +
                                                        "<br/>");
                                                spinner.hide();
                                            });
                                        } else {
                                            $('#response').show().append(
                                                value +
                                                "<br/>"
                                            ); //this is my div with messages
                                            spinner.hide();
                                        }
                                    });
                                }

                            }


                        });
                    }
                });

            });

            //Edit Biller 
            $("#dataTable").on('click', '.bank_entry', function() {
                // console.log("yyer");
                var BillerNm = $(this).closest('tr').find('.biller_name').text();
                var billerid = $(this).data('billerid');
                //  console.log("BillerIDDD: ", billerid);

                $('#billerName').val(BillerNm);
                //$('#billers').value(field);

                $('#edit_billers_form').modal('show');

                //Get biller category list
                $.ajax({
                    url: 'api/biller-category',
                    type: 'get',
                    success: function(data) {
                        // console.log('data');
                        $('#billerCategory').empty();
                        $.each(data.data, function($index, $value) {

                            $('#billerCategory').append('<option value="' + $value
                                .id + '" >' + $value
                                .category_name + '</option>');
                        })
                    }
                });

                $.ajax({
                    url: 'api/biller/' + billerid,
                    type: 'get',
                    success: function(data) {
                        // console.log('data');
                        $('#appendfields').empty();
                        //var fields = '';
                        i = 0;
                        $.each(data.data.biller_fields.fields, function($index, $value) {


                            $('#appendfields').append(
                                '<div class="form-group"><label>Placeholder</label><div class="input-group"><input title="Placeholder" type="text" name="biller_fields[fields][' +
                                i +
                                '][name]" id="name" value="' +
                                $value.name +
                                '"></div><label>Regex</label><div class="input-group"><input title="Regex" type="text" name="biller_fields[fields][' +
                                i +
                                '][regex]" id="regex" value="' +
                                $value.regex + '"></div>' +
                                '<label>Check regex</label><div class="input-group"><input title="Regex" id="checkbox_' +
                                i +
                                '" type="checkbox"  class="checkboxClass" name="biller_fields[fields][' +
                                i +
                                '][check_regex]" id="check_regex" value="' +
                                $value.check_regex + '"></div>' +
                                '</div><br/>');

                            if ($value.check_regex)
                                $('#checkbox_' + i).attr('checked', 'checked');
                            i++;

                        })


                    }
                });

                $('#submit_button').attr('data-biller-id', $(this).data('billerid'));
            });

            $("#edit_billers_form").on("hide.bs.modal", function() {

                window.location.reload();
            });
            $('#editBiller').on('submit', function(e) {
                e.preventDefault();

                var formFields = $('#editBiller').serialize();
                // var formFields = new FormData($('#editBiller'));
                console.log("formFields: " + formFields);
                var BillerId = $('#submit_button').data('biller-id');

                $.ajax({
                    url: 'api/biller/' + BillerId,
                    type: 'patch',
                    dataType: 'JSON',
                    data: formFields,
                    cache: false,
                    async: false,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        if (data.error_code == 0) {
                            //console.log(data);
                            $('#edit_billers_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#editBiller').closest('form').find(
                            "input[type=text], textarea").val(
                            "");

                    },
                    error: function(data) {

                        if (data.status === 422) {
                            var errors = $.parseJSON(data.responseText);
                            $.each(errors, function(key, value) {
                                // console.log(key+ " " +value);
                                $('#response').addClass(
                                    "alert alert-danger");

                                if ($.isPlainObject(value)) {
                                    $.each(value, function(key, value) {
                                        // console.log(key + " " +
                                        //     value);
                                        $('#response').show()
                                            .append(value +
                                                "<br/>");

                                    });
                                } else {
                                    $('#response').show().append(value +
                                        "<br/>"
                                    ); //this is my div with messages
                                }
                            });
                        }

                    }



                });
            });

            //Biller Transaction Details
            $("#dataTable").on('click', '.biller_transaction', function() {
                // console.log("yyer");
                var BillerNm = $(this).closest('tr').find('.biller_name').text();
                var billerid = $(this).data('billerid');
                //console.log("BillerIDDD: ", billerid);

                $('#billerNm').val(BillerNm);

                $('#billers_transaction_form').modal('show');

                $('#dataTableBillerTrans').DataTable({
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    "bLengthChange": false,
                    "processing": true,
                    "serverSide": true,
                    "searching": false,
                    "ajax": {
                        url: '{{ url('api/bill-payment') }}',
                        data: function(d) {
                            d.request_origin = 'web',
                                d.biller_id = billerid
                        }
                    },
                    "columns": [{
                            data: 'created_at',
                            className: "created_at",
                            render: function(data, type, row, meta) {
                                return moment.utc(data).local().format(
                                    'DD/MM/YYYY HH:mm a');
                            }
                        },
                        {
                            data: 'bill_payment_id'
                        },
                        {
                            data: 'biller_fields.amount.value'
                        },
                        {
                            data: 'user.username',

                            render: function(data, type, row) {
                                return row.user.username + '<br>(MobileNo: ' + row.user
                                    .mobile_no +
                                    ')' + '<br>(UserType: ' + row.user.user_type +
                                    ')';
                            }
                        }
                    ]

                });

            });
            $("#billers_transaction_form").on("hide.bs.modal", function() {

                window.location.reload();
            });



            //Add Biller
            $("#submit_button").on('click', function() {
                $('#biller_form').modal('show');

                //Get biller category list
                $.ajax({
                    url: 'api/biller-category',
                    type: 'get',
                    success: function(data) {
                        // console.log('data');
                        $('#biller_category_id').empty();
                        $.each(data.data, function($index, $value) {

                            $('#biller_category_id').append('<option value="' + $value
                                .id + '" >' + $value
                                .category_name + '</option>');
                        })
                    }
                });
            });

            $(document).on('change', '.checkboxClass', function() {
                if ($(this).is(':checked')) {
                    $(this).attr('value', 1);
                    // console.log( $(this).parent().next());
                    $(this).parent().next().show();
                } else {
                    // console.log( $(this).parent().next());
                    $(this).attr('value', 0);
                    $(this).parent().next().hide();
                }
            });

            var maxField = 10;
            var addButton = $('.add_button');
            var addfields = $('.fields');
            i = 0;


            $(addButton).click(function() {
                if (i < maxField) {
                    i++;
                    var inputField =
                        '<div class="fields"><div class="form-group"><label>Placeholder</label><div class="input-group"><input type="text" name="biller_fields[fields][' +
                        i +
                        '][name]" value="" class="form-control" title="Placeholder(e.g. Mobile No, Biller No.)" required /></div></div><div class="form-group"><label>Validate</label><input type="checkbox" name="biller_fields[fields][' +
                        i +
                        '][check_regex]" id="checkbox1"  class="checkboxClass"  value=0></div><div class="form-group" id="regex"><label>Regex</label><div class="input-group"><input type="text" name="biller_fields[fields][' +
                        i +
                        '][regex]" value="" class="form-control" title="To validate placeholder" /></div></div></div>';
                    $(addfields).append(inputField);
                }
            });

            $('#addNewBiller').on('submit', function(e) {
                e.preventDefault();
                spinner.show();
                /* var password = Math.floor(10000000 + Math.random() * 90000000);
                var password_confirmation = password;

                $("<input />").attr("type", "hidden")
                    .attr("name", "password")
                    .attr("value", password)
                    .appendTo("#addNewBiller");

                $("<input />").attr("type", "hidden")
                    .attr("name", "password_confirmation")
                    .attr("value", password)
                    .appendTo("#addNewBiller"); */

                //var formFields =  $('#addNewBiller').serialize();
                var formFields = new FormData(this);
                //console.log("FormFields: " + formFields);

                $.ajax({
                    url: 'api/user',
                    type: 'post',
                    dataType: 'JSON',
                    data: formFields,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        //console.log("ttttt");

                        if (data.error_code == 0) {
                            //console.log(data);
                            spinner.hide();
                            $('#biller_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#addNewBiller').closest('form').find(
                            "input[type=text], textarea").val(
                            "");

                    },
                    error: function(data) {

                        if (data.status === 422) {
                            var errors = $.parseJSON(data.responseText);
                            $.each(errors, function(key, value) {
                                // console.log(key+ " " +value);
                                $('#response').addClass(
                                    "alert alert-danger");

                                if ($.isPlainObject(value)) {
                                    $.each(value, function(key, value) {
                                        // console.log(key + " " +
                                        //     value);
                                        $('#response').show()
                                            .append(value +
                                                "<br/>");
                                        spinner.hide();
                                    });
                                } else {
                                    $('#response').show().append(value +
                                        "<br/>"
                                    ); //this is my div with messages
                                    spinner.hide();
                                }
                            });
                        }

                    }



                });
            });

            $("#biller_form").on("hide.bs.modal", function() {

                window.location.reload();
            });




        });
    </script>
</body>

</html>
