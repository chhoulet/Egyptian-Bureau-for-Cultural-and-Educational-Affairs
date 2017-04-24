<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ArticleBundle\Entity\Article;
use ArticleBundle\Form\ArticleType;
use ArticleBundle\Form\ArticleBisType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleController extends Controller
{
	public function listAction()
	{
		$em=$this->getDoctrine()->getManager();
		$articles=$em->getRepository('ArticleBundle:Article')->listArticles();

		return $this->render('AdminBundle:Article:list.html.twig', array('articles'=>$articles));
	}

	public function deleteAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$article=$em->getRepository('ArticleBundle:Article')->find($id);
		$arrayCollectionNewsletters=$article->getNewsletter();

		$listNewsletters=array();
		foreach($arrayCollectionNewsletters as $element)
		{
			array_push($listNewsletters, $element);
		}

		if($listNewsletters != null)
		{
			$titlesOfNewsletters=array();
			foreach($listNewsletters as $newsletter)
			{
				$title=$newsletter->getTitle();
				array_push($titlesOfNewsletters, $title);
			}

			$result=count($titlesOfNewsletters);			
			if($result == 1)
			{
				foreach($titlesOfNewsletters as $title)
				{
					$ti=$title;
				}				
				$session->getFlashbag()->add('deleteMessa','This article is connected at this newsletter :'.' '. $ti . ' It can\'t be deleted !');			
			}
			else
			{
				$titles=implode(",", $titlesOfNewsletters);				
				$session->getFlashbag()->add('deleteMessage','This article is connected at these newsletters :'.' '. $titles . '  It can\'t be deleted  !');								
			}
			return $this->redirectToRoute('admin_homepage ');		
		}

		$em->remove($article);
		$em->flush();

		$session->getFlashbag()->add('deleteMess','This article is deleted !');
		return $this->redirectToRoute('admin_article_list');
	}

	public function createAction(Request $request, $idOrigin)
	{	
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$affich=1;
		$article=new Article();
		$article->setOrigin($idOrigin);
		$article->setSelected(true);

		// Quand origin == 3 ou 6, creation d'Article et d'activités avec Subject complété !
		if ($idOrigin == 3 || $idOrigin == 6 || $idOrigin == 9)
		{
			$form=$this->createForm(ArticleBisType::class, $article);			
		}
		else
		{
			$form=$this->createForm(ArticleType::class, $article);
		}

		$form->handleRequest($request);
		
		if($form->isValid() && $form->isSubmitted())
		{	
			$file=$article->getPhoto();

			if($file != null)
			{
				$fileName=md5(uniqid()) . '.' . $file->guessExtension();							
				$file->move($this->getParameter('photos_directory'), $fileName);
				$article->setPhoto($fileName);				
			}

			$file1=$article->getFilename();

			if($file1 != null)
			{
				$filename1=md5(uniqid()).'.'.$file1->guessExtension();
				$file1->move($this->getParameter('photos_directory'), $filename1);
				$article->setFilename($filename1);
			}

			$article->setDateCreated(new \DateTime());						
			$em->persist($article);
			$em->flush();

			$session->getFlashbag()->add('succes', 'This article is created !');
			return $this->redirectToRoute('admin_homepage');			
		}

		if ($idOrigin == 3 || $idOrigin == 6 || $idOrigin == 9)
		{
			return $this->render('AdminBundle:Article:createBis.html.twig', 
				array('form'=>$form->createView(), 'origin'=>$idOrigin,'affich'=>$affich));
		}
		else
		{
			return $this->render('AdminBundle:Article:create.html.twig', 
				array('form'=>$form->createView(), 'origin'=>$idOrigin,'affich'=>$affich));			
		}  		
	}

	public function editArticleAction(Request $request, $id, $idOrigin)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$affich=2;
		$listArticles=$em->getRepository('ArticleBundle:Article')->findAll();
		$listIdArticles=[];
		foreach($listArticles as $article)
		{
			$idArt=$article->getId();
			$listIdArticles[]=$idArt;
		}

		if($id != null && in_array($id, $listIdArticles))
		{
			$article=$em->getRepository('ArticleBundle:Article')->find($id);
			$photo=$article->getPhoto();
			$filenameOrigin=$article->getFilename();

			// Quand origin == 3 ou 6, edition d'Article et d'activités avec Subject complété !
			if ($idOrigin == 3 || $idOrigin == 6)
			{
				$form=$this->createForm(ArticleBisType::class, $article);			
			}
			else
			{
				$form=$this->createForm(ArticleType::class, $article);
				$article->setSelected(1);
			}		

			$form->handleRequest($request);

			if($form->isValid() && $form->isSubmitted())
			{			
				$photoEdit=$article->getPhoto();
				$fileEdit=$article->getFilename();

				if($photoEdit == null)
				{
					$article->setPhoto($photo);
				}
				else
				{
					$photoName=md5(uniqid()) . '.' . $photoEdit->guessExtension();							
					$photoEdit->move($this->getParameter('photos_directory'), $photoName);
					$article->setPhoto($photoName);								
				}

				if($fileEdit == null)
				{
					$article->setFilename($filenameOrigin);
				}
				else
				{
					$filename=md5(uniqid()).'.'.$fileEdit->guessExtension();
					$fileEdit->move($this->getParameter('photos_directory'), $filename);
					$article->setFilename($filename);
				}

				$em->flush();
				
				$session->getFlashbag()->add('succes','This article has been updated with success !');
				return $this->redirectToRoute('admin_article_list');
			}

			if ($idOrigin == 3 || $idOrigin == 6)
			{
				return $this->render('AdminBundle:Article:createBis.html.twig', 
					array('form'=>$form->createView(), 'origin'=>$idOrigin,'affich'=>$affich));
			}
			else
			{
				return $this->render('AdminBundle:Article:create.html.twig', 
					array('form'=>$form->createView(), 'origin'=>$idOrigin,'affich'=>$affich));			
			}
		}
		else
		{
			throw new NotFoundHttpException("Article not found");
		}
	}
}

