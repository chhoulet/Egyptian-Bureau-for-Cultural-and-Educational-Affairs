<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller{
	
	public function aboutAction()
	{
		$em=$this->getDoctrine()->getManager();
		
		$listCounseillors=$em->getRepository('ArticleBundle:Counseillor')->getCounseillorsActive();
		$ArticlesForMissionBureauCulturel=$em->getRepository('ArticleBundle:Article')->getArticlesForActivities(4);
        $ArticlesForHistoireBureauCulturel=$em->getRepository('ArticleBundle:Article')->getArticlesForActivities(5);

		return $this->render('ArticleBundle:Default:about.html.twig', array('listCounseillors'=>$listCounseillors,
																			'ArticlesForMissionBureauCulturel'=>$ArticlesForMissionBureauCulturel,
																			'ArticlesForHistoireBureauCulturel'=>$ArticlesForHistoireBureauCulturel));
	}

	public function aboutArabAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listCounseillors=$em->getRepository('ArticleBundle:Counseillor')->getCounseillorsActive();
		$ArticlesForMissionBureauCulturel=$em->getRepository('ArticleBundle:Article')->getArticlesForActivities(4);
        $ArticlesForHistoireBureauCulturel=$em->getRepository('ArticleBundle:Article')->getArticlesForActivities(5);
/*var_dump($ArticlesForMissionBureauCulturel, $ArticlesForHistoireBureauCulturel);die;*/
		return $this->render('ArticleBundle:Default:aboutArab.html.twig', array('listCounseillors'=>$listCounseillors,
																			'ArticlesForMissionBureauCulturel'=>$ArticlesForMissionBureauCulturel,
																			'ArticlesForHistoireBureauCulturel'=>$ArticlesForHistoireBureauCulturel));
	}
}