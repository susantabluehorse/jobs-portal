<?php
namespace App\Grids;
use App\Grids\Core\Grid;
use App\Skill;
class SkillsGrid extends BaseGrid
{	
	protected function setGrid(Grid $grid)
    {
        $grid->addColumn("id",'#')->setSearchFilter();
        $grid->addColumn("skill",'Skill Name')->setSearchFilter();
        $grid->addColumn('status')->setCallback(function($var, $row){
            $status = $row->getSrc()->status;
            if($status === 1){
                $nameStatus = 'Active';
                $classStatus = 'btn btn-primary banSkills';
            } else {
                $nameStatus = 'Inactive';
                $classStatus = 'btn btn-danger unbanSkills';
            }
            return '<button type="button" data-id="'.$row->getSrc()->id.'" class="'.$classStatus.'">'.$nameStatus.'</button>';
        });
        return $grid;
    }

    protected function getQuery()
    {
        return (new Skill())->newQuery();
    }
}