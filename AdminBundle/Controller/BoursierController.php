<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ArticleBundle\Entity\Event;
use ArticleBundle\Form\EventType;
use ArticleBundle\Form\BoursierType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


Class BoursierController extends Controller
{
	public function createEventAction(Request $request)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$affich=1;		
		$eventBoursier=new Event();
		$form=$this->createForm(EventType::class, $eventBoursier);

		$form->handleRequest($request);

		if($form->isValid() && $form->isSubmitted())
		{
			$eventBoursier->setBoursier(true);
			$em->persist($eventBoursier);
			$em->flush();

			$listBoursiers=$em->getRepository('UserBundle:User')->findAll();

			$listMails=array();
			foreach($listBoursiers as $boursier)
			{
				$mail=$boursier->getEmail();
				$listMails[]=$mail;
			}
			$listMailsUniq=array_unique($listMails);
						
			$subject=$eventBoursier->getName();
			$mailFrom="example@gmail.com";			
			$body="An event has been just created for you by the Cultural Bureau of the Egyptian Ambassy. Please see details in your personal space on our website !";

			foreach($listMailsUniq as $mailTo)
			{
				$this->get('article_bundle_service_mail')->send($subject, $body, $mailTo, $mailFrom);				
			}

			return $this->redirectToRoute('admin_boursier_event_listEvent');
		}

		return $this->render('AdminBundle:Boursier:createEvent.html.twig', array('form'=>$form->createView(), 'affich'=>$affich));
	}

	public function listEventAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listEvents=$em->getRepository('ArticleBundle:Event')->findAll();

		return $this->render('AdminBundle:Boursier:listEvent.html.twig', array('listEvents'=>$listEvents));
	}

	public function deleteEventAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$deletedEvent=$em->getRepository('ArticleBundle:Event')->find($id);

		$em->remove($deletedEvent);
		$em->flush();

		$session->getFlashBag()->add('deleteEvent', 'This event is deleted !');
		return $this->redirectToRoute('admin_boursier_event_listEvent');
	}

	public function editEventAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$affich=2;
		$editedEvent=$em->getRepository('ArticleBundle:Event')->find($id);
		$form=$this->createForm(EventType::class, $editedEvent);

		$form->handleRequest($request);

		if($form->isValid() && $form->isSubmitted())
		{			
			$em->flush();

			return $this->redirectToRoute('admin_boursier_event_listEvent');
		}

		return $this->render('AdminBundle:Boursier:createEvent.html.twig', 
			array('form'=>$form->createView(), 'affich'=>$affich));
	}

	public function desactivateAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();

		$listBoursiers=$em->getRepository('ArticleBundle:Boursier')->findByActivated(1);
		$listIdBoursiers=[];
		foreach($listBoursiers as $boursier)
		{
			$idBoursier=$boursier->getId();
			$listIdBoursiers[]=$idBoursier;
		}

		if($id)
		{
			if(in_array($id,$listIdBoursiers))
			{
				$desactivate=$em->getRepository('ArticleBundle:Boursier')->find($id);
			
				$desactivate->setActivated(0);
				$em->flush();

				$session->getFlashBag()->add('desactivate', 'This scholar has been activated !');
				return $this->redirectToRoute('admin_management_boursiers');			
			}
			else
			{
				throw new NotFoundHttpException("This scholar is not desactivated !");
			}
		}		
		else
		{
			throw new NotFoundHttpException("This scholar doesn't exist !");
		}
	}

	public function activateAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();

		$listBoursiers=$em->getRepository('ArticleBundle:Boursier')->findByActivated(0);
		$listIdBoursiers=[];
		foreach($listBoursiers as $boursier)
		{
			$idBoursier=$boursier->getId();
			$listIdBoursiers[]=$idBoursier;
		}

		if($id)
		{
			if(in_array($id,$listIdBoursiers))
			{
				$desactivate=$em->getRepository('ArticleBundle:Boursier')->find($id);
			
				$desactivate->setActivated(1);
				$em->flush();

				$session->getFlashBag()->add('desactivate', 'This scholar has been activated !');
				return $this->redirectToRoute('admin_management_boursiers');			
			}
			else
			{
				throw new NotFoundHttpException("This scholar is not desactivated !");
			}
		}		
		else
		{
			throw new NotFoundHttpException("This scholar doesn't exist !");
		}
	}

	public function updateAction(Request $request, $idBoursier)
	{
		$em=$this->getDoctrine()->getManager();		
		$session=$request->getSession();

        if($idBoursier != 0)
        {
        	$listBours=$em->getRepository('ArticleBundle:Boursier')->findAll();
	        $listIdBours=[];
	        foreach($listBours as $boursier)
	        {
	            $id=$boursier->getId();
	            $listIdBours[]=$id;
	        }

            if(in_array($idBoursier, $listIdBours))
            {
              $boursier=$em->getRepository('ArticleBundle:Boursier')->find($idBoursier);
            }
            else
            {
                throw new NotFoundHttpException("Scholar not found");
            }
        }
        else
        {
        	throw new NotFoundHttpException("This scholar doesn't exist !");
        }       

        $formBoursier=$this->createForm(BoursierType::class, $boursier);
        $formBoursier->handleRequest($request);

        if($formBoursier ->isSubmitted() && $formBoursier->isValid())
        {
            $em->flush();

            $session->getFlashbag()->add('editBoursier', $boursier->getFullName() .' is updated !');
            return $this->redirectToRoute('admin_management_boursiers', array('idBoursier' => 0));
        }
        
        return $this->render('AdminBundle:Boursier:update.html.twig',
        	array('form'=>$formBoursier->createView(),
        		  'boursier'    =>$boursier));
	}
}