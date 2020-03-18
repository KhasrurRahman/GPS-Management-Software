@extends('frontend.layout.app')
@section('title','Feature')
@push('css')
@endpush
@section('content')

    <div class="tm-padding-section">
        <div class="container">
            <div class=" text-center" style="padding: 0px !important;">
				<h2 style="font-size: 32px;background: #00b9ff;color: white;font-weight: bold;">Main Feature</h2>
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
