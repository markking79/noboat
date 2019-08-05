@extends('layouts.app')

@section('page-title') Your Packs @endsection

@section('content')
    <div class="row">
        <div class="col-6">
            <h1>Your Packs</h1>
        </div>
        <div class="col-6 text-right">
            <a class="btn btn-lg btn-primary" href="#">Add Pack</a><br /><br />
        </div>
    </div>

    @if (!$packs->isEmpty ())
        @foreach ($packs->chunk (3) as $chunked_packs)
            <div class="row view-packs-content list-user-packs-content">
                @foreach ($chunked_packs as $pack)
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="card">
                            <a href="{{route ('user.packs.edit', ['pack' => $pack])}}">
                                <div class="card-image-content">
                                    @if ($pack->image)
                                        <img class="card-img-top" src="{{Storage::url ($pack->image)}}" />
                                    @else
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve"><g transform="translate(5 5) scale(8.932696708362196) translate(0.21500003337860107 -0.9419994354248047)">
                                                <g xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M31.639,20.609c-0.644-4.262-4.346-10.375-6.43-11.631l-0.512-0.306H21.34c-1.775-2.437-3.688-3.637-5.761-3.561   c-2.797,0.102-4.783,2.602-5.445,3.561h-2.8L6.608,9.123c-2.116,1.524-5.59,7.369-6.213,11.486   c-0.61,4.029,1.006,5.716,2.027,6.361c0.705,0.446,1.54,0.67,2.42,0.668c0.577,0,1.174-0.096,1.766-0.283   c0,1.082,0.877,1.959,1.958,1.959H23.25c1.081,0,1.958-0.877,1.958-1.959v-0.073c0.662,0.237,1.335,0.356,1.981,0.356   c0.881,0,1.718-0.223,2.42-0.668C30.63,26.325,32.25,24.639,31.639,20.609z M15.661,7.176c0.993-0.024,1.991,0.474,2.991,1.496   h-5.846C13.519,7.95,14.519,7.214,15.661,7.176z M4.083,24.355c-0.64-0.406-0.872-1.633-0.622-3.283   c0.406-2.691,1.893-5.371,3.147-7.215v10.091C5.69,24.552,4.657,24.719,4.083,24.355z M22.604,26.369   c0.035,0.152,0,0.312-0.098,0.436c-0.098,0.122-0.244,0.193-0.402,0.193h-0.578c-0.144,0-0.28-0.064-0.375-0.175   c-0.092-0.111-0.131-0.259-0.104-0.4l0.269-1.483c-0.477-0.166-0.82-0.625-0.82-1.16c0-0.459,0.219-0.86,0.627-1.07v-9.471H10.696   V23.68c0,0.285-0.226,0.518-0.511,0.518s-0.512-0.231-0.512-0.518V12.713c0-0.286,0.237-0.5,0.523-0.5h11.439   c0.286,0,0.508,0.215,0.508,0.5v9.914c0.479,0.174,0.799,0.622,0.799,1.146c0,0.482-0.274,0.906-0.683,1.106L22.604,26.369z    M27.95,24.355c-0.579,0.367-1.63,0.192-2.552-0.424c-0.063-0.041-0.125-0.078-0.191-0.109v-10.28   c1.295,1.843,2.936,4.681,3.365,7.53C28.823,22.723,28.591,23.948,27.95,24.355z"></path>
                                                </g>
                                            </g></svg>
                                    @endif
                                </div>
                            </a>

                            <div class="card-body">
                                <h5 class="card-title">{{$pack->name}} @if (!$pack->is_visible) <span class="private-badge badge badge-pill badge-danger">Private</span> @endif </h5>
                                <h6 class="card-subtitle mb-2 text-muted">

                                    @if ($pack->login_user_liked)
                                        <svg class="heartSVG" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve"><g transform="translate(5 5) scale(0.7552083333333334) translate(-64 -64)">
                                                <path xmlase weighns="http://www.w3.org/2000/svg" d="M340.8,83C307,83,276,98.8,256,124.8c-20-26-51-41.8-84.8-41.8C112.1,83,64,131.3,64,190.7c0,27.9,10.6,54.4,29.9,74.6  L245.1,418l10.9,11l10.9-11l148.3-149.8c21-20.3,32.8-47.9,32.8-77.5C448,131.3,399.9,83,340.8,83L340.8,83z"></path>
                                            </g></svg>
                                    @else
                                        <svg class="heartSVG" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve"><g transform="translate(5 5) scale(8.1209747251463) translate(-7.144999027252197 -7.145001411437988)">
                                                <path xmlns="http://www.w3.org/2000/svg" d="M37.299,10.731c-1.586-0.873-3.379-1.334-5.185-1.334c-2.646,0-5.162,0.967-7.112,2.696  c-1.953-1.729-4.474-2.696-7.119-2.696c-1.801,0-3.593,0.461-5.187,1.336c-3.424,1.896-5.551,5.5-5.551,9.406  c0,1.101,0.172,2.193,0.51,3.248c1.773,7.637,15.946,16.608,16.551,16.987c0.244,0.153,0.521,0.229,0.798,0.229  c0.276,0,0.554-0.078,0.798-0.23c0.604-0.379,14.768-9.352,16.545-16.987c0.336-1.054,0.508-2.146,0.508-3.248  C42.854,16.233,40.727,12.629,37.299,10.731z M39.473,22.523c-0.015,0.046-0.026,0.092-0.038,0.14  C38.321,27.666,29.29,34.497,25.003,37.32c-4.289-2.821-13.322-9.647-14.436-14.656c-0.011-0.048-0.023-0.096-0.039-0.142  c-0.254-0.774-0.383-1.575-0.383-2.382c0-2.815,1.534-5.414,4-6.779c1.146-0.63,2.438-0.963,3.736-0.963  c2.311,0,4.484,1.022,5.968,2.805c0.285,0.343,0.708,0.541,1.153,0.541h0.001c0.446,0,0.869-0.199,1.153-0.543  c1.477-1.781,3.647-2.803,5.957-2.803c1.301,0,2.593,0.333,3.733,0.96c2.47,1.368,4.004,3.966,4.004,6.782  C39.854,20.947,39.726,21.75,39.473,22.523z"></path>
                                            </g></svg>
                                    @endif


                                    {{$pack->heart_count ?? "0" }} likes</h6>
                                <p class="card-text">
                                    {{$pack->desired_weight_format($pack_weight_units)}} <i>(base weight)</i><br />
                                    ${{number_format ($pack->visible_cost, 2)}}<br />
                                    {{$pack->visible_item_count  ?? "0"}} items<br/>
                                    Created {{$pack->display_date}}
                                </p>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{route ('user.packs.edit', ['pack' => $pack])}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route ('packs.show', ['pack' => $pack])}}" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                        <br />
                    </div>
                @endforeach
            </div>
        @endforeach
    @else
        <p>No packs on file.</p>
    @endif

    <br />
    {{ $packs->links() }}
@endsection