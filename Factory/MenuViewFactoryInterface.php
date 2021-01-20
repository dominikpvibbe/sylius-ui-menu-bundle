<?php


namespace Vibbe\SyliusUiMenuBuilderPlugin\Factory;


use Sylius\Component\Core\Model\ChannelInterface;
use Vibbe\SyliusUiMenuBuilderPlugin\Entity\MenuNodeInterface;
use Vibbe\SyliusUiMenuBuilderPlugin\View\MenuView;

interface MenuViewFactoryInterface
{
    public function create(MenuNodeInterface $menuNode, string $locale): MenuView;
}
