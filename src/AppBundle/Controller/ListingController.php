<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Flight;
use AppBundle\Entity\PlaneModel;
use AppBundle\Entity\Reservation;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class ListingController
 * @package AppBundle\Controller
 *
 * @Route("listing")
 */
class ListingController extends Controller
{

    /**
     * List one reservation with one flight and one planemodel, with few IDs..
     *
     * @param Reservation $reservation
     * @param Flight $flight
     * @param PlaneModel $planeModel
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/{reservation_id}/flight/{flight_id}/planemodel/{planemodel_id}", name="listing_index", requirements={"reservation_id": "\d+"})
     * @Method("GET")
     * @ParamConverter("reservation", options={"mapping": {"reservation_id": "id"}})
     * @ParamConverter("flight", options={"mapping": {"flight_id": "id"}})
     * @ParamConverter("planemodel", options={"mapping": {"planemodel_id": "id"}})
     *
     */
    public function indexAction(Reservation $reservation, Flight $flight, PlaneModel $planeModel)
    {
        return $this->render('listing/index.html.twig', [
            'reservation' => $reservation,
            'flight' => $flight,
            'planemodel' => $planeModel,
        ]);
    }


}
