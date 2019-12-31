<?php

namespace AppBundle\Controller;

use AppBundle\Application\Application as App;
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
            'version'=>App::appVersion($source_app,'nova/app','version'),
            'build'=>App::appVersion($source_app,'nova/app','build'),
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
        var_dump('inside');
        $final=json_encode(App::upgrade());
        var_dump($final);
        return new Response($final);
    }
}
