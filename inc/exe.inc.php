<?php
/**
 * Created by PhpStorm.
 * User: base
 * Date: 16.05.2019
 * Time: 17:57
 */

$arg = 'T';
$vehicle = ( ( $arg == 'B' ) ? 'bus' :
    ( $arg == 'A' ) ? 'airplane' :
        ( $arg == 'T' ) ? 'train' :
            ( $arg == 'C' ) ? 'car' :
                ( $arg == 'H' ) ? 'horse' :
                    'feet' );
echo $vehicle;