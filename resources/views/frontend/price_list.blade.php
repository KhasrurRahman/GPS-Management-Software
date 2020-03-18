@extends('frontend.layout.app')
@section('title','Price')
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
    </style>

@endpush
@section('content')


<div class="container">
		<div class="tm-padding-section">
			<div class="tm-section-title text-center" style="padding: 0px !important;">
				<h2>Price List</h2>
			</div>
			<div class="row justify-content-center mt-30-reverse">

                @foreach($price as $key=>$data)

				<div class="col-lg-3 col-md-6 col-sm-10 col-12 mt-30 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;padding: 8px !important;">
					<div class="tm-pricebox" style="padding: 0px !important;">
						<div class="tm-pricebox-header"  style="border-bottom: 2px solid #f15922">
							<div class="top" style="background-image: url('{{asset('storage/app/public/price_list/'.$data->bg_image)}}') !important;">
								<h3 class="top_header"><span style="color: #ffffff;"></span></h3>

							</div>
						</div>
						<div class="packInfo">
							Device price<span style="display: inline-block;">{{$data->device_price}}</span> Tk. and Monthly Charge <span style="display: inline-block;">{{$data->monthly_charge}}</span> Tk.
						</div>
						<div class="tm-pricebox-body pl-3 pr-2">
							<ul style="text-align: left !important;">

								<li></li>
                                @php($sub_cat = \App\Price_sub_category::where('price_id',$data->id)->get())
                                @foreach($sub_cat as $sub_data)
                                    @if($sub_data->active_status == 1)
								<li><i class="fa fa-check"></i>{{$sub_data->name}}</li>
                                    @else
								<li><i class="fa fa-times"></i>{{$sub_data->name}}</li>
                                    @endif
                                @endforeach
							</ul>
						</div>

						<div class="tm-pricebox-footer mb-5">
							<a type="button" class="tm-button tm-button-dark" @if(\Illuminate\Support\Facades\Auth::check())
                                   href="{{route('user.payment',$data->id)}}"
                                   @else

                                 href="{{route('guest_customer_order',$data->id)}}"
                                   @endif>Buy Now<b style="top: -32px; left: 64.2813px;"></b></a>
						</div>


					</div>
				</div>

               @endforeach

			</div>


		</div>
	</div>






@endsection
@push('js')


@endpush
