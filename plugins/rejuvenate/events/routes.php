<?php
use Rejuvenate\Events\Controllers\Events;

Route::post('/get_geo_coordinates/', function () {
    $deployer = new Events;
    return $deployer->getCoordination();
});