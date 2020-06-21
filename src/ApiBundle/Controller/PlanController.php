<?php

namespace ApiBundle\Controller;


use AppBundle\Entity\Plan;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

/**
 * Address controller.
 *
 * @Route("plans")
 */
class PlanController extends Controller
{
    /**
     * @Rest\Get("/all")
     */
    public function indexAction()
    {
        $plans=$this->getDoctrine()->getRepository(Plan::class)->findAll();
        return $plans;
    }
}
