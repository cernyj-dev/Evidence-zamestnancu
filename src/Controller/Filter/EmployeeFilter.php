<?php

namespace App\Controller\Filter;

use Doctrine\ORM\QueryBuilder;

class EmployeeFilter
{
    public function __construct(public ?string $name = null){
    }

    public function apply(QueryBuilder $qb): QueryBuilder{
        if($this->name !== null) {
            $qb = $qb->andWhere('e.name LIKE :name')
                ->setParameter('name', '%'.$this->name.'%');
        }


        return $qb;
    }
}