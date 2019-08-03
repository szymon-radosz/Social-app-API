<?php

namespace App\Http\Traits;
use App\ErrorLog;

trait CalculateDistanceDifferenceTrait {
    public function calculateDistanceDifference($distance, $currentUserLat, $currentUserLng){
        $coordsLatValue;
        $coordsLngValue;
        $distanceDefault;

        /*
        Degrees of latitude have the same linear distance anywhere in the world, because all lines of latitude are the same size. 
        So 1 degree of latitude is equal to 1/360th of the circumference of the Earth, which is 1/360th of 40,075 km.

        The length of a lines of longitude depends on the latitude. 
        The line of longitude at latitude l will be cos(l)*40,075 km. 
        One degree of longitude will be 1/360th of that.

        So you can work backwards from that. 
        Assuming you want something very close to one square kilometre, you'll want 1 * (360/40075) = 0.008983 degrees of latitude.

        At your example latitude of 53.38292839, the line of longitude will be cos(53.38292839)*40075 = [approx] 23903.297 km long. 
        So 1 km is 1 * (360/23903.297) = 0.015060 degrees.
        */

        if($distance === "1km"){
            $coordsLatValue = 1 * (360/40075);
            $coordsLngValue = 1 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === "2km"){
            $coordsLatValue = 3 * (360/40075);
            $coordsLngValue = 3 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === "5km"){
            $coordsLatValue = 5 * (360/40075);
            $coordsLngValue = 5 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === "10km"){
            $coordsLatValue = 10 * (360/40075);
            $coordsLngValue = 10 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === "50km"){
            $coordsLatValue = 50 * (360/40075);
            $coordsLngValue = 50 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === "100km"){
            $coordsLatValue = 100 * (360/40075);
            $coordsLngValue = 100 * (360/23903.297);
            $distanceDefault = false;
        }else if($distance === ""){
            $coordsLatValue = 10 * (360/40075);
            $coordsLngValue = 10 * (360/23903.297);
            $distanceDefault = true;
        }

        $latDifferenceBottom = $currentUserLat - $coordsLatValue;
        $lngDifferenceBottom = $currentUserLng - $coordsLngValue;

        $latDifferenceTop = $currentUserLat + $coordsLatValue;
        $lngDifferenceTop = $currentUserLng + $coordsLngValue;

        //var_dump([$latDifferenceBottom,$lngDifferenceBottom, $latDifferenceTop, $lngDifferenceTop ]);

        return response()
        ->json(
            [
                'latDifferenceBottom' => $latDifferenceBottom,
                'lngDifferenceBottom' => $lngDifferenceBottom,
                'latDifferenceTop' => $latDifferenceTop,
                'lngDifferenceTop' => $lngDifferenceTop,
                'distanceDefault' => $distanceDefault
            ]
        ); 
    }
}