<?php

declare(strict_types=1);

namespace Vibbe\SyliusUiMenuBuilderPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Component\Resource\Model\ResourceInterface;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;

/**
 * @ORM\Entity()
 */
class MenuNode implements ResourceInterface, TranslatableInterface
{
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $is_main;

    /**
     * @var null|string
     * @ORM\Column(type="string", length=256, nullable=true)
     */
    protected $slug;

    /**
     * @var string|null
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $enabled;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    protected $parameters = [];

    /**
     * @var MenuNode
     * @ORM\ManyToOne(targetEntity="Vibbe\SyliusUiMenuBuilderPlugin\Entity\MenuNode", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parent;

    /**
     * @var MenuNode[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Vibbe\SyliusUiMenuBuilderPlugin\Entity\MenuNode", mappedBy="parent",fetch="EXTRA_LAZY", orphanRemoval=true, cascade={"remove"}),
     */
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

    public function addChildren(MenuNode $menuNode)
    {
        if (!$this->children->contains($menuNode)) {
            $this->children[] = $menuNode;
            $menuNode->setParent($this);
        }
    }

    public function removeChildren(MenuNode $menuNode)
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
    public function parent(): ?MenuNode
    {
        return $this->parent;
    }

    /**
     * @param MenuNode|null $task
     * @return MenuNode
     */
    public function setParent(?MenuNode $task): self
    {
        $this->parent = $task;

        return $this;
    }

    public function isIsMain(): bool
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
