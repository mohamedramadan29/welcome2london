@extends('admin.layouts.master')
@section('title')
    مشاهدة وتعديل الحجز
@endsection
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ مشاهدة وتعديل الحجز  </span>
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
                    <div class="mb-4 main-content-label">مشاهدة وتعديل الحجز</div>
                    <form class="form-horizontal" method="post" action="{{url('admin/booking/update/'.$book['id'])}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">


                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> الاسم </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input readonly required type="text" class="form-control" name="name"
                                                   value="{{$book['name']}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> البريد الالكتروني </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input readonly required type="text" class="form-control" name="price"
                                                   value="{{$book['email']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> رقم الهاتف </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input readonly required type="text" class="form-control" name="price"
                                                   value="{{$book['phone']}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> بداية الرحلة </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input readonly required type="text" class="form-control" name="price"
                                                   value="{{$book['place_from']}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> نهاية الرحلة </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input readonly required type="text" class="form-control" name="price"
                                                   value="{{$book['place_to']}}">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> تاريخ الرحلة </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input readonly required type="text" class="form-control" name="price"
                                                   value="{{$book['travel_date']}}">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> توقيت الرحلة </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input readonly required type="text" class="form-control" name="price"
                                                   value="{{$book['travel_time']}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> عدد الافراد </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input readonly required type="number" class="form-control" name="price"
                                                   value="{{$book['num_person']}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">  عدد الحقائب  </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input readonly required type="number" class="form-control" name="price"
                                                   value="{{$book['num_pages']}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> ملاحظات اضافية </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" readonly name="" id=""> {{$book['notes'] }}</textarea>
                                        </div>
                                    </div>
                                </div>




                            </div>

                            <div class="col-lg-6">
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> حالة الحجز  </label>
                                        </div>
                                        <div class="col-md-9">
                                           <select class="form-control" name="status">
                                               <option value=""> -- حالة الطلب  -- </option>
                                               <option @if($book['status'] == 1) selected @endif value="1"> تمت </option>
                                               <option @if($book['status'] == 2) selected @endif value="2">  تحت التنفيذ  </option>
                                               <option @if($book['status'] == 0) selected @endif value="0"> ملغي  </option>
                                           </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-footer text-left">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">    تعديل الرحلة
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

