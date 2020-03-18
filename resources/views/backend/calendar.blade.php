@extends('backend.layout.app')
@section('title','Search Billing Schedule')
@push('css')

      <style>
    .event-log {
      font-family: consolas, Monaco, monospace;
      margin: 10px 5px;
      line-height: 2;
      border: 1px solid #4c4c4c;
      height: auto;
      width: 90%;
      padding: 2px 6px;
      color: #4c4c4c;
      white-space: pre;
    }
  </style>

@endpush
@section('main_menu','HOME')
@section('active_menu','Search Billing Schedule')
@section('link',route('admin.adminDashboard'))
@section('content')



<div class="container">
    <div class="row">

        <div class="col-md-6 justify-content-center" style="margin: 0 auto">
                    <div class="card card-success">
                      <div class="card-header">
                        <h3 class="card-title">Search Billing Schedule By Picking a date</h3>
                      </div>
                      <div class="card-body">

                          <form action="{{route('admin.calendar_search')}}" method="post" class="mt-2">
                            @csrf
                            <input class="form-control form-control-lg" type="text" id="date" value="" name="date" readonly>
                        <br>
                            <button class="btn btn-success btn-block" type="submit">Search</button>
                         </form>
                      </div>
                      <!-- /.card-body -->
                 </div>
        </div>

    </div>
</div>




@endsection
@push('js')


  <script>
      function calendar(){
      let simplepicker = new SimplePicker({
      zIndex: 10
    });
           simplepicker.open();

    const $button = document.querySelector('button');
    const $eventLog = document.querySelector('.event-log');
    $button.addEventListener('click', (e) => {
      simplepicker.open();

    });

    // $eventLog.innerHTML += '\n\n';
    simplepicker.on('submit', (date, readableDate) => {
      document.getElementById('date').value = readableDate;
    });

    simplepicker.on('close', (date) => {
      $eventLog.innerHTML += 'Picker Closed'  + '\n';
    });
      }

  </script>
@endpush
