@extends('layouts.app3')
@section('title')
Manage Skills
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
        <h2 class="h2 text-info col-md-9">Manage Skills</h2><span class="col-md-3"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSkillsModal">Add Skill</button></span>
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
  <div class="modal fade" id="addSkillsModal" tabindex="-1" role="dialog" aria-labelledby="addSkillsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Skill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('admin/skills/add')}}" method="post" id="addSkills">
          {{ csrf_field() }}
          <div class="modal-body">
            <input type="text" class="form-control" placeholder="Add Skill" name="skill" id="skill" required="required">
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