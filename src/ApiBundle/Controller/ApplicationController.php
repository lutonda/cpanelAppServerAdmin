<?php

namespace ApiBundle\Controller;


use AppBundle\Application\Application as App;
use AppBundle\Application\FTP;
use AppBundle\Entity\Application;
use AppBundle\Entity\Client;
use AppBundle\Entity\Plan;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

/**
 * Address controller.
 *
 * @Route("application")
 */
class ApplicationController extends Controller
{
    /**
     * @Rest\Get("/all")
     */
    public function indexAction()
    {
        $plans = $this->getDoctrine()->getRepository(Plan::class)->findAll();
        return $plans;
    }

    /**
     * @Rest\Post("/new")
     */
    public function newAction(Request $request)
    {

        $r=$request->getClientIp();
        $em = $this->getDoctrine()->getManager();
        /**
         * @var Application $application
         */
        $application = cast(Application::class, toObject($request->get('application')));
        $application->setClient(cast(Client::class,$application->getClient()));
        $application->setAppKey($application->getAppKey() . '.free');
        $application->setDomain($application->getAppKey() .'.'. (new App())->rootdomain);
        $client = $em->getRepository(Client::class)->findOneBy(['email' => $application->getClient()->getEmail()]);

        if (!is_null($client))
            $application->setClient($client);

        $application->setPath((new FTP())->appPathName($application->getAppKey()));
        $em->persist($application);
        $em->flush();

        $path = App::build($application->getAppKey());

        //return $this->redirectToRoute('payment_new', array('id' => $application->getId()));
        $application->setName($application->getName().'|'.$r);
        return $application;

    }
}
