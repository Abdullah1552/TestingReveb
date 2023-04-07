<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('', 'Revebe-Digital-Agency') }}</title>

    <link rel="shortcut icon" href="{{ URL::asset('public/assets/images/favicon.png') }}" type="image/x-icon">
     <link rel="icon" href="{{ URL::asset('public/assets/images/favicon.png') }}" type="image/x-icon">
     <!-- Google font-->
     <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
     <!-- iconfont -->
     <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/icon/icofont/css/icofont.css?v=1') }}">
     <!-- simple line icon -->
     <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/icon/simple-line-icons/css/simple-line-icons.css') }} ">
	 <!-- Font Awesome -->
	<link href="{{ URL::asset('public/assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
	 <!-- Select 2 css -->
	<link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/select2/dist/css/select2.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/plugins/select2/css/s2-docs.css') }}">
	<!-- Multi Select css -->
	<link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/bootstrap-multiselect/dist/css/bootstrap-multiselect.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/multiselect/css/multi-select.css') }}" />
	<!-- Date Picker css -->
	<link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" />
	<!-- Bootstrap Date-Picker css -->
	<link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datetimepicker.css') }} " />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" />
	<!-- Color Picker css -->
	<link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/spectrum/spectrum.css') }}" />
     <!-- Required Fremwork -->
     <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
     <!-- Weather css -->
     <link href="public/assets/css/svg-weather.css" rel="stylesheet">
     <!-- Echart js -->
     <script src="{{ URL::asset('public/assets/plugins/charts/echarts/js/echarts-all.js') }}"></script>
     <!-- Style.css -->
     <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/main.css?v=1620732357') }}">
     <!-- Responsive.css-->
     <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/responsive.css') }}">
	 <!-- Tags css -->
	<link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" />
	<!-- bash syntaxhighlighter css -->
	<link type="text/css" rel="stylesheet" href="{{ URL::asset('public/assets/plugins/syntaxhighlighter/styles/shCoreDjango.css') }}"/>
	<link type="text/css" rel="stylesheet" href="{{ URL::asset('public/assets/css/toastr.min.css') }}"/>
     <!--color css-->
     <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/color/color-1.min.css') }}" id="color"/>
	 <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/style.css') }}" />
	 <script src="{{ URL::asset('public/assets/plugins/Jquery/dist/jquery.min.js') }}"></script>
    @yield('css_files')
    
    <style>
		.btn-primary{
			background-color: #204668 !important;
			border-color: #204668 !important;
			color: white;
		}
		.btn-danger{
			background-color: #df3636  !important;
			border-color: #741c1c !important;
			color: white;
		}
		.btn-success{
			background-color: #439947 !important;
			border-color: #439947 !important;
			color: white;
		}
		.btn-info{
			background-color: #4cb7e7  !important;
			border-color: #4cb7e7  !important;
			color: white;
		}
    </style>

</head>
    <body class="sidebar-mini fixed">
        <div class="loader-bg">
				<div class="loader-bar">
				</div>
		</div>
        <div class="wrapper">
           @include('layouts.navbar')
           @include('layouts.mysideNav')
           @include('layouts.aside')
            @yield('content')
            @yield('content12')

		</div><!--wrapper-->
		@yield('js_files')
	</body>
</html>
<!-- Required Jqurey -->
      <script src="{{ URL::asset('public/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
      <script src="{{ URL::asset('public/assets/plugins/tether/dist/js/tether.min.js') }}"></script>

      <!-- Required Fremwork -->
      <script src="{{ URL::asset('public/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

      <!-- waves effects.js -->
      <script src="{{ URL::asset('public/assets/plugins/Waves/waves.min.js') }}"></script>

      <!-- Scrollbar JS-->
      <!--<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
      <script src="assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js"></script>-->

      <!--classic JS-->
		<script src="{{ URL::asset('public/assets/plugins/classie/classie.js') }}"></script>

      <!-- notification -->
      <script src="{{ URL::asset('public/assets/plugins/notification/js/bootstrap-growl.min.js') }}"></script>
	  <!-- Date picker.js -->
	 <script src="{{ URL::asset('public/assets/plugins/datepicker/js/moment-with-locales.min.js') }}"></script>
	<script src="{{ URL::asset('public/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

      <!-- Rickshaw Chart js -->
      <script src="{{ URL::asset('public/assets/plugins/d3/d3.js') }}"></script>
      <!--<script src="assets/plugins/rickshaw/rickshaw.js"></script>-->

      <!-- Sparkline charts -->
      <script src="{{ URL::asset('public/assets/plugins/jquery-sparkline/dist/jquery.sparkline.js') }}"></script>
	  <!-- Bootstrap Datepicker js -->
		<script type="text/javascript" src="{{ URL::asset('public/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
		<script src="{{ URL::asset('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('public/assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
      <!-- Counter js  -->
      <script src="{{ URL::asset('public/assets/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
      <script src="{{ URL::asset('public/assets/plugins/countdown/js/jquery.counterup.js') }}"></script>

      <!-- custom js -->
      <script type="text/javascript" src="{{ URL::asset('public/assets/js/main.min.js?v=1') }}"></script>
      <!--<script type="text/javascript" src="assets/pages/dashboard.js"></script>-->
      <script type="text/javascript" src="{{ URL::asset('public/assets/pages/elements.js') }}"></script>
      <!--<script src="assets/js/menu.min.js"></script>-->
	  <script src="{{ URL::asset('public/assets/js/menu.js?v=1') }}"></script>
	  <script type="text/javascript" src="{{ URL::asset('public/assets/pages/advance-form.js') }}"></script>
	  <!-- Multi Select js -->
	 <script src="{{ URL::asset('public/assets/plugins/bootstrap-multiselect/dist/js/bootstrap-multiselect.js') }}"></script>
	 <script src="{{ URL::asset('public/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
	 <script type="text/javascript" src="{{ URL::asset('public/assets/plugins/multi-select/js/jquery.quicksearch.js') }}"></script>
	 <!-- highlite js -->
	 <!-- color picker -->
	<script type="text/javascript" src="{{ URL::asset('public/assets/plugins/spectrum/spectrum.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('public/assets/plugins/jscolor/jscolor.js') }}"></script>
	 <!-- Select 2 js -->
     <script src="{{ URL::asset('public/assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
	 <!-- Max-Length js -->
	 <script src="{{ URL::asset('public/assets/plugins/bootstrap-maxlength/src/bootstrap-maxlength.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('public/assets/plugins/syntaxhighlighter/scripts/shCore.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('public/assets/plugins/syntaxhighlighter/scripts/shBrushJScript.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('public/assets/plugins/syntaxhighlighter/scripts/shBrushXml.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('public/assets/pages/accordion.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('public/assets/js/toastr.min.js') }}"></script>
    <script type="text/javascript">SyntaxHighlighter.all();</script>
	<script type="text/javascript" src="{{ URL::asset('public/js/admin.js?v=1620732365') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('public/js/inc.func.js?v=1620732365') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('public/js/account.func.js?v=1620732365') }}"></script>
	{{--<script type="text/javascript" src="{{ URL::asset('pos') }}"></script>--}}
	<script type="text/javascript" src="{{ URL::asset('public/js/tourSale.js?v=1') }}"></script>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        $("#openNav").hide();
        $("#closeNav").show();
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        $("#closeNav").hide();
        $("#openNav").show();
    }
</script>
<script>
    $("ul.treeview-menu li").each(function(){
        if($(this).hasClass("active")){
            $(this).closest("li.treeview").addClass("active");
        }
    });
    $('.date').datepicker({
        todayBtn: false,
        clearBtn: false,
        keyboardNavigation: false,
        forceParse: false,
        todayHighlight: true,
        autoclose:true,
        format: 'yyyy-mm-dd'
    });
    {{--function cron_job() {
		$.ajax({
		url:"{{ url('optimize') }}",
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		dataType:"JSON",
		success:function (data) {

			}
		});
    }
    $(document).ready(function () {
        setTimeout(cron_job, 50000);
        //setInterval(cron_job,100000);
    });--}}
</script>
<script src="//js.pusher.com/3.1/pusher.min.js"></script>
<script type="text/javascript">
    var pusher = new Pusher('5b61c38692b9d9d203fb', {
        encrypted: true,
        "cluster":'ap2'
    });
    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('notification-send');
    // Bind a function to a Event (the full Laravel class)
    channel.bind('App\\Events\\UserNotification', function() {
        toastr.success('You have received Notification from Super Admin!');
    });
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    $(".select2").select2();

</script>
<script>
    business_decimal_points();
</script>
@include('pos.cash-register-modal')
