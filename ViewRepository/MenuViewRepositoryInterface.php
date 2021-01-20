<?php


namespace Vibbe\SyliusUiMenuBuilderPlugin\ViewRepository;


use Vibbe\SyliusUiMenuBuilderPlugin\View\MenuListView;

interface MenuViewRepositoryInterface
{
    public function getAllActive(?string $localeCode): MenuListView;
}
