<?php

declare(strict_types=1);

namespace Vibbe\SyliusUiMenuBuilderPlugin;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Vibbe\SyliusUiMenuBuilderPlugin\DependencyInjection\VibbeSyliusUiMenuBuilderExtension;

final class VibbeSyliusUiMenuBuilderPlugin extends Bundle
{
    public function getContainerExtension()
    {
        return new VibbeSyliusUiMenuBuilderExtension();
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }
}
