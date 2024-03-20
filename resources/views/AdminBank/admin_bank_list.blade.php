<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pacpay Admin Panel</title>


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
                            <h5 class="m-0 font-weight-bold text-primary">Bank List</h5>
                            <a href="{{ asset('addAdminBank') }}" class="btn-fill btn"
                                style="float:right; margin-top: -20px;">Add New Bank</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">BANK NAME</th>
                                            <th class="text-center">ACCOUNT NUMBER</th>
                                            <th class="text-center">SWIFT</th>
                                            <th class="text-center">BSB</th>
                                            <th class="text-center">ACTION</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
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
                        <span>Copyright &copy; Pacpay 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="{{ asset('#page-top') }}">
        <i class="fas fa-angle-up"></i> </a>

    <!-- Edit Bank Modal-->
    <div class="modal fade" id="bank_edit_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit bank details</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <form name='addNewBank' id='editBank'>
                        <div class="row">
                            <div class="col-md-6" style="margin:0 auto; display:block;">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <div class="input-group">
                                        <input type="text" name="bank_name" class="form-control" id="bank_name"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <div class="input-group">
                                        <input type="text" name="account_no" class="form-control" id="account_no"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Swift</label>
                                    <div class="input-group">
                                        <input type="text" name="swift" class="form-control" id="swift"
                                            required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>BSB</label>
                                    <div class="input-group">
                                        <input type="text" name="bsb" class="form-control" id="bsb"
                                            required>

                                    </div>
                                </div>


                            </div>

                            <br><br>



                        </div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw" id='submit_button'
                                data-bnk-id="" style="font-weight:500;">Update</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>


                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".navbar-nav li").removeClass("active"); //this will remove the active class from  
            //previously active menu item 


            //Display Bank List 
            $('#dataTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "processing": true,
                "serverSide": true,
                "searching": true,
                "ajax": {
                    url: '{{ url('api/admin-bank-details') }}',
                    data: function(d) {
                        d.request_origin = 'web'
                    }

                },
                columnDefs: [{
                    targets: 4,
                    render: function(data, type, row, meta) {
                        //  console.log('data');
                        return '<td class="text-center"><button data-bankid="' + row.id +
                            '" class="bank_entry btn" style="color: rgb(30, 50, 250);"><i class="fa fa-edit fa-lg"></i></button>        <button data-bankid="' +
                            row.id +
                            '" class="btn-bank_entry_delete btn" style="color: rgb(30, 50, 250);"><i class="fa fa-close fa-lg"></i></button></td>';
                        //return '<td class="text-center"><a href="{{ asset('AdminBank.update_bank_detail') }}" style="color: rgb(30, 50, 250);"><i class="fa fa-edit fa-lg"></i></a></td>';
                    }

                }],
                "columns": [{
                        data: 'bank_name',
                        className: "bank_name",
                    },
                    {
                        data: 'account_no',
                        className: "ac_no",
                    },
                    {
                        data: 'swift',
                        className: "swift",
                    },
                    {
                        data: 'bsb',
                        className: "bsb",
                    },
                ]

            });

            $("#dataTable").on('click', '.bank_entry', function() {
                var name = $(this).closest('tr').find('.bank_name').text();
                var acno = $(this).closest('tr').find('.ac_no').text();
                var swift = $(this).closest('tr').find('.swift').text();
                var bsb = $(this).closest('tr').find('.bsb').text();

                $('#bank_name').val(name);
                $('#account_no').val(acno);
                $('#swift').val(swift);
                $('#bsb').val(bsb);
                $('#bank_edit_form').modal('show');


                $('#submit_button').attr('data-bnk-id', $(this).data('bankid'));
            });


            //Edit Bank
            $('#editBank').on('submit', function(e) {
                e.preventDefault();


                var formFields = $('#editBank').serialize();
                var BankId = $('#submit_button').data('bnk-id');
                // console.log("Bank Id: " + BankId);

                $.ajax({
                    url: 'api/admin-bank-details/' + BankId,
                    type: 'patch',
                    dataType: 'JSON',
                    data: formFields,
                    success: function(data) {
                        //alert(JSON.stringify(meta.message));
                        //console.log("ttttt");
                        if (data.error_code == 0) {
                            //console.log(data);
                            $('#bank_edit_form').modal('hide');
                            $('#dataTable').DataTable().ajax.reload();
                            Swal.fire({
                                title: "" + data.meta.message,
                                icon: 'success',
                                showCloseButton: true
                            })
                        } else {
                            swal(data.meta.message, "error");
                        }

                        $('#editBank').closest('form').find(
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




            //Delete Bank
            $("#dataTable").on('click', '.btn-bank_entry_delete', function() {

                var BankId = $(this).data('bankid');
                // console.log("BankId: " + BankId);

                Swal.fire({
                    title: "Do you want to delete this bank?",
                    text: "",
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        //  console.log("Result: " + result.value);
                        $.ajax({
                            url: 'api/admin-bank-details/' + BankId,
                            type: 'delete',
                            dataType: 'JSON',

                            success: function(data) {
                                //alert(JSON.stringify(meta.message));
                                //  console.log("ttttt");
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

                $('#submit_button').attr('data-bnk-id', $(this).data('bankid'));
            });



        });
    </script>
</body>

</html>
