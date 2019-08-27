@extends('layouts.app')

@section('page-title') Admin Pack Auto Completes @endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Create Pack Auto Complete</h3>
        </div>
        <div class="card-body">
            <div class="form-group row">
                Pack auto complete saved.  <a href="{{route ('admin.pack_auto_completes.index')}}">continue -></a>
            </div>
        </div>
    </div><br />

@endsection