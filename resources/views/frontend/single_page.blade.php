@extends('frontend.layout.app')
@section('title',$page->title)
@push('css')
@endpush
@section('content')


    <div class="tm-padding-section">
        <div class="container">
            <div class=" text-center" style="padding: 0px !important;">
				<h2 style="font-size: 32px;background: #00b9ff;color: white;font-weight: bold;">{!! $page->title !!}</h2>
			</div>
            <div class="row">

                <p class="text-justify" style="padding: 17px">{!! $page->desc !!}</p>

           </div>
</div>
    </div>

@endsection
@push('js')
@endpush
