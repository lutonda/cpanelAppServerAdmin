<?php

namespace AppBundle\Controller;

use AppBundle\Application\Application as App;
use AppBundle\Entity\Plan;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $source_app=$this->getParameter('paths')['source_app'];

        $sysInfo=(new App())->sysInformation();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'sysinfo'=>$sysInfo,
            'datas'=>$sysInfo->data,
            'version'=>App::lastesVersion(),
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/logout")
     * @throws \RuntimeException
     */
    public function logoutAction(){
        throw new \RuntimeException("logout");
    }
    /**
     * @Route("/sys/upgrade")
     */
    public function sysUpgradeAction(){
        return new Response(json_encode(App::upgrade()),200,['Content-Type'=>' application/json']);

    }


    /**
     * @Rest\Get("/Api/V1/plans")
     */
    public function apiPlansAction(){

        $final=$this->getDoctrine()->getRepository(Plan::class)->findAll();
        return $final;

    }
}
