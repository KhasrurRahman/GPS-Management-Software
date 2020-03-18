@extends('frontend.layout.app')
@section('title','Devices')
@push('css')
    <style>
        .card-body h5{
            font-weight: bold;
            text-align: center;
        }
    </style>
@endpush
@section('content')


    <div class="tm-padding-section">
        <div class="container">
            <div class=" text-center" style="padding: 0px !important;">
				<h2 style="font-size: 32px;background: #f15922;color: white;font-weight: bold;">Tracking Devices</h2>
			</div>

            <div class="row">

                @foreach($device as $data)
                <div class="col-md-3 col-sm-12 mt-2">
                    <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="{{asset('storage/app/public/tracking_device/'.$data->image)}}" alt="Card image cap" height="180px">
                  <div class="card-body">
                      <hr>
                    <h5 class="card-title">{{$data->device_name}}</h5>
                    <p class="card-text">{{$data->description}}</p>
                    <a href="{{route('price_list')}}" class="btn btn-info btn-block" style="color: white">Buy Now</a>
                  </div>
                </div>
               </div>
                @endforeach

            </div>


        </div>
     </div>

    <div class="tm-padding-section">
        <div class="container">
            <div class="tm-section-title text-center mt-2" style="padding: 0px !important;">
				<h2>Main Feature</h2>
			</div>
            <div class="row">

                @foreach($feature as $data)

                  <div class="col-sm-12 col-lg-3 text-center" style="padding-top: 30px">
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
</div>
    </div>


@endsection
@push('js')
@endpush
