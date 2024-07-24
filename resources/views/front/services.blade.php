@extends('front.layouts.master')
@section('content')

    <div class="breadcrumb-section" dir="rtl"
         style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%),url({{asset('assets/front/img/innerpage/inner-banner-bg.png')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="banner-content">
                        <h1> خدماتنا </h1>
                        <ul class="breadcrumb-list">
                            <li><a href="{{'/'}}"> الرئيسية </a></li>
                            <li> خدماتنا</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!------------------ Start Services ---------------->


    <div class="package-grid-section pt-120 mb-120" dir="rtl">
        <div class="container">
            <div class="row gy-5 mb-70">
                @foreach($services as $serv)
                    <div class="col-lg-4 col-md-6">
                        <div class="package-card">
                            <div class="package-card-img-wrap">
                                <a href="{{url('service/'.$serv['slug'])}}" class="card-img"><img
                                        src="{{asset('assets/admin/uploads/services/'.$serv['image'])}}" alt></a>

                            </div>
                            <div class="package-card-content">
                                <div class="card-content-top">
                                    <h5><a href="{{url('service/'.$serv['slug'])}}"> {{ $serv['name']  }} </a></h5>
                                </div>
                                <div class="card-content-bottom">
                                    <div class="price-area">
                                        <h6> السعر يبدا من : </h6>
                                        <span> $ {{number_format($serv['price'],2)}}</span>

                                    </div>
                                    <a href="{{url('service/'.$serv['slug'])}}" class="primary-btn2"> احجز الان
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                             viewBox="0 0 18 18"
                                             fill="none">
                                            <path
                                                d="M8.15624 10.2261L7.70276 12.3534L5.60722 18L6.85097 17.7928L12.6612 10.1948C13.4812 10.1662 14.2764 10.1222 14.9674 10.054C18.1643 9.73783 17.9985 8.99997 17.9985 8.99997C17.9985 8.99997 18.1643 8.26211 14.9674 7.94594C14.2764 7.87745 13.4811 7.8335 12.6611 7.80518L6.851 0.206972L5.60722 -5.41705e-07L7.70276 5.64663L8.15624 7.77386C7.0917 7.78979 6.37132 7.81403 6.37132 7.81403C6.37132 7.81403 4.90278 7.84793 2.63059 8.35988L0.778036 5.79016L0.000253424 5.79016L0.554115 8.91458C0.454429 8.94514 0.454429 9.05483 0.554115 9.08539L0.000253144 12.2098L0.778036 12.2098L2.63059 9.64035C4.90278 10.1523 6.37132 10.1857 6.37132 10.1857C6.37132 10.1857 7.0917 10.2102 8.15624 10.2261Z"/>
                                            <path
                                                d="M12.0703 11.9318L12.0703 12.7706L8.97041 12.7706L8.97041 11.9318L12.0703 11.9318ZM12.0703 5.23292L12.0703 6.0714L8.97059 6.0714L8.97059 5.23292L12.0703 5.23292ZM9.97892 14.7465L9.97892 15.585L7.11389 15.585L7.11389 14.7465L9.97892 14.7465ZM9.97892 2.41846L9.97892 3.2572L7.11389 3.2572L7.11389 2.41846L9.97892 2.41846Z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <nav class="inner-pagination-area">--}}
{{--                        --}}{{--                        {{$services->links()}}--}}
{{--                        @if ($paginator->hasPages())--}}
{{--                            <ul class="pagination-list">--}}
{{--                                --}}{{-- Previous Page Link --}}
{{--                                @if ($paginator->onFirstPage())--}}
{{--                                    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">--}}
{{--                                        <a href="#" class="shop-pagi-btn"><i class="bi bi-chevron-left"></i></a>--}}
{{--                                    </li>--}}
{{--                                @else--}}
{{--                                    <li>--}}
{{--                                        <a href="{{ $paginator->previousPageUrl() }}" class="shop-pagi-btn" rel="prev"--}}
{{--                                           aria-label="@lang('pagination.previous')"><i class="bi bi-chevron-left"></i></a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}

{{--                                --}}{{-- Pagination Elements --}}
{{--                                @foreach ($elements as $element)--}}
{{--                                    --}}{{-- "Three Dots" Separator --}}
{{--                                    @if (is_string($element))--}}
{{--                                        <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>--}}
{{--                                    @endif--}}

{{--                                    --}}{{-- Array Of Links --}}
{{--                                    @if (is_array($element))--}}
{{--                                        @foreach ($element as $page => $url)--}}
{{--                                            @if ($page == $paginator->currentPage())--}}
{{--                                                <li><a href="#" class="active">{{ $page }}</a></li>--}}
{{--                                            @else--}}
{{--                                                <li><a href="{{ $url }}">{{ $page }}</a></li>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}

{{--                                --}}{{-- Next Page Link --}}
{{--                                @if ($paginator->hasMorePages())--}}
{{--                                    <li>--}}
{{--                                        <a href="{{ $paginator->nextPageUrl() }}" class="shop-pagi-btn" rel="next"--}}
{{--                                           aria-label="@lang('pagination.next')"><i class="bi bi-chevron-right"></i></a>--}}
{{--                                    </li>--}}
{{--                                @else--}}
{{--                                    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">--}}
{{--                                        <a href="#" class="shop-pagi-btn"><i class="bi bi-chevron-right"></i></a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}
{{--                            </ul>--}}
{{--                        @endif--}}

{{--                    </nav>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>




    <!-----------------------------------------  End Services ---------------->

    <!---------------------------------- Start Tesmonails ---------------->

    <div class="home2-testimonial-section text-right" dir="rtl">
        <div class="container-fluid">
            <div class="row g-lg-4 gy-5">
                <div class="col-lg-5">
                    <div class="testimonial-content-wrapper">
                        <div class="section-title2 mb-40">
                            <div class="eg-section-tag two">
                                <span> آراء العملاء  </span>
                            </div>
                            <h2> ماذا يقول العملاء عنا </h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="testimonial-card-slider-area">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="swiper home2-testimonial-card-slider mb-35">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="tesimonial-card-wrapper style-2">
                                                <div class="tesimonial-card">
                                                    <img src="assets/img/home2/vector/testi-quote.svg" alt
                                                         class="quote">
                                                    <div class="testimonial-content">
                                                        <p>“ لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على
                                                            العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم
                                                            مطبوعه … بروشور او فلاير على سبيل المثال … او نماذج مواقع
                                                            انترنت … ”</p>
                                                    </div>
                                                    <div class="testimonial-bottom">
                                                        <div class="rating-area">
                                                            <ul class="rating">
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="author-area">
                                                    <div class="author-img">
                                                        <img
                                                            src="{{asset('assets/front/img/home1/testi-author-img1.png')}}"
                                                            alt>
                                                    </div>
                                                    <div class="author-content">
                                                        <h5> Mohamed Ramadan </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="tesimonial-card-wrapper style-2">
                                                <div class="tesimonial-card">
                                                    <img src="assets/img/home2/vector/testi-quote.svg" alt
                                                         class="quote">
                                                    <div class="testimonial-content">
                                                        <p>“ لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على
                                                            العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم
                                                            مطبوعه … بروشور او فلاير على سبيل المثال … او نماذج مواقع
                                                            انترنت … ”</p>
                                                    </div>
                                                    <div class="testimonial-bottom">
                                                        <div class="rating-area">
                                                            <ul class="rating">
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="author-area">
                                                    <div class="author-img">
                                                        <img
                                                            src="{{asset('assets/front/img/home1/testi-author-img1.png')}}"
                                                            alt>
                                                    </div>
                                                    <div class="author-content">
                                                        <h5> Mohamed Ramadan </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="tesimonial-card-wrapper style-2">
                                                <div class="tesimonial-card">
                                                    <img src="assets/img/home2/vector/testi-quote.svg" alt
                                                         class="quote">
                                                    <div class="testimonial-content">
                                                        <p>“ لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على
                                                            العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم
                                                            مطبوعه … بروشور او فلاير على سبيل المثال … او نماذج مواقع
                                                            انترنت … ”</p>
                                                    </div>
                                                    <div class="testimonial-bottom">
                                                        <div class="rating-area">
                                                            <ul class="rating">
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="author-area">
                                                    <div class="author-img">
                                                        <img
                                                            src="{{asset('assets/front/img/home1/testi-author-img1.png')}}"
                                                            alt>
                                                    </div>
                                                    <div class="author-content">
                                                        <h5> Mohamed Ramadan </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="tesimonial-card-wrapper style-2">
                                                <div class="tesimonial-card">
                                                    <img src="assets/img/home2/vector/testi-quote.svg" alt
                                                         class="quote">
                                                    <div class="testimonial-content">
                                                        <p>“ لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على
                                                            العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم
                                                            مطبوعه … بروشور او فلاير على سبيل المثال … او نماذج مواقع
                                                            انترنت … ”</p>
                                                    </div>
                                                    <div class="testimonial-bottom">
                                                        <div class="rating-area">
                                                            <ul class="rating">
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="author-area">
                                                    <div class="author-img">
                                                        <img
                                                            src="{{asset('assets/front/img/home1/testi-author-img1.png')}}"
                                                            alt>
                                                    </div>
                                                    <div class="author-content">
                                                        <h5> Mohamed Ramadan </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slide-and-view-btn-grp style-3">
                                    <div class="slider-btn-grp3">
                                        <div class="slider-btn testimonial-card-slider-prev">
                                            <i class="bi bi-arrow-right"></i>
                                            <span> السابق  </span>
                                        </div>
                                        <div class="slider-btn testimonial-card-slider-next">
                                            <span> التالي  </span>
                                            <i class="bi bi-arrow-left"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-------------------------------------------- End Tesmonails ------------>

@endsection
