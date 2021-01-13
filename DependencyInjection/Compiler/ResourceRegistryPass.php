<?php

declare(strict_types=1);

namespace Vibbe\SyliusUiMenuBuilderPlugin\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class ResourceRegistryPass implements CompilerPassInterface
{
    public const RESOURCE_MENU_TAG = 'sylius_resource.menu';

    public function process(ContainerBuilder $container)
    {

    }
}
