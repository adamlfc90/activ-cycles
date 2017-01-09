<?php namespace Rejuvenate\Events;

use Backend;
use System\Classes\PluginBase;

/**
 * events Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'events',
            'description' => 'Manage events/courses.',
            'author'      => 'Rejuvenate',
            'icon'        => 'icon-calendar'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Rejuvenate\Events\Components\Events' => 'events',
            'Rejuvenate\Events\Components\Event'  => 'event'
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'rejuvenate.events.access_events' => [
                'tab'   => 'events',
                'label' => 'Manage events'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'events' => [
                'label'       => 'Events',
                'url'         => Backend::url('rejuvenate/events/events'),
                'icon'        => 'icon-calendar',
                'permissions' => ['rejuvenate.events.*'],
                'order'       => 500,
            ],
        ];
    }

    /**
     * Register back-end settings
     * 
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Events',
                'icon'        => 'icon-table',
                'description' => 'Configure Events Google Maps API',
                'class'       => 'Rejuvenate\events\Models\Settings',
                'order'       => 600,
                'permissions' => ['rejuvenate.events.settings']
            ]
        ];
    }


}
