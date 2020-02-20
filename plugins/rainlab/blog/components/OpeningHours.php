<?php namespace RainLab\Blog\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Collection;
use RainLab\Blog\Classes\DateUtils;
use RainLab\Blog\Models\Post;

class OpeningHours extends ComponentBase
{
    use DateUtils;

    /**
     * All available locations.
     *
     * @return Collection
     */
    public $posts;
    /**
     * All available locations keyed by the slug attribute.
     *
     * @return Collection
     */
    public $postBySlug;
    /**
     * The first available location.
     *
     * Makes it easier to access it in the frontend if
     * only one location is available.
     *
     * @return Location
     */
    public $post;

    public function componentDetails()
    {
        return [
            'name'        => 'offline.openinghours::lang.components.opening_hours.name',
            'description' => 'offline.openinghours::lang.components.opening_hours.description',
            'icon'        => 'clock',
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'offline.openinghours::lang.components.opening_hours.slug.title',
                'description' => 'offline.openinghours::lang.components.opening_hours.slug.description',
                'type'        => 'dropdown',
            ],
        ];
    }

    public function getSlugOptions()
    {
        return Post::orderBy('sort_order', 'ASC')->get()->pluck('name', 'slug')->toArray();
    }

    public function onRun()
    {
        $this->posts       = Post::with('hours', 'exceptions')->get();
        $this->postBySlug = $this->posts->keyBy('slug');

        $slug = $this->property('slug');

        $this->post = $slug
            ? $this->postBySlug->get($slug)
            : $this->post = $this->postBySlug->first();
    }
}
