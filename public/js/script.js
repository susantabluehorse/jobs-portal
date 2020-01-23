$(document).ready(function(){

	// unable to pick multiple checkbox to category
   $('input.catFilter').on('change', function() {
    $('input.catFilter').not(this).prop('checked', false);  
	});

   //Delete job posting in Client dashboard
    $(document).on('click', '#deleteJob', function(){
        var id = $(this).data('id');
        var jobPosting = $(this).parents("tr");
        $('.loading').show();
            $.ajax({ 
                type: 'DELETE',
                url: '/jobs/' + id,
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {

                },
                success: function(data) {
                	/*console.log(data);*/
                   jobPosting.fadeOut(350);
                   toastr.success(' ', 'Job Posting Deleted', {timeOut: 3000, positionClass: 'toast-top-center'});
                   $('.loading').hide();
                }
            });
        });

	// Delete JOB JYOTIRMOY COAD
	$(document).on('click', '.deleteJob', function(){
		id = $(this).data('id');
		$('.loading').show();
		$.ajax({
			type: 'post',
			url: '/jobs/delete',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				id: id
			},success: function(data) {
				$('#jobTable').load(' #jobTable > div');
				toastr.success(' ', 'Deleted', {timeOut: 3000, positionClass: 'toast-top-center'});
				$('.loading').hide();
			}
		});
	});
	//Edit job posting in Client dashboard
	 $(document).on('click', '#editJob', function(){
        var id = $(this).data('id');
        $('.loading').show();
            $.ajax({ 
                type: 'get',
                url: '/jobs/' + id + '/edit',
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                  window.location.href = '/jobs/'+ id + '/edit';
                  $('.loading').hide();
                }
            });
        });



   // Add new Educational background
   $(document).on('click', '#addNewEducation', function(event){ 
    event.preventDefault();
   	var course = $(this).parent().siblings().find('#addCourse');
   	var school = $(this).parent().siblings().find('#addSchool');
   	var year = $(this).parent().siblings().find('#addSchoolYear');
   	var achievement = $(this).parent().siblings().find('#addAchievement');
    $('.loading').show();
	    $.ajax({ 
	        type: 'post',
	        url: '/profile/education/store',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	          course:course.val(),
	          school:school.val(),
	          year:year.val(),
	          achievement:achievement.val()
	        },success: function(data) {     
	        	course.val("");
	        	school.val("");
	        	year.val("");
	        	achievement.val("");
	            $('#educationBackgroundBody').load(' #educationBackgroundBody > div');
	            toastr.success(' ', 'Education Background Added', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
	});

   // Edit Educational Background
   $(document).on('click', '.editEducation', function(){ 
   	id = $(this).data('id');
   	var course = $(this).parent().siblings().find('#editCourse').val();
   	var school = $(this).parent().siblings().find('#editSchool').val();
   	var year = $(this).parent().siblings().find('#editSchoolYear').val();
   	var achievement = $(this).parent().siblings().find('#editAchievement').val();
    $('.loading').show();
   		 $.ajax({ 
	        type: 'post',
	        url: '/profile/education/update',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	       	  id: id,
	          course:course,
	          school:school,
	          year:year,
	          achievement:achievement
	        },success: function(data) {    
	            $('#educationBackgroundBody').load(' #educationBackgroundBody > div');
	            toastr.success(' ', 'Education Background Updated', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
   });



   // Delete Educational Background
   $(document).on('click', '.deleteEducation', function(){ 
   	id = $(this).data('id');
    $('.loading').show();
   		$.ajax({ 
	        type: 'post',
	        url: '/profile/education/delete',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	       	  id: id
	        },success: function(data) {  
	            $('#educationBackgroundBody').load(' #educationBackgroundBody > div');
	            toastr.success(' ', 'Deleted', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
  }); 	

// Add New Project
$(document).on('click', '.addProjectButton', function(){ 
	var name = $(this).parent().siblings().find('#addProject');
	var role = $(this).parent().siblings().find('#addProjectRole');
	var company_name = $(this).parent().siblings().find('#addProjectCompany');
	var duration = $(this).parent().siblings().find('#addProjectDuration');
	var description = $(this).parent().siblings().find('#addProjectDescription');
 $('.loading').show();
	 $.ajax({ 
		 type: 'post',
		 url: '/profile/project/store',
		 headers: {
		   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		 },
		 data: {
			name: name.val(),
			role: role.val(),
			company_name: company_name.val(),
			duration: duration.val(),
		   description: description.val()
		 },success: function(data) {     
			name.val("");
			role.val("");
			company_name.val("");
			duration.val("");
			 description.val("");
			 $('.ProjectBodyBaground').load(' .ProjectBodyBaground > div');
			 toastr.success(' ', 'New Project Added', {timeOut: 3000, positionClass: 'toast-top-center'});
			 $('.loading').hide();
		 }
	 });
 });
// edit project
   $(document).on('click', '.editProject', function(){ 
	var id = $(this).data('id');
	var name = $(this).parent().siblings().find('#editProjectName').val();
	var role = $(this).parent().siblings().find('#editProjectRole').val();
	var company_name = $(this).parent().siblings().find('#editProjectCompanyName').val();
	var duration = $(this).parent().siblings().find('#editProjectDuration').val();
	var description = $(this).parent().siblings().find('#editProjectDescription').val();
 $('.loading').show();
		 $.ajax({ 
		 type: 'post',
		 url: '/profile/project/update',
		 headers: {
		   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		 },
		 data: {
			  id: id,
			  name:name,
			  role:role,
			  company_name:company_name,
			  duration:duration,
		   description:description
		 },success: function(data) {    
			 $('.ProjectBodyBaground').load(' .ProjectBodyBaground > div');
			 toastr.success(' ', 'Project Updated', {timeOut: 3000, positionClass: 'toast-top-center'});
			 $('.loading').hide();
		 }
	 });
});
   // Delete Project Background
   $(document).on('click', '.deleteProject', function(){ 
	var id = $(this).data('id');
				$.ajax({ 
				 type: 'post',
				 url: '/profile/project/delete',
				 headers: {
				   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				 },
				 data: {
					  id: id
				 },success: function(data) {  
					 $('.ProjectBodyBaground').load(' .ProjectBodyBaground > div');
					 toastr.success(' ', 'Deleted', {timeOut: 3000, positionClass: 'toast-top-center'});
					 $('.loading').hide();
				 }
			 });
});

	// Add new Educational background
   $(document).on('click', '.addNewWorkButton', function(){ 
   	var position = $(this).parent().siblings().find('#addPosition');
   	var company = $(this).parent().siblings().find('#addCompany');
   	var year = $(this).parent().siblings().find('#addWorkYear');
   	var description = $(this).parent().siblings().find('#addWorkDescription');
    $('.loading').show();
	    $.ajax({ 
	        type: 'post',
	        url: '/profile/work/store',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	          position: position.val(),
	          company: company.val(),
	          year: year.val(),
	          description: description.val()
	        },success: function(data) {     
	        	position.val("");
	        	company.val("");
	        	year.val("");
	        	description.val("");
	            $('.workBackgroundBody').load(' .workBackgroundBody > div');
	            toastr.success(' ', 'New Work Added', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
	});


    // Edit Work Background
   $(document).on('click', '.editWorkBackground', function(){ 
   	var id = $(this).data('id');
   	var position = $(this).parent().siblings().find('#editPosition').val();
   	var company = $(this).parent().siblings().find('#editCompany').val();
   	var workyear = $(this).parent().siblings().find('#editWorkYear').val();
   	var description = $(this).parent().siblings().find('#editWorkDescription').val();
    $('.loading').show();
   		 $.ajax({ 
	        type: 'post',
	        url: '/profile/work/update',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	       	  id: id,
	          position:position,
	          company:company,
	          workyear:workyear,
	          description:description
	        },success: function(data) {    
	            $('.workBackgroundBody').load(' .workBackgroundBody > div');
	            toastr.success(' ', 'Education Background Updated', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
   	});

   	// Delete Work Background
   	$(document).on('click', '.deleteWork', function(){ 
   		var id = $(this).data('id');
		$.ajax({ 
			type: 'post',
			url: '/profile/work/delete',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				id: id
			},success: function(data) {  
				$('.workBackgroundBody').load(' .workBackgroundBody > div');
				toastr.success(' ', 'Deleted', {timeOut: 3000, positionClass: 'toast-top-center'});
				$('.loading').hide();
			}
		});
  	}); 

	// applicant modal Background
	$(document).on('click', '.jobApplicant', function(){ 
		var id = $(this).data('id');
		$('#modalId').val(id);
	});
	$(document).on('click', '.appliModdalClose', function(){ 
		$('#modalId').val('');
	}); 
	$("#sendApplicant").submit(function(e) {
		e.preventDefault();
		var id = $('#modalId').val();
		var status = $('#modalstatus').val();
		$('.loading').show();
		$.ajax({ 
			type: 'post',
			url: '/admin/jobs/send/applicant',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				id: id,
				status:status
			},success: function(data) {  
				$('#jobApplicantModal').modal('hide');
				location.reload();
				toastr.success(' ', 'Update Applicant Status', {timeOut: 3000, positionClass: 'toast-top-center'});
				$('.loading').hide();
			}
		});
	});
	$("#addCategory").submit(function(e) {
		e.preventDefault();
		var category_name = $('#category_name').val();
		$('.loading').show();
		$.ajax({ 
			type: 'post',
			url: '/admin/categories/add',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				category_name: category_name
			},success: function(data) {
				var res = $.parseJSON(data);
				if(res.status==1){
					$('#addCategoryModal').modal('hide');
					location.reload();
					toastr.success(' ', res.msg, {timeOut: 3000, positionClass: 'toast-top-center'});
					$('.loading').hide();
				} else {
					toastr.success(' ', res.msg, {timeOut: 3000, positionClass: 'toast-top-center'});
					$('.loading').hide();
				}
			}
		});
	});
	$(document).on('click', '.banCategory', function(){ 
    	var id = $(this).data('id');
    	$('.loading').show();
    		$.ajax({ 
	        type: 'post',
	        url: '/admin/categories/ban',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	       	  id: id
	        },success: function(data) {  
	            location.reload();
	            toastr.success(' ', 'Category Inactive', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
    });	
    $(document).on('click', '.unbanCategory', function(){ 
    	var id = $(this).data('id');
    	$('.loading').show();
    		$.ajax({ 
	        type: 'post',
	        url: '/admin/categories/unban',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	       	  id: id
	        },success: function(data) {  
	            location.reload();
	            toastr.success(' ', 'Category Active', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
    });
	$("#addSkills").submit(function(e) {
		e.preventDefault();
		var skill = $('#skill').val();
		$('.loading').show();
		$.ajax({ 
			type: 'post',
			url: '/admin/skills/add',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				skill: skill
			},success: function(data) {
				var res = $.parseJSON(data);
				if(res.status==1){
					$('#addSkillsModal').modal('hide');
					location.reload();
					toastr.success(' ', res.msg, {timeOut: 3000, positionClass: 'toast-top-center'});
					$('.loading').hide();
				} else {
					toastr.success(' ', res.msg, {timeOut: 3000, positionClass: 'toast-top-center'});
					$('.loading').hide();
				}
			}
		});
	});
	$(document).on('click', '.banSkills', function(){ 
    	var id = $(this).data('id');
    	$('.loading').show();
    		$.ajax({ 
	        type: 'post',
	        url: '/admin/skills/ban',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	       	  id: id
	        },success: function(data) {  
	            location.reload();
	            toastr.success(' ', 'Skill Inactive', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
    });	
    $(document).on('click', '.unbanSkills', function(){ 
    	var id = $(this).data('id');
    	$('.loading').show();
    		$.ajax({ 
	        type: 'post',
	        url: '/admin/skills/unban',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	       	  id: id
	        },success: function(data) {  
	            location.reload();
	            toastr.success(' ', 'Skill Active', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
    });
    $("#addCourses").submit(function(e) {
		e.preventDefault();
		var name = $('#name').val();
		$('.loading').show();
		$.ajax({ 
			type: 'post',
			url: '/admin/courses/add',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				name: name
			},success: function(data) {
				var res = $.parseJSON(data);
				if(res.status==1){
					$('#addCoursesModal').modal('hide');
					location.reload();
					toastr.success(' ', res.msg, {timeOut: 3000, positionClass: 'toast-top-center'});
					$('.loading').hide();
				} else {
					toastr.success(' ', res.msg, {timeOut: 3000, positionClass: 'toast-top-center'});
					$('.loading').hide();
				}
			}
		});
	});
	$(document).on('click', '.banCourses', function(){ 
    	var id = $(this).data('id');
    	$('.loading').show();
    		$.ajax({ 
	        type: 'post',
	        url: '/admin/courses/ban',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	       	  id: id
	        },success: function(data) {  
	            location.reload();
	            toastr.success(' ', 'Course Inactive', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
    });	
    $(document).on('click', '.unbanCourses', function(){ 
    	var id = $(this).data('id');
    	$('.loading').show();
    		$.ajax({ 
	        type: 'post',
	        url: '/admin/courses/unban',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	       	  id: id
	        },success: function(data) {  
	            location.reload();
	            toastr.success(' ', 'Course Active', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
    });
   // Add Profile information
   $(document).on('click', '.addProfileButton', function(){ 
	   	var title = $(this).parent().siblings().find('#editJobTitle').val();
	   	var city = $(this).parent().siblings().find('#editCity').val();
	   	var province = $(this).parent().siblings().find('#editProvince').val();
	   	var country = $(this).parent().siblings().find('#editCountry').val();
	   	var overview = $(this).parent().siblings().find('#editOverview').val();
	    $('.loading').show();   
	   		 $.ajax({ 
		        type: 'post',
		        url: '/profile/store',
		        headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
		        data: {
		          title:title,
		          city:city,
		          province:province,
		          country:country,
		          overview:overview
		        },success: function(data) {    
			    location.reload();
	            toastr.success(' ', 'Profile Successfully Updated', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
   });

	// Edit Company Profile information
	$(document).on('click', '.editCompanyProfileButton', function(){
		var id = $(this).data('id');
		var name = $(this).parent().siblings().find('#editCompanyName').val();
		var location = $(this).parent().siblings().find('#editCompanyLocation').val();
		var contact_person = $(this).parent().siblings().find('#editContactPerson').val();
		var description = $(this).parent().siblings().find('#editCompanyDescription').val();
		$('.loading').show();
		$.ajax({
			type: 'post',
			url: '/company-profile/edit',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				id: id,
				name:name,
				location:location,
				contact_person:contact_person,
				description:description,
			},success: function(data) {
				location.reload();
				toastr.success(' ', 'Profile Successfully Updated', {timeOut: 3000, positionClass: 'toast-top-center'});
				$('.loading').hide();
			}
		});
	});

   // Edit Profile information
   $(document).on('click', '.editProfileButton', function(){ 
	   	var id = $(this).data('id');
	   	var title = $(this).parent().siblings().find('#editJobTitle').val();
	   	var city = $(this).parent().siblings().find('#editCity').val();
	   	var province = $(this).parent().siblings().find('#editProvince').val();
	   	var country = $(this).parent().siblings().find('#editCountry').val();
	   	var overview = $(this).parent().siblings().find('#editOverview').val();
	    $('.loading').show();   
	   		 $.ajax({ 
		        type: 'post',
		        url: '/profile/edit',
		        headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
		        data: {
		       	  id: id,
		          title:title,
		          city:city,
		          province:province,
		          country:country,
		          overview:overview
		        },success: function(data) {    
			    location.reload();
	            toastr.success(' ', 'Profile Successfully Updated', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
   });

   //Ban Users
    $(document).on('click', '.banUsers', function(){ 
    	var id = $(this).data('id');
    	$('.loading').show();
    		$.ajax({ 
	        type: 'post',
	        url: '/admin/users/ban',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	       	  id: id
	        },success: function(data) {  
	            location.reload();
	            toastr.success(' ', 'User Inactive', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
    });	

    //Unban Freelancers
    $(document).on('click', '.unbanJobseeker', function(){ 
    	var id = $(this).data('id');
    	$('.loading').show();
    		$.ajax({ 
	        type: 'post',
	        url: '/admin/jobseeker/unban',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	       	  id: id
	        },success: function(data) {  
	            location.reload();
	            toastr.success(' ', 'User Active', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
    });	

     //Unban Clients
    $(document).on('click', '.unbanCompany', function(){ 
    	var id = $(this).data('id');
    	$('.loading').show();
    		$.ajax({ 
	        type: 'post',
	        url: '/admin/company/unban',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	       	  id: id
	        },success: function(data) {  
	            location.reload();
	            toastr.success(' ', 'Company Active', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
    });


    $(document).on('click', '.banJob', function(){ 
    	var id = $(this).data('id');
    	$('.loading').show();
    		$.ajax({ 
	        type: 'post',
	        url: '/admin/jobs/ban',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	       	  id: id
	        },success: function(data) {
	            location.reload();
	            toastr.success(' ', 'Job Inactive', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
    });
    $(document).on('click', '.unbanJob', function(){ 
    	var id = $(this).data('id');
    	$('.loading').show();
    		$.ajax({ 
	        type: 'post',
	        url: '/admin/jobs/unban',
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        data: {
	       	  id: id
	        },success: function(data) { 
	            location.reload();
	            toastr.success(' ', 'Job Active', {timeOut: 3000, positionClass: 'toast-top-center'});
	            $('.loading').hide();
	        }
	    });
    });

    //Delete job posting in Admin Panel
    $(document).on('click', '.deleteJobPosting', function(){
        var id = $(this).data('id');
        console.log(id);
        $('.loading').show();
            $.ajax({ 
                type: 'get',
                url: '/admin/jobs/delete/'+id,
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                  _method: 'DELETE',
                },
                success: function(data) {
                   location.reload();
                   toastr.success(' ', 'Job Posting Deleted', {timeOut: 3000, positionClass: 'toast-top-center'});
                   $('.loading').hide();
                }
            });
        });


  


});//document.ready