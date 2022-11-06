<?php

namespace SoapClient\Controller;

use Laminas\Form\Annotation\AttributeBuilder;
use Laminas\Form\Element\Submit;
use Laminas\Mvc\Controller\AbstractActionController;
use SoapClient\Model\Movie;
use SoapClient\Soap\Client;

class IndexController extends AbstractActionController
{
    private $movies;
    /**
     * @param Client $client
     */
    public function __construct(public Client $client)
    {
    }

    public function indexAction()
    {
        $this->movies=$this->client->fetchMovies();
        return ['movies' => $this->movies];
    }

    public function addAction()
    {
        $builder = new AttributeBuilder();
        $form = $builder->createForm(Movie::class);
        $form->add(new Submit('save', ['label' => 'Zapisz']));

        if ($this->getRequest()->isPost()) {
            $form->setData($this->params()->fromPost());

            if ($form->isValid()) {
                try {
                    $this->client->add($form->getData());
                    $this->flashMessenger()->addSuccessMessage('Rekord został dodany');
                } catch (\SoapFault $e) {
                    $this->flashMessenger()->addErrorMessage($e->getMessage());
                }
            }

            return $this->redirect()->toRoute('soap-client', ['action' => 'add']);
        }

        return ['form' => $form];
    }
    public function usunAction()
    {
        $id = (int)$this->params()->fromQuery('id');
        $this->client->delete( $id);
        return $this->redirect()->toRoute('soap-client');
    }

    public function edytujAction()
    {
        $id = (int)$this->params()->fromQuery('id');
        if (empty($id)) {
            $this->redirect()->toRoute('soap-client');
        }
        $builder = new AttributeBuilder();
        $form = $builder->createForm(Movie::class);

        $form->add(new Submit('save', ['label' => 'Zapisz']));

        if ($this->getRequest()->isGet()) {
             $this->movies=$this->client->fetchMovies();
             $form->id=$id;
             $movies=$this->client->fetchMovies();
             $movie=array_column($movies, null, 'id')[$id];
             $form->setData($movie);

        }
        if ($this->getRequest()->isPost()) {
            $form->setData($this->params()->fromPost());

            if ($form->isValid()) {
                try {
                    $this->client->edit($id,$form->getData());
                    $this->flashMessenger()->addSuccessMessage('Rekord został zaktualizowany');
                } catch (\SoapFault $e) {
                    $this->flashMessenger()->addErrorMessage($e->getMessage());
                }
            }

            return $this->redirect()->toRoute('soap-client', ['action' => 'add']);
        }

        return ['form' => $form];
    }
}