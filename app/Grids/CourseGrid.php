<?php
namespace App\Grids;
use App\Grids\Core\Grid;
use App\Course;
class CourseGrid extends BaseGrid
{	
	protected function setGrid(Grid $grid)
    {
        $grid->addColumn("id",'#')->setSearchFilter();
        $grid->addColumn("name",'Course Name')->setSearchFilter();
        $grid->addColumn('status')->setCallback(function($var, $row){
            $status = $row->getSrc()->status;
            if($status === 1){
                $nameStatus = 'Active';
                $classStatus = 'btn btn-primary banCourses';
            } else {
                $nameStatus = 'Inactive';
                $classStatus = 'btn btn-danger unbanCourses';
            }
            return '<button type="button" data-id="'.$row->getSrc()->id.'" class="'.$classStatus.'">'.$nameStatus.'</button>';
        });
        return $grid;
    }

    protected function getQuery()
    {
        return (new Course())->newQuery();
    }
}