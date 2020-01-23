<?php

namespace App\Grids\Core;

use Nayjest\Grids\GridConfig;
use Nayjest\Grids\EloquentDataProvider;
use App\Grids\Core\Header;
use App\Grids\Core\Column;
use App\Grids\Core\Footer;
use Nayjest\Grids\Grid as NayGrid;
use Nayjest\Grids\Components\TFoot;
use Nayjest\Grids\Components\THead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class Grid
{
    const OPERATOR_LIKE = 'like';
    const OPERATOR_EQ = '=';
    const OPERATOR_NOT_EQ = '<>';
    const OPERATOR_GT = '>';
    const OPERATOR_LS = '<';
    const OPERATOR_LSE = '<=';
    const OPERATOR_GTE = '>=';
    private $config;
    private $header;
    private $footer;
    private $hiddenColumns = [];
    private $sort = [];

    public function __construct($dataSource)
    {
        $this->config = new GridConfig();
        $this->setDefaultPageSize(10);
        $this->setDefaultSort(['id' => 'desc']);
        $this->setDataSource($dataSource);
        $this->header = new Header($this->config->getComponentByName(THead::NAME));
        $this->footer = new Footer($this->config->getComponentByName(TFoot::NAME));
    }

    private function setDataSource($source)
    {
        $this->config->setDataProvider(
            new EloquentDataProvider($source)
        );
        return $this;
    }

    public function setName($name)
    {
        $this->config->setName($name);
        return $this;
    }

    public function setDefaultPageSize($size)
    {
        $this->config->setPageSize($size);
        return $this;
    }

    public function setDefaultSort($sortArray)
    {
        $this->sort = $sortArray;
        return $this;
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function getFooter()
    {
        return $this->footer;
    }

    public function addColumn($name, $label = null)
    {
        $column = new Column($this, $name, $label);
        $this->config->addColumn($column->getConfig());
        return $column;
    }

    public function addHiddenColumn($name)
    {
        $this->hiddenColumns[] = $name;
        return $this;
    }

    public function render()
    {
        $this->sort();
        $nayGrid = new NayGrid($this->config);
        return $nayGrid->render();
    }

    private function sort()
    {
        $name = $this->config->getName();
        if (empty(Input::get($name)['sort'])) {
            Input::merge([
                $name => [
                    'sort' => $this->sort
                ]
            ]);
        }
    }
}
