<?php

declare(strict_types=1);

namespace Vibbe\SyliusUiMenuBuilderPlugin\Entity;


use Sylius\Component\Resource\Model\TranslationInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface MenuNodeTranslationInterface extends ResourceInterface, TranslationInterface
{
    public function getTooltip(): ?string;

    public function setTooltip(?string $tooltip);

    public function getName(): ?string;

    public function setName(?string $name);
}
