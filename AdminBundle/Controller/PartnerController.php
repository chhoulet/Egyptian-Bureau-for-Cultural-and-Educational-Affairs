<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ArticleBundle\Entity\Partner;
use ArticleBundle\Form\PartnerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Class PartnerController extends Controller
{
	public function listPartnerAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listPartners=$em->getRepository('ArticleBundle:Partner')->findAll();

		return $this->render('AdminBundle:Partner:listPartner.html.twig', array('listPartners'=>$listPartners));
	}

	public function createPartnerAction(Request $request)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$affich=1;
		$partner=new Partner();
		
		$form=$this->createForm(PartnerType::class, $partner);

		$form->handleRequest($request);

		if($form->isValid() && $form->isSubmitted())
		{			
			$file=$partner->getBrochure();

			if($file)
			{
				$filename=md5(uniqid()).'.'.$file->guessExtension();
				$file->move($this->getParameter('photos_directory'), $filename);
				$partner->setBrochure($filename);
			}

			$em->persist($partner);
			$em->flush();

			$session->getFlashbag()->add('succes', 'This partner is created !');
			return $this->redirectToRoute('admin_partner_list');
		}

		return $this->render('AdminBundle:Partner:create.html.twig', array('form'=>$form->createView(), 'affich'=>$affich));	
	}

	public function editPartnerAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$affich=2;
		$partner=$em->getRepository('ArticleBundle:Partner')->find($id);

		if($partner->getBrochure() != null)
		{			
			$partner->setBrochure('');
			$em->flush();
		}
		
		$form=$this->createForm(PartnerType::class, $partner);

		$form->handleRequest($request);

		if($form->isValid() && $form->isSubmitted())
		{						
			$file=$partner->getBrochure();
			if($file)
			{
				$filename=md5(uniqid()).'.'.$file->guessExtension();
				$file->move($this->getParameter('photos_directory'), $filename);
				$partner->setBrochure($filename);
			}

			$em->flush();

			$session->getFlashbag()->add('edit', 'This partner is updated !');
			return $this->redirectToRoute('admin_partner_list');
		}

		return $this->render('AdminBundle:Partner:create.html.twig', array('form'=>$form->createView(), 'affich'=>$affich));	
	}

	public function deletePartnerAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$deletedPartner=$em->getRepository('ArticleBundle:Partner')->find($id);

		$em->remove($deletedPartner);
		$em->flush();

		$session->getFlashBag()->add('deletedPartner', 'This partner is deleted !');
		return $this->redirectToRoute('admin_partner_list');
	}

	public function activePartnerAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$activePartner=$em->getRepository('ArticleBundle:Partner')->find($id);

		if($activePartner != null)
		{
			if($activePartner->getActive() == 2)
			{
				$activePartner->setActive(1);
				$em->flush();

				$session->getFlashBag()->add('activatedPartner', 'This partner is activated	!');
				return $this->redirectToRoute('admin_partner_list');
			}
			else
			{
				$session->getFlashBag()->add('activatedPartner', 'This partner is already activated	!');
				return $this->redirectToRoute('admin_partner_list');
			}
		}
		else
		{
			throw new NotFoundHttpException("This partner doesn't exist !");
		}
	}

	public function desactivePartnerAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$desactivePartner=$em->getRepository('ArticleBundle:Partner')->find($id);

		if($desactivePartner != null)
		{
			if($desactivePartner->getActive() == 1)
			{
				$desactivePartner->setActive(2);
				$em->flush();

				$session->getFlashBag()->add('desactivatedPartner', 'This partner is desactivated !');
				return $this->redirectToRoute('admin_partner_list');
			}
			else
			{
				$session->getFlashBag()->add('activatedPartner', 'This partner is already desactivated	!');
				return $this->redirectToRoute('admin_partner_list');
			}
		}
		else
		{
			throw new NotFoundHttpException("This partner doesn't exist !");
		}
	}
}
