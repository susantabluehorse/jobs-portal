<?php


namespace App\Grids;

use App\Grids\Core\Grid;

abstract class BaseGrid
{
    protected $data = [];

    private function __construct($data = [])
    {
        $this->data = $data;
    }

    public static function get($data = [])
    {
        $gridGenerator = new static($data);
        $grid = $gridGenerator->setGrid(new Grid($gridGenerator->getQuery($data)));
        $grid->setDefaultPageSize(20);
        return $grid->render();
    }

    abstract protected function setGrid(Grid $grid);

    abstract protected function getQuery();
}
