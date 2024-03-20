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
    {{--<link href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}"--}}
          {{--rel="stylesheet" media="screen" />--}}
    {{--<link href="{{ asset('http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') }}"--}}
          {{--rel="stylesheet">--}}
  {{--  <link rel="stylesheet"
          href="{{ asset('http://fortawesome.github.io/Font-Awesome/3.2.1/assets/font-awesome/css/font-awesome.css') }}">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
            href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i') }}"
            rel="stylesheet">--}}

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>


    </style>
</head>

<body id="page-top">
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4" style="margin:auto; width: 70%; padding:10px; background-color:#1e32fa;">
        <div class="card-header py-3">
            <!-- <img src="img/logo.png" width="60%" style="margin-left: 20%"> -->
            {{-- <h5 class="m-0 font-weight-bold text-primary" style="text-align: center">SCAN TO PAY</h5> --}}
            <h5 class="m-0 font-weight-bold " style="text-align: center; background-color:#1e32fa; color: #FFFFFF;">SCAN TO PAY</h5>
        </div>

        <div class="card">
            <div class="card-body">
                        <div>
                            <div class="" style="text-align: center;width: 240px;margin: 5px auto;height: 70px;display: block;">
                              <!-- <div style="text-align:center; width:100%;"> -->
                             @if(isset($userDetails['profile_pic_img_url']) && !empty($userDetails['profile_pic_img_url']))
                              <div style="float:left;margin-right: 0;width: 30%;text-align: center;">
                              @else
                              <div style="float:left;margin-right: 0;width: 0%;text-align: center;">
                              @endif
                               <img src="{{ $userDetails['profile_pic_img_url'] }}" width="60" height="60" alt="img" id="profile-img" style="border-radius:50%;">
                              </div>
                              @if(isset($userDetails['profile_pic_img_url']) && !empty($userDetails['profile_pic_img_url']))
                               <div style="float:left;width: 70%;text-align: center;">
                               @else
                               <div style="float:left;width: 100%;text-align: center;">
                               @endif
                                   <label for="exampleInputEmail1" style="width:100%; padding-bottom:0px;font-size:16px;"><b>{{$userDetails['full_name']}}</b></label> 
                                   <label for="exampleInputEmail1">{{$userDetails['pacpay_user_id']}}</label>
                                   <!-- <label for="exampleInputEmail1">{{$userDetails['mobile_no']}}</label> -->
                               </div>
                              <!-- </div> -->
                            </div>
                            
                            <div class="qr_wrap" style="width:50%; margin:0 auto; text-align:center; display:block;"> 
                                    <img src="data:image/png;base64, {!! base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::size(450)
                                            ->format('png')
                                        ->backgroundColor(255, 255, 255)
                                             ->merge('/public/img/qr_logo.png',0.4)
                                             ->errorCorrection('H')
                                             ->generate($userDetails['qr_code_info'])) !!}" style="height:230px; width:230px; margin:0px auto; text-align:center;">

                                <!-- <h5 class="m-0 font-weight-bold "
                                    style="text-align: center; background-color:#1e32fa; color: #FFFFFF;">SCAN TO PAY
                                </h5> -->
                            </div>
                            <br />
                            <!-- <div class="form-group" style="text-align: center; color: #1e32fa"> -->
                                <!-- <img src="{{ $userDetails['profile_pic_img_url'] }}"
                                                            width="150" alt="img" id="profile-img"> -->
                                <!-- <label for="exampleInputEmail1">{{$userDetails['full_name']}} ({{$userDetails['pacpay_user_id']}}) </label><br />
                                <label for="exampleInputEmail1">{{$userDetails['mobile_no']}}</label> -->
                            <!-- </div> -->
                        </div>

            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".navbar-nav li").removeClass("active"); //this will remove the active class from
        //previously active menu item
        //$('#home').addClass('active');
        //for demo
        //$('#user').addClass('active');
        //for sale
        //$('#merchant').addClass('active');
    });
</script>
</body>
</html>
