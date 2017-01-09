<?php namespace Rejuvenate\Events\Components;

use Cms\Classes\ComponentBase;
use Rejuvenate\Events\Models\Event as EventModel;
use Cms\Classes\Page;

class Events extends ComponentBase
{
    public $events;
    public $detailPage;

    public function componentDetails()
    {
        return [
            'name'        => 'Events Component',
            'description' => 'Display events list'
        ];
    }

    public function defineProperties()
    {
        return [
            'upcomingEvents' => [
                'title'             => 'Only active events',
                'description'       => 'Get only upcoming events (exclude past events).',
                'type'              => 'dropdown',
                'default'           => 'yes',
                'options'           => [
                    'yes' => "Yes",
                    'no'  => "No",
                    'all' => "All"
                ],
            ],
            'orderBy' => [
                'title'             => 'Order by',
                'type'              => 'dropdown'
            ],
            'perPage' => [
                'title'             => 'Per page',
                'type'              => 'dropdown',
                'default'           => 'all'
            ],
            'detailPage' => [
                'title'             => 'Detail Page',
                'description'       => 'The page that contains the events detail info.',
                'type'              => 'dropdown'
            ]
        ];
    }

    public function getPerPageOptions()
    {
        $count = EventModel::count();
        $list = range(1, $count);
        array_unshift($list, 'All');

        return $list;
    }

    public function getOrderByOptions()
    {
        return EventModel::$allowedSortingOptions;
    }

    public function getDetailPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->detailPage = $this->property('detailPage');

        $events = (new EventModel())->getEvents([
            'upcomingEvents' => $this->property('upcomingEvents'),
            'orderBy'        => $this->property('orderBy'),
            'perPage'        => $this->property('perPage')
        ]);

        if($this->detailPage != null)
            $events = $this->setUrls($events);

        $this->events = $events;
    }

    /*
     * Add a "url" helper attribute for linking to each property details
     */
    public function setUrls(&$items)
    {
        $items->each(function($item)
        {
            $item->setUrl($this->detailPage, $this->controller);
        });

        return $items;
    }


}