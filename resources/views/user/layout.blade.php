<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta
            name="description"
            content="@yield('description', 'Hello, I am Suhadak Akbar. I currently work as Backend Programmer.')">

        <title>@yield('title', 'Suhadak Akbar')</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
        <link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css"/>
        <link rel="icon" type="image/x-icon" href="favicon.ico">
    </head>
    <body class="@yield('body') is-preload">
        <div id="app">
		<div id="page-wrapper">
            <section id="header" class="wrapper">

                <!-- Logo -->
                @yield('logo')

                <!-- Nav -->
                <nav id="nav">
                    <ul>
                        {{-- <li class="current"><a href="index.html">Home</a></li> --}}
                        {{-- <li>
                            <a href="#">Dropdown</a>
                            <ul>
                                <li><a href="#">Lorem ipsum</a></li>
                                <li><a href="#">Magna veroeros</a></li>
                                <li><a href="#">Etiam nisl</a></li>
                                <li>
                                    <a href="#">Sed consequat</a>
                                    <ul>
                                        <li><a href="#">Lorem dolor</a></li>
                                        <li><a href="#">Amet consequat</a></li>
                                        <li><a href="#">Magna phasellus</a></li>
                                        <li><a href="#">Etiam nisl</a></li>
                                        <li><a href="#">Sed feugiat</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Nisl tempus</a></li>
                            </ul>
                        </li> --}}
                        @if (!Illuminate\Support\Facades\Route::is('home'))
                            <li><a href="{{ url('/') }}">Home</a></li>
                        @endif
                        <li><a href="https://blog.akbarsuhadak.com">Blog</a></li>
                        <li><a href="{{ route('project.index') }}">Project</a></li>
                    </ul>
                </nav>

            </section>

            {{-- <section id="intro" class="wrapper style1">
                <div class="title">The Introduction</div>
                <div class="container">
                    <p class="style1">So in case you were wondering what this is all about ...</p>
                    <p class="style2">
                        Escape Velocity is a free responsive<br class="mobile-hide" />
                        site template by <a href="http://html5up.net" class="nobr">HTML5 UP</a>
                    </p>
                    <p class="style3">It's <strong>responsive</strong>, built on <strong>HTML5</strong> and <strong>CSS3</strong>, and released for
                    free under the <a href="http://html5up.net/license">Creative Commons Attribution 3.0 license</a>, so use it for any of
                    your personal or commercial projects &ndash; just be sure to credit us!</p>
                    <ul class="actions">
                        <li><a href="#" class="button style3 large">Proceed</a></li>
                    </ul>
                </div>
            </section> --}}
            @yield('main')
				
            @yield('highlights')

            <section id="footer" class="wrapper">
                {{-- <div class="title">Contact</div> --}}
                <div class="container">
                    <header class="style1">
                        <h2>{{ __('content.contact.title') }}</h2>
                        <p>
                            {{ __('content.contact.first') }}<br />
                            {{ __('content.contact.second') }}
                        </p>
                    </header>
                    <div class="row">
                        <div class="col-8 col-12-medium">
                            <!-- Contact Form -->
                            <contact-component></contact-component>
                        </div>
                        <div class="col-4 col-12-medium">

                            <!-- Contact -->
                            <section class="feature-list small">
                                <div class="row">
                                    <div class="col-12 col-12-small">
                                        <section>
                                            <h3 class="icon solid fa-comment">Social Media</h3>
                                            <p>
                                                <a href="https://www.linkedin.com/in/akbarsuhadak">LinkedIn</a><br />
                                                <a href="https://twitter.com/akbarsuhadak">Twitter</a><br />
                                                <a href="https://web.facebook.com/akbarsuhadak">Facebook</a>
                                            </p>
                                        </section>
                                    </div>
                                    <div class="col-12 col-12-small">
                                        <section>
                                            <h3 class="icon solid fa-envelope">Email</h3>
                                            <p>
                                                <a href="mailto:akbarsuhadak@gmail.com">akbarsuhadak@gmail.com</a>
                                            </p>
                                        </section>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                    <div id="copyright">
                        <ul>
                            <li>&copy; {{ date('Y') }} {{ config('app.name') }}</li>
                            <li>Original Design: <a href="http://html5up.net">HTML5 UP</a></li>
                        </ul>
                    </div>
                </div>
            </section>
		</div>
        </div>

		<!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
        <script src="{{ mix('js/manifest.js') }}" type="text/javascript"></script>
        <script src="{{ mix('js/vendor.js') }}" type="text/javascript"></script>
        <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.dropotron/1.4.3/jquery.dropotron.min.js"
            integrity="sha512-ugEhUBPC3XfTEBbRia5d9er1tFe5N4yzwQr3xrNSTfmT09xe0fwYxgfDSLwUKCnFoFtLd5rJBZP5tdfcUzLNvw=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer">
        </script>
        <script src="{{ asset('assets/js/browser.min.js') }}"></script>
        <script src="{{ asset('assets/js/breakpoints.min.js') }}"></script>
        <script src="{{ asset('assets/js/util.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script src="{{ asset('assets/js/modernizr-custom.js') }}"></script>
	</body>
</html>
