<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ArticleBundle\Entity\Message;
use ArticleBundle\Form\MessageType;
use ArticleBundle\Form\MessageArabType;
use Symfony\Component\HttpFoundation\Request;

Class ContactController extends Controller
{
	public function contactAction(Request $request)
	{		
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$message=new Message();
		$form=$this->createForm(MessageType::class, $message);

		$form->handleRequest($request);

		if($form->isValid() && $form->isSubmitted())
		{
			$message->setDateCreated(new \DateTime());
			$em->persist($message);
			$em->flush();
			

			$session->getFlashbag()->add('succes', 'Your message has been sent !');
			return $this->redirectToRoute('article_homepage');
		}

		return $this->render('ArticleBundle:Default:contact.html.twig', array('form'=>$form->createView()));
	}

	public function contactArabAction(Request $request)
	{		
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$message=new Message();
		$form=$this->createForm(MessageArabType::class, $message);

		$form->handleRequest($request);

		if($form->isValid() && $form->isSubmitted())
		{
			$message->setDateCreated(new \DateTime());
			$em->persist($message);
			$em->flush();
			

			$session->getFlashbag()->add('succes', 'Your message has been sent !');
			return $this->redirectToRoute('article_homepage');
		}

		return $this->render('ArticleBundle:Default:contactArab.html.twig', array('form'=>$form->createView()));
	}
}