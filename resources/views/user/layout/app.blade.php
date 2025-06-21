@include('user.layout.header')
@include('user.layout.sidebar')
<div class="page-wrapper">
    <div class="page-content">
        @yield('main-section')
    </div>
</div>
@include('user.layout.footer')
