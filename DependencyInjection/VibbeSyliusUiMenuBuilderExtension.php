<?php

declare(strict_types=1);

namespace Vibbe\SyliusUiMenuBuilderPlugin\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Vibbe\SyliusUiMenuBuilderPlugin\Entity\MenuNode;
use Vibbe\SyliusUiMenuBuilderPlugin\Entity\MenuNodeTranslation;
use Vibbe\SyliusUiMenuBuilderPlugin\Doctrine\ORM\MenuNodeRepository;
use Vibbe\SyliusUiMenuBuilderPlugin\Form\Type\MenuNodeTranslationType;
use Vibbe\SyliusUiMenuBuilderPlugin\Form\Type\MenuNodeType;

class VibbeSyliusUiMenuBuilderExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $loader->load('services.yaml');
    }

    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        if (isset($bundles['SyliusResourceBundle'])) {
            $config = [
                'resources' => [
                    'vibbe_sylius.menu' => [
                        'classes'     => [
                            'model' => MenuNode::class,
                            'repository' => MenuNodeRepository::class,
                            'form' => MenuNodeType::class
                        ],
                        'translation' => [
                            'classes' => [
                                'model' => MenuNodeTranslation::class,
                                'form'  => MenuNodeTranslationType::class
                            ],
                        ],
                    ],
                ],
            ];

            $gridConfig = [
                'grids' => [
                    'vibbe_sylius_menu' => [
                        'driver'  => [
                            'name'    => 'doctrine/orm',
                            'options' => [
                                'class' => MenuNode::class,
                            ],
                        ],
                        'fields'  => [
                            'slug'        => [
                                'type'  => 'string',
                                'label' => 'Slug',
                            ],
                            'description' => [
                                'type'  => 'string',
                                'label' => 'Opis',
                            ],
                            'enabled' => [
                                'type'    => 'twig',
                                'label'   => 'sylius.ui.enabled',
                                'options' => [
                                    'template' => '@SyliusUi/Grid/Field/enabled.html.twig',
                                ],
                            ],
                        ],
                        'actions' => [
                            'main' => [
                                'create' => [
                                    'type' => 'create',
                                ],
                            ],
                            'item' => [
                                'update' => [
                                    'type' => 'update',
                                ],
                                'delete' => [
                                    'type' => 'delete',
                                ],
                            ],
                        ],
                    ],
                ],
            ];

            foreach ($container->getExtensions() as $name => $extension) {
                switch ($name) {
                    case 'sylius_resource':
                        $container->prependExtensionConfig($name, $config);
                        break;
                    case 'sylius_grid':
                        $container->prependExtensionConfig($name, $gridConfig);
                        break;
                }
            }
        }

    }

}
