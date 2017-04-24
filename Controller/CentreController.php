<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CentreController extends Controller
{
	public function accueilAction()
	{
		$em=$this->getDoctrine()->getManager();
		$activites = $em->getRepository('ArticleBundle:Article')->getActivitesForCentreCulturel();
		return $this->render('ArticleBundle:Centre:accueil.html.twig', array('activites'=>$activites));
	}

	public function contactAction()
	{
		return $this->render('ArticleBundle:Centre:contact.html.twig');
	}

	public function histoireAction()
	{
		$em=$this->getDoctrine()->getManager();
		$histoires = $em->getRepository('ArticleBundle:Article')->getArticlesForHistoireCentreCulturel();
		
		return $this->render('ArticleBundle:Centre:histoire.html.twig', array('histoires'=>$histoires));
	}

	public function missionAction()
	{
		$em=$this->getDoctrine()->getManager();
		$missions = $em->getRepository('ArticleBundle:Article')->getArticlesForMissionCentreCulturel();
		
		return $this->render('ArticleBundle:Centre:mission.html.twig', array('missions'=>$missions));
	}

	public function oldActivitesAction()
	{
		$em=$this->getDoctrine()->getManager();
		$oldActivites = $em->getRepository('ArticleBundle:Article')->getOldActivitesForCentreCulturel();
		
		return $this->render('ArticleBundle:Centre:oldActivites.html.twig', array('oldActivites'=>$oldActivites));
	}

//Functions gérant la partie en Arabe du Centre Culturel
	public function accueilArabAction() 
	{
		$em=$this->getDoctrine()->getManager();
		$activites = $em->getRepository('ArticleBundle:Article')->getActivitesForCentreCulturel();

		return $this->render('ArticleBundle:Centre:accueilArab.html.twig', array('activites'=>$activites));
	}

	public function contactArabAction()
	{
		return $this->render('ArticleBundle:Centre:contactArab.html.twig');
	}

	public function histoireArabAction()
	{
		$em=$this->getDoctrine()->getManager();
		$histoires = $em->getRepository('ArticleBundle:Article')->getArticlesForHistoireCentreCulturel();
		
		return $this->render('ArticleBundle:Centre:histoireArab.html.twig', array('histoires'=>$histoires));
	}

	public function missionArabAction()
	{
		$em=$this->getDoctrine()->getManager();
		$missions = $em->getRepository('ArticleBundle:Article')->getArticlesForMissionCentreCulturel();
		
		return $this->render('ArticleBundle:Centre:missionArab.html.twig', array('missions'=>$missions));
	}

	public function oldActivitesArabAction()
	{
		$em=$this->getDoctrine()->getManager();
		$oldActivites = $em->getRepository('ArticleBundle:Article')->getOldActivitesForCentreCulturel();
		
		return $this->render('ArticleBundle:Centre:oldActivitesArab.html.twig', array('oldActivites'=>$oldActivites));
	}

}
