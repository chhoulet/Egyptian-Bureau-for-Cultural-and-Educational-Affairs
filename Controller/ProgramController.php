<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ArticleBundle\Entity\Program;
use ArticleBundle\Entity\Event;
use ArticleBundle\Form\ProgramType;
use Symfony\Component\HttpFoundation\Request;

class ProgramController extends Controller
{
	public function createAction(Request $request)
	{
		$em=$this->getDoctrine()->getManager();
		$program=new Program();

		/*$event=new Event();
		$event->setName('concert');
		$event->setDateEvent(new \DateTime());
		$event->setDescription('Test Creation');
		$event->setPlace('Paris');

		$event1=new Event();
		$event1->setName('colloque');
		$event1->setDateEvent(new \DateTime());
		$event1->setDescription('Test Creation Formulaires');
		$event1->setPlace('Lyon');

		$program->addEvent($event);
		$program->addEvent($event1);*/

/*var_dump($event, $event1);die;*/
		$form=$this->createForm(ProgramType::class, $program);

		$form->handleRequest($request);

		if($form->isValid() && $form->isSubmitted())
		{
			/*$event->setProgram($program);
			$event1->setProgram($program);*/
			$em->persist($program);
			/*$em->persist($event);
			$em->persist($event1);*/

			$em->flush();

			return $this->redirectToRoute('article_homepage');
		}

		return $this->render('ArticleBundle:Program:create.html.twig', array('form'=>$form->createView()));
	}
}