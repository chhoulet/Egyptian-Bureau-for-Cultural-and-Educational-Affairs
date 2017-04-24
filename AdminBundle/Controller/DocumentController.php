<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ArticleBundle\Entity\Document;
use ArticleBundle\Form\DocumentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

class DocumentController extends Controller 
{
	public function editDocAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();

		$editDoc=$em->getRepository('ArticleBundle:Document')->find($id);

		/*$file=new File($this->getParameter('documents_directory').'/'.$editDoc->getFile());
		$editDoc->setFile($file);*/
		$form=$this->createForm(DocumentType::class, $editDoc);

		$form->handleRequest($request);

		if($form->isValid() && $form->isSubmitted())
		{			
			$filename=$editDoc->getFile();
			$file=$filename->get($this->getParameter('documents_directory'), $editDoc->getName());
			$editDoc->setFile($file);

			$session->getFlashBag()->add('editDoc','This document has been updated with success !');
			return $this->redirectToRoute('admin_document_listDoc');
		}

		return $this->render('AdminBundle:Document:editDoc.html.twig', array('form'=>$form->createView()));
	}

	public function suppDocAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$suppDoc=$em->getRepository('ArticleBundle:Document')->find($id);

		$em->remove($suppDoc);
		$em->flush();
		$session->getFlashBag()->add('suppDoc','This document has been deleted with success !');
		return $this->redirectToRoute('admin_school_document', array('idStudent'=>0));
	}
}

