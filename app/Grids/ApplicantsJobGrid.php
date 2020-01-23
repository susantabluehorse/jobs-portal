<?php
namespace App\Grids;
use App\Grids\Core\Grid;
use App\Job;
use App\JobCategory;
class ApplicantsJobGrid extends BaseGrid
{	
	protected function setGrid(Grid $grid)
    {
        $grid->addColumn("id",'#')->setSearchFilter();
        $grid->addColumn("user.name",'User Name')->setSearchFilter();
        $grid->addColumn("category.category_name",'Category Name')->setSearchFilter()->setCallback(function($var, $row){
            return $row->getSrc()->category->category_name;
        });
        $grid->addColumn("title",'Name')->setSearchFilter();
        $grid->addColumn("budget",'Salary')->setSearchFilter();
        $grid->addColumn("position_type",'Position')->setSearchFilter();
        $grid->addColumn('applicants.id', 'Applicants')->setCallback(function ($val, $dp) {
            $applicants = $dp->getSrc()->applicants;
            return $applicants->sum('id');
        });
        $grid->addColumn('status')->setSelectFilter(array(1=>'Active', 0=>'Inactive'))->setCallback(function($var, $row){
            $status = $row->getSrc()->status;
            if($status === 1){
                $nameStatus = 'Active';
                $classStatus = 'btn btn-primary banJob';
            } else {
                $nameStatus = 'Inactive';
                $classStatus = 'btn btn-danger unbanJob';
            }
            return '<button type="button" data-id="'.$row->getSrc()->id.'" class="'.$classStatus.'">'.$nameStatus.'</button>';
        });
        $grid->addColumn("")->setCallback(function ($var, $row) {
            return '<a href="'.url('/admin/jobs/view', $row->getSrc()->id).'"><i class="fa fa-eye"></i></a>';
        });
        return $grid;
    }

    private function getCategoryName()
    {
        return JobCategory::where('status', '=', 1)->pluck('category_name','id')->toArray();
    }

    protected function getQuery()
    {
        return Job::with('category', 'user', 'applicants')->withCount('applicants');
    }
}