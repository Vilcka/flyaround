<?php
/**
 * Created by PhpStorm.
 * User: legolas
 * Date: 28/05/18
 * Time: 15:22
 */

namespace AppBundle\Service;


class FlightInfo
{

    /**
     * @var string
     */
    private $unit;


    /**
     * FlightInfo constructor.
     * @param $unit
     * @var string
     *
     */
    public function __construct($unit)
    {
        $this->unit = $unit;
    }

    /**
     * @param $latitudeFrom
     * @param $longitudeFrom
     * @param $latitudeTo
     * @param $longitudeTo
     * @return float|int
     */
    public function getDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $d = 0;
        $earth_radius = 6371;
        $dLat = deg2rad($latitudeTo - $latitudeFrom);
        $dLon = deg2rad($longitudeTo - $longitudeFrom);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));

        switch ($this-> unit) {
            case 'km':
                $d = $c * $earth_radius;
                break;
            case 'mi':
                $d = $c * $earth_radius / 1.609344;
                break;
            case 'nmi':
                $d = $c * $earth_radius / 1.852;
                break;
        }

        return $d;

    }

    public function getTime($distance, $speed)
    {
        $time = ($distance / $speed)*60;

        return round($time,2);
    }

}