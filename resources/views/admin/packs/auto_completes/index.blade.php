@extends('layouts.app')

@section('page-title') Admin Pack Auto Completes @endsection

@section('content')

    <div class="row">
        <div class="col-12 text-right">
            <a class="btn btn-lg btn-primary" href="{{route ('admin.pack_auto_completes.create')}}">Add New</a><br /><br />
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Search Pack Auto Completes</h3>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-12 col-md-3 col-form-label text-md-right">Search</label>

                <div class="col-12 col-md-9">
                    <input id="term" name="term" type="text" class="form-control" placeholder="ZPacks..." autofocus>
                </div>
            </div>
        </div>
    </div><br />

    <div class="card">
        <div class="card-header">
            <h3>Pack Auto Completes</h3>
        </div>

        <div class="card-body">
            <div class="row d-none d-md-flex">
                <div class="col-1">

                </div>
                <div class="col-4">

                </div>
                <div class="col-2 text-center">
                    <p><b>Price</b> <i>(each)</i></p>
                </div>
                <div class="col-2 text-center">
                    <p><b>Weight</b> (each)</p>
                </div>
                <div class="col-3 text-center">

                </div>
            </div>

            @if ($items) @foreach ($items as $item)
                <div class="row view-pack-row">
                    <div class="col-12">
                        <hr />
                    </div>

                    <div class="col-12 col-md-1 text-center">
                        <div class="image-content">
                            @if ($item->image)
                                <img src="{{Storage::url ($item->image)}}?v=@php echo rand (0,100000000); @endphp" />
                            @else
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve"><g transform="translate(5 5) scale(3.7815069787135234) translate(0 2.334503173828125)">
                                        <path xmlns="http://www.w3.org/2000/svg" d="M64.571,0H12.118L0,19.388V72.02h76.689V19.387L64.571,0z M74.667,69.999H2.02V19.968L13.237,2.023h24.096v16.646H5.677  v2.021H71.01v-2.021H39.355V2.021H63.45l11.218,17.946L74.667,69.999L74.667,69.999z M24.344,37.333h28v2.021h-28V37.333z"></path>
                                    </g></svg>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <h3 class="display_name">{{$item->name}}</h3>
                        @if ($item->purchase_link)
                            <p class="display_description">{{$item->purchase_link}}</p>
                        @endif
                    </div>
                    <div class="col-12 col-md-2 text-left text-md-center">
                        <p>$<span class="display_cost">{{number_format ($item->price, 2)}}</span> <span class="d-inline-flex d-md-none font-weight-bold">(each)</span></p>

                    </div>
                    <div class="col-12 col-md-2 text-left text-md-center">
                        <p><span class="display_weight"> {{$item->ounces ?? "0"}}</span> oz. <i>(<span class="convertOunces">{{$item->ounces ?? "0"}}</span>) <span class="d-inline-flex d-md-none font-weight-bold">(each)</span></i></p>
                    </div>
                    <div class="col-12 col-md-3 text-left text-md-right">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a id="editItemBtn-{{$item->id}}" href="#" class="btn btn-sm btn-primary editItemBtn" data-toggle="modal" data-target="#editItemModal">Edit</a>
                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteItem-{{$item->id}}">Delete</a>
                        </div>
                    </div>
                    <br />

                    <div class="modal" id="deleteItem-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteItem-{{$item->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Delete Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <p>Are you sure you would like to delete <b>{{$item->name}}</b>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No Cancel</button>
                                    <button id="confirmDeleteItemBtn-{{$item->id}}" type="button" class="btn btn-danger confirmDeleteItemBtn" data-dismiss="modal">Yes Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach @endif
        </div>
    </div>

    <br />
    {{$items->links ()}}

@endsection