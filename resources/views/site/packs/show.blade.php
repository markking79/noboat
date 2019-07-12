@extends('layouts.app')

@section('page-title') {{$pack->name}} @endsection

@section('content')

    <div class="row view-pack-heading-row">

        <div class="col-12 col-md-2">
            <div class="image-content text-center">
                @if ($pack->image)
                    <img src="{{Storage::url ($pack->image)}}" />
                @else
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve"><g transform="translate(5 5) scale(8.932696708362196) translate(0.21500003337860107 -0.9419994354248047)">
                            <g xmlns="http://www.w3.org/2000/svg">
                                <path d="M31.639,20.609c-0.644-4.262-4.346-10.375-6.43-11.631l-0.512-0.306H21.34c-1.775-2.437-3.688-3.637-5.761-3.561   c-2.797,0.102-4.783,2.602-5.445,3.561h-2.8L6.608,9.123c-2.116,1.524-5.59,7.369-6.213,11.486   c-0.61,4.029,1.006,5.716,2.027,6.361c0.705,0.446,1.54,0.67,2.42,0.668c0.577,0,1.174-0.096,1.766-0.283   c0,1.082,0.877,1.959,1.958,1.959H23.25c1.081,0,1.958-0.877,1.958-1.959v-0.073c0.662,0.237,1.335,0.356,1.981,0.356   c0.881,0,1.718-0.223,2.42-0.668C30.63,26.325,32.25,24.639,31.639,20.609z M15.661,7.176c0.993-0.024,1.991,0.474,2.991,1.496   h-5.846C13.519,7.95,14.519,7.214,15.661,7.176z M4.083,24.355c-0.64-0.406-0.872-1.633-0.622-3.283   c0.406-2.691,1.893-5.371,3.147-7.215v10.091C5.69,24.552,4.657,24.719,4.083,24.355z M22.604,26.369   c0.035,0.152,0,0.312-0.098,0.436c-0.098,0.122-0.244,0.193-0.402,0.193h-0.578c-0.144,0-0.28-0.064-0.375-0.175   c-0.092-0.111-0.131-0.259-0.104-0.4l0.269-1.483c-0.477-0.166-0.82-0.625-0.82-1.16c0-0.459,0.219-0.86,0.627-1.07v-9.471H10.696   V23.68c0,0.285-0.226,0.518-0.511,0.518s-0.512-0.231-0.512-0.518V12.713c0-0.286,0.237-0.5,0.523-0.5h11.439   c0.286,0,0.508,0.215,0.508,0.5v9.914c0.479,0.174,0.799,0.622,0.799,1.146c0,0.482-0.274,0.906-0.683,1.106L22.604,26.369z    M27.95,24.355c-0.579,0.367-1.63,0.192-2.552-0.424c-0.063-0.041-0.125-0.078-0.191-0.109v-10.28   c1.295,1.843,2.936,4.681,3.365,7.53C28.823,22.723,28.591,23.948,27.95,24.355z"></path>
                            </g>
                        </g></svg>
                @endif
            </div>
            <div class="text-center col-12" style="margin-top: 10px;">
                <iframe src="https://www.facebook.com/plugins/share_button.php?href={{config('APP_URL')}}{{url()->current()}}&layout=button&size=small&appId=538515852997725&width=59&height=20" width="59" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <h1>{{$pack->name}}</h1>
            <p>
                <span class="convertOunces">{{$pack->visible_ounces  ?? "0"}}</span> <i>(base weight)</i><br />
                ${{number_format ($pack->visible_cost, 2)}} USD<br />
                {{$pack->visible_item_count  ?? "0"}} items<br />

                <span id="likableHeart" @if (!$pack->login_user_liked) style="display: none;" @endif>
                    <svg class="heartSVG" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve"><g transform="translate(5 5) scale(0.56640625) translate(0 0)">
                            <path xmlns="http://www.w3.org/2000/svg" d="M512,179.078c0,43.181-18.609,82.015-48.245,108.922H464L304,448c-16,16-32,32-48,32s-32-16-48-32L48,288h0.245  C18.609,261.093,0,222.259,0,179.078C0,97.849,65.849,32,147.078,32C190.259,32,229.093,50.609,256,80.245  C282.907,50.609,321.741,32,364.922,32C446.15,32,512,97.849,512,179.078z"></path>
                        </g></svg>
                    </span>
                <span id="unlikableHeart" @if ($pack->login_user_liked) style="display: none;" @endif>
                    <svg class="heartSVG" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve"><g transform="translate(5 5) scale(8.1209747251463) translate(-7.144999027252197 -7.145001411437988)">
                            <path xmlns="http://www.w3.org/2000/svg" d="M37.299,10.731c-1.586-0.873-3.379-1.334-5.185-1.334c-2.646,0-5.162,0.967-7.112,2.696  c-1.953-1.729-4.474-2.696-7.119-2.696c-1.801,0-3.593,0.461-5.187,1.336c-3.424,1.896-5.551,5.5-5.551,9.406  c0,1.101,0.172,2.193,0.51,3.248c1.773,7.637,15.946,16.608,16.551,16.987c0.244,0.153,0.521,0.229,0.798,0.229  c0.276,0,0.554-0.078,0.798-0.23c0.604-0.379,14.768-9.352,16.545-16.987c0.336-1.054,0.508-2.146,0.508-3.248  C42.854,16.233,40.727,12.629,37.299,10.731z M39.473,22.523c-0.015,0.046-0.026,0.092-0.038,0.14  C38.321,27.666,29.29,34.497,25.003,37.32c-4.289-2.821-13.322-9.647-14.436-14.656c-0.011-0.048-0.023-0.096-0.039-0.142  c-0.254-0.774-0.383-1.575-0.383-2.382c0-2.815,1.534-5.414,4-6.779c1.146-0.63,2.438-0.963,3.736-0.963  c2.311,0,4.484,1.022,5.968,2.805c0.285,0.343,0.708,0.541,1.153,0.541h0.001c0.446,0,0.869-0.199,1.153-0.543  c1.477-1.781,3.647-2.803,5.957-2.803c1.301,0,2.593,0.333,3.733,0.96c2.47,1.368,4.004,3.966,4.004,6.782  C39.854,20.947,39.726,21.75,39.473,22.523z"></path>
                        </g></svg>
                    </span>
                <span id="likeCountContent">{{$pack->heart_count  ?? "0"}}</span> likes
            </p>
        </div>
        <div class="col-12 col-md-4 text-right">
            <div class="btn-group btn-group-sm" role="group" style="margin-bottom: 10px;">
                <a href="?pack_weight_units=Imperial" class="btn @if ($pack_weight_units == 'Imperial') btn-primary @else btn-secondary @endif ">Imperial</a>
                <a href="?pack_weight_units=Metric" class="btn @if ($pack_weight_units == 'Metric') btn-primary @else btn-secondary @endif ">Metric</a>
            </div>
        </div>
    </div><br />

    @if ($pack->categories)

        @foreach ($pack->categories as $category)
            @if ($category->is_visible)
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <div class="row">
                            <div class="col-12 col-md-8">

                                <h3>{{$category->name}}</h3>
                            </div>
                            @if (count($category['items']) > 0)
                                <div class="col-12 col-md-4 text-md-right">
                                    {{$category->total_ounces}} oz. (<span class="convertOunces">{{$category->total_ounces}}</span>)<br />
                                    ${{number_format ($category->total_cost, 2)}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @if (count($category['items']) > 0)

                            <div class="row d-none d-md-flex">
                                <div class="col-1">

                                </div>
                                <div class="col-6">

                                </div>
                                <div class="col-2 text-center">
                                    <p><b>Price</b> <i>(each)</i></p>
                                </div>
                                <div class="col-2 text-center">
                                    <p><b>Weight</b> (each)</p>
                                </div>
                                <div class="col-1 text-center">
                                    <p><b>Qty.</b></p>
                                </div>
                            </div>

                            @foreach ($category['items'] as $item)

                                <div class="row view-pack-row">
                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <div class="col-12 col-md-1 text-center">
                                        <div class="image-content">
                                            @if ($item->image)
                                                <img src="{{Storage::url ($item->image)}}" />
                                            @else
                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve"><g transform="translate(5 5) scale(3.7815069787135234) translate(0 2.334503173828125)">
                                                        <path xmlns="http://www.w3.org/2000/svg" d="M64.571,0H12.118L0,19.388V72.02h76.689V19.387L64.571,0z M74.667,69.999H2.02V19.968L13.237,2.023h24.096v16.646H5.677  v2.021H71.01v-2.021H39.355V2.021H63.45l11.218,17.946L74.667,69.999L74.667,69.999z M24.344,37.333h28v2.021h-28V37.333z"></path>
                                                    </g></svg>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <h3>@if ($item->purchase_link)<a target="_blank" href="{{$item->purchase_link}}">@endif{{$item->name}}@if ($item->purchase_link)</a>@endif</h3>
                                        <p>{{substr($item->description, 0, 100)}} @if (strlen($item->description) > 100) <a href="#" class="readMoreLink">read more</a> <span class="moreText" style="display: none;">{{substr($item->description, 100, 100000000)}}</span> @endif </p>
                                    </div>
                                    <div class="col-12 col-md-2 text-left text-md-center">
                                        <p>${{number_format ($item->cost_each, 2)}} <span class="d-inline-flex d-md-none font-weight-bold">(each)</span></p>

                                    </div>
                                    <div class="col-12 col-md-2 text-left text-md-center">
                                        <p>{{$item->ounces_each  ?? "0"}} oz. <i>(<span class="convertOunces">{{$item->ounces_each  ?? "0"}}</span>) <span class="d-inline-flex d-md-none font-weight-bold">(each)</span></i></p>
                                    </div>
                                    <div class="col-12 col-md-1 text-left text-md-center">
                                        <p>x {{$item->quantity  ?? "0"}} <span class="d-inline-flex d-md-none font-weight-bold">(quantity)</span></p>
                                    </div>
                                </div>

                            @endforeach

                        @else
                            <div class="row">
                                <div class="col col-12">
                                    N/A
                                </div>
                            </div>
                        @endif
                    </div>
                </div><br />
            @endif
        @endforeach
    @endif

@endsection
@section('script')
    <script>
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        window.onload = function () {

            ouncesConvertToPretty ('{{$pack_weight_units}}');

            $('.readMoreLink').click (function (e) {
                e.preventDefault ();

                $(this).parent ().find ('.moreText').show ();
                $(this).hide ();
            });

            @auth
            $('#likableHeart svg').click (function () {
                $('#likableHeart').hide ();
                $('#unlikableHeart').show ();

                $('#likeCountContent').html (parseInt($('#likeCountContent').html ())-1);

                $.post ('#', {'like': false});
            });

            $('#unlikableHeart svg').click (function () {
                $('#likableHeart').show ();
                $('#unlikableHeart').hide ();

                $('#likeCountContent').html (parseInt($('#likeCountContent').html ())+1);

                $.post ('#', {'like': true});
            });
            @endif

        }

        function ouncesConvertToPretty (convertTo)
        {

            if (convertTo == 'Metric')
            {
                $('.convertOunces').each (function () {
                    var ounces = parseInt($(this).text ());
                    $(this).text ((ounces / 35.27).toFixed (1) + ' kg.');
                });
            }
            else if (convertTo == 'Imperial')
            {
                $('.convertOunces').each (function () {
                    var ounces = parseInt($(this).text ());
                    $(this).text ((ounces / 16).toFixed (1) + ' lb.');
                });
            }
        }
    </script>
@endsection