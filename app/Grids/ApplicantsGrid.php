<?php
namespace App\Grids;
use App\Grids\Core\Grid;
use App\Applicant;
class ApplicantsGrid extends BaseGrid
{	
	protected function setGrid(Grid $grid)
    {
        $grid->addColumn("id",'#')->setSearchFilter();
        $grid->addColumn("user.name",'User Name')->setSearchFilter();
        $grid->addColumn("application_letter",'Application Letter')->setSearchFilter();
        $grid->addColumn('status')->setCallback(function($var, $row){
            $status = $row->getSrc()->status;
            if($status === 'hired'){
                $classStatus = 'btn btn-primary jobApplicant';
            } else if($status === 'pending'){
                $classStatus = 'btn btn-secondary jobApplicant';
            } else {
                $classStatus = 'btn btn-danger jobApplicant';
            }
            return '<button type="button" data-id="'.$row->getSrc()->id.'" class="'.$classStatus.'" data-toggle="modal" data-target="#jobApplicantModal">'.ucwords($status).'</button>';
        });
        return $grid;
    }

    protected function getQuery()
    {
        $job_id = session('job_id');
        return Applicant::with('user')->where('job_id',$job_id);
    }
}