<?php


namespace Vibbe\SyliusUiMenuBuilderPlugin\Factory;


use Sylius\Component\Resource\Factory\FactoryInterface;
use Vibbe\SyliusUiMenuBuilderPlugin\Entity\MenuNodeInterface;

class MenuNodeFactory implements MenuNodeFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createNew(): MenuNodeInterface
    {
        return $this->factory->createNew();
    }

    public function createForParent(?MenuNodeInterface $menuNodeParent): MenuNodeInterface
    {
        $menuNode = $this->createNew();
        $menuNode->setParent($menuNodeParent);
        return $menuNode;
    }

}
