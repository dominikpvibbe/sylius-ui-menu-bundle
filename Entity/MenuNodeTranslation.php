<?php

declare(strict_types=1);

namespace Vibbe\SyliusUiMenuBuilderPlugin\Entity;


use Sylius\Component\Resource\Model\AbstractTranslation;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class MenuNodeTranslation extends AbstractTranslation
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=256, nullable=true)
     */
    protected $name;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     */
    protected $tooltip;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
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
