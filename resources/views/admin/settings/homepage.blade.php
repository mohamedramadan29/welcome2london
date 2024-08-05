@extends('admin.layouts.master')
@section('title')
    تعديل محتوي الصفحة الرئيسية
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
                    <div class="mb-4 main-content-label"> تعديل محتوي الصفحة الرئيسية</div>
                    <form class="form-horizontal" method="post" action="{{url('admin/homepage/update')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label"> العنوان الاول </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name='hero_first_title'
                                           value="{{$homedata['hero_first_title']}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label"> العنوان الثاني </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name='hero_second_title'
                                           value="{{$homedata['hero_second_title']}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label"> وصف القسم الاول </label>
                                </div>
                                <div class="col-md-9">
                                    <textarea class="form-control"
                                              name='hero_desc'>{{$homedata['hero_desc']}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">رقم الهاتف</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="hero_phone" class="form-control"
                                           value="{{$homedata['hero_phone']}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">  الصورة الاولي   </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="file" class="form-control" name="hero_image1" value="">
                                    <img width="80px" src="{{asset('assets/admin/uploads/homepage/'.$homedata['hero_image1'])}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">  الصورة الثانية   </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="file" class="form-control" name="hero_image2" value="">
                                    <img width="80px" src="{{asset('assets/admin/uploads/homepage/'.$homedata['hero_image2'])}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">   الصورة الثالثة  </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="file" class="form-control" name="hero_image3" value="">
                                    <img width="80px" src="{{asset('assets/admin/uploads/homepage/'.$homedata['hero_image3'])}}" alt="">
                                </div>
                            </div>
                        </div>

                        <h5> قسم من نحن  </h5>

                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">  العنوان  </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name='about_title'
                                           value="{{$homedata['about_title']}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label"> الوصف  </label>
                                </div>
                                <div class="col-md-9">
                                    <textarea class="form-control"
                                              name='about_desc'>{{$homedata['about_desc']}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">   الصورة  </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="file" class="form-control" name="about_image" value="">
                                    <img width="80px" src="{{asset('assets/admin/uploads/homepage/'.$homedata['about_image'])}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">  الميزة الاولي  </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name='about_feature1'
                                           value="{{$homedata['about_feature1']}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">  الميزة الثانية   </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name='about_feature2'
                                           value="{{$homedata['about_feature2']}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">  الميزة الثالثة  </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name='about_feature3'
                                           value="{{$homedata['about_feature3']}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">  الميزة الرابعة   </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name='about_feature4'
                                           value="{{$homedata['about_feature4']}}">
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

