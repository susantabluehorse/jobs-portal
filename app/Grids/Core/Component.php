<?php

namespace App\Grids\Core;

use Nayjest\Grids\Components\HtmlTag as NayTag;
use Nayjest\Grids\Components\CsvExport;
use Nayjest\Grids\Components\ExcelExport;
use Nayjest\Grids\Components\ColumnsHider;
use Nayjest\Grids\Components\RecordsPerPage;
use Nayjest\Grids\Components\ShowingRecords;
use App\Grids\Core\HtmlTag;

class Component
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function createHtmlTag()
    {
        $htmlTag = new HtmlTag();
        return $htmlTag;
    }

    public function addExcelExport($fileName)
    {
        $excelExport = (new ExcelExport())->setFileName($fileName);
        $this->config->addComponent($excelExport);
        return $this;
    }

    public function addCsvExport($fileName)
    {
        $excelExport = (new CsvExport())->setFileName($fileName);
        $this->config->addComponent($excelExport);
        return $this;
    }

    public function addColumnsHider()
    {
        $columnsHider = new ColumnsHider;
        $this->config->addComponent($columnsHider);
        return $this;
    }

    public function addRecordsPerPage($variants = [])
    {
        $recordsPerPage = new RecordsPerPage;
        if ($variants) {
            $recordsPerPage->setVariants($variants);
        }
        $this->config->addComponent($recordsPerPage);
        return $this;
    }

    public function addShowingRecords()
    {
        $showingRecords = new ShowingRecords;
        $this->config->addComponent($showingRecords);
        return $this;
    }

    public function addResetButton()
    {
        $resetButton = (new NayTag())
            ->setContent('<i class="fa fa-refresh" aria-hidden="true"></i> Reset')
            ->setTagName('button')
            ->setAttributes([
                'type' => 'button',
                'class' => 'btn btn-success btn-sm grid-reset',
            ]);
        $this->config->addComponent($resetButton);
        return $this;
    }
}
