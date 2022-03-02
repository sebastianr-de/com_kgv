<?php

namespace Rosental\Component\Kgv\Administrator\Extension;

use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Categories\CategoryInterface;
use Joomla\CMS\Categories\CategoryServiceTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use Psr\Container\ContainerInterface;
use Rosental\Component\Kgv\Administrator\Service\HTML\AdministratorService;

class KgvComponent extends MVCComponent implements BootableExtensionInterface, CategoryFactoryInterface
{
    use CategoryServiceTrait;
    use HTMLRegistryAwareTrait;

    public function boot(ContainerInterface $container)
    {
        $this->getRegistry()->register('kgvadministrator', new AdministratorService);
    }

}