@extends('front.layouts.master')

@section('title')
    تاكيد الحجز
@endsection
@section('content')
    <div class="error-section">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="error-wrapper">
                        <h1> من فضلك يجب تأكيد الطلب الخاص بك </h1>
                        @if (Session::has('Success_message'))
                            <div class="alert alert-success"> {{ Session::get('Success_message') }} </div>
                        @endif
                        <div class="alert alert-success"> رقم الحجز الخاص بك
                            هو: {{ $booking['id'] }} </div>
                        @php
                            $setting = \App\Models\admin\Setting::find(1);
                                    $confirm_price = $setting->main_price;

                        @endphp
                        <p><span>  £ {{$confirm_price}}  </span> يجب تاكيد الحجز الخاص بك ودفع مبلغ وقدرة </p>

                        <div class="row mt-3" id="paypal-success" style="display: none;">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <div class="alert alert-success" role="alert">
                                    تم تاكيد الحجز الخاص بك بنجاح
                                </div>
                            </div>
                        </div>

                        @csrf
                        <div class="input-group">
                            <span class="input-group-text">£</span>
                            <input style="background:#edecec" readonly type="text"
                                   class="form-control"
                                   id="paypal-amount"
                                   value="{{$confirm_price}}"
                                   aria-label="Amount (to the nearest pound)">
                            <span class="input-group-text">{{$confirm_price}}</span>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 col-lg-6 offset-lg-3" id="payment_options"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script
        src="https://www.paypal.com/sdk/js?client-id={{config('paypal.client_id')}}&currency=GBP&intent=capture&components=buttons,funding-eligibility"></script>

    <script>
        const fundingSources = [
            paypal.FUNDING.PAYPAL,    // PayPal
            paypal.FUNDING.CARD,      // بطاقات الائتمان
            paypal.FUNDING.APPLEPAY,  // Apple Pay
        ];

        fundingSources.forEach(function (fundingSource) {
            paypal.Buttons({
                fundingSource: fundingSource,  // تحديد وسيلة الدفع

                createOrder: function () {
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
