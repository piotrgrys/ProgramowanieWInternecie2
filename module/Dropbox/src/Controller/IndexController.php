<?php

namespace Dropbox\Controller;

use Dropbox\Service\Dropbox;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Dropbox\Form\FileForm;

class IndexController extends AbstractActionController
{
    public function __construct(public Dropbox $dropbox, private FileForm $fileForm)
    {
    }

    public function indexAction()
    {
        if (!$this->dropbox->isAuthorized()) {
            return $this->redirect()->toRoute('dropbox/default', ['action' => 'authorize']);
        }

        $path = $this->params()->fromQuery('path', '');
        $files = $this->dropbox->getFileList($path);

        return ['files' => $files];
    }

    public function authorizeAction()
    {
        return ['authorize_url' => $this->dropbox->generateAuthorizationUrl()];
    }

    public function finishAction()
    {
        $code = $this->params()->fromQuery('code');
        $msg = '';

        try {
            $result = $this->dropbox->getAccessToken($code);

            if ($result === true) {
                return $this->redirect()->toRoute('dropbox');
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
        }

        return ['msg' => $msg];
    }

    public function editorAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        if (empty($id)) {
            $this->redirect()->toRoute('dropbox');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->ksiazkaForm->setData($request->getPost());

            if ($this->ksiazkaForm->isValid()) {
                $this->ksiazka->aktualizuj($id, $request->getPost());

                return $this->redirect()->toRoute('ksiazki');
            }
        } else {
            $daneKsiazki = $this->ksiazka->pobierz($id);
            $this->ksiazkaForm->setData($daneKsiazki);
        }

        $viewModel = new ViewModel(['tytul' => 'Edycja pliku', 'form' => $this->fileForm]);
        $viewModel->setTemplate('application/ksiazki/dodaj');

        return $viewModel;
    }
    public function addAction()
    {
        $this->fileForm->get('zapisz')->setValue('Dodaj');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->fileForm->setData($request->getPost());

            if ($this->fileForm->isValid()) {
                //$this->mapmarker->add($request->getPost());
                $this->dropbox->addFile($request->getPost());
                return $this->redirect()->toRoute('dropbox');
            }
        }
        return new ViewModel(['tytul' => 'Dodawanie nowego pliku', 'form' => $this->fileForm]);
    }
    public function usunAction()
    {
        $request = $this->getRequest();
        
        if ($request->isGet()) {
            $file = $this->params()->fromQuery('path');
            $this->dropbox->deleteFile($file);
        } 
        return $this->redirect()->toRoute('dropbox');
    }
    public function edytujAction()
    {
        $request = $this->getRequest();
        
        if ($request->isGet()) {
            $file = $this->params()->fromQuery('path');
            $content=$this->dropbox->getFile($file);
            $this->fileForm->get('FileName')->setAttribute('disabled', 'disabled');
            $this->fileForm->get('FileName')->setValue($file);
            $this->fileForm->get('FileContent')->setValue($content);
            $viewModel=new ViewModel(['tytul' => 'Edycja pliku', 'form' => $this->fileForm]);
            $viewModel->setTemplate('dropbox/index/add');
            return $viewModel;
        } 
        return $this->redirect()->toRoute('dropbox');
    }
    public function downloadAction()
    {
        $request = $this->getRequest();
        
        if ($request->isGet()) {
            $file = $this->params()->fromQuery('path');
            $content=$this->dropbox->getFile($file);
            $path = tempnam(sys_get_temp_dir(), 'prefix');
            $handle = fopen($path, "w");
            fwrite($handle , $content);
            fclose($handle);
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' .str_replace('/','',$file) . '"');
            header('Content-Length: ' . filesize($path));
            header('Content-Description: File Transfer');
            header('Pragma: public');
            
            readfile($path);
            return $this->response;
        } 
        return $this->redirect()->toRoute('dropbox');
    }
}

