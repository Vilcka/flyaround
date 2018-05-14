<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Review;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="review_index")
     * @Method("GET)
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $review = $em->getRepository('AppBundle:Review')->findAll();
        return $this->render('review/index.html.twig',[
            'review' => $review,
        ]);
    }


    public function newAction()
    {

    }
}
