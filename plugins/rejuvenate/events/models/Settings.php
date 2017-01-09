<?php namespace Rejuvenate\Events\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * settings Model
 */
class Settings extends Model
{
    use Validation;

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'rejuvenate_events_settings';

    public $settingsFields = 'fields.yaml';

    /**
     * Validation rules
     */
    public $rules = [
        'api_key' => 'required'
    ];


}