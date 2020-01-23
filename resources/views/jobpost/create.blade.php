@extends('layouts.app')


@section('title')
    Dashboard - Client
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 my-5">            
            @include('partials.alert')
            <div class="card card-default">  
                <div class="card-header"><h3 class="h3 text-center text-info">Create a Job Post</h3></div>
                <div class="card-body">
                  <form method="POST" action="/jobs">
                  	{{ csrf_field() }}
                  	 <div class="form-group">
					    <label for="title">Title of Job Posting</label>
					    <input type="text" class="form-control" id="title" name="title" placeholder="Example: Web Developer with Ecommerce Experience">
					  </div>
					  <div class="form-group">
					    <label for="article-ckeditor">Job Description</label>
					    <textarea class="form-control" id="article-ckeditor" rows="3" name="body"></textarea>
					  </div>
					  <div class="row">
						  <div class="form-group col-md-6">
						    <label for="budget">Propose Budget</label>
						    <input type="text" class="form-control" id="budget" name="budget">
						  </div>
						  <div class="form-group col-md-6">
						    <label for="jobcategory">Job Category</label>
						    <select class="form-control" id="jobcategory" name="category_id">
						    	<option selected disabled value="0">...Select Job Category</option>
			                        @foreach ($categories as $category)
			                            <option value="{{$category->id}}">{{$category->category_name}}</option>
			                        @endforeach
						    </select>
						    </div>
					  </div>
					  <div class="row">
						  <div class="form-group col-md-6">
						    <label for="positionType">Position Type</label>
						    <select class="form-control" name="positionType" id="positionType">
						    	<option selected disabled value="0">...Select Job Category</option>
			                    <option value="part-time">Part-Time</option>
			                   	<option value="full-time">Full-Time</option>
						    </select>
						  </div>
						  <div class="form-group col-md-6">
						    <label for="project_duration">Experience</label>
						    {{ Form::select('project_duration', range(0, 100), null, array('class'=>'form-control', 'id'=>'project_duration')) }}
						  </div>
					  </div>
					  <div class="row">
						  <div class="form-group col-md-6">
						    <label for="qualification">Propose Qualification</label>
						    <input type="text" class="form-control" id="qualification" name="qualification">
						  </div>
						  <div class="form-group col-md-6">
						    <label for="sector">Propose Sector</label>
						    <input type="text" class="form-control" id="sector" name="sector">
						  </div>
					  </div>
					  <div class="row">
						  <div class="form-group col-md-6">
						    <label for="age">Propose Age</label>
						    <input type="number" class="form-control" id="age" name="age">
						  </div>
						  <div class="form-group col-md-6"></div>
					  </div>
					  <button type="submit" class="btn btn-info">Submit</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsplugins') 
  <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
  <script>
      CKEDITOR.replace( 'article-ckeditor' );
  </script>
@endsection