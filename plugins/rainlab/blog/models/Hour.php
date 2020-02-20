<?php namespace RainLab\Blog\Models;

use Model;
use October\Rain\Database\Traits\Validation;
use RainLab\Blog\Classes\DateUtils;

class Hour extends Model
{
    use Validation;
    use DateUtils;

    public $table = 'rainlab_openinghours_hours';
    public $jsonable = ['hours'];
    public $rules = [
        'weekday'      => 'required|min:0|max:6',
        'hours.*.from' => 'required|date',
        'hours.*.to'   => 'required|date',
    ];
    public $belongsTo = [
        'post' => Post::class,
    ];
    
    /**
     * Alias for getWeekdaysOption, used for checkbox list
     * in create context.
     *
     * @return array
     */
    public function getWeekdaysOptions()
    {
        return $this->getWeekdayOptions();
    }
}
