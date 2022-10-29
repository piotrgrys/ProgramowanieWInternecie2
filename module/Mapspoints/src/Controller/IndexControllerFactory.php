<?php

namespace Mapspoints\Controller;

use Mapspoints\Form\MapmarkerForm;
use Mapspoints\Model\Mapmarker;
//use Interop\Container\ContainerInterface;
use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $mapmarker = $container->get(Mapmarker::class);
        $mapmarkerForm = $container->get(MapmarkerForm::class);
        return new IndexController($mapmarker, $mapmarkerForm);
    }
}
