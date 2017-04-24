<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ArticleBundle\Entity\Message;
use ArticleBundle\Entity\Answer;
use ArticleBundle\Form\AnswerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MessageController extends Controller
{
	public function listAction()
	{
		$em=$this->getDoctrine()->getManager();
		$messages=$em->getRepository('ArticleBundle:Message')->findAll();
		$messageUnRead =$em->getRepository('ArticleBundle:Message')->countMessageUnRead();		
				
		return $this->render('AdminBundle:Message:list.html.twig', array('messages'=>$messages,
																		 'messageUnRead'=>$messageUnRead));
	}

	public function readAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$message=$em->getRepository('ArticleBundle:Message')->find($id);
		$message->setReadMessage(1);

		$em->flush();

		return $this->redirectToRoute('admin_message_list');
	}

	public function deleteAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$message=$em->getRepository('ArticleBundle:Message')->find($id);

		$em->remove($message);
		$em->flush();

		$session->getFlashbag()->add('deleteMess','This message is deleted !');
		return $this->redirectToRoute('admin_message_list');
	}

	public function answerToAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$listAnswers=$em->getRepository('ArticleBundle:Answer')->findByMessageUser($id);
		
		$answer=new Answer();
		$form=$this->createForm(AnswerType::class, $answer);

		if($id != null)
		{
			$message=$em->getRepository('ArticleBundle:Message')->find($id);
			if($message != null)
			{
				$mailTo=$message->getMail();

				if($message != null)
				{
					$form->handleRequest($request);
					if($form->isValid() && $form->isSubmitted())
					{
						$subject=$answer->getTitle();
						$mailFrom=$message->getMail();
						$body=$answer->getMessage();
						$message->setAnsweredMessage(1);
						$message->setReadMessage(1);
						$message->addAnswer($answer);
						$answer->setDateCreated(new \DateTime());
						$answer->setMessageUser($message);

						$em->persist($answer);
						$em->flush();

						$this->get('article_bundle_service_mail')->send($subject, $body, $mailTo, $mailFrom);
						$session->getFlashbag()->add('sendMess','This message is sent !');
						return $this->redirectToRoute('admin_message_answerTo', array('id'=>$id));
					}
				}						
			}
		}

		return $this->render('AdminBundle:Message:answer.html.twig', array('message'=>$message,
																		   'listAnswers'=>$listAnswers,									   
																		   'form'=>$form->createView()));
	}
	
}