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
                        <p> السعر ::  <strong> $ {{$service['price']}} </strong> </p>
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
            <div class="col-xl-8">
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
            <div class="col-xl-4">
                <div class="banner2-card">
                    <img src="{{asset('assets/front/img/innerpage/support-img.jpg')}}" alt>
                    <div class="banner2-content-wrap">
                        <div class="banner2-content">
                            <div class="hotline-area">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28">
                                        <path
                                            d="M27.2653 21.5995L21.598 17.8201C20.8788 17.3443 19.9147 17.5009 19.383 18.1798L17.7322 20.3024C17.6296 20.4377 17.4816 20.5314 17.3154 20.5664C17.1492 20.6014 16.9759 20.5752 16.8275 20.4928L16.5134 20.3196C15.4725 19.7522 14.1772 19.0458 11.5675 16.4352C8.95784 13.8246 8.25001 12.5284 7.6826 11.4893L7.51042 11.1753C7.42683 11.0269 7.39968 10.8532 7.43398 10.6864C7.46827 10.5195 7.56169 10.3707 7.69704 10.2673L9.81816 8.61693C10.4968 8.08517 10.6536 7.1214 10.1784 6.40198L6.39895 0.734676C5.91192 0.00208106 4.9348 -0.21784 4.18082 0.235398L1.81096 1.65898C1.06634 2.09672 0.520053 2.80571 0.286612 3.63733C-0.56677 6.74673 0.0752209 12.1131 7.98033 20.0191C14.2687 26.307 18.9501 27.9979 22.1677 27.9979C22.9083 28.0011 23.6459 27.9048 24.3608 27.7115C25.1925 27.4783 25.9016 26.932 26.3391 26.1871L27.7641 23.8187C28.218 23.0645 27.9982 22.0868 27.2653 21.5995ZM26.9601 23.3399L25.5384 25.7098C25.2242 26.2474 24.7142 26.6427 24.1152 26.8128C21.2447 27.6009 16.2298 26.9482 8.64053 19.3589C1.0513 11.7697 0.398595 6.75515 1.18669 3.88421C1.35709 3.28446 1.75283 2.77385 2.2911 2.45921L4.66096 1.03749C4.98811 0.840645 5.41221 0.93606 5.62354 1.25397L7.67659 4.3363L9.39976 6.92078C9.60612 7.23283 9.53831 7.65108 9.24392 7.88199L7.1223 9.53232C6.47665 10.026 6.29227 10.9193 6.68979 11.6283L6.85826 11.9344C7.45459 13.0281 8.19599 14.3887 10.9027 17.095C13.6095 19.8012 14.9696 20.5427 16.0628 21.139L16.3694 21.3079C17.0783 21.7053 17.9716 21.521 18.4653 20.8753L20.1157 18.7537C20.3466 18.4595 20.7647 18.3918 21.0769 18.5979L26.7437 22.3773C27.0618 22.5885 27.1572 23.0128 26.9601 23.3399ZM15.8658 4.66809C20.2446 4.67296 23.7931 8.22149 23.798 12.6003C23.798 12.858 24.0069 13.0669 24.2646 13.0669C24.5223 13.0669 24.7312 12.858 24.7312 12.6003C24.7257 7.7063 20.7598 3.74029 15.8658 3.73494C15.6081 3.73494 15.3992 3.94381 15.3992 4.20151C15.3992 4.45922 15.6081 4.66809 15.8658 4.66809Z"></path>
                                        <path
                                            d="M15.865 7.46746C18.6983 7.4708 20.9943 9.76678 20.9976 12.6001C20.9976 12.7238 21.0468 12.8425 21.1343 12.93C21.2218 13.0175 21.3404 13.0666 21.4642 13.0666C21.5879 13.0666 21.7066 13.0175 21.7941 12.93C21.8816 12.8425 21.9308 12.7238 21.9308 12.6001C21.9269 9.2516 19.2134 6.53813 15.865 6.5343C15.6073 6.5343 15.3984 6.74318 15.3984 7.00088C15.3984 7.25859 15.6073 7.46746 15.865 7.46746Z"></path>
                                        <path
                                            d="M15.865 10.267C17.1528 10.2686 18.1964 11.3122 18.198 12.6C18.198 12.7238 18.2472 12.8424 18.3347 12.9299C18.4222 13.0174 18.5409 13.0666 18.6646 13.0666C18.7883 13.0666 18.907 13.0174 18.9945 12.9299C19.082 12.8424 19.1312 12.7238 19.1312 12.6C19.1291 10.797 17.668 9.33589 15.865 9.33386C15.6073 9.33386 15.3984 9.54274 15.3984 9.80044C15.3984 10.0581 15.6073 10.267 15.865 10.267Z"></path>
                                    </svg>
                                </div>
                                <div class="content">
                                    <span> لتفاصيل اكثر  </span>
                                    <h6><a href="tel:+ 01011642731">+ 01011 6427 31</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
