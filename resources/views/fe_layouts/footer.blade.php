</main>

<!-- footer area start -->
{{-- <footer>
    <div class="footer__area footer-bg">
        <div class="footer__top pt-190 pb-40">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <div class="footer__widget mb-50">
                            <div class="footer__widget-head mb-22">
                                <div class="footer__logo">
                                    <a href="/">
                                        <img style="max-width: 150px" src="{{ asset('lms-02.png') }}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="footer__widget-body">

                                <p>Pembelajaran yang baik pada dasarnya disampaikan dan dapat diakses & pelajari dengan
                                    mudah oleh seluruh siswa</p>


                            </div>
                        </div>
                    </div>
                    <div
                        class="col-xxl-2 offset-xxl-1 col-xl-2 offset-xl-1 col-lg-3 offset-lg-0 col-md-2 offset-md-1 col-sm-5 offset-sm-1 col-6">
                        <div class="footer__widget mb-50">
                            <div class="footer__widget-head mb-22">
                                <h3 class="footer__widget-title">Structur</h3>
                            </div>
                            <div class="footer__widget-body">
                                <div class="footer__link">
                                    <ul>
                                        <li><a href="#">Daftar Guru</a></li>
                                        <li><a href="#">Daftar Mapel</a></li>
                                        <li><a href="#">Daftar Kelas</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-xl-2 col-lg-2 offset-lg-0 col-md-3 offset-md-1 col-sm-6 col-6">
                        <div class="footer__widget mb-50">
                            <div class="footer__widget-head mb-22">
                                <h3 class="footer__widget-title">Ranking</h3>
                            </div>
                            <div class="footer__widget-body">
                                <div class="footer__link">
                                    <ul>
                                        <li><a href="#">My Ranking</a></li>
                                        <li><a href="#">Overall Ranking</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-5 col-sm-6">
                        <div class="footer__widget footer__pl-70 mb-50">
                            <div class="footer__widget-head mb-22">
                                <h3 class="footer__widget-title">Subscribe</h3>
                            </div>
                            <div class="footer__widget-body">
                                <div class="footer__subscribe">
                                    <form action="#">
                                        <div class="footer__subscribe-input mb-15">
                                            <input type="number" placeholder="Your whatsapp number">
                                            <button type="submit">
                                                <i class="far fa-arrow-right"></i>
                                                <i class="far fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </form>
                                    <p>Get the latest lesson and updates right at your whatsapp inbox. (BETA)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="footer__copyright text-center">
                            <p>© {{ date('Y') }} LMS, SMK 1 Krian Sidoarjo. Design By : <a href="#"> IT
                                    Team</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer> --}}
<!-- footer area end -->
<!-- JS here -->

<script src="{{ asset('fe_assets/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('fe_assets/assets/js/vendor/waypoints.min.js') }}"></script>
<script src="{{ asset('fe_assets/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('fe_assets/assets/js/jquery.meanmenu.js') }}"></script>
<script src="{{ asset('fe_assets/assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('fe_assets/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('fe_assets/assets/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('fe_assets/assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('fe_assets/assets/js/parallax.min.js') }}"></script>
<script src="{{ asset('fe_assets/assets/js/backToTop.js') }}"></script>
<script src="{{ asset('fe_assets/assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('fe_assets/assets/js/ajax-form.js') }}"></script>
<script src="{{ asset('fe_assets/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('fe_assets/assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('fe_assets/assets/js/main.js') }}"></script>
<script src="{{ asset('assets/vendor/toastr/toastr.js') }}"></script> <!-- Toastr Plugin Js --> 
<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script> <!-- SweetAlert Plugin Js --> 
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
{{-- <script type="module" src="{{ asset('app.js') }}"></script> <!-- SweetAlert Plugin Js -->  --}}
@yield('script')
{{-- @vite(['resources/js/app.js']) --}}
</body>

</html>
