@extends('layouts.app')

@section('content')
<div class="content-wrapper">
	<style>
		.highcharts-credits {
			display: none;
		}

		.dashboard-total-products {
			font-size: 18px !important;
		}
	</style>

	<head>
	</head>
	<!-- Container-fluid starts -->
	<!-- Main content starts -->
	<div class="container-fluid">
		<div class="row">
			<div class="main-header">
				<h4>Main Dashboard <span style="font-size: 14px;"></span></h4>
			</div>
		</div>
		<!-- 4-blocks row start -->
		{{-- <div class="row m-b-30 dashboard-header">
			<div class="col-lg-3 col-sm-6">
				<div class="col-sm-12 card dashboard-product">
					<span>Total Sale</span>
					<h2 class="dashboard-total-products counter">62,593,212.00</h2>
					<div class="side-box bg-warning">
						<i class="fa fa-money"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="col-sm-12 card dashboard-product">
					<span>Total Receivable</span>
					<h2 class="dashboard-total-products counter">2,265,799.09&nbsp; Dr</h2>
					<div class="side-box bg-primary">
						<i class="fa fa-money"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="col-sm-12 card dashboard-product">
					<span>Total Payable</span>
					<h2 class="dashboard-total-products counter"> (551,351.36)&nbsp; Cr</h2>
					<div class="side-box bg-success">
						<i class="fa fa-money"></i>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6">
				<div class="col-sm-12 card dashboard-product">
					<span>Bank & Petty Cash Balance</span>
					<h2 class="dashboard-total-products counter"> 1,763,899.65&nbsp; Dr</h2>
					<div class="side-box bg-danger">
						<i class="fa fa-money"></i>
					</div>
				</div>
			</div>

		</div> --}}


		<!-- scroll bar start  -->
		{{-- <div class="container-fluid">
			<div class="row">
				<div class="col" style="display: flex; margin-bottom:2%;">
					<input type="text" class="mb-1 inputClass" id="inputField" placeholder="Search Here" style="padding: 0; width: 20%;margin-right :2%;" /><button class="btn btn-primary">Filter</button>
					<!-- search icon -->
					<a href="#" class="iconStyling  border-dark border-bottom border-top border-end "><i class="fa-sharp fa-solid fa-magnifying-glass text-dark mt-2"></i></a>

				</div>

			</div>
		</div> --}}

		{{-- <div class="container-fluid" class="results transition visible" id="result" style="display: none;">
			<div class="row">
				<div class="col">

					<ul class="unorderedList box" style="padding: 0;">
						<li class="listStyling"><a class="list_style" href="#">Last 7 Days</a></li>
						<li class="listStyling"><a class="list_style" href="#">Last 30 Days</a></li>
						<li class="listStyling"><a class="list_style" href="#">Last 6 Months</a></li>
						<li class="listStyling"><a class="list_style" href="#">Last 1 Year</a></li>
						<li class="listStyling"><a class="list_style" href="#">Last 10 Year</a></li>


					</ul>

				</div>

			</div>
		</div> --}}
        <div class="container-fluid">
			<div class="row">
				<div class="col" style="display:flex; margin-bottom:2%;">
					{{-- <input type="date" class="mb-1 inputClass form-control" style="padding: 0; width: 20%;margin-right :2%;" /> --}}
                    <select name="Search" style="margin-right:2%;" class="form-select" id="mySelect" onchange="showCalendar()">
                    <option> Select Option </option>
                    <option value="option1">Last 1 Day</option>
                    <option value="option2">Last 7 Days</option>
                    <option value="option3">Last 30 Days</option>
                    <option value="option4">Last 1 Year</option>

                    <option value="option5">Choose Custom</option>
                </select>
                    <button class="btn btn-primary">Filter</button>
					<!-- search icon -->
					{{-- <a href="#" class="iconStyling  border-dark border-bottom border-top border-end ">Filter</a> --}}


				</div>

			</div>
		</div>

        <div class="container-fluid">
			<div class="row">
				<div class="col" style="display:none;margin-bottom:2%;" id="calendar">
					<input type="date" class="mb-1 inputClass form-control" style="padding: 0; width: 20%;margin-right :2%;" />
                    {{-- <select name="Search" id="">
                    <option value="">Last 7 Days</option>
                    <option value="">Last 30 Days</option>
                    <option value="">Last 1 Year</option>
                    <option value="">Last 10 Year</option>
                </select> --}}
                    <button class="btn btn-primary">Filter</button>
					<!-- search icon -->
					{{-- <a href="#" class="iconStyling  border-dark border-bottom border-top border-end ">Filter</a> --}}


				</div>

			</div>
		</div>
		<!-- 4-blocks row end -->
		<!-- 1-3-block row start -->
		<div class="container-fluid">
            <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info" style="padding:5%;">
                <div class="inner">
                  <h3>150</h3>

                  <p style="color:rgb(68, 68, 68);font-size:1.3rem">Date Wise Sale</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success" style="padding:5%;">
                <div class="inner">
                  <h3>53<sup style="font-size: 20px"></sup></h3>

                  <p style="color:rgb(68, 68, 68);font-size:1.3rem">Online Sale</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning" style="padding:5%;">
                <div class="inner">
                  <h3>44</h3>

                  <p style="color:rgb(68, 68, 68);font-size:1.3rem">Location Wise Sale</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
              </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
          </div>
          <!-- /.row -->
			<div class="row" style="padding-top: 5%">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<div class="card-block" style="background: beige;">
									<div class="row m-b-10 dashboard-total-income">
										<div class="col-sm-12 text-left">
											<div id="client-wise"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row">
								<div class="col-sm-12">
									<div class="card">
										<div class="card-block" style="background: burlywood;">
											<div class="row m-b-10 dashboard-total-income">
												<div class="col-sm-12">
													<div id="vendor-wise"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="col-sm-12">
							<div class="card">
								<div class="card-block" style="background: currentColor;">
									<div class="row m-b-10 dashboard-total-income">
										<div class="col-sm-12 text-left">
											<div id="branch-wise"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- 1-3-block row end -->
	</div>
	<script type="text/javascript" src="{{ URL::asset('public/js/chart.min.js?v=1') }}"></script>
	<script src="https://code.highcharts.com/highcharts.js?v=1"></script>
	<script src="https://code.highcharts.com/highcharts.js?v=1"></script>
	<script>
		function clientWise() {
			Highcharts.chart('client-wise', {
				chart: {
					type: 'column'
				},
				title: {
					text: 'Date Wise Sale'
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					categories: ['Cash Sale', 'NAWABZADA SHAZAIN BUGTI', 'WAHAJ SAGHIR', 'NAYRA SARFRAZ', 'SHEERAZ OFFICE  ', 'DR NAVEED BAQAI', 'SYED ZAKI MUHAMMAD CO', 'SUI NORTHERN GAS PIPE LINE LTD', 'FARRUKH SHAHED (ELECTRONICS)', 'SIP NATALJA'],
					crosshair: true
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Amount (RS)'
					}
				},
				tooltip: {
					headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y:.1f} RS</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0
					}
				},
				series: [{
						name: 'Total Sale',
						data: [8132166, 3152759, 553120, 1322571, 5840031, 201100, 2328780, 832550, 363041, 900800]

					},
					/*{
				name: 'Profit',
				data: []

			}, */
					{
						name: 'Receiveable',
						data: [115164.69, -144741, 0, 0, 0, -59977, 0, 0, 6361, 64700]

					}
				]
			});
		}
		clientWise();

		function vendorWise() {
			Highcharts.chart('vendor-wise', {
				chart: {
					type: 'column'
				},
				title: {
					text: 'Online Sale'
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					categories: ['Azeem Vendor', 'Naeem Vendor', 'Mouse Vendor'],
					crosshair: true
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Amount (RS)'
					}
				},
				tooltip: {
					headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y:.1f} RS</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0
					}
				},
				series: [{
					name: 'Total Sale',
					data: [4500, 39135531.79799999, 3056511.06]

				}]
			});
		}
		vendorWise();

		function branchWise() {
			Highcharts.chart('branch-wise', {
				chart: {
					type: 'column'
				},
				title: {
					text: 'Location Wise Sale'
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					categories: [
						'Jan',
						'Feb',
						'Mar',
						'Apr',
						'May',
						'Jun',
						'Jul',
						'Aug',
						'Sep',
						'Oct',
						'Nov',
						'Dec',
					],
					crosshair: true
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Amount (RS)'
					}
				},
				tooltip: {
					headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y:.1f} RS</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0
					}
				},
				series: [{
					name: 'Head Office',
					data: [3053698, 4037235, 8188289, 4072829, 648402, 0, 0, 0, 0, 0, 0, 0]
				}, ]
			});
		}
		branchWise();

		// scroll bar
		$("#inputField").focus(function() {
			$("#result").css("display", "block");
		});
		//   for the hidding of the code
		$(document).click(function() {

		});
		let link = $('.inputClass');
		let box = $('.box');

		link.click(function() {
			box.show();
		});

		$(document).click(function() {
			box.hide();
		});

		box.click(function(e) {
			e.stopPropagation();

		})
		link.click(function(e) {
			e.stopPropagation();

		});
	</script>
	@endsection
	@section('css_files')
	<!-- bootstrap files -->
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" /> -->
	<!-- css files -->
	<link rel="stylesheet" href="/public/assets/css/scroll_bar.css" />
	<!-- font awesome -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
	<!-- jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function showCalendar() {
          var select = document.getElementById("mySelect");
          var calendar = document.getElementById("calendar");

          if (select.value === "option5") {
            calendar.style.display = "block";
          } else {
            calendar.style.display = "none";
          }
        }
        </script>
	@endsection
