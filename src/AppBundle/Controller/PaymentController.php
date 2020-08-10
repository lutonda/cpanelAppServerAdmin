<?php

namespace AppBundle\Controller;

use AppBundle\Application\Application as App;
use AppBundle\Entity\Application;
use AppBundle\Entity\Payment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Payment controller.
 *
 * @Route("payment")
 */
class PaymentController extends Controller
{
    /**
     * Lists all payment entities.
     *
     * @Route("/", name="payment_index", methods={"GET"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $payments = $em->getRepository('AppBundle:Payment')->findAll();

        return $this->render('payment/index.html.twig', array(
            'payments' => $payments,
        ));
    }

    /**
     * Creates a new payment entity.
     *
     * @Route("/new/{id}", name="payment_new", methods={"GET", "POST"})
     */
    public function newAction(Application $application,Request $request)
    {
        $payment = new Payment();
        $form = $this->createForm('AppBundle\Form\PaymentType', $payment);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $payment->setApplication($application);
        if ($form->isSubmitted() && $form->isValid()) {
            $payment->setLicense();
            $em->persist($payment);
            $em->flush();

            return $this->redirectToRoute('application_show', array('id' => $application->getId()));
        }

        return $this->render('payment/new.html.twig', array(
            'payment' => $payment,
            'form' => $form->createView(),
        ));
    }
    /**
     * Creates a new payment entity.
     *
     * @Route("/refresh/{id}", name="payment_refresh", methods={"GET"})
     */
    public function refreshAction(Payment $payment,Request $request)
    {
        App::sendLicense($payment);
        return $this->redirectToRoute('application_show', array('id' => $payment->getApplication()->getId()));
    }

    /**
     * Finds and displays a payment entity.
     *
     * @Route("/{id}", name="payment_show",methods={"GET"})
     */
    public function showAction(Payment $payment)
    {
        $deleteForm = $this->createDeleteForm($payment);

        return $this->render('payment/show.html.twig', array(
            'payment' => $payment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing payment entity.
     *
     * @Route("/{id}/edit", name="payment_edit", methods={"GET", "POST"})
     */
    public function editAction(Request $request, Payment $payment)
    {
        $deleteForm = $this->createDeleteForm($payment);
        $editForm = $this->createForm('AppBundle\Form\PaymentType', $payment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('payment_edit', array('id' => $payment->getId()));
        }

        return $this->render('payment/edit.html.twig', array(
            'payment' => $payment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a payment entity.
     *
     * @Route("/{id}", name="payment_delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request, Payment $payment)
    {
        $form = $this->createDeleteForm($payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($payment);
            $em->flush();
        }

        return $this->redirectToRoute('payment_index');
    }

    /**
     * Creates a form to delete a payment entity.
     *
     * @param Payment $payment The payment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Payment $payment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('payment_delete', array('id' => $payment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
