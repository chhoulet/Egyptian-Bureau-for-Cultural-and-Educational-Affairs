<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ArticleBundle\Entity\Mail;
use ArticleBundle\Form\MailType;
use ArticleBundle\Form\MailArabType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{
    public function homepageAction(Request $request)
    {
    	$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();

		//Gestion de l'enregistrement des mails
		$mail=new Mail();
		$form=$this->createForm(MailType::class, $mail);

		$form->handleRequest($request);

		if($form->isValid() && $form->isSubmitted())
		{		
			$listMails=$em->getRepository('ArticleBundle:Mail')->findAll();			

			if ($form->get('unSubscribe')->isClicked()) 
			{				
				foreach($listMails as $mailBa)
				{
					if($mailBa->getMail() == $mail->getMail())
					{
						$mail=$em->getRepository('ArticleBundle:Mail')->find($mailBa->getId());
						$em->remove($mail);
						$em->flush();
						$session->getFlashBag()->add('unSubscribe', 'You unsubscribed well of the newsletter !');						
						return $this->redirectToRoute('article_homepage');
					}
				
				}	
					
				$session->getFlashBag()->add('errorMail', 'This e-mail address does not appear in the list !');					
				return $this->redirectToRoute('article_homepage');					
			}

			foreach($listMails as $mailBa)
			{

				if($mailBa->getMail() == $mail->getMail())
				{										
					$session->getFlashBag()->add('Subscriber', 'You are already registered on the newsletter !');
					return $this->redirectToRoute('article_homepage');
				}
			}	
			
			$em->persist($mail);		
			$em->flush();

			$session->getFlashBag()->add('succesMail', 'Your mail is registered !');
			return $this->redirectToRoute('article_homepage');
		}

		//Sélection des articles en homepage
		$articlesSelected=$em->getRepository('ArticleBundle:Article')->articlesHomepage();
		$article=array_shift($articlesSelected);
		array_unshift($articlesSelected, $article);

		foreach($articlesSelected as $article)
		{
			$main=$article->getMain();
			html_entity_decode($main);
			strip_tags($main);
			$article->setMain($main);
		}

        return $this->render('ArticleBundle:Default:homepage.html.twig', 
        	 array('form'=>$form->createView(),
        	 	   'articl'=>$article,
         	       'articlesSelected'=>$articlesSelected));
    }

    public function homepageArabeAction(Request $request)
    {
    	$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();

		//Gestion de l'enregistrement des mails
		$mail=new Mail();
		$form=$this->createForm(MailArabType::class, $mail);

		$form->handleRequest($request);

		if($form->isValid() && $form->isSubmitted())
		{		
			$listMails=$em->getRepository('ArticleBundle:Mail')->findAll();

			if ($form->get('Delete')->isClicked()) 
			{				
				foreach($listMails as $mailBa)
				{
					if($mailBa->getMail() == $mail->getMail())
					{
						$em->remove($mailBa);
						$em->flush();
					}

					$session->getFlashBag()->add('unSubscribe', 'تمّ إلغاء اشتراكك في القائمة البريدية');
					return $this->redirectToRoute('article_homepage');
				}
			}			

			foreach($listMails as $mailBa)
			{
				if($mailBa->getMail() == $mail->getMail())
				{					
					$session->getFlashBag()->add('Subscriber', 'لقد تمّ مسبقاً اشتراكك في القائمة البريدية');
					return $this->redirectToRoute('article_homepage');
				}
			}	
			
			$em->persist($mail);
			$em->flush();

			$session->getFlashBag()->add('succesMail', 'لقد تمّ تسجيل بريدك الالكتروني!');
			return $this->redirectToRoute('article_homepage_arabe');
		}

		//Sélection des articles en homepage
		$articlesSelected=$em->getRepository('ArticleBundle:Article')->articlesHomepage();
		$article=array_shift($articlesSelected);
		array_unshift($articlesSelected, $article);

        return $this->render('ArticleBundle:Default:homepageArab.html.twig', 
        	 array('form'=>$form->createView(),
        	 	   'article'=>$article,
         	       'articlesSelected'=>$articlesSelected));
    }
}
