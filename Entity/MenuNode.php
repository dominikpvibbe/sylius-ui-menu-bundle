<?php

declare(strict_types=1);

namespace Vibbe\SyliusUiMenuBuilderPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;

class MenuNode implements MenuNodeInterface
{
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    protected $id;

    protected $is_main;

    protected $slug;

    protected $description;

    protected $enabled = false;

    protected $parameters = [];

    private $parent;

    private $children;

    public function __construct()
    {
        $this->initializeTranslationsCollection();
        $this->children = new ArrayCollection();
        $this->is_main  = true;
    }

    public function getId()
    {
        return $this->id;
    }


    /**
     * @return MenuNode[]|ArrayCollection
     */
    public function children()
    {
        return $this->children;
    }

    public function addChildren(MenuNodeInterface $menuNode)
    {
        if (!$this->children->contains($menuNode)) {
            $this->children[] = $menuNode;
            $menuNode->setParent($this);
        }
    }

    public function removeChildren(MenuNodeInterface $menuNode)
    {
        if ($this->children->contains($menuNode)) {
            $this->children->removeElement($menuNode);
            // set the owning side to null (unless already changed)
            if ($menuNode->parent() === $this) {
                $menuNode->setParent(null);
            }
        }
    }

    /**
     * @return bool
     */
    public function hasParent(): bool
    {
        return (bool)$this->parent;
    }

    /**
     * @return MenuNode|null
     */
    public function parent(): ?MenuNodeInterface
    {
        return $this->parent;
    }

    /**
     * @param MenuNode|null $task
     * @return MenuNode
     */
    public function setParent(?MenuNodeInterface $menuNode): self
    {
        $this->parent = $menuNode;

        return $this;
    }

    public function isMain(): bool
    {
        return $this->is_main;
    }

    public function setIsMain(bool $is_main): void
    {
        $this->is_main = $is_main;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }

    public function getName(): ?string
    {
        return $this->getTranslation()->getName();
    }

    public function setName(?string $name)
    {
        $this->getTranslation()->setName($name);
    }

    public function getTooltip(): ?string
    {
        return $this->getTranslation()->getTooltip();
    }

    public function setTooltip(?string $tooltip)
    {
        $this->getTranslation()->setTooltip($tooltip);
    }

    protected function createTranslation(): TranslationInterface
    {
        return new MenuNodeTranslation();
    }
}
