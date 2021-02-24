<?php


namespace Vibbe\SyliusUiMenuBuilderPlugin\ViewRepository;


use Vibbe\SyliusUiMenuBuilderPlugin\View\MenuListView;
use Vibbe\SyliusUiMenuBuilderPlugin\View\MenuView;

interface MenuViewRepositoryInterface
{
    public function getAllActive(?string $localeCode): MenuListView;

    public function getOneBySlug(string $slug,?string $localeCode): MenuView;
}
