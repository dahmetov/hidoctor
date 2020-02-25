<?php namespace RainLab\Blog\Models;

use Str;
use Model;
use Url;

class Specialization extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'rainlab_blog_specializations';

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required',
        'slug' => 'required|between:3,64|unique:rainlab_blog_specializations',
    ];

    protected $guarded = [];

    public $hasMany = [
        'posts' => ['RainLab\Blog\Models\Post']
    ];

    public $belongsToMany = [
        'tags' => [
            'Bedard\BlogTags\Models\Tag',
            'table' => 'bedard_blogtags_specialization_tag',
            'order' => 'name'
        ]
    ];

    public function beforeValidate()
    {
        // Generate a URL slug for this model
        if (!$this->exists && !$this->slug) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function afterDelete()
    {
        $this->posts()->detach();
    }

    /**
     * Sets the "url" attribute with a URL to this object
     *
     * @param string $pageName
     * @param Cms\Classes\Controller $controller
     *
     * @return string
     */
    public function setUrl($pageName, $controller)
    {
        $params = [
            'id'   => $this->id,
            'slug' => $this->slug
        ];

        return $this->url = $controller->pageUrl($pageName, $params, false);
    }
}
