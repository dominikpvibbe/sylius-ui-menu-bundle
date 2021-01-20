<?php


namespace Vibbe\SyliusUiMenuBuilderPlugin\Doctrine\ORM;


use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Vibbe\SyliusUiMenuBuilderPlugin\Repository\MenuNodeRepositoryInterface;

class MenuNodeRepository extends EntityRepository implements MenuNodeRepositoryInterface
{
   /* public function paginateWithNoParents(array $criteria = [], array $sorting = []): iterable
    {
        $queryBuilder = $this->createQueryBuilder('menuNode');
        $queryBuilder->where('menuNode.parent IS NULL');

        $this->applyCriteria($queryBuilder, $criteria);
        $this->applySorting($queryBuilder, $sorting);

        return $this->getPaginator($queryBuilder);
    }*/

    public function createPaginator(array $criteria = [], array $sorting = []): iterable
    {
        $queryBuilder = $this->createQueryBuilder('menuNode');
        $queryBuilder->where('menuNode.parent IS NULL');

        $this->applyCriteria($queryBuilder, $criteria);
        $this->applySorting($queryBuilder, $sorting);

        return $this->getPaginator($queryBuilder);
    }
}
