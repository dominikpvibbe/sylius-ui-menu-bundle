<?php


namespace Vibbe\SyliusUiMenuBuilderPlugin\Factory;


use Sylius\Component\Core\Model\ChannelInterface;
use Vibbe\SyliusUiMenuBuilderPlugin\Entity\MenuNodeInterface;
use Vibbe\SyliusUiMenuBuilderPlugin\View\MenuView;

class MenuViewFactory implements MenuViewFactoryInterface
{
    /** @var string */
    private $menuViewClass;

    /** @var string */
    private $fallbackLocale;

    public function __construct(string $menuViewClass, string $fallbackLocale)
    {
        $this->menuViewClass = $menuViewClass;
        $this->fallbackLocale   = $fallbackLocale;
    }

    public function create(MenuNodeInterface $menuNode, string $locale): MenuView
    {
        $menuView = new $this->menuViewClass();

        $translation = $menuNode->getTranslation($locale);
        $menuView->slug = $menuNode->getSlug();
        $menuView->id  = $menuNode->getId();
        $menuView->name = $translation->getName() ?? '';
        $menuView->tooltip = $translation->getTooltip() ?? '';

        return $menuView;
    }

}
