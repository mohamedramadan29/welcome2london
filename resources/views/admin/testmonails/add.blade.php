@extends('admin.layouts.master')
@section('title')
    اضف راي جديد
@endsection
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  اضف راي جديد  </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <!-- row -->
    <div class="row row-sm">

        <!-- Col -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if(Session::has('Success_message'))
                        <div
                            class="alert alert-success"> {{Session::get('Success_message')}} </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-4 main-content-label">  اضف راي جديد </div>
                    <form class="form-horizontal" method="post" action="{{url('admin/testmonail/add')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">  اسم الشخص </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input required type="text" class="form-control" name="person_name"
                                                   value="{{old('person_name')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> الصورة </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input required type="file" class="form-control" name="image">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> كتابة التعليق   </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea cols="" rows="5" class="form-control" required
                                                      name="person_desc">{{old('person_desc')}}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card-footer text-left">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">  اضافة راي
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- /Col -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection

