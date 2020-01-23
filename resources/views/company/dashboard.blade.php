@extends('layouts.app')


@section('title')
    Dashboard - Company
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 my-5">            
            @include('partials.alert')
            <div class="card card-default">  
                <div class="card-header"><h3 class="h3 d-inline-block text-info">Company Dashboard</h3><span class="float-right"><a href="/jobs/create"><button class="btn btn-info">Post a Job</button></a></span></div>
                <div class="card-body pt-0 table-responsive">
                   @if(count($jobs) > 0)
                      <table class="table table-striped " id="jobTable">
                          <thead>
                            <tr>
                              <th>Job</th>
                              <th>Date Posted</th>
                              <th>Posted By</th>                  
                              <th></th>
                              <th></th>
                            </tr>
                          </thead>
                      <tbody>
                         @foreach ($jobs as $job)
                          <tr>
                            <th scope="row"><h5 class="h5"><a href="jobs/{{$job->id}}" class="text-success">{{$job->title}}</a></h5 ></th>
                            <td><small>{{$job->created_at->diffForHumans()}}</small></td>
                            <td>{{$job->user->name}}</td>
                            <td>
                              <i class="far fa-edit text-info" id="editJob" data-id="{{$job->id}}"></i>
                            </td>
                            <td>
                                <i class="far fa-trash-alt text-danger" id="deleteJob" data-id="{{$job->id}}"></i>

                                {{--<a href="{{route('job-delete',$job->id)}}"><i class="far fa-trash-alt text-danger"></i></a>--}}
                            </td>
                          </tr>
                          <!-- Delete Education Modal -->
                          <div class="modal fade" id="deleteJobs{{$job->id}}">
                              <div class="modal-dialog">
                                  <div class="modal-content">

                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                          <h4>REMOVE JOB</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                      <div class="modal-body">
                                          <h6 class="modal-title h6">Are you sure you want to delete <span class="text-info">"{{$job->title}}"</span>?</h6>
                                      </div>
                                      <!-- Modal footer -->
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-danger text-white px-5" data-dismiss="modal">No</button>
                                          <button type="button" class="btn btn-primary deleteJob px-5" data-dismiss="modal" data-id="{{$job->id}}">Yes</button>
                                      </div>

                                  </div>
                              </div>
                          </div>
                          @endforeach
                        @else
                            <p class="mt-5 text-center mb-5">You don't have any job post</p>
                        @endif
                      </tbody>
                    </table>
                    {{$jobs->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


