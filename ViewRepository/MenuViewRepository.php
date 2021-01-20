<?php


namespace Vibbe\SyliusUiMenuBuilderPlugin\ViewRepository;


use Sylius\Component\Core\Model\ChannelInterface;
use Vibbe\SyliusUiMenuBuilderPlugin\Factory\MenuViewFactoryInterface;
use Vibbe\SyliusUiMenuBuilderPlugin\Provider\LocaleProviderInterface;
use Vibbe\SyliusUiMenuBuilderPlugin\Repository\MenuNodeRepositoryInterface;
use Vibbe\SyliusUiMenuBuilderPlugin\View\MenuListView;
use Webmozart\Assert\Assert;

class MenuViewRepository implements MenuViewRepositoryInterface
{

    /** @var MenuNodeRepositoryInterface $menuRepository */
    private $menuRepository;

    /** @var MenuViewFactoryInterface */
    private $menuViewFactory;

    private $localeProvider;

    public function __construct(MenuNodeRepositoryInterface $menuRepository,
                                MenuViewFactoryInterface $menuViewFactory,
                                LocaleProviderInterface $localeProvider)
    {
        $this->menuRepository    = $menuRepository;
        $this->menuViewFactory   = $menuViewFactory;
        $this->localeProvider    = $localeProvider;
    }

    public function getAllActive(?string $localeCode): MenuListView
    {
        $activeMenus = $this->menuRepository->findBy(['enabled' => true]);

        $menuListView = new MenuListView();

        foreach ($activeMenus as $menu) {
            $menuListView->items[] = $this->menuViewFactory->create($menu,$this->localeProvider->provide($localeCode));
        }

        return $menuListView;
    }


}
