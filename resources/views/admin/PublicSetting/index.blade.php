@extends('admin.layouts.master')
@section('title')
     اعدادت العاامة
@endsection
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تعديل محتوي الصفحة الرئيسية  </span>
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
                    <div class="mb-4 main-content-label"> اعدادات العامة  </div>
                    <form class="form-horizontal" method="post" action="{{url('admin/public_setting/update')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">  رقم الهاتف </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name='phone'
                                           value="{{$setting['phone']}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label"> البريد الالكتروني  </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name='email'
                                           value="{{$setting['email']}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">  العنوان   </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name='address'
                                           value="{{$setting['address']}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">  توقيت العمل  </label>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="time_work" id="" class="form-control">{{$setting['work_time']}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">  رابط الفسبوك  </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name='facebook_link'
                                           value="{{$setting['facebook_link']}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">  رابط تويتر  </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name='twitter_link'
                                           value="{{$setting['twitter_link']}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">  رابط تيك توك   </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name='tiktok_link'
                                           value="{{$setting['tiktok_link']}}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">تعديل البيانات
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

