@extends('layouts.app3')
@section('title')
Manage Jobs
@endsection
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      @if(count($errors)>0)
        <div class="alert alert-danger w-50 mx-auto mt-3 text-center">
          <ul>
            @foreach($errors->all() as $error)
              <li style="list-style: none;">{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="col-md-10  my-5">
        <h2 class="h2 text-info">Manage Jobs</h2>
        <div class="card card-default text-white">
          <div class="tab-content text-muted p-3">
              <div class="tab-pane active" id="admin-tabs-1" role="tabpanel">
                @include('admin.grid')
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection