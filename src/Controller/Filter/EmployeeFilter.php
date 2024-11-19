<?php
// this class inspired by: https://gitlab.fit.cvut.cz/BI-TWA/B241/tutorial/-/commit/737efcb3eaae65b673d011ad586c04cd22ef2377
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