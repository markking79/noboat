@extends('layouts.app')

@section('page-title') Update Account @endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Update Account</h3>
        </div>
        <div class="card-body">
            Account updated. <a href="{{route ('user.edit')}}">continue -></a>
        </div>
    </div><br />

@endsection