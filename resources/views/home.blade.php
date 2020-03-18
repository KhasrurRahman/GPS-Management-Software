@extends('frontend.layout.app')
@section('title','Home')
@push('css')
    <style>

    .top {
    	overflow: hidden;
    	/*background: #f7931e;*/
    	text-align: center;
    	color: #fff;
        height: 200px;
    }
    .top h3 {
    	display: block;
    	/*margin-top: 22px;*/
    	line-height: 1;
    	font-size: 20px;
    	/*margin-bottom: 29px;*/
    }
    .top h4 {
    	font-size: 16px;
    	/*margin-top: 20px;*/
    	/*margin-bottom: 15px !important;*/
    }
    .newPrice {
    	font-size: 25px;
    	color: #000;
    	line-height: 1.4;
    }
    .oldPrice {
    	font-size: 22px;
    	color: #999;
    	text-decoration: line-through;
    	line-height: 1;
    }
    .packPrice {
    	width: 163px;
    	margin: 0 auto;
    	margin-bottom: 0px;
    	padding: 26px 0px;
    	background: #fff;
    	color: #333;
    	border-radius: 50%;
    	transform: rotate(-15deg);
    	margin-bottom: 15px !important;
    	position: relative;
    	box-shadow: -1px 1px 21px rgba(0, 0, 0, 0.4);
    	line-height: 1;
    }
    .packPrice::before {
    	border-color: #D225CC;
    }
    .packPrice::before {
    	width: calc(100% + 14px);
    	position: absolute;
    	content: "";
    	left: -7px;
    	top: -7px;
    	height: calc(100% + 14px);
    	border: 3px solid #FFBE4F;
    	border-top-color: rgb(255, 190, 79);
    	border-right-color: rgb(255, 190, 79);
    	border-bottom-color: rgb(255, 190, 79);
    	border-left-color: rgb(255, 190, 79);
    	border-radius: 50%;
    }
    .packInfo {
    	line-height: 1.2;
    	text-align: center;
    	font-size: 15px;
    	color: #000;
    	margin-top: 12px;
    	font-weight: 400;
    }
    .packInfo span {
    	color: #FF4F51;
    	font-weight: bold;
    	font-size: 20px;
    }
    .tm-pricebox-body ul li i.fa-check {
    	background-color: #7BD11F;
    }
    .tm-pricebox-body ul li i.fa {
    	color: #fff;
    	text-align: center;
    	width: 19px;
    	padding: 4px 0px;
    	height: auto;
    	border-radius: 50%;
    	font-size: 11px;
    	margin-right: 10px;
    }
    .tm-pricebox-body ul li i.fa-times {
    	background-color: #ff6259;
    }
    .tm-pricebox-body ul li i.fa {
    	color: #fff;
    	text-align: center;
    	width: 19px;
    	padding: 4px 0px;
    	height: auto;
    	border-radius: 50%;
    	font-size: 11px;
    	margin-right: 10px;
    }

        .top_header{
            padding: 6px;
            font-weight: bold;
            font-size: 23px;
        }
        .title_border_buttom{
            border-bottom: 3px solid #f15922;
            font-weight: bold;
            font-size: 28px;
        }

    </style>
@endpush

@section('content')
@include('frontend.layout.home_cover')



            <!--Pricing-->
            <div class="tm-section services-area pt-2 bg-grey">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10 col-12">
                            <div class="text-center" style="padding: 0px !important;">
                                <h2><span class="title_border_buttom">Price List</span></h2>
                            </div>
                        </div>
                    </div>
            <div class="row justify-content-center mt-30-reverse">


				@foreach($price as $main_key=>$data)
                    @break($main_key == 8)
				<div class="col-lg-3 col-md-6 col-sm-10 col-12 mt-30 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;padding: 8px !important;">
					<div class="tm-pricebox" style="padding: 0px !important;">
						<div class="tm-pricebox-header" style="border-bottom: 2px solid #f15922">
							<div class="top" style="background-image: url('{{asset('storage/app/public/price_list/'.$data->bg_image)}}') !important;">
								<h3 class="top_header"><span style="color: #000000;text-shadow: 2px 3px 4px #f5f5f5;font-family: 'Open Sans',sans-serif"></span></h3>

							</div>
						</div>
						<div class="packInfo">
							Device price<span style="display: inline-block;">{{$data->device_price}}</span> Tk. and Monthly Charge <span style="display: inline-block;">{{$data->monthly_charge}}</span> Tk.
						</div>
						<div class="tm-pricebox-body pl-3 pr-2">
							<ul style="text-align: left !important;">

								<li></li>
                                @php($sub_cat = \App\Price_sub_category::where('price_id',$data->id)->get())
                                @foreach($sub_cat as $key=>$sub_data)

                                    @break($key == 4)

                                    @if($sub_data->active_status == 1)
								<li><i class="fa fa-check"></i>{{$sub_data->name}}</li>
                                    @else
								<li><i class="fa fa-times"></i>{{$sub_data->name}}</li>
                                    @endif

                                @endforeach

                                <Span style="display: none" class="show_details_{{$data->id}}">
                                @foreach($sub_cat as $key=>$sub_data2)

                                    @if($key <4)
                                    @else
                                       @if($sub_data2->active_status == 1)
                                    <li><i class="fa fa-check"></i>{{$sub_data2->name}}</li>
                                        @else
                                    <li><i class="fa fa-times"></i>{{$sub_data2->name}}</li>
                                        @endif
                                     @endif

                                @endforeach
                                </Span>


							</ul>
						</div>

                        <span class="show_details_{{$data->id}}" style="display: none">
						<div class="tm-pricebox-footer mb-5">
							<a type="button" class="tm-button tm-button-dark"
                               @if(\Illuminate\Support\Facades\Auth::check())
                                   href="{{route('user.payment',$data->id)}}"
                                   @else

                                 href="{{route('guest_customer_order',$data->id)}}"
                                   @endif

                            >Buy Now<b style="top: -32px; left: 64.2813px;"></b></a>
						</div>
                         </span>

                        <a href="#" type="button" class="btn btn-info mt-2 mb-2" id="show{{$data->id}}" onclick="showfullprice({{$data->id}})" style="color: white">Show More</a>


					</div>
				</div>

               @endforeach


			</div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tm-portfolio-loadmore text-center mt-3 mb-2">
                                <a href="{{route('price_list')}}" class="tm-button tm-button-dark">View All<b></b></a>
                            </div>
                        </div>
                    </div>
              </div>
            </div>

            <!--Price List-->


            <!-- Main Feature -->
            <div class="tm-section about-us-area bg-white pt-2 ">
                <div class="text-center" style="padding: 0px !important;">
                    <h2 style="margin-bottom: 0px"><span class="title_border_buttom">Main Feature</span></h2>
                 </div>
                <div class="container">
                    <div class="row">
                                    @foreach($feature as $key=>$data)
                                        @break($key== 12)
                                        <div class="col-sm-6 col-xs-6 col-lg-2 text-center" style="padding-top: 30px">
                                                            <div class="card text-center" style="padding: 20px; max-height: 160px; min-height: 160px;">
                                                                <p style="margin-bottom: 0px">
                                                                    <img src="{{asset('storage/app/public/feature/'.$data->image)}}" height="70px" style="padding: 10px" width="auto">
                                                                    <br>
                                                                    <b>{{$data->name}}</b>
                                                                </p>
                                                            </div>
                                        </div>

                                    @endforeach

                                </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tm-portfolio-loadmore text-center mb-3 mt-3">
                                <a href="{{route('feature')}}" class="tm-button tm-button-dark mb-2">View All<b></b></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--// Main Feature -->



            <!-- Mobile app And Web -->
            <div class="tm-section about-us-area bg-white tm-padding-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="about-image2">
                                <img class="wow fadeInLeft" src="{{asset('public/assets/frontend/images/bg/app-2.png')}}" alt="about image" style="visibility: visible; animation-name: fadeInLeft;">
                            </div>
                        </div>
{{--                        <div class="col-lg-4">--}}
{{--                            <div class="about-image2">--}}
{{--                                <img class="wow fadeInLeft" src="assets/images/others/about-image-2.png" alt="about image" style="visibility: visible; animation-name: fadeInLeft;">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-lg-6">
                            <div class="about-content">
                                <h2>Mobile app And Web</h2>
                                <h6>Lorem ipsum dolor sit amet consectetur adipisicing elitsed do
                                    eiusmod ncididunt ametfh consectetur.</h6>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod ncididunt
                                    ametfh consectetur dolore magna aliqua. Ut enim ad minim veniam dolor sitame
                                    magnaelit ate consectetur adipisicing. Expedita omnis maiores aliquam hic ab
                                    dolorem aut. Saepe voluptatem pariatur aut vel repellat. Quo quis voluptas sunt
                                    laudantium est et.</p>
                                <ul class="stylish-list">
                                    <li><i class="far fa-check-square"></i>We are providing different services</li>
                                    <li><i class="far fa-check-square"></i>We are one of leading company</li>
                                    <li><i class="far fa-check-square"></i>We are one of leading company</li>
                                    <li><i class="far fa-check-square"></i>We are one of leading company</li>
                                    <li><i class="far fa-check-square"></i>We are one of leading company</li>
                                </ul>
                                <a href="#" ><img src="{{asset('public/assets/frontend/images/bg/sote.png')}}" alt="" style="height: 140px;margin-top: 10px"><b></b></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Mobile app And Web -->



            <!-- We Cover -->
            <div class="tm-section services-area p-2 bg-grey">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10 col-12">
                            <div class="text-center">
                                <h2><span class="title_border_buttom">We Cover</span></h2>

                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-3 col-sm-12 mt-2" style="" >
                            <img src="{{asset('public/assets/frontend/images/bg/images.png')}}" alt="" height="200" style="box-shadow: 3px 3px 6px 0px;width: 100% !important;">
                            <spna><p style="background: white;box-shadow: 3px 3px 6px 0px;padding: 3px;text-align: center;font-size: 19px;font-weight: bold;margin: 0px;">asd asd asda</p></spna>

                        </div>

<div class="col-md-3 col-sm-12 mt-2" style="" >
                            <img src="{{asset('public/assets/frontend/images/bg/images.png')}}" alt="" height="200" style="box-shadow: 3px 3px 6px 0px;width: 100% !important;">
                            <spna><p style="background: white;box-shadow: 3px 3px 6px 0px;padding: 3px;text-align: center;font-size: 19px;font-weight: bold;margin: 0px;">asd asd asda</p></spna>

                        </div>


<div class="col-md-3 col-sm-12 mt-2" style="" >
                            <img src="{{asset('public/assets/frontend/images/bg/images.png')}}" alt="" height="200" style="box-shadow: 3px 3px 6px 0px;width: 100% !important;">
                            <spna><p style="background: white;box-shadow: 3px 3px 6px 0px;padding: 3px;text-align: center;font-size: 19px;font-weight: bold;margin: 0px;">asd asd asda</p></spna>

                        </div>

                        <div class="col-md-3 col-sm-12 mt-2" style="" >
                            <img src="{{asset('public/assets/frontend/images/bg/images.png')}}" alt="" height="200" style="box-shadow: 3px 3px 6px 0px;width: 100% !important;">
                            <spna><p style="background: white;box-shadow: 3px 3px 6px 0px;padding: 3px;text-align: center;font-size: 19px;font-weight: bold;margin: 0px;">asd asd asda</p></spna>

                        </div>

                    </div>
                </div>
            </div>
            <!--// Main Feature -->





            <!-- Our Client -->
            <div class="tm-section brand-logos-area  bg-white mb-3">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10 col-12">
                            <div class="text-center mt-2">
                                <h2><span class="title_border_buttom">Some of Our Valuable Client</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="brandlogo-slider">

                        @foreach($happy_client as $data)
                        <div class="brandlogo">
                            <a href="#">
                                <img src="{{asset('storage/app/public/happy_client/'.$data->image)}}" alt="brand-logo">
                            </a>
                        </div>
                       @endforeach


                    </div>
                </div>
            </div>
            <!--// Our Client -->


<!-- Our DevicePartners -->
            <div class="tm-section brand-logos-area  bg-grey">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10 col-12">
                            <div class="text-center mt-2">
                                <h2><span class="title_border_buttom">Our Device Partners</span></h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <img src="{{asset('public/assets/frontend/images/bg/gp.png.webp')}}" alt="">
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <img src="{{asset('public/assets/frontend/images/bg/bl.png.webp')}}" alt="">
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <img src="{{asset('public/assets/frontend/images/bg/ws.png.webp')}}" alt="">
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <img src="{{asset('public/assets/frontend/images/bg/gp.png.webp')}}" alt="">
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <img src="{{asset('public/assets/frontend/images/bg/bl.png.webp')}}" alt="">
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <img src="{{asset('public/assets/frontend/images/bg/ws.png.webp')}}" alt="">
                        </div>
                    </div>

                </div>
            </div>
     <!--// Our DevicePartners -->




        <!-- Our Telecom Partners -->
            <div class="tm-section brand-logos-area  bg-white">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10 col-12">
                            <div class="text-center mt-2">
                                <h2><span class="title_border_buttom">Our Telecom Partners</span></h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <img src="{{asset('public/assets/frontend/images/bg/gp.png.webp')}}" alt="">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <img src="{{asset('public/assets/frontend/images/bg/bl.png.webp')}}" alt="">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <img src="{{asset('public/assets/frontend/images/bg/ws.png.webp')}}" alt="">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <img src="{{asset('public/assets/frontend/images/bg/ws.png.webp')}}" alt="">
                        </div>
                    </div>

                </div>
            </div>
            <!--// Our Telecom Partners -->




           <!-- Count Down Area -->
            <div class="tm-section funfact-area tm-padding-section mt-30 bg-white"
                data-black-overlay="8">
                <div class="funfact-areashape" style="background: whitesmoke !important;">
{{--                    <img src="{{asset('public/assets/frontend/images/funfact/funfact-shape.png')}}" alt="funfact area shape">--}}
                </div>
                <div class="container-fluid">
                    <div class="row mt-30-reverse justify-content-center">

                        <!-- Funfact Single -->
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12 mt-30">
                            <div class="tm-funfact">
                                <span class="tm-funfact-icon">
                                    <img src="{{asset('public/assets/frontend/images/bg/man.png')}}" alt="" height="80px">
                                </span>
                                <div class="tm-funfact-content">
                                    <span class="odometer" data-count-to="1500"></span ><span style="font-size: 32px;margin-top: 21px;font-weight: bold;">+</span>
                                    <h5>Happy Clients</h5>
                                </div>
                            </div>
                        </div>
                        <!--// Funfact Single -->

                        <!-- Funfact Single -->
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12 mt-30">
                            <div class="tm-funfact">
                                <span class="tm-funfact-icon">
                                    <img src="{{asset('public/assets/frontend/images/bg/car.png')}}" alt="" height="80px">
                                </span>
                                <div class="tm-funfact-content">
                                    <span class="odometer" data-count-to="1600"></span><span style="font-size: 32px;margin-top: 21px;font-weight: bold;">+</span>
                                    <h5>Cars</h5>
                                </div>
                            </div>
                        </div>
                        <!--// Funfact Single -->

                        <!-- Funfact Single -->
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12 mt-30">
                            <div class="tm-funfact">
                                <span class="tm-funfact-icon">
                                    <img src="{{asset('public/assets/frontend/images/bg/truck.png')}}" alt="" height="80px">
                                </span>
                                <div class="tm-funfact-content">
                                    <span class="odometer" data-count-to="1600"></span><span style="font-size: 32px;margin-top: 21px;font-weight: bold;">+</span>
                                    <h5>Truck & Bus</h5>
                                </div>
                            </div>
                        </div>
                        <!--// Funfact Single -->

                        <!-- Funfact Single -->
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12 mt-30">
                            <div class="tm-funfact">
                                <span class="tm-funfact-icon">
                                    <img src="{{asset('public/assets/frontend/images/bg/bike.png')}}" alt="" height="80px">
                                </span>
                                <div class="tm-funfact-content">
                                    <span class="odometer" data-count-to="500"></span><span style="font-size: 32px;margin-top: 21px;font-weight: bold;">+</span>
                                    <h5>Bikes</h5>
                                </div>
                            </div>
                        </div>
                        <!--// Funfact Single -->

                        <!-- Funfact Single -->
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12 mt-30">
                            <div class="tm-funfact">
                                <span class="tm-funfact-icon">
                                    <img src="{{asset('public/assets/frontend/images/bg/auto-ricksaw.png')}}" alt="" height="80px">
                                </span>
                                <div class="tm-funfact-content">
                                    <span class="odometer" data-count-to="2000"></span><span style="font-size: 32px;margin-top: 21px;font-weight: bold;">+</span>
                                    <h5>Auto Ricksaw</h5>
                                </div>
                            </div>
                        </div>
                        <!--// Funfact Single -->

                        <!-- Funfact Single -->
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12 mt-30">
                            <div class="tm-funfact">
                                <span class="tm-funfact-icon">
                                    <img src="{{asset('public/assets/frontend/images/bg/work.png')}}" alt="" height="80px">
                                </span>
                                <div class="tm-funfact-content">
                                    <span class="odometer" data-count-to="75"></span><span style="font-size: 32px;margin-top: 21px;font-weight: bold;">+</span>
                                    <h5>Corporate Clients</h5>
                                </div>
                            </div>
                        </div>
                        <!--// Funfact Single -->

                    </div>
                </div>
            </div>
            <!--// Count Down Area -->

@endsection
@push('js')



<script>
function showfullprice(id){
    console.log(id);
    $(".show_details_"+id).show(800);
    $("#show"+id).hide();
}
</script>
@endpush















