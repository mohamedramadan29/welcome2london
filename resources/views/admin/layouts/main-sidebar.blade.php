<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . ($page = 'admin/dashboard')) }}">
            لوحة التحكم
            {{--            <img--}}
            {{--                src="{{ URL::asset('assets/admin/img/brand/logo.png') }}" class="main-logo" alt="logo">--}}
        </a>
        <a class="desktop-logo logo-dark active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/admin/img/brand/logo_tabrat.png') }}" class="main-logo dark-theme"
                alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/admin/img/logo_tabrat.png') }}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/admin/img/logo_tabrat.png') }}" class="logo-icon dark-theme"
                alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">

                    <img alt="user-img" class="avatar avatar-xl brround"
                         src="{{ URL::asset('assets/admin/img/logo_tabrat.png') }}"><span
                        class="avatar-status profile-status bg-green"></span>


                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0"> {{Auth::guard('admin')->user()->name}}  </h4>
                    <span class="mb-0 text-muted">  {{Auth::guard('admin')->user()->email}} </span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category"> الرئيسية</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/dashboard')) }}">
                    <svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/>
                        <path
                            d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/>
                    </svg>
                    <span class="side-menu__label">الرئيسية </span></a>
            </li>

            <li class="side-item side-item-category"> الخدمات</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="">
                    <i style="font-size: 22px;margin-left: 10px" class="fa fa-file-signature"></i>
                    <span class="side-menu__label">     الخدمات  </span><i
                        class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{url('admin/services')}}"> الخدمات </a></li>
                </ul>
            </li>

            <li class="side-item side-item-category"> الحجوزات</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="">
                    <i style="font-size: 22px;margin-left: 10px" class="fa fa-folder-open"></i>
                    <span class="side-menu__label">  الحجوزات  </span><i
                        class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{url('admin/categories')}}"> مشاهدة الاقسام </a></li>
                </ul>
            </li>
            <li class="side-item side-item-category"> المستخدمين</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="">
                    <i style="font-size: 22px;margin-left: 10px" class="fa fa-users"></i>
                    <span class="side-menu__label">  بيانات المستخدمين  </span><i
                        class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{url('admin/users')}}"> المستخدمين </a>
                    </li>
                </ul>
            </li>
            <li class="side-item side-item-category"> الاعدادات</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="">
                    <i style="font-size: 22px;margin-left: 10px" class="bx bx-cog"></i>
                    <span class="side-menu__label">  الاعدادات الشخصية </span><i
                        class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{url('admin/update_admin_password')}}"> تعديل كلمة المرور </a>
                    </li>
                    <li><a class="slide-item" href="{{url('admin/update_admin_details')}}"> تعديل البيانات </a></li>
                </ul>
            </li>

        </ul>
    </div>
</aside>
<!-- main-sidebar -->
