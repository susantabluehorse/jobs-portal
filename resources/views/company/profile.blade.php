@extends('layouts.app')


@section('title')
    Profile - {{$user->name}}
@endsection

@section('select2css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 my-5">
                @include('partials.alert')
                <div class="row mb-3">
                    <div class="col-md-2 text-center">
                        @if(!empty($profile->photo))
                            <img class="p-0 profilepicture rounded-circle" src="{{ \App\Http\Controllers\ExtraController::photoURL($profile->photo) }}"   data-toggle="modal" data-target="#uploadphoto{{$user->id}}">
                        @else
                            <i class="fas fa-user-circle fa-10x text-muted"  data-toggle="modal" data-target="#uploadphoto{{$user->id}}"></i>
                        @endif
                        {{-- Upload Photo --}}
                        <div class="modal fade" id="uploadphoto{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <form action="{{route('company-profile.photo')}}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="modal-header">
                                            <h5 class="modal-title text-info" id="exampleModalLabel">Upload Photo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body editworksbody">
                                            <div class="form-group">
                                                <input type="file" class="form-control-file text-center"  name="photo" aria-describedby="fileHelp">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{--UPLOAD PROFILE DETAILS--}}
                            <div class="modal fade" id="addprofile{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <form action="{{route('company-profile.edit')}}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="modal-header">
                                                <h5 class="modal-title text-info" id="exampleModalLabel">Upload Photo</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body editworksbody">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-briefcase"></i>&nbsp;Company Name</span>
                                                    </div>
                                                    <input type="text" id="editCompanyName" class="form-control" name="name" value="{{$profile !== null ? $profile->name : ''}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i>&nbsp;Company Location</span>
                                                    </div>
                                                    <input type="text" id="editCompanyName" class="form-control" name="location" value="{{$profile !== null ? $profile->location : ''}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user-circle"></i>&nbsp;Contact Person Name</span>
                                                    </div>
                                                    <input type="text" id="editCompanyName" class="form-control" name="contact_person" value="{{$profile !== null ? $profile->contact_person : ''}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user-circle"></i>&nbsp;Contact Person E-mail</span>
                                                    </div>
                                                    <input type="text" id="editContactEmail" class="form-control" name="contact_email" value="{{$profile !== null ? $profile->contact_email : ''}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user-circle"></i>&nbsp;Contact Person Phone</span>
                                                    </div>
                                                    <input type="text" id="editCompanyPhone" class="form-control" name="contact_phone" value="{{$profile !== null ? $profile->contact_phone : ''}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user-circle"></i>&nbsp;HR Name</span>
                                                    </div>
                                                    <input type="text" id="editHRName" class="form-control" name="hr_name" value="{{$profile !== null ? $profile->hr_name : ''}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user-circle"></i>&nbsp;HR E-mail</span>
                                                    </div>
                                                    <input type="text" id="editHREmail" class="form-control" name="hr_email" value="{{$profile !== null ? $profile->hr_email : ''}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user-circle"></i>&nbsp;HR Phone</span>
                                                    </div>
                                                    <input type="text" id="editHRPhone" class="form-control" name="hr_phone" value="{{$profile !== null ? $profile->hr_phone : ''}}">
                                                </div>
                                                <div class="form-group">
                                                    <span class="input-group-text"><i class="fas fa-briefcase"></i>&nbsp;Company Details</span>
                                                    <textarea class="form-control" id="editCompanyDescription"  name="description" rows="3">{{$profile !== null ? $profile->description : ''}}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="col-md-10 pl-5">
                        <h3 class="h3 text-info d-inline-block">{{$user->name}}</h3>
                        @if ($profile !== null)
                            <button class="btn btn-default float-right" data-toggle="modal" data-target="#addprofile{{$user->id}}"><i class="far fa-edit text-success"></i> <span class="text-success h6">Edit</span></button>
                        @else
                            <button class="btn btn-default float-right" data-toggle="modal" data-target="#addprofile{{$user->id}}"><i class="far fa-edit text-success"></i> <span class="text-success h6">Edit</span></button>
                        @endif
                        <h5 class="h5">
                            @if ($profile !== null)
                                {{$profile->name}}
                            @endif
                        </h5>
                        <small class="h6 text-muted"><i class="fas fa-map-marker-alt"></i>
                            @if ($profile !== null)
                                {{$profile->location}}
                            @endif</small>
                    </div>
                </div>
                {{-- Edit Profile --}}
                @if ($profile !== null)
                    <div class="modal fade" id="editprofile1{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                @else
                    <div class="modal fade" id="addprofile1{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                @endif
                    </div>
                            <div class="card mb-0">
                                <div class="card-header">
                                    <a class="card-title">
                                        <h5 class="d-inline-block h5 text-success font-weight-bold mb-0">About Company</h5>
                                    </a>
                                </div>
                                <div class="card-body" id="educationBackgroundBody">
                                    <div>
                                        <p>{!! $profile !== null ? nl2br(e($profile->description)) : '' !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <div class="card-header">
                                    <a class="card-title">
                                        <h5 class="d-inline-block h5 text-success font-weight-bold mb-0">Your Company Details</h5>
                                    </a>
                                </div>
                                <div class="card-body" id="educationBackgroundBody">
                                        <div>
                                            <h5 class="h5 text-info">Company Name : {{$profile->name}}</h5>
                                            <h6 class="h6 text-black">Contact Person Name : {{$profile->contact_person}}</h6>
                                            <h6 class="h6 text-black">Contact Person E-mail : {{$profile->contact_email}}</h6>
                                            <h6 class="h6 text-black">Contact Person Phone : {{$profile->contact_phone}}</h6>
                                            <h6 class="h6 text-black">HR Name : {{$profile->hr_person}}</h6>
                                            <h6 class="h6 text-black">HR E-mail : {{$profile->hr_email}}</h6>
                                            <h6 class="h6 text-black">HR Phone : {{$profile->hr_phone}}</h6>
                                            <small class="h6 mb-2 text-muted">Location : {{$profile->location}}</small>
                                            <hr>
                                        </div>
                                </div>
                            </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
@section('jsplugins')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.select2').select2({
                width: 'resolve',
                placeholder: "Please select Skills",
                allowClear: true
            });
            $('.selectedskills').select2().val({!! json_encode($user->skills()->allRelatedIds()) !!}).trigger('change');
        });
    </script>
@endsection