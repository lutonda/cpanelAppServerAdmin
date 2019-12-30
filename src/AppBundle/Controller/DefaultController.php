<?php

namespace AppBundle\Controller;

use AppBundle\Application\Application as App;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Yaml\Yaml;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        
        $source_app=__DIR__.'/../../..';//$this->getParameter('paths')['source_app'];
        $file=Yaml::parse(file_get_contents($source_app . '/app/config/config.yml'));
        
        $sysInfo=(new App())->sysInformation();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'sysinfo'=>$sysInfo,
            'datas'=>$sysInfo->data,
            'version'=>$file['twig']['globals']['version'],
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
}
