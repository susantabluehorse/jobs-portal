<?php
namespace App\Grids;
use App\Grids\Core\Grid;
use App\User;
class JobseekersGrid extends BaseGrid
{	
	protected function setGrid(Grid $grid)
    {
        $grid->addColumn("id")->setSearchFilter();
        $grid->addColumn("name")->setSearchFilter();
        $grid->addColumn("email")->setSearchFilter();
        $grid->addColumn("phone")->setSearchFilter();
        $grid->addColumn('status')->setCallback(function($var, $row){
            $status = $row->getSrc()->status;
            if($status === 1){
                $nameStatus = 'Active';
                $classStatus = 'btn btn-primary banUsers';
            } else {
                $nameStatus = 'Inactive';
                $classStatus = 'btn btn-danger unbanJobseeker';
            }
            return '<button type="button" data-id="'.$row->getSrc()->id.'" class="'.$classStatus.'">'.$nameStatus.'</button>';
        });
        return $grid;
    }

    protected function getQuery()
    {
        return User::where(function ($query) {
            $query->where('role', '1')->orWhere('role', '4');
        });
    }
}