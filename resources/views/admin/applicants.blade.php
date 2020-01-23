@extends('layouts.app3')
@section('title')
Manage {{$job->title}}
@endsection
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10  my-2">
        <h2 class="h2 text-info">Manage {{$job->title}}</h2>
        <div class="card card-default text-white">
          <div class="tab-content text-muted p-3">
            <div class="col-md-6">
              <h3 class="h3 text-info mb-4">{{$job->title}}</h3>
              {!! $job->body !!}
            </div>
            <div class="col-md-6 h6">
              <ul class="list-unstyled">
                <li class="mb-2"><span class="text-success"><i class="fas fa-clock"></i> Posted: </span>{{$job->created_at->diffForHumans()}}</li>
                <li class="mb-2"><span class="text-success"><i class="fas fa-clock"></i> Budget: </span>{{number_format($job->budget)}}</li>
                <li class="mb-2"><span class="text-success"><i class="fas fa-briefcase"></i> Position : </span>
                {{ucwords($job->position_type)}}</li>
                <li class="mb-2"><span class="text-success"><i class="fas fa-hourglass-end"></i> Project Duration: </span>{{ ucwords($job->project_duration) }}</li>
                <li class="mb-2"><span class="text-success"><i class="fas fa-tags"></i> Category: </span>{{ ucwords($job->category->category_name) }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
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
  <div class="modal fade" id="jobApplicantModal" tabindex="-1" role="dialog" aria-labelledby="jobApplicantModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close appliModdalClose" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('admin/jobs/send/applicant')}}" method="post" id="sendApplicant">
          {{ csrf_field() }}
          <div class="modal-body">
            <input type="hidden" name="job_id" id="modalId" value="">
            <select name="status" id="modalstatus" class="browser-default custom-select" required>
              <option value="">--Select--</option>
              <option value="approved">Approved</option>
              <option value="pending">Pending</option>
              <option value="rejected">Rejected</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary appliModdalClose" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection