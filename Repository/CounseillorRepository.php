<?php

namespace ArticleBundle\Repository;

/**
 * CounseillorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CounseillorRepository extends \Doctrine\ORM\EntityRepository
{
	public function getCounseillorsActive()
	{
		$query=$this->getEntityManager()->createQuery('
			SELECT c
			FROM ArticleBundle:Counseillor c 
			WHERE c.active = 1
			ORDER BY c.hierarchicLevel ASC');

		return $query->getResult();
	}

	public function getCounseillorsNonActive()
	{
		$query=$this->getEntityManager()->createQuery('
			SELECT c 
			FROM ArticleBundle:Counseillor c 
			WHERE c.active = 0
			AND c.hierarchicLevel = 1');

		return $query->getResult();
	}
}
