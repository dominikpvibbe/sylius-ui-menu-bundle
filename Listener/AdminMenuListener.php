<?php

namespace Vibbe\SyliusUiMenuBuilderPlugin\Listener;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $parentMenu = $menu
            ->addChild('vibbe_sylius_menu')
            ->setLabel('Shop Menu')
        ;

        $parentMenu
            ->addChild('vibbe_sylius_menu',[
                'route' => 'vibbe_sylius_admin_menu_index'
            ])
            ->setLabel('Menu')
            ->setLabelAttribute('icon', 'list')
        ;
    }
}
