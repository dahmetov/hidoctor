<?php namespace RainLab\Blog\Models;

use Model;
use October\Rain\Database\Traits\Validation;
use RainLab\Blog\Classes\DateUtils;

class DateException extends Model
{
    use Validation;
    use DateUtils;

    public $table = 'rainlab_openinghours_exceptions';
    public $rules = [
        'for_date'     => 'required|date',
        'hours.*.from' => 'required|date',
        'hours.*.to'   => 'required|date',
    ];
    public $dates = ['for_date'];
    public $casts = ['yearly' => 'boolean'];
    public $jsonable = ['hours'];
    public $belongsTo = [
        'post' => Post::class,
    ];
}
