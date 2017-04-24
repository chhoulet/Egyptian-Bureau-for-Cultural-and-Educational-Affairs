<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ServiceController extends Controller
{
	public function listAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listServices=$em->getRepository('ArticleBundle:Article')->getArticlesForActivities(9);

		return $this->render('ArticleBundle:Service:list.html.twig', array('listServices'=>$listServices));
	}

	public function listArabeAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listServices=$em->getRepository('ArticleBundle:Article')->getArticlesForActivities(9);

		return $this->render('ArticleBundle:Service:listArabe.html.twig', array('listServices'=>$listServices));
	}	
}
