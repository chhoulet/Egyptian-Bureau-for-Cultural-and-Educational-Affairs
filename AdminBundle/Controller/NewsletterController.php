<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use ArticleBundle\Entity\Newsletter;
use ArticleBundle\Form\NewsletterType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class NewsletterController extends Controller
{    
    public function createNewsAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $listNewsletters=$em->getRepository('ArticleBundle:Newsletter')->getNewslettersByDate();
        $session=$request->getSession();       
        $newsletter=new Newsletter();
        $date=new \DateTime();
        $dateCreated=$date->format('d-m-Y');        
        $form=$this->createForm(NewsletterType::class, $newsletter);

        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted())
        {
            $data=$form->getData();
            $articles=$data->getArticle();
            
            foreach($articles as $article)
            {
                $article->addNewsletter($newsletter);
            }
            $newsletter->setDateCreated($dateCreated);
            $em->persist($newsletter);
            
            $em->flush();

            $session->getFlashbag()->add('newsletter', 'This newsletter'.' '. $newsletter->getTitle() . ' has been created with success !');
            return $this->redirectToRoute('admin_newsletter_create');
        }

        return $this->render('AdminBundle:Newsletter:createNews.html.twig', 
            array('form'=>$form->createView(),
                  'listNewsletters'=>$listNewsletters,
                  'dateCreated'=>$dateCreated));
    }   

	public function sendNewsAction(Request $request, $id, $origin=null)
	{
        $em=$this->getDoctrine()->getManager();
        $session=$request->getSession();
        $newsletter=$em->getRepository('ArticleBundle:Newsletter')->find($id);
        $date=new \DateTime();
        $monthY=$date->format('m-Y');

        $subject="Newsletter of the month : ". $monthY;
        $mailFrom="contact@bureauculturel.fr";//Email factice, de test          

        $body=$this->render('AdminBundle:Newsletter:preview.html.twig', array('newsletter'=>$newsletter));

        //Envoi des mails : Sélection des adresses mail et suppression des doublons
        if($origin == 1)
        {
            $listMailsToBeSend=$em->getRepository('ArticleBundle:Mail')->findByEvent(1);            
        }
        elseif ($origin == 2)
        {
            $listMailsToBeSend=$em->getRepository('ArticleBundle:Mail')->findByEvent(2);            
        }
        else
        {
            $listMailsToBeSend=$em->getRepository('ArticleBundle:Mail')->findAll();
        }        


        $result=count($listMailsToBeSend);
        if(!$listMailsToBeSend && !isset($listMailsToBeSend) && $result < 1)
        {     
            throw new NotFoundHttpException("No email adress recorded !");            
        }    
              
        foreach($listMailsToBeSend as $mail)
        {                      
            $mailTo=$mail->getMail();
            $this->get('article_bundle_service_mail')->send($subject, $body, $mailTo, $mailFrom);
        }       

        $newsletter->setDateSended(new \DateTime());
        $em->flush();
        $session->getFlashBag()
             ->add(
        'notice',
        'Your newsletter is successfully sended !'
        );                

        
        return $this->redirectToRoute('admin_newsletter_create');
	}

    public function editNewsAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$request->getSession();
        $editedNews=$em->getRepository('ArticleBundle:Newsletter')->find($id);
        $form=$this->createForm(NewsletterType::class, $editedNews);

        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted())
        {
            $data=$form->getData();
            $articles=$data->getArticle();
            
            foreach($articles as $article)
            {
                $article->addNewsletter($editedNews);
            }
                                    
            $em->flush();

            $session->getFlashbag()->add('editedNews','This newsletter : '. $editedNews->getTitle() . 'is updated !');
            return $this->redirectToRoute('admin_newsletter_create');
        }

        return $this->render('AdminBundle:Newsletter:editNews.html.twig', array('form'=>$form->createView()));
    }

    public function deleteNewsAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$request->getSession();
        $deletedNews=$em->getRepository('ArticleBundle:Newsletter')->find($id);
        $articlesOfdeletedNews=$deletedNews->getArticle();        

        foreach($articlesOfdeletedNews as $article)
        {                                               
            $article->removeNewsletter($deletedNews);
        }

        $em->remove($deletedNews);
        $em->flush();

        $session->getFlashbag()->add('deletedNews','This newsletter is deleted !');
        return $this->redirectToRoute('admin_newsletter_create');
    }

    public function listAbonnesAction()
    {
        $em=$this->getDoctrine()->getManager();
        $listAbo=$em->getRepository('ArticleBundle:Mail')->findAll();

        return $this->render('AdminBundle:Newsletter:listAbonnes.html.twig', 
            array('listAbo'=>$listAbo));
    }

    public function desactivateAction(Request $request, $idAbonne)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$request->getSession();
        $listAbonnes=$em->getRepository('ArticleBundle:Mail')->findByActive(1);
        $listIdAbonnes=[];

        foreach($listAbonnes as $abonne)
        {
            $id=$abonne->getId();
            $listIdAbonnes[]=$id;
        }

        if($idAbonne) 
        {
            if(in_array($idAbonne, $listIdAbonnes))
            {
                $abonne=$em->getRepository('ArticleBundle:Mail')->find($idAbonne);
                $abonne->setActive(2);
                $em->flush();

                $session->getFlashbag()->add('desac', 'This email adress : ' . $abonne->getMail() .' is desactivated !');
                return $this->redirect($this->generateUrl('admin_newsletter_listAbonnes'));                
            }
            else
            {
                throw new NotFoundHttpException("No email adress recorded !");
            }
        }
        else
        {
            throw new NotFoundHttpException("No email adress recorded !");
        }
    }

    public function activateAction(Request $request, $idAbonne)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$request->getSession();
        $listAbonnes=$em->getRepository('ArticleBundle:Mail')->findByActive(2);
        $listIdAbonnes=[];

        foreach($listAbonnes as $abonne)
        {
            $id=$abonne->getId();
            $listIdAbonnes[]=$id;
        }

        if($idAbonne && in_array($idAbonne, $listIdAbonnes))
        {
            $abonne=$em->getRepository('ArticleBundle:Mail')->find($idAbonne);
            $abonne->setActive(1);
            $em->flush();

            $session->getFlashbag()->add('acti', 'This email adress : ' . $abonne->getMail() .' is activated !');
            return $this->redirect($this->generateUrl('admin_newsletter_listAbonnes'));
        }
        else
        {
            throw new NotFoundHttpException("No email adress recorded !");
        }
    }

    public function deleteAction(Request $request, $idAbonne)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$request->getSession();
        $listAbonnes=$em->getRepository('ArticleBundle:Mail')->findAll();
        $listIdAbonnes=[];

        foreach($listAbonnes as $abonne)
        {
            $id=$abonne->getId();
            $listIdAbonnes[]=$id;
        }

        if($idAbonne && in_array($idAbonne, $listIdAbonnes))
        {
            $deletedAbo=$em->getRepository('ArticleBundle:Mail')->find($idAbonne);
            $em->remove($deletedAbo);
            $em->flush();

            $session->getFlashbag()->add('deletedMail', 'This mail adress is deleted !');
            return $this->redirectToRoute('admin_newsletter_listAbonnes');
        }
        else
        {
            throw new NotFoundHttpException("No email adress recorded !");
        }
    }

    public function previewAction($idNew)
    {
        $em=$this->getDoctrine()->getManager();

        $listNewsletters=$em->getRepository('ArticleBundle:Newsletter')->findAll();

        if($idNew)
        {
            $listIdNews=[];
            foreach($listNewsletters as $newsletter)
            {
                $id=$newsletter->getId();
                $listIdNews[]=$id;
            }

            if(in_array($idNew, $listIdNews))            
            {
                $newsletter=$em->getRepository('ArticleBundle:Newsletter')->find($idNew);
                return $this->render('AdminBundle:Newsletter:preview.html.twig', 
                    array('newsletter'=>$newsletter));
            }
            else
            {
                throw new NotFoundHttpException("No newsletter found !");
            }
        }
        else
        {
            throw new NotFoundHttpException("No newsletter found !");
        }
    }
}