<?php

namespace Maps\Controller;

use Maps\Model\Mapmarker;
use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $mapmarker = $container->get(Mapmarker::class);
        return new IndexController($mapmarker);
    }
}
