<?php namespace Rejuvenate\Events\Components;

use Cms\Classes\ComponentBase;
use Rejuvenate\Events\Models\Event as EventModel;

class Event extends ComponentBase
{
    public $event;

    public function componentDetails()
    {
        return [
            'name'        => 'Event Details',
            'description' => 'Single event detail'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'Slug',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ]
        ];
    }

    public function onRun()
    {
        $this->event = EventModel::where(str_replace(':', '', $this->propertyName('slug')), $this->property('slug'))->first();
    }


}