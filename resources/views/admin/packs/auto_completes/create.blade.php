@extends('layouts.app')

@section('page-title') Create Auto Complete @endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Create Pack Auto Complete</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pack_auto_completes.store') }}">
                @csrf


                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" name="name" value="{{ old('name', $item->name) }}" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group row d-none">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                    <div class="col-md-6">
                        <textarea id="description" name="description" class="form-control" rows="10">{{ old('description', $item->description ) }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Image</label>

                    <div class="col-md-6">
                        <div class="upload-btn-wrapper">
                            <button class="btn btn-primary btn-sm">Upload</button>
                            <input id="addItemUploadImageBtn" type="file" name="image" />
                        </div>
                        <div id="uploadAddItemImageProgressBar" class="progress" style="display: none;margin-top: 10px;">
                            <div class="progress-bar progress-bar-animated progress-bar-striped bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="image-content @if (!$item->image_url) d-none @endif ">
                            <input type="hidden" id="image_file" name="image_file" value="{{$item->image}}" />
                            <img src="{{Storage::url ($item->image_url)}}" style="max-width: 100%;" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                    <div class="col-md-6">
                        <input id="name" type="number" name="price" step="any" value="{{ old('price', $item->cost_each ) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="weight" class="col-md-4 col-form-label text-md-right">Weight (in ounces)</label>

                    <div class="col-md-6">
                        <input id="weight" type="number" step="any" name="weight" value="{{ old('weight', $item->ounces_each ) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="link" class="col-md-4 col-form-label text-md-right">Affiliate Link</label>

                    <div class="col-md-6">
                        <input id="link" type="text" name="link" value="{{ old('link' ) }}" class="form-control" placeholder="http://www...">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div><br />

@endsection

@section('script')

    <script>
        var xhr = false;

        window.onload = function () {

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});


            $('#addItemUploadImageBtn').fileupload({
                url: '{{route ('api.public.image.store')}}',
                dataType: 'json',
                add: function (e, data) {
                    var acceptFileTypes = /^image\/(gif|jpe?g|png)$/i;
                    if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                        alert('File type not supported');
                        return;
                    }
                    data.submit();
                },
                done: function (e, data) {

                    let image = data.result.image;

                    $('#uploadAddItemImageProgressBar').hide ();
                    $(this).parent ().parent ().parent ().find ('.image-content img').attr ('src', image.url);
                    $(this).parent ().parent ().parent ().find ('.image-content').removeClass ('d-none');

                    $('#image_file').val (image.asset_name);
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#uploadAddItemImageProgressBar').show ();
                    $('#uploadAddItemImageProgressBar .progress-bar').css ('width', progress+'%');
                }
            });

        }


    </script>

@endsection