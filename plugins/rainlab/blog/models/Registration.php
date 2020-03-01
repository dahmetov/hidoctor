<?php namespace RainLab\Blog\Models;

use Str;
use Model;
use Url;

class Registration extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'rainlab_blog_registrations';

    /*
     * Validation
     */
    public $rules = [
        'date' => 'required|date',
    ];

    protected $guarded = [];

    public $belongsTo = [
        'post' => ['RainLab\Blog\Models\Post'],
        'user' => ['RainLab\User\Models\User'],
    ];
}
