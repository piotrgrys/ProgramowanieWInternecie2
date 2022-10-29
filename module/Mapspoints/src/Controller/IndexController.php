<?php

namespace Mapspoints\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Mapspoints\Form\MapmarkerForm;
use Mapspoints\Model\Mapmarker;

class IndexController extends AbstractActionController
{
    public function __construct(private Mapmarker $mapmarker, private MapmarkerForm $mapmarkerForm)
    {
    }
    public function indexAction()
    {
        return new ViewModel();
    }
    public function listAction()
    {
        return new ViewModel([
            'mapmarkers' => $this->mapmarker->pobierzWszystko(),
        ]);
    }
    public function addAction()
    {
        $this->mapmarkerForm->get('zapisz')->setValue('Dodaj');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->mapmarkerForm->setData($request->getPost());

            if ($this->mapmarkerForm->isValid()) {
                $this->mapmarker->add($request->getPost());

                return $this->redirect()->toRoute('maps');
            }
        }

        return new ViewModel(['tytul' => 'Dodawanie punktu na mapie', 'form' => $this->mapmarkerForm]);
    }
}
