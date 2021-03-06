<?php


namespace Vibbe\SyliusUiMenuBuilderPlugin\Doctrine\ORM;


use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Vibbe\SyliusUiMenuBuilderPlugin\Entity\MenuNodeInterface;
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
    public function findOneByParentId($parentId = null): ?MenuNodeInterface
    {
        if((int) $parentId  <= 0) {
            return null;
        }

        return $this->find($parentId);
    }

    public function createQueryBuilderByParentId($parentId = null)
    {
        $queryBuilder = $this->createQueryBuilder('o');

        if(!empty($parentId) && (int)$parentId > 0 ) {
            $queryBuilder->andWhere('o.parent = :parentId')
                ->setParameter('parentId',$parentId);
        } else {
            $queryBuilder->andWhere('o.parent IS NULL');
        }

        return $queryBuilder;
    }

    public function createPaginator(array $criteria = [], array $sorting = []): iterable
    {
        $queryBuilder = $this->createQueryBuilder('menuNode');
        $queryBuilder->where('menuNode.parent IS NULL');

        $this->applyCriteria($queryBuilder, $criteria);
        $this->applySorting($queryBuilder, $sorting);

        return $this->getPaginator($queryBuilder);
    }
}
