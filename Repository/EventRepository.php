<?php

namespace ArticleBundle\Repository;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends \Doctrine\ORM\EntityRepository
{
	public function getEventsForBoursiers()
	{
		$query=$this->getEntityManager()->createQuery('
			SELECT e 
			FROM ArticleBundle:Event e 
			WHERE e.boursier = true
			ORDER BY e.dateEvent');

		return $query->getResult();
	}
}
