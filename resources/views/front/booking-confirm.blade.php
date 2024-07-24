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


                        <p><span> EUR {{$confirm_price}}  </span> يجب تاكيد الحجز الخاص بك ودفع مبلغ وقدرة </p>
                        <form method="post" action="{{route('payment')}}">
                            @csrf
                            <div class="form-inner">
                                <input type="text" required readonly disabled class="form-control" value="{{$confirm_price}}  EU ">
                            </div>
                            <br>
                            <br>
                            <button type="submit" class="primary-btn1 hover-btn3">
                                تأكيد الحجز
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
