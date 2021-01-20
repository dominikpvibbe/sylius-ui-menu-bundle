<?php

declare(strict_types=1);

namespace Vibbe\SyliusUiMenuBuilderPlugin\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

interface MenuNodeInterface extends ResourceInterface, TranslatableInterface
{
    /**
     * @return MenuInterface[]|ArrayCollection
     */
    public function children();

    public function addChildren(MenuNodeInterface $menuNode);

    public function removeChildren(MenuNodeInterface $menuNode);

    public function hasParent(): bool;

    public function parent(): ?MenuNodeInterface;

    public function setParent(?MenuNodeInterface $menuNode): self;

    public function isMain(): bool;

    public function setIsMain(bool $isMain);

    public function getSlug(): ?string;

    public function setSlug(?string $slug);

    public function getDescription(): ?string;

    public function setDescription(?string $description);

    public function isEnabled(): bool;

    public function setEnabled(bool $enabled): void;

    public function getParameters(): array;

    public function setParameters(array $parameters);

    public function getName(): ?string;

    public function setName(?string $name);

    public function getTooltip(): ?string;

    public function setTooltip(?string $tooltip);
}
