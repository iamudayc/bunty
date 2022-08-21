<!DOCTYPE html>
<html>
@include('admin.partials.header')

    <body class="page-header-fixed">
        <div class="overlay"></div>
        @include('admin.partials.navbar')
        
        <main class="page-content content-wrap">
            @include('admin.partials.sidebar')
            <div class="page-inner">
                @yield('breadcumb')
                <div id="main-wrapper">
                    @yield('content')
                </div><!-- Main Wrapper -->
                @include('admin.partials.footer')
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        @include('admin.partials.nav_container')
        <div class="cd-overlay"></div>
	

@include('admin.partials.scripts')
@yield('scripts')
    
</body>

</html>