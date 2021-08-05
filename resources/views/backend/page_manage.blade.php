@extends('backend.layout.app')
@section('title',$page->title)
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu',$page->title)
@section('link',route('admin.adminDashboard'))
@section('content')


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.manage_page_save',$page->id)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Product Title</label>
                                        <input type="text" class="form-control" name="title"
                                               value="{!! $page->title !!}">
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="textarea"  rows="10" name="desc">{!! $page->desc !!}</textarea>
                                    </div>
                                </div>

                            </div>


                            <button class="btn btn-primary pull-right" type="submit">Save</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>








@endsection
@push('js')
@endpush
