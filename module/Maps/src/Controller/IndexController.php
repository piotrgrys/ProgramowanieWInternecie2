<?php

namespace Maps\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Maps\Model\Mapmarker;

class IndexController extends AbstractActionController
{
    public function __construct(private Mapmarker $mapmarker)
    {
    }
    public function indexAction()
    {
        $returnArray = array();
        foreach ($this->mapmarker->pobierzWszystko() as $result) {
            $returnArray[] = $result;
        }
        return new ViewModel([
            'results' =>$this-> mapmarker->pobierzWszystko(),
        ]);
    }
}
