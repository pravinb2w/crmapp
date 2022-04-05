<!DOCTYPE html>
<html lang="en">
    @include('crm.layouts.head')
    @yield('add_on_styles')
    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": false}'>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            @include('crm.layouts.sidemenu')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
        @include('crm.layouts.script')

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    @include('crm.layouts.topbar')
                    <!-- end Topbar -->

                    <!-- Start Content-->
                    @yield('content')
                    <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <script>document.write(new Date().getFullYear())</script> --}}
                                {{ $copyrights }}
                            </div>
                            <div class="col-md-6">
                                {{-- <div class="text-md-end footer-links d-none d-md-block">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div> --}}
                                
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper --> 
      
        @yield('add_on_script')

        <div class="modal fade show" id="Mymodal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-modal="true" role="dialog">
            <!-- /.modal-dialog -->
        </div>
    </body>
</html>
    