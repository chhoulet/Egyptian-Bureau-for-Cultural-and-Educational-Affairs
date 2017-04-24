<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CounseillorController extends Controller
{
	public function unactiveAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listCounseillorsUnactive=$em->getRepository('ArticleBundle:Counseillor')->getCounseillorsNonActive();

		return $this->render('ArticleBundle:Counseillor:listUnactive.html.twig', 
			array('listCounseillorsUnactive'=>$listCounseillorsUnactive));
	}

	public function unactiveArabAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listCounseillorsUnactiveArab=$em->getRepository('ArticleBundle:Counseillor')->getCounseillorsNonActive();

		return $this->render('ArticleBundle:Counseillor:listUnactiveArab.html.twig', 
			array('listCounseillorsUnactiveArab'=>$listCounseillorsUnactiveArab));
	}
}