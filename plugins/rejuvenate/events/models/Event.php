<?php namespace Rejuvenate\Events\Models;

use Illuminate\Support\Facades\DB;
use Model;
use October\Rain\Database\Traits\Validation;

/**
 * event Model
 */
class Event extends Model
{
    use Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'rejuvenate_events';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    public $rules = [
        'title'       => 'required',
        'slug'        => 'required'
    ];

    public static $allowedSortingOptions = array(
        'title asc'        => 'Title (ascending)',
        'title desc'       => 'Title (descending)',
        'created_at asc'   => 'Created (ascending)',
        'created_at desc'  => 'Created (descending)',
        'random'           => 'Randomly'
    );

    public function setUrl($pageName, $controller)
    {
        $params = [
            'id'    => $this->id,
            'slug'  => $this->slug,
        ];

        return $this->url = $controller->pageUrl($pageName, $params);
    }

    public function scopeGetEvents($events, $options)
    {
        extract(array_merge([
            'live' => true
        ], $options));

        /**
         * Get only upcoming events (exclude past events).
         */
        if(strcasecmp($options['upcomingEvents'], 'yes') === 0) {
            $events->where('date', '>=', DB::raw('NOW()'));
        }

        /**
         * Order by
         */
        if (in_array($options['orderBy'], array_keys(self::$allowedSortingOptions)))
        {
            $parts = explode(' ', $options['orderBy']);
            if (count($parts) < 2) {
                array_push($parts, 'desc');
            }
            list($sortField, $sortDirection) = $parts;
            if ($sortField == 'random') {
                $sortField = DB::raw('RAND()');
            }
            $events->orderBy($sortField, $sortDirection);
        }

        /**
         * Result per page
         */
        if(strcasecmp($options['perPage'], 'all') !== 0) {
            $events->take($options['perPage']);
        }

        return $events->get();
    }


}