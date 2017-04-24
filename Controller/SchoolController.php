<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SchoolController extends Controller
{
	public function presentationAction()
	{
		$em=$this->getDoctrine()->getManager();
		$test=false;
		$schoolActivities=$em->getRepository('ArticleBundle:Article')->findByOrigin(8);

		$listarrayActivity=[];
		foreach($schoolActivities as $activity)
		{
			$activity=array('datetime'=>$activity->getDateCreated()->getTimestamp(), 'id'=>$activity->getId());
			$listarrayActivity[]=$activity;
		}

		rsort($listarrayActivity);

		$listActivities=[];
		foreach($listarrayActivity as $arrayActivity)
		{
			$arrayActivity=$em->getRepository('ArticleBundle:Article')->find($arrayActivity['id']);
			$listActivities[]=$arrayActivity;
		}

		$nbrActivities=count($listActivities);

		if($nbrActivities >3)
		{
			$test=true;
			while ($nbrActivities >3)
			{
				array_pop($listActivities);
				$nbrActivities=count($listActivities);
			}
		}		

		return $this->render('ArticleBundle:School:presentation.html.twig', 
			array('schoolActivities'=>$listActivities,
				  'test'=>$test));
	}

	public function examsAction()
	{
		$em=$this->getDoctrine()->getManager();
		$documentsScholars=$em->getRepository('ArticleBundle:Document')->findByPublicDoc(3);

		return $this->render('ArticleBundle:School:exams.html.twig', array('documentsScholars'=>$documentsScholars));
	}

	public function activitiesAction()
	{
		$em=$this->getDoctrine()->getManager();
		$schoolActivities=$em->getRepository('ArticleBundle:Article')->findByOrigin(8);		
		
		for ($i=0; $i <=2 ; $i++)
		{ 
			array_pop($schoolActivities);
		}	

		rsort($schoolActivities);		

		return $this->render('ArticleBundle:School:activities.html.twig', array('schoolActivities'=>$schoolActivities));
	}
	
}