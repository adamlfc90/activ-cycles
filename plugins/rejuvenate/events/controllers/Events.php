<?php namespace Rejuvenate\Events\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Rejuvenate\Events\Classes\Geocoder;
use Rejuvenate\Events\Models\Settings;

/**
 * Events Back-end Controller
 */
class Events extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['rejuvenate.events.access_events'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Rejuvenate.Events', 'events', 'events');

        $this->addJs('https://maps.googleapis.com/maps/api/js?key=' . Settings::get('api_key'));
    }

    public function getCoordination()
    {
        if(!empty($_POST['location']) || !empty($_POST['post_code']))
        {
            $address = isset($_POST['location']) ? $_POST['location'] : null;
            $address .= isset($_POST['post_code']) ? $_POST['post_code'] : null;
            $address = strip_tags($address);

            $geocoder = Geocoder::geocode($address);

            if ($geocoder->was_successful()) {

                echo json_encode(array(
                    'lat' => $geocoder->get_latitude(),
                    'lng' => $geocoder->get_longitude()
                ));
                exit;
            }
        }
    }


}