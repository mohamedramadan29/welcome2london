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
{{--                    <div class="row mt-3" id="paypal-success" style="display: none;">--}}
{{--                        <div class="col-12 col-lg-6 offset-lg-3">--}}
{{--                            <div class="alert alert-success" role="alert">--}}
{{--                                تم تاكيد الحجز الخاص بك بنجاح--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <h3> احجز رحلتك   </h3>
                    <form id="booking-form" method="post" action="{{route('booking-serve')}}">
                        @csrf
                        <div class="input-group">
                            <input readonly type="hidden"
                                   class="form-control"
                                   id="paypal-amount"
                                   value="30"
                                   aria-label="Amount (to the nearest pound)">
                        </div>
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
{{--                                    <button  class="primary-btn1 btn-hover" type="submit">--}}
{{--                                        احجز الان--}}
{{--                                    </button>--}}
                                    <div class="row mt-3">
                                        <div class="col-12 col-lg-6 offset-lg-3" id="payment_options"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://www.paypal.com/sdk/js?client-id={{config('paypal.client_id')}}&currency=GBP&intent=capture&components=buttons,funding-eligibility"></script>
<script>
    const fundingSources = [
        paypal.FUNDING.PAYPAL,    // PayPal
        paypal.FUNDING.CARD,      // بطاقات الائتمان
        paypal.FUNDING.APPLEPAY,  // Apple Pay
    ];

    fundingSources.forEach(function(fundingSource) {
        function validateBookingForm() {
            const form = document.getElementById('booking-form');
            const name = form.querySelector('input[name="name"]').value;
            const phone = form.querySelector('input[name="phone"]').value;
            const email = form.querySelector('input[name="email"]').value;
            const num_person = form.querySelector('input[name="num_person"]').value;
            const num_pages = form.querySelector('input[name="num_pages"]').value;
            const travel_date = form.querySelector('input[name="travel_date"]').value;
            const travel_time = form.querySelector('input[name="travel_time"]').value;
            const notes = form.querySelector('textarea[name="notes"]').value;

            // تحقق من أن الحقول المطلوبة ليست فارغة
            if (!name || !phone || !email || !num_person || !num_pages || !travel_date || !travel_time || !notes) {
                alert("يرجى ملء جميع الحقول المطلوبة قبل الحجز");
                return false;
            }

            return true;
        }
        paypal.Buttons({
            fundingSource: fundingSource,  // تحديد وسيلة الدفع
            createOrder: function () {
                // تأكد من صحة بيانات النموذج قبل متابعة الدفع
                if (!validateBookingForm()) {
                    return actions.reject(); // إلغاء الدفع إذا كان هناك حقول ناقصة
                }
                return fetch("/create/" + document.getElementById("paypal-amount").value)
                    .then((response) => response.text())
                    .then((id) => {
                        return id;
                    });
            },
            onApprove: function () {
                return fetch("/complete", {
                    method: "post",
                    headers: {"X-CSRF-Token": '{{csrf_token()}}'}
                })
                    .then((response) => response.json())
                    .then((order_details) => {
                        console.log(order_details);
                        document.getElementById("paypal-success").style.display = 'block';
                        document.getElementById('booking-form').submit();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            onCancel: function (data) {
                // معالجة الإلغاء
            },

            onError: function (err) {
                // معالجة الخطأ
                console.log(err);
            }
        }).render('#payment_options'); // قم بعرض الزر في الحاوية
    });
</script>


@endsection
