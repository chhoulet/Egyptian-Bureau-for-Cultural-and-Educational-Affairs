<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
	public function listAction($idLang)
	{
		$em=$this->getDoctrine()->getManager();
		$listArticles=$em->getRepository('ArticleBundle:Article')->listArticles();

		for ($i = 1; $i <= 3; $i++) 
		{
    		$trash = array_shift($listArticles);
		}		

		if($idLang == 1)
		{
			return $this->render('ArticleBundle:Article:list.html.twig', array('listArticles'=>$listArticles));			
		}
		else
		{
			return $this->render('ArticleBundle:Article:listArabe.html.twig', array('listArticles'=>$listArticles));
		}
	}
}