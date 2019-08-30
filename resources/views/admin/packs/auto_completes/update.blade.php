@extends('layouts.app')

@section('page-title') Edit Auto Complete @endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Edit Pack Auto Complete</h3>
        </div>
        <div class="card-body">
            <div class="form-group row">
                Pack auto complete saved.  <a href="{{route ('admin.pack_auto_completes.index')}}">continue -></a>
            </div>
        </div>
    </div><br />

@endsection