<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PartnerController extends Controller
{
	public function listPartnerPublicAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listPartners=$em->getRepository('ArticleBundle:Partner')->findByActive(1);

		return $this->render('ArticleBundle:Partner:listPartners.html.twig', array('listPartners'=>$listPartners));
	}

	public function listPartnerPublicArabAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listPartners=$em->getRepository('ArticleBundle:Partner')->findByActive(1);

		return $this->render('ArticleBundle:Partner:listPartnersArab.html.twig', array('listPartners'=>$listPartners));
	}
}