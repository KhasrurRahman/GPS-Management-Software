<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        @php($cover = $banner = \App\HomePageModel::all()->first())
      <img class="d-block w-100 h-50" src="{{asset('storage/app/public/home_cover/'.$cover->cover_image)}}" alt="First slide">
    </div>


      @php($covers = $banner = \App\HomePageModel::all())
      @foreach($covers as $key=>$data )
@if($key > 0)
      <div class="carousel-item">
      <img class="d-block w-100 h-50" src="{{asset('storage/app/public/home_cover/'.$data->cover_image)}}" alt="First slide">
      </div>
      @endif
       @endforeach

  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
