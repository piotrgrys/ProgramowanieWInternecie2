<?php

namespace Dropbox\Form;

use Laminas\Form\Form;
use Laminas\InputFilter\InputFilterProviderInterface;

class FileForm extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct();

        $this->setAttributes(['method' => 'post', 'class' => 'form']);
        $this->add([
            'name' => 'FileName',
            'type' => 'Text',
            'options' => [
                'label' => 'Nazwa pliku',
            ],
            'attributes' => ['class' => 'form-control'],
        ]);
        $this->add([
            'name' => 'FileContent',
            'type' => 'Text',
            'options' => [
                'label' => 'Treść pliku',
            ],
            'attributes' => ['class' => 'form-control'],
        ]);
        $this->add([
            'name' => 'zapisz',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Zapisz',
                'class' => 'btn btn-primary',
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [
            [
                'name' => 'FileName',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [],
            ],
            [
                'name' => 'FileContent',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [],
            ],
        ];
    }
}