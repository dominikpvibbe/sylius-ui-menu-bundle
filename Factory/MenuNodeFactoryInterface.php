<?php


namespace Vibbe\SyliusUiMenuBuilderPlugin\Factory;


use Sylius\Component\Resource\Factory\FactoryInterface;
use Vibbe\SyliusUiMenuBuilderPlugin\Entity\MenuNode;
use Vibbe\SyliusUiMenuBuilderPlugin\Entity\MenuNodeInterface;

interface MenuNodeFactoryInterface extends FactoryInterface
{
    public function createForParent(?MenuNodeInterface $menuNode): MenuNodeInterface;
}
