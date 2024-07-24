@extends('front.layouts.master')
@section('title') احجز رحلتك  @endsection
@section('content')
    <div class="breadcrumb-section" dir="rtl"
         style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%),url({{asset('assets/front/img/innerpage/inner-banner-bg.png')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="banner-content">
                        <h1> احجز رحلتك  </h1>
                        <ul class="breadcrumb-list">
                            <li><a href="{{url('/')}}"> الرئيسية  </a></li>
                            <li> احجز رحلتك  </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-page pt-120 mb-120" dir="rtl">
        <div class="container">
            @if (Session::has('Success_message'))
                <div class="alert alert-success"> {{ Session::get('Success_message') }} </div>
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
            <div class="row g-lg-4 gy-5">
                <div class="col-lg-12">

                    <div class="contact-form-area">
                        <h3> احجز رحلتك   </h3>
                        <form method="post" action="{{url('booking')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mb-20">
                                    <div class="form-inner">
                                        <label> الاسم  *</label>
                                        <input type="text" placeholder="" required name="name" value="{{old('name')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="form-inner">
                                        <label> رقم الهاتف </label>
                                        <input type="text" placeholder="" required name="phone" value="{{old('phone')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="form-inner">
                                        <label> البريد الالكتروني  </label>
                                        <input type="email" placeholder="" required name="email" value="{{old('email')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="form-inner">
                                        <label> بداية الرحلة  </label>
                                        <input type="text" placeholder="" required name="place_from" value="{{old('place_from')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="form-inner">
                                        <label>  مكان الوصول </label>
                                        <input type="text" placeholder="" required name="place_to" value="{{old('place_to')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="form-inner">
                                        <label> عدد الافراد </label>
                                        <input type="number" min="1" placeholder="" required name="num_person" value="{{old('num_person')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="form-inner">
                                        <label> عدد الحقائب  </label>
                                        <input type="number" min="1" placeholder="" required name="num_pages" value="{{old('num_pages')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="form-inner">
                                        <label> تاريخ الرحلة  </label>
                                        <input type="date" placeholder="" required name="travel_date" value="{{old('travel_date')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="form-inner">
                                        <label> حدد التوقيت  </label>
                                        <input type="time" placeholder="" required name="travel_time" value="{{old('travel_time')}}">
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-30">
                                    <div class="form-inner">
                                        <label>  تفاصيل اضافية   *</label>
                                        <textarea placeholder="" required name="notes">{{old('notes')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-inner">
                                        <button  class="primary-btn1 btn-hover" type="submit">
                                           احجز الان
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
