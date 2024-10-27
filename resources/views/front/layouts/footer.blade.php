<footer class="footer-section style-2" dir="rtl">
    <div class="container">
        <div class="footer-top">
            <div class="row g-lg-4 gy-5 justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="{{url('/')}}"><img width="170px" src="{{asset('assets/front/img/main_logo22.png')}}" alt></a>
                        </div>
                        <h3> احجز رحلتك الان </h3>
                        <a href="{{url('booking')}}" class="primary-btn1"> احجز الان </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 d-flex justify-content-lg-center justify-content-sm-start">
                    <div class="footer-widget">
                        <div class="widget-title">
                            <h5> روابط </h5>
                        </div>
                        <ul class="widget-list">
                            <li><a href="{{'/'}}"> الرئيسية </a></li>
                            <li><a href="{{url('contact')}}"> تواصل معنا </a></li>
                            <li><a href="{{url('terms')}}"> سياسة الاستخدام </a></li>
                            <li><a href="{{url('conditions')}}"> الشروط والاحكام </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 d-flex justify-content-lg-center justify-content-md-start">
                    <div class="footer-widget">
                        <div class="widget-title">
                            <h5> الخدمات </h5>
                        </div>
                        @php
                            $services = \App\Models\admin\Service::select('name','slug')->get();
                        @endphp
                        <ul class="widget-list">
                            @foreach($services as $serv)
                                <li><a href="{{url('service/'.$serv['slug'])}}"> {{$serv['name']}} </a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="row">
                @php
                    $setting = \App\Models\admin\PublicSetting::first();
                @endphp
                <div
                    class="col-lg-12 d-flex flex-md-row flex-column align-items-center justify-content-md-between justify-content-center flex-wrap gap-3">
                    <ul class="social-list">
                        <li>
                            <a href="{{$setting['facebook_link']}}"><i class="bx bxl-facebook"></i></a>
                        </li>
                        <li>
                            <a href="{{$setting['twitter_link']}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                                     class="bi bi-twitter-x" viewBox="0 0 16 16">
                                    <path
                                        d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"/>
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="{{$setting['tiktok_link']}}"><i class="bx bxl-tiktok"></i></a>
                        </li>
                    </ul>
                    <p>    جميع الحقوق محفوظة | بواسطة  <a href="https://www.egenslab.com/"> Mr </a></p>

                </div>
            </div>
        </div>
    </div>
</footer>


<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="{{asset('assets/front/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery-ui.js')}}"></script>
<script src="{{asset('assets/front/js/moment.min.js')}}"></script>
<script src="{{asset('assets/front/js/daterangepicker.min.js')}}"></script>

<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/front/js/popper.min.js')}}"></script>

<script src="{{asset('assets/front/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assets/front/js/slick.js')}}"></script>

<script src="{{asset('assets/front/js/waypoints.min.js')}}"></script>

<script src="{{asset('assets/front/js/jquery.counterup.min.js')}}"></script>

<script src="{{asset('assets/front/js/isotope.pkgd.min.js')}}"></script>

<script src="{{asset('assets/front/js/jquery.magnific-popup.min.js')}}"></script>

<script src="{{asset('assets/front/js/jquery.marquee.min.js')}}"></script>

<script src="{{asset('assets/front/js/jquery.nice-select.min.js')}}"></script>

<script src="{{asset('assets/front/js/select2.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.fancybox.min.js')}}"></script>

<script src="{{asset('assets/front/js/custom.js')}}"></script>
<script>
    const txts = document.querySelector(".animate-text").children,
        txtslen = txts.length;
    let index = 0;

    function animateText() {
        console.log(txts[index]);
        for (let i = 0; i < txtslen; i++) {
            txts[i].classList.remove("text-in");
        }
        txts[index].classList.add("text-in");
        if (index == txtslen - 1) {
            index = 0;
        } else {
            index++;
        }

        setTimeout(animateText, 3000);
    }

    window.onload = animateText;
</script>
</body>
</html>
