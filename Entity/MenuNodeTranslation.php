<?php

declare(strict_types=1);

namespace Vibbe\SyliusUiMenuBuilderPlugin\Entity;


use Sylius\Component\Resource\Model\AbstractTranslation;
use Sylius\Component\Resource\Model\TranslatableInterface;

class MenuNodeTranslation extends AbstractTranslation implements MenuNodeTranslationInterface
{
    protected $id;

    protected $name;

    protected $tooltip;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getTooltip(): ?string
    {
        return $this->tooltip;
    }

    /**
     * @param string|null $tooltip
     */
    public function setTooltip(?string $tooltip): void
    {
        $this->tooltip = $tooltip;
    }

}
