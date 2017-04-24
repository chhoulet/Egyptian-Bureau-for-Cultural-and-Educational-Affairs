<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ArticleBundle\Entity\Counseillor;
use ArticleBundle\Form\CounseillorType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CounseillorController extends Controller
{
	public function listAction($origin)
	{
		$em=$this->getDoctrine()->getManager();

		if($origin == 1)
		{
			$listCounseillors=$em->getRepository('ArticleBundle:Counseillor')->findAll();			
		}
		else
		{
			$listCounseillors=$em->getRepository('ArticleBundle:Counseillor')->findBy(
				array('active'=>false,
				      'hierarchicLevel'=>1));
		}

		return $this->render('AdminBundle:Counseillor:list.html.twig', 
			array('listCounseillors'=>$listCounseillors,
				  'origin'          =>$origin));
	}

	public function createAction(Request $request)
	{
		$em=$this->getDoctrine()->getManager();
		$counseillor=new Counseillor();
		$session=$request->getSession();
		$form=$this->createForm(CounseillorType::class, $counseillor);
		$affich=0;

		$form->handleRequest($request);

		if($form->isValid() && $form->isSubmitted())
		{			
			$file=$counseillor->getImage();

			if($file != null)
			{
				$imageName=md5(uniqid()).'.'. $file->guessExtension();								
				$file->move($this->getParameter('photos_directory'),$imageName);
				$counseillor->setImage($imageName);
			}

			$em->persist($counseillor);
			$em->flush();

			$session->getFlashBag()->add('counseillor', $counseillor->getName() . ' ' . $counseillor->getFirstName() . ' is added to the list !');
			return $this->redirectToRoute('admin_homepage');
		}

		return $this->render('AdminBundle:Counseillor:create.html.twig', array('form'=>$form->createView(), 'affich' => $affich));
	}

	public function editAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$affich=1;		
		$counseillor=$em->getRepository('ArticleBundle:Counseillor')->find($id);
		$filename=$counseillor->getImage();

		$form=$this->createForm(CounseillorType::class, $counseillor);

		$form->handleRequest($request);

		if($form->isValid() && $form->isSubmitted())
		{				
			$file=$counseillor->getImage();			
			
			if($file != null)
			{
				$imageName=md5(uniqid()).'.'. $file->guessExtension();								
				$file->move($this->getParameter('photos_directory'),$imageName);
				$counseillor->setImage($imageName);				
			}
			else
			{
				$counseillor->setImage($filename);				
			}

			$counseillor->setUpdatedAt(new \DateTime());
			$em->flush();

			$session->getFlashBag()->add('editCounseillor', 'M-Mme '. $counseillor->getName() . ' ' . $counseillor->getFirstName() . ' is updated with success !');
			return $this->redirectToRoute('admin_counseillor_list', array('origin'=>1));
		}

		return $this->render('AdminBundle:Counseillor:create.html.twig', 
			array('form'=>$form->createView(), 
				  'affich' => $affich,
				  'counseillor'=>$counseillor));
	}

	public function deleteAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$deleteCounseillor=$em->getRepository('ArticleBundle:Counseillor')->find($id);

		if($deleteCounseillor != null)
		{
			$em->remove($deleteCounseillor);
			$em->flush();			
			$session->getFlashBag()->add('deleteCounseillor', 'This counseillor has been deleted of the database !');
		}
		else{
			throw new NotFoundHttpException("Counseillor not existing !");
		}	

		return $this->redirectToRoute('admin_counseillor_list', array('origin'=>1));
	}

	public function desactivateAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$desactivateCounseillor=$em->getRepository('ArticleBundle:Counseillor')->find($id);

		if($desactivateCounseillor != null)
		{
			if($desactivateCounseillor->getActive() == 1)
			{
				$desactivateCounseillor->setActive(0);
				$em->flush();			
				$session->getFlashBag()->add('desactivateCounseillor', 'This counseillor has been desactivated !');				
			}
			else
			{
				$session->getFlashBag()->add('desactivatedCounseillor', 'This counseillor has already been desactivated !');
			}
		}
		else{
			throw new NotFoundHttpException("Counseillor not existing !");
		}

		return $this->redirectToRoute('admin_counseillor_list', array('origin'=>1));
	}

	public function activateAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$activateCounseillor=$em->getRepository('ArticleBundle:Counseillor')->find($id);

		if($activateCounseillor != null)
		{
			if($activateCounseillor->getActive() == 0)
			{
				$activateCounseillor->setActive(1);
				$em->flush();			
				$session->getFlashBag()->add('activateCounseillor', 'This counseillor has been activated !');				
			}
			else
			{
				$session->getFlashBag()->add('activateDCounseillor', 'This counseillor is already activated !');
			}
		}
		else{
			throw new NotFoundHttpException("Counseillor not existing !");
		}

		return $this->redirectToRoute('admin_counseillor_list', array('origin'=>1));
	}
}

