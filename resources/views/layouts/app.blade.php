<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}: @yield ('page-title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ config('app.name') }}" />
    <meta property="og:image" content="{{config('app.url')}}/images/packs/facebook-share.jpg?v=2" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    @guest
                        <div class="top-right links d-none d-lg-block">
                            <a href="{{route ('packs.index')}}">Pack Lists</a>
                            @if (strpos(Route::currentRouteName(), 'user.packs') !== 0)
                                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </div>
                    @endguest
                    <ul class="navbar-nav ml-auto d-block d-lg-none">
                        <!-- Authentication Links -->
                        @guest
                            <a class="nav-link" href="{{route ('packs.index')}}">
                                Pack Lists
                            </a>
                            @if (strpos(Route::currentRouteName(), 'user.packs') !== 0)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">

                                <a class="nav-link" href="{{route ('packs.index')}}">
                                    Pack Lists
                                </a>

                                <a class="nav-link" href="{{route ('user.packs.index')}}">
                                    Your Packs
                                </a>

                                <a class="nav-link" href="{{route ('user.edit')}}">
                                    Account
                                </a>

                                @if (Auth()->user()->is_admin)
                                    <a class="nav-link" href="{{route ('admin.pack_auto_completes.index')}}">
                                        Admin
                                    </a>
                                @endif

                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="@guest col-0 d-none @else col-lg-3 col-xl-2 d-none d-lg-block @endguest">

                        <!-- <div class="left-menu-spacer"></div> -->
                        <div class="left-menu-item">
                            <svg enable-background="new 0 0 300 300"version=1.1 viewBox="0 0 300 300"x=0px xml:space=preserve xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink y=0px><g transform="translate(5 5) scale(8.932696708362196) translate(0.21500003337860107 -0.9419994354248047)"><g xmlns=http://www.w3.org/2000/svg><path d="M31.639,20.609c-0.644-4.262-4.346-10.375-6.43-11.631l-0.512-0.306H21.34c-1.775-2.437-3.688-3.637-5.761-3.561   c-2.797,0.102-4.783,2.602-5.445,3.561h-2.8L6.608,9.123c-2.116,1.524-5.59,7.369-6.213,11.486   c-0.61,4.029,1.006,5.716,2.027,6.361c0.705,0.446,1.54,0.67,2.42,0.668c0.577,0,1.174-0.096,1.766-0.283   c0,1.082,0.877,1.959,1.958,1.959H23.25c1.081,0,1.958-0.877,1.958-1.959v-0.073c0.662,0.237,1.335,0.356,1.981,0.356   c0.881,0,1.718-0.223,2.42-0.668C30.63,26.325,32.25,24.639,31.639,20.609z M15.661,7.176c0.993-0.024,1.991,0.474,2.991,1.496   h-5.846C13.519,7.95,14.519,7.214,15.661,7.176z M4.083,24.355c-0.64-0.406-0.872-1.633-0.622-3.283   c0.406-2.691,1.893-5.371,3.147-7.215v10.091C5.69,24.552,4.657,24.719,4.083,24.355z M22.604,26.369   c0.035,0.152,0,0.312-0.098,0.436c-0.098,0.122-0.244,0.193-0.402,0.193h-0.578c-0.144,0-0.28-0.064-0.375-0.175   c-0.092-0.111-0.131-0.259-0.104-0.4l0.269-1.483c-0.477-0.166-0.82-0.625-0.82-1.16c0-0.459,0.219-0.86,0.627-1.07v-9.471H10.696   V23.68c0,0.285-0.226,0.518-0.511,0.518s-0.512-0.231-0.512-0.518V12.713c0-0.286,0.237-0.5,0.523-0.5h11.439   c0.286,0,0.508,0.215,0.508,0.5v9.914c0.479,0.174,0.799,0.622,0.799,1.146c0,0.482-0.274,0.906-0.683,1.106L22.604,26.369z    M27.95,24.355c-0.579,0.367-1.63,0.192-2.552-0.424c-0.063-0.041-0.125-0.078-0.191-0.109v-10.28   c1.295,1.843,2.936,4.681,3.365,7.53C28.823,22.723,28.591,23.948,27.95,24.355z"></path></g></g></svg>
                            <a class="{{ (strpos(Route::currentRouteName(), 'packs') === 0) ? 'active' : '' }}" href="{{route ('packs.index')}}">
                                Pack Lists
                            </a>
                        </div>
                        @auth
                            <div class="left-menu-item">
                                <svg enable-background="new 0 0 300 300"version=1.1 viewBox="0 0 300 300"x=0px xml:space=preserve xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink y=0px><g transform="translate(5 5) scale(1) translate(-5 -5.000007629394531)"><g xmlns=http://www.w3.org/2000/svg transform="translate(5 5) scale(7.631578947368421) translate(0 2.7960003912448883)"><g xmlns=http://www.w3.org/2000/svg id=_x33_43._Playlist><g><path d="M6.304,3.145l-4.608-2.88C0.759-0.321,0,0.1,0,1.204v6c0,1.104,0.759,1.525,1.696,0.94l4.608-2.88    C7.241,4.679,7.241,3.729,6.304,3.145z M36,1.204H12c-1.105,0-2,0.896-2,2v2c0,1.104,0.895,2,2,2h24c1.104,0,2-0.896,2-2v-2    C38,2.1,37.105,1.204,36,1.204z M1.696,20.145l4.608-2.88c0.937-0.586,0.895-1.461-0.093-1.955l-4.422-2.211    C0.801,12.605,0,13.1,0,14.204v5C0,20.309,0.759,20.729,1.696,20.145z M36,13.204H12c-1.105,0-2,0.896-2,2v2c0,1.104,0.895,2,2,2    h24c1.104,0,2-0.896,2-2v-2C38,14.1,37.105,13.204,36,13.204z M6.304,27.145l-4.608-2.88C0.759,23.679,0,24.1,0,25.204v6    c0,1.104,0.759,1.525,1.696,0.94l4.608-2.88C7.241,28.68,7.241,27.73,6.304,27.145z M36,25.204H12c-1.105,0-2,0.896-2,2v2    c0,1.104,0.895,2,2,2h24c1.104,0,2-0.896,2-2v-2C38,26.1,37.105,25.204,36,25.204z"></path></g></g><g xmlns=http://www.w3.org/2000/svg></g><g xmlns=http://www.w3.org/2000/svg></g><g xmlns=http://www.w3.org/2000/svg></g><g xmlns=http://www.w3.org/2000/svg></g><g xmlns=http://www.w3.org/2000/svg></g><g xmlns=http://www.w3.org/2000/svg></g><g xmlns=http://www.w3.org/2000/svg></g><g xmlns=http://www.w3.org/2000/svg></g><g xmlns=http://www.w3.org/2000/svg></g><g xmlns=http://www.w3.org/2000/svg></g><g xmlns=http://www.w3.org/2000/svg></g><g xmlns=http://www.w3.org/2000/svg></g><g xmlns=http://www.w3.org/2000/svg></g><g xmlns=http://www.w3.org/2000/svg></g><g xmlns=http://www.w3.org/2000/svg></g></g></g></svg>
                                <a class="{{ (strpos(Route::currentRouteName(), 'user.packs') === 0) ? 'active' : '' }}" href="{{route ('user.packs.index')}}">
                                    Your Packs
                                </a>
                            </div>
                            <div class="left-menu-item">
                                <svg enable-background="new 0 0 300 300"version=1.1 viewBox="0 0 300 300"x=0px xml:space=preserve xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink y=0px><g transform="translate(5 5) scale(14.692470727591916) translate(1.5585002899169922 0)"><path d="M16.621,19.738h-2c0-3.374-2.83-6.118-6.311-6.118S2,16.365,2,19.738H0c0-4.478,3.729-8.118,8.311-8.118  C12.893,11.62,16.621,15.26,16.621,19.738z"xmlns=http://www.w3.org/2000/svg></path><path d="M8.311,10.97c-3.023,0-5.484-2.462-5.484-5.485C2.827,2.461,5.287,0,8.311,0c3.025,0,5.486,2.46,5.486,5.485  C13.797,8.51,11.336,10.97,8.311,10.97z M8.311,2C6.389,2,4.826,3.563,4.826,5.485S6.389,8.97,8.311,8.97  c1.923,0,3.486-1.563,3.486-3.485S10.232,2,8.311,2z"xmlns=http://www.w3.org/2000/svg></path></g></svg>
                                <a class="{{ (strpos(Route::currentRouteName(), 'user.edit') === 0) ? 'active' : '' }}" href="{{route ('user.edit')}}">
                                    Account
                                </a>
                            </div>
                            <div class="left-menu-item">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve"><g transform="translate(5 5) scale(2.350081153515049) translate(-3.3000030517578125 -1.5500011444091797)">
                                        <path xmlns="http://www.w3.org/2000/svg" d="M89.3,29.6V8.9c0-3.3-2.7-6-6-6h-74c-3.3,0-6,2.7-6,6v3.9v78.2v2.7c0,2.2,1.3,4.3,3.2,5.3l45.6,23.6c2,1,4.4-0.4,4.4-2.7  V96.9h26.8c3.3,0,6-2.7,6-6V58.1h-12l0,23.8c0,1.7-1.3,3-3,3H56.6V54.1V34.6v-0.6c0-2.2-1.3-4.3-3.2-5.3L26.5,14.9l47.8,0  c1.7,0,3,1.3,3,3l0,11.8H89.3z"></path>
                                        <path xmlns="http://www.w3.org/2000/svg" d="M104.7,19.8c0,0,19.5,19.5,19.5,19.5c2.5,2.5,2.5,6.2,0,8.7l-19.5,19.5c-2.5,2.5-6.3,2.6-8.8,0.1c-2.4-2.4-2.1-6.4,0.2-8.8  l8.8-8.7c0,0-34.1,0-34.1,0c-1.7,0-3.4-0.7-4.5-2c-2.8-3-2.1-8.3,1.5-10.3c0.9-0.5,2-0.8,3-0.8l34.1,0c0,0-8.7-8.7-8.8-8.7  c-2.3-2.3-2.6-6.4-0.2-8.7C98.3,17.2,102.2,17.3,104.7,19.8z"></path>
                                    </g></svg><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>

                            @if (Auth()->user()->is_admin)
                                <div class="left-menu-spacer"></div>
                                <div class="left-menu-item">
                                    <svg enable-background="new 0 0 300 300"version=1.1 viewBox="0 0 300 300"x=0px xml:space=preserve xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink y=0px><g transform="translate(5 5) scale(8.247773792735922) translate(-7.420000076293945 -7.390500068664551)"><path d="M42.378,21.532l-8.87,7.93l2.516,11.628c0.042,0.193-0.035,0.394-0.195,0.511c-0.087,0.062-0.19,0.096-0.294,0.096  c-0.086,0-0.173-0.022-0.251-0.067L25,35.644l-10.283,5.985c-0.172,0.099-0.385,0.088-0.545-0.028  c-0.16-0.115-0.236-0.315-0.194-0.51l2.515-11.628l-8.87-7.93c-0.147-0.133-0.203-0.34-0.142-0.527s0.228-0.322,0.425-0.343  l11.837-1.201l4.8-10.887c0.16-0.361,0.755-0.361,0.915,0l4.8,10.887l11.837,1.201c0.197,0.021,0.364,0.153,0.426,0.343  C42.581,21.193,42.525,21.398,42.378,21.532z"xmlns=http://www.w3.org/2000/svg></path></g></svg>
                                    <a class="{{ (strpos(Route::currentRouteName(), 'admin') === 0) ? 'active' : '' }}" href="{{route ('admin.pack_auto_completes.index')}}">
                                        Admin
                                    </a>
                                </div>
                            @endif
                        @endauth

                    </div>
                    <div class="@guest col-12 @else col-lg-9 col-xl-10 col-md-12 @endguest">
                        @yield('content')
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center"><a href="#" data-toggle="modal" data-target="#registerModal" class="text-danger">report an issue</a></div>
                </div>
            </div>
        </main>
    </div>

    <div class="modal fade reportAnIssueModal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="reportAnIssueModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Report An Issue</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="reportIssueCompletedContent" style="display: none;">Thank you. Your message has been sent!</div>
                    <div class="form-group">
                        <label for="siteIssueMessage">Issue</label>
                        <textarea id="siteIssueMessage" name="siteIssueMessage" class="form-control" rows="9"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="reportIssueCloseBtn" type="button" class="btn btn-danger" data-dismiss="modal" style="display: none;">Close</button>
                    <button id="reportIssueCancelBtn" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button id="reportAnIssueBtn" type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
