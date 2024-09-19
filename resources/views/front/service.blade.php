@extends('front.layouts.master')
@section('title') {{$service['name']}} @endsection
 @section('content')
<div class="breadcrumb-section" dir="rtl"
     style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%),url({{asset('assets/front/img/innerpage/inner-banner-bg.png')}});">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="banner-content">
                    <h1> {{$service['name']}} </h1>
                    <ul class="breadcrumb-list">
                        <li><a href="{{'/'}}"> الرئيسية  </a></li>
                        <li> {{$service['name']}} </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="home2-about-section pt-120 text-right" dir="rtl">
    <div class="container">
        <div class="row mb-30">
            <div class="col-lg-6">
                <div class="about-content">
                    <div class="section-title2 mb-30">
                        <div class="eg-section-tag">
                            <span>  تفاصيل الخدمة  </span>
                        </div>
                        <h2> {{$service['name']}} </h2>
                        <p> السعر ::  <strong>     {{$service['price']}}   £</strong> </p>
                        <p>
                        {{$service['description']}}
                        </p>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center">
                <div class="about-img-wrap">
                    <div class="about-img">
                        <img src="{{asset('assets/admin/uploads/services/'.$service['image'])}}" alt class="about-img">
                    </div>
                    <img src="{{asset('assets/front/img/home2/vector/plane-vector.svg')}}" alt class="vector">
                </div>
            </div>
        </div>
        <div class="more_details">
            <div class="container">
                <div class="data section-title2">
                    <p>
                        {{$service['more_details']}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="package-details-area pt-120 mb-120 position-relative" dir="rtl">
    <div class="container">
        <div class="row g-xl-4 gy-5">
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
            <div class="col-12 col-12">
                <div class="contact-form-area">
                    <h3> احجز رحلتك   </h3>
                    <form method="post" action="{{route('booking-serve')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-20">
                                <div class="form-inner">
                                    <label> الاسم  *</label>
                                    <input type="hidden" name="serv_id" value="{{$service['id']}}">
                                    <input type="hidden" name="travel_price" value="{{$service['price']}}">
                                    <input type="hidden" name="serv_name" value="{{$service['name']}}">
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
