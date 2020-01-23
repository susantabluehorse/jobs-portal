<?php

namespace App\Grids\Core;

use Nayjest\Grids\Components\THead;
use App\Grids\Core\Component;

class Header extends Component
{
    public function __construct($config = null)
    {
        if (empty($config)) {
            $config = new THead();
        }
        parent::__construct($config);
        $this->setDefaultComponents();
    }

    private function setDefaultComponents()
    {
        $headerTag = $this->createHtmlTag()->addClass("flex gutter-between");
        $leftTag = $this->createHtmlTag()
            ->addRecordsPerPage([10, 20, 50, 100, 200])
            ->addShowingRecords();

        $rightTag = $this->createHtmlTag()
            ->addResetButton()
            ->addExcelExport('excel-data-'.date('d-m-Y-h-i-s'))
            ->addCsvExport('csv-data-'.date('d-m-Y-h-i-s'));
            // ->addColumnsHider();

        $headerTag->getConfig()->addComponent($leftTag->getConfig());
        $headerTag->getConfig()->addComponent($rightTag->getConfig());

        $this->config->addComponent($headerTag->getConfig());
    }
}
