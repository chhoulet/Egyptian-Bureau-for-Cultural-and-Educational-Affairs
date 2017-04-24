<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ArticleBundle\Entity\Book;
use ArticleBundle\Form\BookType;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
	public function listAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listBooks=$em->getRepository('ArticleBundle:Book')->findAll();
	
		return $this->render('AdminBundle:Book:list.html.twig', array('listBooks'=>$listBooks));		
	}

	public function createAction(Request $request)
	{
		$em=$this->getDoctrine()->getManager();
		$affich=2;
		$book= new Book();
		$session=$request->getSession();
	
		$form= $this->createForm(BookType::class, $book);

		$form->handleRequest($request);

		if($form->isValid() && $form->isSubmitted())
		{
			$em->persist($book);
			$em->flush();

			$session->getFlashBag()->add('succesCreaBook', 'This book is added to the list !');
			return $this->redirectToRoute('admin_book_list');
		}

		return $this->render('AdminBundle:Book:create.html.twig', array('form'=>$form->createView(),'affich'=>$affich));
	}

	public function deleteBookAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$bookDeleted = $em->getRepository('ArticleBundle:Book')->find($id);
		$session=$request->getSession();

		$em->remove($bookDeleted);
		$em->flush();
		$session->getFlashBag()->add('succesDeletion', 'This book is deleted !');
		
		return $this->redirectToRoute('admin_book_list');		
	}

	public function updateBookAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$affich=1;
		$book= $em->getRepository('ArticleBundle:Book')->find($id);
		$session=$request->getSession();
	
		$form= $this->createForm(BookType::class, $book);

		$form->handleRequest($request);

		if($form->isValid() && $form->isSubmitted())
		{			
			$em->flush();

			$session->getFlashBag()->add('succesUpdateBook', 'This book is updated !');
			return $this->redirectToRoute('admin_book_list');
		}

		return $this->render('AdminBundle:Book:create.html.twig', array('form'=>$form->createView(),'affich'=>$affich));
	}
}



