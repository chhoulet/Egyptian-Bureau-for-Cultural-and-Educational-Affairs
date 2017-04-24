<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ArticleBundle\Form\UserAdminType;
use ArticleBundle\Form\UserDocType;
use ArticleBundle\Form\DocumentType;
use ArticleBundle\Form\BoursierType;
use ArticleBundle\Form\DocumentScholarType;
use ArticleBundle\Entity\Document;
use ArticleBundle\Entity\Boursier;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use UserBundle\Repository\UserRepository;


class HomeController extends Controller
{
    public function homepageAction(Request $request)
    {
    	$em=$this->getDoctrine()->getManager();
        $session=$request->getSession();

        // Alimentation des boxes donnant des informations chiffrées
        /*$numberBooks=$em->getRepository('ArticleBundle:Book')->countBook();
        $numberBooksAvailable=$em->getRepository('ArticleBundle:Book')->countBookAvailable();
        $numberBooksUnAvailable=$em->getRepository('ArticleBundle:Book')->countBookUnAvailable();*/
        $boursiersNumber=$em->getRepository('UserBundle:User')->countBoursiers();
        $mailsNumber=$em->getRepository('ArticleBundle:Mail')->countMails();
        $studentsNumber=$em->getRepository('ArticleBundle:Student')->countStudents();

        // Comptage des messages par destinataire
        $messagesUnRead=$em->getRepository('ArticleBundle:Message')->countMessageUnRead();
        $messagesConseiller=$em->getRepository('ArticleBundle:Message')->countMessageConseiller();
        $messagesAttacheCulturel=$em->getRepository('ArticleBundle:Message')->countMessageAttacheCulturel();
        $messagesAttacheAdministratif=$em->getRepository('ArticleBundle:Message')->countMessageAttacheAdministratif();
        $messagesSecretaireAdministratif=$em->getRepository('ArticleBundle:Message')->countMessageSecretaireAdministratif();
        $messagesSchoolSecretaire=$em->getRepository('ArticleBundle:Message')->countMessageSchoolSecretaire(5);

        // Alimentation des boxes de gestion du Bureau Culturel et du Centre Culturel
        $articlesHomepage=$em->getRepository('ArticleBundle:Article')->getArticlesForActivities(6);

        /*$ArticlesForMissionCentreCulturel=$em->getRepository('ArticleBundle:Article')->getArticlesForMissionCentreCulturel();
        $ArticlesForHistoireCentreCulturel=$em->getRepository('ArticleBundle:Article')->getArticlesForHistoireCentreCulturel();
        $ActivitesCentreCulturel=$em->getRepository('ArticleBundle:Article')->getActivitesForCentreCulturel();*/

        $ArticlesForMissionBureauCulturel=$em->getRepository('ArticleBundle:Article')->getArticlesForActivities(4);
        $ArticlesForHistoireBureauCulturel=$em->getRepository('ArticleBundle:Article')->getArticlesForActivities(5);
        $ArticlesForServicesBureauCulturel=$em->getRepository('ArticleBundle:Article')->getArticlesForActivities(7);

        $ArticlesForSchoolActivities=$em->getRepository('ArticleBundle:Article')->getArticlesForActivities(8); 
        $ArticlesForScholarTexts=$em->getRepository('ArticleBundle:Article')->getArticlesForActivities(9); 
              

        //Création du formulaire envoi de doc aux boursiers:
        $formDoc=$this->createForm(UserDocType::class);

        $formDoc->handleRequest($request);

        if($formDoc->isValid() && $formDoc->isSubmitted())
        {
            $data=$formDoc->getData();
            $document=$data['document'];
            $user=$data['username'];
            $idUser=$user->getId();

            $listUserForThisDocument[]=$document->getUser();

            $listIdUser=array();
            foreach($listUserForThisDocument as $docum)
            {                
                foreach($docum as $idUserDocument)
                {
                    $idUserDocu=$idUserDocument->getId();
                    array_push($listIdUser, $idUserDocu);                    
                }
            }

            if(in_array($idUser, $listIdUser))
            {
                $session->getFlashbag()->add('errDoc', $document->getName() .' has already be sent to '. ' ' . $user->getUsername() . ' and is available in his personal space.');              
                return $this->redirectToRoute('admin_homepage');
            }
            else
            {
                $document->addUser($user);              
                $em->flush();

                $session->getFlashbag()->add('addDoc', $document->getName() .' has been sent '. ' ' . $user->getUsername() . ' and is available in his personal space.');
                return $this->redirectToRoute('admin_homepage');            
            }
        }

        return $this->render('AdminBundle:Homepage:homepage.html.twig', 
             array('messagesUnRead'=>$messagesUnRead,
                   'messagesConseiller'=>$messagesConseiller,
                   'messagesAttacheCulturel'=>$messagesAttacheCulturel,
                   'messagesAttacheAdministratif'=>$messagesAttacheAdministratif,
                   'messagesSecretaireAdministratif'=>$messagesSecretaireAdministratif,
                   'messagesSchoolSecretaire'=>$messagesSchoolSecretaire,
                   'boursiersNumber'=>$boursiersNumber,
                   'mailsNumber'=>$mailsNumber,
                   'studentsNumber'=>$studentsNumber,
                   'articlesHomepage'=>$articlesHomepage,                  
                   'ArticlesForMissionBureauCulturel' =>$ArticlesForMissionBureauCulturel,
                   'ArticlesForHistoireBureauCulturel'=>$ArticlesForHistoireBureauCulturel,
                   'ArticlesForServicesBureauCulturel'=>$ArticlesForServicesBureauCulturel,
                   'ArticlesForSchoolActivities'      =>$ArticlesForSchoolActivities,
                   'ArticlesForScholarTexts'          =>$ArticlesForScholarTexts,
                   'formDoc'=>$formDoc->createView()));
    }

    public function managementAction(Request $request)
    {   
        $em=$this->getDoctrine()->getManager();
        $session=$request->getSession();
        $listUsers=$em->getRepository('UserBundle:User')->findAll();

        // Sélection des users pour apparition dans tableau
        $listBoursiers=[];
        
        foreach($listUsers as $user)
        {
            $roles=$user->getRoles();      
           
            if($roles ==(array('ROLE_USER')) && 
               $roles !=(array('ROLE_SUPER_ADMIN')) &&
               $roles !=(array('ROLE_EDITOR')) &&
               $roles !=(array('ROLE_MANAGEMENT')) &&
               $roles !=(array('ROLE_ADMIN')))
            {
               $listBoursiers[]=$user;
            }
        }
        //
       
        //Création du formulaire envoi de doc à un boursier:
        $formDoc=$this->createForm(UserDocType::class);        

        $formDoc->handleRequest($request);

        if($formDoc->isValid() && $formDoc->isSubmitted())
        {
          //Récupération des données du formulaire
            $data=$formDoc->getData();                 
            $description=$data['description'];
            $name=$data['name'];
            $user=$data['username'];            
            $file=$data['file'];

            //Instanciation et hydratation de l'objet Document
            $document=new Document();
            $document->setName($name)
                     ->setDescription($description)
                     ->addUser($user);
            
            //Traitement du file
            $filename=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('documents_directory'), $filename);
            $document->setfile($filename);

            //Set de l'attribut publicDoc et flush()                
            $document->setPublicDoc(2);

            $em->persist($document);
            $em->flush();

            $subject='A document has been sent to you by the Cultural Office of the Egypt Embassy.';
            $body=$document->getName() .' is available in your personal space.
             You can read it now.
             By wishing you good reception,
             Cultural Office of the Egypt Embassy';
            $mailTo=$user->getEmail();
            $mailAmbassade='contact@bureauculturel.fr';
            $mailFrom=$mailAmbassade;

            $this->get('article_bundle_service_mail')->send($subject, $body, $mailTo, $mailFrom);

            $session->getFlashbag()->add('addDoc', $document->getName() .' is sent to '. ' ' . $user->getUsername() . ' and is available in his personal space. An email has been sent to him.');
            return $this->redirectToRoute('admin_management_boursiers', array('idBoursier'=>0));            
        }

        $document=new Document();
        $form=$this->createForm(DocumentScholarType::class, $document);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $file=$document->getFile();
            $filename=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('documents_directory'), $filename);
            $document->setFile($filename);
            $document->setPublicDoc(1);

            $em->persist($document);
            $em->flush();

            $session->getFlashBag()->add('alldoc', $document->getName(). ' has been uploaded on the website successfully !');
            return $this->redirectToRoute('admin_management_boursiers', array('idBoursier'=>0));  
        }

        return $this->render('AdminBundle:Homepage:management.html.twig', 
            array('formDoc'=>$formDoc->createView(),                  
                  'form'=>$form->createView(),                  
                  'listBoursiers'=>$listBoursiers));
    }

    public function deleteBoursierAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$request->getSession();

        $listBoursiers=$em->getRepository('ArticleBundle:Boursier')->findAll();

        if($id)
        {
            $listIdBoursiers=[];
            foreach($listBoursiers as $boursier)
            {
                $idB=$boursier->getId();
                $listIdBoursiers[]=$idB;
            }

            if(in_array($id, $listIdBoursiers))
            {
                $deletedBoursier=$em->getRepository('ArticleBundle:Boursier')->find($id);
                $userBoursier=$deletedBoursier->getUser();

                $em->remove($deletedBoursier);
                $em->remove($userBoursier);
                $em->flush();

                $session->getFlashBag()->add('deletedBoursier','This scholar is deleted from the database !');
                return $this->redirectToRoute('admin_management_boursiers');            
            }
            else
            {
                throw new NotFoundHttpException("Scholar not found");
            }
        }
        else
        {
            throw new NotFoundHttpException("Scholar not found");
        }
    }

    public function rightsAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$request->getSession();
        $listUsers=$em->getRepository('UserBundle:User')->findAll();

        $listAdmins=[];
        foreach($listUsers as $user)
        {
          $roles=$user->getRoles();
            if($roles != (array('ROLE_USER')))
            {
                $listAdmins[]=$user;
            }
        }

         //Création du formulaire donnant des droits d'Admin:
        $form=$this->createForm(UserAdminType::class);
        $form->handleRequest($request);

        if($form->isValid() && $form ->isSubmitted())
        {
          $data=$form->getData();
          $user=$data['username'];
          $roleForm=$data['role'];
          $rolesUser=$user->getRoles();

            if ($form->get('unSubscribe')->isClicked())
            {
                $roles=$user->getRoles();
                foreach($roles as $role)
                {
                  $user->removeRole($role);                  
                }
                $user->addRole('ROLE_USER');
                $em->flush();

                $this->get('session')->getFlashbag()->add('userDel', $user->getUsername(). ' can not manage the web site any more !');
                return $this->redirectToRoute('admin_management_rights');
            }
            else
            {
                if($roleForm == 1)
                {
                    if(in_array('ROLE_ADMIN', $rolesUser))      
                    {
                       $this->get('session')->getFlashbag()->add('userRights',$user->getUsername(). ' has already the admin rights !');
                       return $this->redirectToRoute('admin_management_rights');
                    }
                    else
                    {
                      $user->setRoles(array('ROLE_ADMIN'));         
                      $em->flush();

                      $this->get('session')->getFlashbag()->add('userAd',$user->getUsername(). ' has now the admin rights !');
                      return $this->redirectToRoute('admin_management_rights');            
                    }                 
                }
                elseif($roleForm == 2)
                {
                    if(in_array('ROLE_EDITOR', $rolesUser))
                    {
                       $this->get('session')->getFlashbag()->add('userRights',$user->getUsername(). ' has already the editor rights !');
                       return $this->redirectToRoute('admin_management_rights');
                    }
                    else
                    {
                        $user->setRoles(array('ROLE_EDITOR'));         
                        $em->flush();

                        $this->get('session')->getFlashbag()->add('userAd',$user->getUsername(). ' has now the editor rights !');
                        return $this->redirectToRoute('admin_management_rights');
                    }
                }
                elseif($roleForm == 3)
                {
                    if(in_array('ROLE_MANAGEMENT', $rolesUser))
                    {
                        $this->get('session')->getFlashbag()->add('userRights',$user->getUsername(). ' has already the management rights !');
                        return $this->redirectToRoute('admin_management_rights');
                    }
                    else
                    {
                        $user->setRoles(array('ROLE_MANAGEMENT'));         
                        $em->flush();

                        $this->get('session')->getFlashbag()->add('userAd',$user->getUsername(). ' has now the management rights !');
                        return $this->redirectToRoute('admin_management_rights');
                    }
                }
            }          
        }

        return $this->render('AdminBundle:Homepage:rights.html.twig', 
            array('listUsers'=>$listAdmins, 
                  'form'=>$form->createView()));

    }
}
