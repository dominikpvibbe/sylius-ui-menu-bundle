<?php


namespace Vibbe\SyliusUiMenuBuilderPlugin\Provider;


interface LocaleProviderInterface
{
    public function provide(?string $locale): string;
}
