<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Review;
use AppBundle\Form\ReviewType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ReviewController
 * @package AppBundle\Controller
 *
 * @Route("review")
 */
class ReviewController extends Controller
{

    /**
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="review_index")
     * @Method("GET")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reviews = $em->getRepository('AppBundle:Review')->findAll();
        return $this->render('review/index.html.twig',[
            'reviews' => $reviews,

        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/new", name="review_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            return $this->redirectToRoute('review_show', ['id' => $review->getId()]);

        }
        return $this->render('review/new.html.twig', [
            'review' => $review,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a review entity
     *
     * @Route("/{id}", name="review_show")
     * @Method("GET")
     * @param Review $review
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Review $review)
    {
        $deleteForm = $this->createDeleteForm($review);
        return $this->render('review/show.html.twig', [
            'review' => $review,
            'delete_form' => $deleteForm->createView(),
        ]);

    }


    /**
     *
     * @Route("/{id}/edit", name="review_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Review $review
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Review $review)
    {
        $deleteForm = $this->createDeleteForm($review);
        $editForm = $this->createForm('AppBundle\Form\ReviewType', $review);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('review_edit', [ 'id' => $review->getId()]);
        }

        return $this->render('review/edit.html.twig', [
            'review' => $review,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a review Entity
     *
     * @Route("/{id}", name="review_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Review $review
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Review $review)
    {
        $form = $this->createDeleteForm($review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($review);
            $em->flush();
        }

        return $this->redirectToRoute('review_index');

    }

    /**
     * Create a form to delete a review entity.
     *
     * @param Review $review
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Review $review)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('review_delete', ['id' => $review->getId()]))
            ->setMethod('Delete')
            ->getForm();
    }
}
