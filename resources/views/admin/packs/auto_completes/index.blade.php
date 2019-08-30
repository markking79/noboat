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
                    <input id="terms" name="terms" type="text" class="form-control" placeholder="ZPacks..." autofocus>
                </div>
            </div>
            <span id="searchResultsContent"></span>
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
                <div id="row-{{$item->id}}" class="row view-pack-row">
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
                            <p class="display_description"><a href="{{$item->purchase_link}}" target="_blank">{{$item->purchase_link}}</a></p>
                        @endif
                    </div>
                    <div class="col-12 col-md-2 text-left text-md-center">
                        <p>$<span class="display_cost">{{number_format ($item->price, 2)}}</span> <span class="d-inline-flex d-md-none font-weight-bold">(each)</span></p>

                    </div>
                    <div class="col-12 col-md-2 text-left text-md-center">
                        <p><span class="display_weight"> {{$item->ounces ?? "0"}}</span> oz. <i>(<span class="convertOunces">{{$item->desired_weight_format ()}}</span>) <span class="d-inline-flex d-md-none font-weight-bold">(each)</span></i></p>
                    </div>
                    <div class="col-12 col-md-3 text-left text-md-right">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{route ('admin.pack_auto_completes.edit', ['pack_auto_completes' => $item->id])}}" class="btn btn-sm btn-primary">Edit</a>

                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteItem-{{$item->id}}">Delete</a>


                        </div>
                    </div>

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
                                    <button id="{{$item->id}}" type="button" class="btn btn-danger confirmDeleteItemBtn" data-dismiss="modal">Yes Delete</button>
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
@section('script')

    <script>

        var xhr = false;

        let editUrl = '{{route ('admin.pack_auto_completes.edit', ['pack_auto_completes' => 123])}}';

        window.onload = function () {

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

            $('.confirmDeleteItemBtn').click (function () {

                let id = $(this).attr ('id');
                var url = '{{route ('api.admin.pack_auto_completes.destroy', ['id' => 123])}}';
                url = url.replace ('123', id);

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    success: function(result) {
                        $('#row-'+id).remove ();
                    }
                });

            });

            $('#terms').keyup (function () {

                let terms = $(this).val ();

                if (xhr)
                    xhr.abort ();

                if (!terms)
                {
                    $('#searchResultsContent').html ('');
                    return;
                }

                var url = '{{route ('api.admin.pack_auto_completes.index', ['terms' => 123])}}';
                url = url.replace ('123', terms);

                xhr = $.ajax({
                    url: url,
                    success: function(results) {

                        $('#searchResultsContent').html ('');
                        dataObj = eval('(' + results + ')');

                        obj = dataObj.data;

                        if (obj)
                        {
                            for (i in obj)
                            {
                                var image = '';
                                if (obj[i].image != '')
                                    image = '<img src="' + obj[i].image + '" />';
                                else
                                    image = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve"><g transform="translate(5 5) scale(3.7815069787135234) translate(0 2.334503173828125)">\n' +
                                        '                                    <path xmlns="http://www.w3.org/2000/svg" d="M64.571,0H12.118L0,19.388V72.02h76.689V19.387L64.571,0z M74.667,69.999H2.02V19.968L13.237,2.023h24.096v16.646H5.677  v2.021H71.01v-2.021H39.355V2.021H63.45l11.218,17.946L74.667,69.999L74.667,69.999z M24.344,37.333h28v2.021h-28V37.333z"></path>\n' +
                                        '                                </g></svg>';

                                var price = '$' + obj[i].price.toFixed(2);

                                var link = '';
                                if (obj[i].purchase_link  != '')
                                    link = obj[i].purchase_link;

                                var ounces = '0';
                                if (obj[i].ounces != null)
                                    ounces = obj[i].ounces;

                                var itemEditUrl = editUrl.replace ('123', obj[i].id);

                                var html = '<div class="row view-pack-row">\n' +
                                    '                <div class="col-12">\n' +
                                    '                    <hr />\n' +
                                    '                </div>\n' +
                                    '\n' +
                                    '                <div class="col-12 col-md-1 text-center">\n' +
                                    '                    <div class="image-content">\n' +
                                                            image +
                                    '                    </div>\n' +
                                    '                </div>\n' +
                                    '                <div class="col-12 col-md-4">\n' +
                                    '                    <h3 class="display_name">'+obj[i].name+'</h3>\n' +
                                    '                    <p class="display_description"><a href="'+link+'" target="_blank">'+link+'</a></p>\n' +
                                    '                </div>\n' +
                                    '                <div class="col-12 col-md-2 text-left text-md-center">\n' +
                                    '                    <p><span class="display_cost">'+price+'</span> <span class="d-inline-flex d-md-none font-weight-bold">(each)</span></p>\n' +
                                    '\n' +
                                    '                </div>\n' +
                                    '                <div class="col-12 col-md-2 text-left text-md-center">\n' +
                                    '                    <p><span class="display_weight"> '+ ounces +'</span> oz. <span class="d-inline-flex d-md-none font-weight-bold">(each)</span></i></p>\n' +
                                    '                </div>\n' +
                                    '                <div class="col-12 col-md-3 text-left text-md-right">\n' +
                                    '                    <div class="btn-group" role="group">\n' +
                                    '                        <a href="'+itemEditUrl+'" class="btn btn-sm btn-primary editItemBtn">Edit</a>\n' +
                                    '                    </div>\n' +
                                    '                </div>\n' +
                                    '            </div>';

                                $('#searchResultsContent').append (html);

                            }
                        }

                    }
                });
            });



        }

    </script>
@endsection