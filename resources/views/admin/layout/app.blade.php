@include('admin.layout.header')
@include('admin.layout.sidebar')
<div class="page-wrapper">
    <div class="page-content">
        @yield('main-section')
    </div>
</div>
@include('admin.layout.footer')
