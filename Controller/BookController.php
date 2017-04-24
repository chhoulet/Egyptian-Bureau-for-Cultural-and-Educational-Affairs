<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ArticleBundle\Entity\Book;

Class BookController extends Controller
{
	public function listAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listBooks=$em->getRepository('ArticleBundle:Book')->findAll();
		$nbrBooks=$em->getRepository('ArticleBundle:Book')->countBook();

		return $this->render('ArticleBundle:Book:list.html.twig', 
			array('listBooks'=>$listBooks,
				  'nbrBooks' =>$nbrBooks));
	}

	public function listArabAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listBooks=$em->getRepository('ArticleBundle:Book')->findAll();
		$nbrBooks=$em->getRepository('ArticleBundle:Book')->countBook();		

		return $this->render('ArticleBundle:Book:listArab.html.twig', 
			array('listBooks'=>$listBooks,
				  'nbrBooks' =>$nbrBooks));
	}
}
