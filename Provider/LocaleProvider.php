<?php


namespace Vibbe\SyliusUiMenuBuilderPlugin\Provider;



use Sylius\Component\Locale\Model\LocaleInterface;
use Webmozart\Assert\Assert;

class LocaleProvider implements LocaleProviderInterface
{
    private $localeProvider;

    public function __construct(\Sylius\Component\Locale\Provider\LocaleProviderInterface $localeProvider)
    {
        $this->localeProvider = $localeProvider;
    }

    public function provide(?string $locale): string
    {
        if($locale === null) {
            $locale = $this->localeProvider->getDefaultLocaleCode();

            Assert::notNull($locale);
        }

        Assert::oneOf($locale, $this->localeProvider->getAvailableLocalesCodes());

        return $locale;
    }

}
