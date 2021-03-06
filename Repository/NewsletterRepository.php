<?php

namespace ArticleBundle\Repository;

/**
 * NewsletterRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NewsletterRepository extends \Doctrine\ORM\EntityRepository
{
	public function getNewslettersByDate()
	{
		$query=$this->getEntityManager()->createQuery('
			SELECT n 
			FROM ArticleBundle:Newsletter n 
			ORDER BY n.dateCreated DESC');

		return $query->getResult();
	}

	public function getLastNewsletters()
	{
		$query=$this->getEntityManager()->createQuery('
			SELECT n 
			FROM ArticleBundle:Newsletter n 
			ORDER BY n.dateCreated DESC')
		->setMaxResults(1);

		return $query->getSingleResult();
	}
}
