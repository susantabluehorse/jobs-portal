@extends('layouts.app3')
@section('title')
Manage Categories
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
        <h2 class="h2 text-info col-md-10">Manage Categories</h2><span class="col-md-2"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">Add Category</button></span>
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
  <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('admin/categories/add')}}" method="post" id="addCategory">
          {{ csrf_field() }}
          <div class="modal-body">
            <input type="text" class="form-control" placeholder="Add Category" name="category_name" id="category_name" required="required">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection