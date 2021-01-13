<?php

declare(strict_types=1);

namespace Vibbe\SyliusUiMenuBuilderPlugin\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Vibbe\SyliusUiMenuBuilderPlugin\Entity\Menu;

class VibbeSyliusUiMenuBuilderExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration,$configs);

        $loader->load('services.yaml');
    }

    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        if(isset($bundles['SyliusResourceBundle'])) {
            $config = [
                'resources' => [
                    'app.menu' => [
                        'classes' => [
                            'model' => Menu::class
                        ]
                    ]
                ]
            ];

            foreach ($container->getExtensions() as $name => $extension) {
                switch ($name) {
                    case 'sylius_resource':
                        $container->prependExtensionConfig($name, $config);
                        break;
                }
            }
        }
    }

}
