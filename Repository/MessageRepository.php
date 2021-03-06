<?php

namespace ArticleBundle\Repository;

/**
 * MessageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MessageRepository extends \Doctrine\ORM\EntityRepository
{
	public function countMessageUnRead()
	{
		$query=$this->getEntityManager()->createQuery('
			SELECT COUNT(m.id)
			FROM ArticleBundle:Message m 
			WHERE m.readMessage = 0');
		
		return $query->getSingleScalarResult();
	}

	public function countMessageConseiller()
	{
		$query=$this->getEntitymanager()->createQuery('
			SELECT COUNT(m.id)
			FROM ArticleBundle:Message m 
			WHERE m.receiver = 1');

		return $query->getSingleScalarResult();
	}

	public function countMessageAttacheCulturel()
	{
		$query=$this->getEntitymanager()->createQuery('
			SELECT COUNT(m.id)
			FROM ArticleBundle:Message m 
			WHERE m.receiver = 2');

		return $query->getSingleScalarResult();
	}

	public function countMessageAttacheAdministratif()
	{
		$query=$this->getEntitymanager()->createQuery('
			SELECT COUNT(m.id)
			FROM ArticleBundle:Message m 
			WHERE m.receiver = 3');

		return $query->getSingleScalarResult();
	}

	public function countMessageSecretaireAdministratif()
	{
		$query=$this->getEntitymanager()->createQuery('
			SELECT COUNT(m.id)
			FROM ArticleBundle:Message m 
			WHERE m.receiver = 4');

		return $query->getSingleScalarResult();
	}

	public function countMessageSchoolSecretaire($receiver)
	{
		$query=$this->getEntitymanager()->createQuery('
			SELECT COUNT(m.id)
			FROM ArticleBundle:Message m 
			WHERE m.receiver = :receiver')
		->setParameter('receiver', $receiver);

		return $query->getSingleScalarResult();
	}
}
