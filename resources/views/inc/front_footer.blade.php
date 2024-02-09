<!-- ====== Footer Start ====== -->
<footer class="ud-footer wow fadeInUp " data-wow-delay=".15s ">
    <div class="shape shape-1 ">
        <img src="{{ asset('front/assets/images/footer/shape-1.svg') }} " alt="shape " />
    </div>
    <div class="shape shape-2 ">
        <img src="{{ asset('front/assets/images/footer/shape-2.svg') }} " alt="shape " />
    </div>
    <div class="shape shape-3 ">
        <img src="{{ asset('front/assets/images/footer/shape-3.svg') }} " alt="shape " />
    </div>
    <div class="ud-footer-widgets ">
        <div class="container ">
            <div class="row ">
                <div class="col-md-6">
                    <div class="ud-widget ">
                        <a href="index.html " class="ud-footer-logo ">
                            <img src="{{ asset('logo.png') }} " alt="logo " />
                        </a>
                        <p class="ud-widget-desc ">
                            We create digital experiences for brands and companies by using technology.
                        </p>
                        <ul class="ud-widget-socials ">
                            @if(get_settings('social_facebook'))
                                <li><a href="{{ get_settings('social_facebook') }}"><i class="lni lni-facebook-filled"></i></a></li>
                            @endif

                            @if(get_settings('social_twitter'))
                                <li><a href="{{ get_settings('social_twitter') }}"><i class="lni lni-twitter-filled"></i></a></li>
                            @endif

                            @if(get_settings('social_insta'))
                                <li><a href="{{ get_settings('social_insta') }}"><i class="lni lni-instagram-filled"></i></a></li>
                            @endif

                            @if(get_settings('social_youtube'))
                                <li><a href="{{ get_settings('social_youtube') }}"><i class="lni lni-linkedin-original"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="ud-widget ">
                        <h5 class="ud-widget-title ">روابط مهمة</h5>
                        <ul class="ud-widget-links ">
                            @forelse(ActivePagesMenus(['position','!=' , 'header']) as $page)
                                @if($page->position != 'hidden')
                                    <li>
                                        <a href="{{ url($page->slug) }}">
                                            {{  $page->title }}
                                        </a>
                                    </li>
                                @endif
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>

                {{-- <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 ">
                    <div class="ud-widget ">
                        <h5 class="ud-widget-title ">Features</h5>
                        <ul class="ud-widget-links ">
                            <li>
                                <a href="javascript:void(0) ">How it works</a>
                            </li>
                            <li>
                                <a href="javascript:void(0) ">Privacy policy</a>
                            </li>
                            <li>
                                <a href="javascript:void(0) ">Terms of service</a>
                            </li>
                            <li>
                                <a href="javascript:void(0) ">Refund policy</a>
                            </li>
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="ud-footer-bottom ">
        <div class="container ">
            <div class="row ">
                <div class="col-md-12 text-center">
                    <p class="ud-footer-bottom-right text-center">
                       جميع الحقوق محفوظة لمنصة مكتب {{ '©'.date('Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ====== Footer End ====== -->
