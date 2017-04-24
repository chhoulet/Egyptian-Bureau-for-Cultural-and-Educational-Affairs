<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ArticleBundle\Entity\Boursier;
use ArticleBundle\Form\BoursierType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class BoursierController extends Controller
{
	public function accueilAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listForms=$em->getRepository('ArticleBundle:Document')->findByPublicDoc(1);
		$listArticles=$em->getRepository("ArticleBundle:Article")->findByOrigin(9);

		return $this->render('ArticleBundle:Boursier:accueil.html.twig', 
			array('listForms'=>$listForms,
				  'listArticles'=>$listArticles));
	}	

	public function showProfilAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();		
		$user=$this->getUser();
		$boursier=null;	
		$listEvents=$em->getRepository('ArticleBundle:Event')->getEventsForBoursiers();	
		$listBoursiers=$em->getRepository('ArticleBundle:Boursier')->findAll();


		foreach($listBoursiers as $bours)
		{
			$idBoursier=$bours->getUser()->getId();

			if($idBoursier==$id)
			{			
				$boursier=$em->getRepository('ArticleBundle:Boursier')->find($bours->getId());
			}			
		}	

		if($boursier != null)
		{
			if($boursier->getUser()->getId() != $user->getId())
			{
				throw $this->createAccessDeniedException('You have no rights to reach this page');
			}			
			else
			{
				$listDocumentsByBoursier=$em->getRepository('ArticleBundle:Document')->getDocumentsByUser($user->getId());
			}	
		}

		if($boursier == null)
		{
			$affich=0;
			$boursier=new Boursier();
			$listDocumentsByBoursier=$em->getRepository('ArticleBundle:Document')->getDocumentsByUser($user->getId());

			$form=$this->createForm(BoursierType::class, $boursier);

			$form->handleRequest($request);
			
			if($form->isValid() && $form->isSubmitted())
			{   
				$user->setBoursier($boursier);
				$boursier->setUser($user);
				$em->persist($boursier);
				$em->flush();
				$affich=1;

				return $this->redirectToRoute('article_boursier_showProfil', 
					array("id"=>$user->getId(),
						  "boursier"=>$boursier,
						  "affich"=>$affich));
			}

						
			return $this->render('ArticleBundle:Boursier:showProfil.html.twig', 
				array('id'=>$id,
					  'listEvents'=>$listEvents,
					  'form'=>$form->createView(),
					  'affich'=>$affich,
					  'boursier'=>$boursier,
					  'listDocumentsByBoursier'=>$listDocumentsByBoursier));					
		}
		else
		{
			$affich=1;
			return $this->render('ArticleBundle:Boursier:showProfil.html.twig', 
			array('id'=>$id,
				  'listEvents'=>$listEvents,				  
				  'affich'=>$affich,
				  'boursier'=>$boursier,
				  'listDocumentsByBoursier'=>$listDocumentsByBoursier));
		}
	}


	public function editProfilAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$user=$this->getUser();
		$boursier=$em->getRepository('ArticleBundle:Boursier')->find($id);
		$affich=1;
		$listEvents=$em->getRepository('ArticleBundle:Event')->getEventsForBoursiers();
		$session=$request->getSession();

		$listBoursiers=$em->getRepository('ArticleBundle:Boursier')->findAll();

		if($id)
		{
			foreach($listBoursiers as $bours)
			{
				$idBoursier=$bours->getUser()->getId();

				if($idBoursier==$id)
				{			
					$boursier=$em->getRepository('ArticleBundle:Boursier')->find($bours->getId());
				}			
			}	

			if($boursier->getUser()->getId() != $user->getId())
			{
				throw $this->createAccessDeniedException('You have no rights to reach this page');
			}
			else
			{
				$boursier=$em->getRepository('ArticleBundle:Boursier')->find($id);
				$form=$this->createForm(BoursierType::class, $boursier);

				$form->handleRequest($request);
				if($form->isValid() && $form->isSubmitted())
				{
					$em->flush();

					$session->getFlashbag()->add('editboursier', 'Your profil is updated !');
					return $this->redirectToRoute('article_boursier_showProfil', 
						array('id'=>$user->getId(),
							  'listEvents'=>$listEvents,
							  'affich'=>$affich,
							  'boursier'=>$boursier));
				}

				return $this->render('ArticleBundle:Boursier:edit.html.twig', array('form'=>$form->createView(),
																					'boursier'=>$boursier));
			}			
		}
		else
		{
			throw $this->createAccessDeniedException('You have no rights to reach this page');
		}
	}	
}

