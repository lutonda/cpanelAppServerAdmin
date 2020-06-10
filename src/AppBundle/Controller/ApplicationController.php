<?php

namespace AppBundle\Controller;

use AppBundle\Application\FileUploader;
use AppBundle\Entity\Application;
use AppBundle\Application\Application as App;
use AppBundle\Entity\Client;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Application controller.
 *
 * @Route("application")
 */
class ApplicationController extends Controller
{
    /**
     * Lists all application entities.
     *
     * @Route("/", name="application_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $applications = $em->getRepository('AppBundle:Application')->findAll();

        return $this->render('application/index.html.twig', array(
            'applications' => $applications,
        ));
    }

    /**
     * Creates a new application entity.
     *
     * @Route("/new", name="application_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        $application = new Application();
        $form = $this->createForm('AppBundle\Form\ApplicationType', $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $application->setDomain($application->getAppKey().'.nova-erp.com');
            $client=$em->getRepository(Client::class)->findOneBy(['email'=>$application->getClient()->getEmail()]);
            if(!is_null($client))
                $application->setClient($client);
            $em->persist($application);
            $em->flush();
            print_r('<style>*{color: #96ffe9; font-size: 14px; font-family: Arial, Helvetica, sans-serif; background: #000}</style><div style="text-align: center"><img style="margin: 5%" src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/b6e0b072897469.5bf6e79950d23.gif"/><h1>I N S T A L I N G . . . </h1></div>');
            $path = App::build($application->getAppKey());

            $application->setPath($path);
            $em->flush();
            print_r('<a href="'.$this->generateUrl('payment_new', array('id' => $application->getId())).'">Click here to go to the next Step</a>');
            return $this->redirectToRoute('payment_new', array('id' => $application->getId()));
        }

        return $this->render('application/new.html.twig', array(
            'application' => $application,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a application entity.
     *
     * @Route("/{id}", name="application_show")
     * @Method("GET")
     */
    public function showAction(Application $application)
    {
        $deleteForm = $this->createDeleteForm($application);

        $source_app=$this->getParameter('paths')['source_app'];
        
        return $this->render('application/show.html.twig', array(
            'application' => $application,
            'version'=>App::currentVersion($application->getAppKey()),
            'rootVersion'=>App::lastesVersion(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a application entity.
     *
     * @Route("/{id}/logo/upload", name="application_logo_upload")
     * @Method("POST")
     */
    public function logoUploadAction(Application $application, Request $request, FileUploader $uploader, LoggerInterface $logger)
    {

        $file=$request->files->get('image');
        $uploader->upload($application->getPath().'/img/logo', $file, 'logo.png');

        return $this->redirect($this->generateUrl('application_show',['id'=>$application->getId()]));
    }

    /**
     * Finds and displays a application entity.
     *
     * @Route("/upgrade/{id}", name="application_upgrade")
     * @Method("GET")
     */
    public function upgradeAction(Application $application)
    {
        $deleteForm = $this->createDeleteForm($application);

        $source_app=$this->getParameter('paths')['source_app'];

        $version=App::currentVersion($application->getAppKey());
        $rootVersion=App::lastesVersion($application->getAppKey());
        App::upgrade($application->getAppKey());

        return $this->redirect($this->generateUrl('application_show',['id'=>$application->getId(),'upgraded'=>$version]));
    }

    /**
     * Displays a form to edit an existing application entity.
     *
     * @Route("/{id}/edit", name="application_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Application $application)
    {
        $deleteForm = $this->createDeleteForm($application);
        $editForm = $this->createForm('AppBundle\Form\ApplicationType', $application);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('application_edit', array('id' => $application->getId()));
        }

        return $this->render('application/edit.html.twig', array(
            'application' => $application,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a application entity.
     *
     * @Route("/{id}", name="application_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Application $application)
    {
        $form = $this->createDeleteForm($application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($application);
            $em->flush();
        }

        return $this->redirectToRoute('application_index');
    }

    /**
     * Creates a form to delete a application entity.
     *
     * @param Application $application The application entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Application $application)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('application_delete', array('id' => $application->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
