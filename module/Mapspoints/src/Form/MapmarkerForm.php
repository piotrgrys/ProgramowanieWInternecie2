<?php

namespace Mapspoints\Form;

use Laminas\Form\Form;
use Laminas\InputFilter\InputFilterProviderInterface;

class MapmarkerForm extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('mapmarker');

        $this->setAttributes(['method' => 'post', 'class' => 'form']);
        $this->add([
            'name' => 'Lat',
            'type' => 'Text',
            'options' => [
                'label' => 'Lat',
            ],
            'attributes' => ['class' => 'form-control'],
        ]);
        $this->add([
            'name' => 'Lang',
            'type' => 'Text',
            'options' => [
                'label' => 'Lang',
            ],
            'attributes' => ['class' => 'form-control'],
        ]);
        $this->add([
            'name' => 'Address',
            'type' => 'Text',
            'options' => [
                'label' => 'Address',
            ],
            'attributes' => ['class' => 'form-control'],
        ]);
        $this->add([
            'name' => 'Description',
            'type' => 'Text',
            'options' => [
                'label' => 'Description',
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
                'name' => 'Lat',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [],
            ],
            [
                'name' => 'Lang',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [],
            ],
            [
                'name' => 'Address',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [],
            ],
            [
                'name' => 'Description',
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