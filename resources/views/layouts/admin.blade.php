<!DOCTYPE html>
<html lang="en">
@include('includes.admin.header')

<body>

    @include('includes.admin.sidebar')
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        @include('includes.admin.topbar')
        <!-- ========== section start ========== -->
        <section class="section">
            <div class="container-fluid">
                <!-- ========== title-wrapper start ========== -->
                <div class="title-wrapper pt-30">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="title mb-30">
                                <h2>@yield('title')</h2>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-md-6">
                            @yield('breadcrumb')
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                @yield('content')
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

    </main>
    <!-- ======== main-wrapper end =========== -->
    @include('includes.admin.scripts')
    @stack('addon-script')


</body>

</html>
