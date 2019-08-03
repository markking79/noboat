@extends('layouts.app')

@section('page-title') {{$pack->name}} @endsection

@section('content')

    <div class="row view-pack-heading-row">
        @guest
        <div class="col-12 d-sm-block d-md-none text-right">
            <a class="btn btn-lg btn-primary" href="#">Add Your Pack</a><br /><br />
        </div>
        @endguest

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
            <div class="text-center col-12 mt-2">
                <iframe src="https://www.facebook.com/plugins/share_button.php?href={{config('APP_URL')}}{{url()->current()}}&layout=button&size=small&appId=538515852997725&width=59&height=20" width="59" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <h1>{{$pack->name}}</h1>
            <p>
                {{$pack->desired_weight_format ($pack_weight_units)}} <i>(base weight)</i><br />
                ${{number_format ($pack->visible_cost, 2)}} USD<br />
                {{$pack->visible_item_count  ?? "0"}} items<br />

                <like-pack
                        v-bind:user-is-loggedin="@auth true @else false @endif"
                        v-bind:user-has-liked="{{$pack->login_user_liked ? 'true' : 'false'}}"
                        v-bind:pack-id="{{$pack->id}}"
                        like-api-url="{{route ('api.user.pack_likes.store')}}"
                        unlike-api-url="{{route ('api.user.pack_likes.destroy', ['pack_id' => $pack->id])}}"
                        v-bind:pack-like-count="{{$pack->heart_count  ?? "0"}}"
                ></like-pack>
            </p>
        </div>
        <div class="col-12 col-md-4 text-right">
            @guest
            <span class="d-none d-md-block">
                <a class="btn btn-lg btn-primary" href="#">Add Your Pack</a><br /><br />
            </span>
            @endguest
            <div class="btn-group btn-group-sm" role="group" style="margin-bottom: 10px;">
                <a href="?pack_weight_units=imperial" class="btn @if ($pack_weight_units == 'imperial') btn-primary @else btn-secondary @endif ">Imperial</a>
                <a href="?pack_weight_units=metric" class="btn @if ($pack_weight_units == 'metric') btn-primary @else btn-secondary @endif ">Metric</a>
            </div>
        </div>
    </div><br />

    @if ($pack->categories)

        @foreach ($pack->categories as $category)
            @if ($category->is_visible)
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 col-md-8">

                                <h3>{{$category->name}}</h3>
                            </div>
                            @if (count($category['items']) > 0)
                                <div class="col-12 col-md-4 text-md-right">
                                    {{$category->total_ounces}} oz. ({{$category->desired_weight_format ($pack_weight_units)}})<br />
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
                                        <p>
                                            <readmore text="{{$item->description}}"></readmore>
                                    </div>
                                    <div class="col-12 col-md-2 text-left text-md-center">
                                        <p>${{number_format ($item->cost_each, 2)}} <span class="d-inline-flex d-md-none font-weight-bold">(each)</span></p>

                                    </div>
                                    <div class="col-12 col-md-2 text-left text-md-center">
                                        <p>{{$item->ounces_each  ?? "0"}} oz. <i>({{$item->desired_weight_format ($pack_weight_units)}}) <span class="d-inline-flex d-md-none font-weight-bold">(each)</span></i></p>
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