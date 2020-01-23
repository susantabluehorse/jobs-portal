<?php

namespace App\Grids\Core;

use DateTime;
use DateTimeZone;
use App\Grids\Core;
use App\Grids\Core\Filter;
use App\Grids\Core\SearchFilter;
use App\Grids\Core\SelectFilter;
use App\Grids\Core\DateTimeRangeFilter;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\EloquentDataProvider;
use Illuminate\Support\Collection;

class Column
{
    private $config;
    private $grid;
    private $columnName;
    private $relation;
    private $filter;

    public function __construct($grid, $name, $label = null)
    {
        $this->grid = $grid;
        $this->config = new FieldConfig();
        $this->setName($name);
        if (!empty($label)) {
            $this->setLabel($label);
        }
    }

    public function getConfig()
    {
        return $this->config;
    }

    private function setName($name)
    {
        $this->columnName = $name;
        $names = explode(".", $name);
        $totalNames = count($names);
        if ($totalNames > 1) {
            $this->columnName = $names[$totalNames-1];
            $this->relation = implode(".", array_slice($names, 0, $totalNames-1));
        }
        $this->config->setName($name);
        return $this;
    }

    private function setLabel($label)
    {
        $this->config->setLabel($label);
        return $this;
    }

    public function setCallback($function)
    {
        $this->config->setCallback($function);
        return $this;
    }

    public function setLink($format, $columnNames = [], $class=null, $label = null)
    {
        $this->setCallback(function ($val, $row) use ($format, $columnNames, $label, $class) {
            $params = [];
            foreach ($columnNames as $columnName) {
                $object = $row->getSrc();
                $names = explode(".", $columnName);
                foreach ($names as $name) {
                    $object = $object->$name;
                }
                $params[] = $object;
            }
            $link = vsprintf($format, $params);

            if (empty($label)) {
                $label = $val;
            }

            return '<a class="'.$class.'" href="'.$link.'">'.$label.'</a>';
        });

        return $this;
    }

    public function setSortable()
    {
        $this->config->setSortable(true);
        return $this;
    }

    private function addFilter($config)
    {
        $this->config->addFilter($config);
        return $this;
    }

    public function setFilteringFunc($function)
    {
        $this->filter->setFilteringFunc($function);
        return $this;
    }

    public function setSearchFilter($operator = Grid::OPERATOR_LIKE)
    {
        $this->filter = new SearchFilter($this->columnName, $this->relation, $operator);
        $this->addFilter($this->filter->getConfig());
        return $this;
    }

    public function setSelectFilter($options = [], $matchColumnName = null)
    {
        $columnName = $this->columnName;
        if (!empty($matchColumnName)) {
            $columnName = $matchColumnName;
        }
        $this->filter = new SelectFilter($columnName, $this->relation, $options);
        $this->addFilter($this->filter->getConfig());
        return $this;
    }

    public function setBooleanFilter($trueValue = 'Yes', $falseVaue = 'No')
    {
        $options = array_combine([1, 0], [$trueValue, $falseVaue]);
        $this->setSelectFilter($options);
        $this->setCallback(function ($val) use ($trueValue, $falseVaue) {
            return $val == '1' ? $trueValue : $falseVaue;
        });
        return $this;
    }

    public function setExistenceFilter()
    {
        $this->setBooleanFilter();
        $relation = $this->relation;
        $columnName = $this->columnName;

        $this->filter->setFilteringFunc(function ($val, EloquentDataProvider $dp) use ($relation, $columnName) {
            $builder = $dp->getBuilder();
            if ($val == '1') {
                if (empty($relation)) {
                    $builder->whereNotNull($columnName);
                } else {
                    $builder->whereHas($relation, function ($subQuery) use ($columnName) {
                        $subQuery->whereNotNull($columnName);
                    });
                }
            } elseif ($val == '0') {
                if (empty($relation)) {
                    $builder->whereNull($columnName);
                } else {
                    $builder->whereDoesntHave($relation, function ($subQuery) use ($columnName) {
                        $subQuery->whereNotNull($columnName);
                    });
                }
            }
        });

        $this->setCallback(function ($val, $row) use ($relation, $columnName) {
            $object = $row->getSrc();
            if (!empty($relation)) {
                $relationNames = explode('.', $relation);
                foreach ($relationNames as $relationName) {
                    $object = $object->$relationName;
                }
            }

            if (is_array($object)) {
                if (!$object->isEmpty()) {
                    return 'Yes';
                }
            } elseif (!empty($object->$columnName)) {
                return 'Yes';
            }

            return 'No';
        });

        return $this;
    }

    public function setDateTimeRangeFilter()
    {
        $this->filter = new DateTimeRangeFilter($this->columnName, $this->relation, '=');
        $this->addFilter($this->filter->getConfig());
        return $this;
    }

    public function isDate($format = 'd M, Y \a\t h:i A')
    {
        $this->setCallback(function ($val) use ($format) {
            return (new DateTime($val))->format($format);
        });
        return $this;
    }
}
