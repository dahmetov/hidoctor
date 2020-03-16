<?php namespace RainLab\Blog\Components;

use DB;
use Validator;
use Event;
use Auth;
use BackendAuth;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use RainLab\Blog\Models\Post as BlogPost;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use VojtaSvoboda\Reviews\Models\Review;

class Post extends ComponentBase
{
    /**
     * @var RainLab\Blog\Models\Post The post model used for display.
     */
    public $post;

    /**
     * @var RainLab\Blog\Models\Post The post model used for display.
     */
    public $parent_post;

    /**
     * @var string Reference to the page name for linking to categories.
     */
    public $categoryPage;

    public function componentDetails()
    {
        return [
            'name'        => 'rainlab.blog::lang.settings.post_title',
            'description' => 'rainlab.blog::lang.settings.post_description'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'rainlab.blog::lang.settings.post_slug',
                'description' => 'rainlab.blog::lang.settings.post_slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string',
            ],
            'categoryPage' => [
                'title'       => 'rainlab.blog::lang.settings.post_category',
                'description' => 'rainlab.blog::lang.settings.post_category_description',
                'type'        => 'dropdown',
                'default'     => 'blog/category',
            ],
        ];
    }

    public function getCategoryPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function init()
    {
        Event::listen('translate.localePicker.translateParams', function ($page, $params, $oldLocale, $newLocale) {
            $newParams = $params;

            foreach ($params as $paramName => $paramValue) {
                $records = BlogPost::transWhere($paramName, $paramValue, $oldLocale)->first();

                if ($records) {
                    $records->translateContext($newLocale);
                    $newParams[$paramName] = $records[$paramName];
                }
            }
            return $newParams;
        });
    }

    public function onRun()
    {
        $this->categoryPage = $this->page['categoryPage'] = $this->property('categoryPage');
        $this->post = $this->page['post'] = $this->loadPost();
        $this->parent_post = $this->page['parent_post'] = $this->loadParentPost();
    }

    public function onRender()
    {
        if (empty($this->post)) {
            $this->post = $this->page['post'] = $this->loadPost();
        }
    }

    protected function loadPost()
    {
        $slug = $this->property('slug');

        $post = new BlogPost;

        $post = $post->isClassExtendedWith('RainLab.Translate.Behaviors.TranslatableModel')
            ? $post->transWhere('slug', $slug)
            : $post->where('slug', $slug);

        if (!$this->checkEditor()) {
            $post = $post->isPublished();
        }

        $post = $post->with('reviews', 'reviews.user');

        try {
            $post = $post->firstOrFail();
            $post->avg_rating = $post->reviews->avg('rating');
        } catch (ModelNotFoundException $ex) {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }

        /*
         * Add a "url" helper attribute for linking to each category
         */
        if ($post && $post->categories->count()) {
            $post->categories->each(function($category) {
                $category->setUrl($this->categoryPage, $this->controller);
            });
        }

        return $post;
    }

    protected function loadParentPost()
    {
        $post = new BlogPost;

        $post = $post->where('id', $this->post->getParentId());

        if (!$this->checkEditor()) {
            $post = $post->isPublished();
        }

        try {
            $post = $post->firstOrFail();
        } catch (ModelNotFoundException $ex) {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }

        /*
         * Add a "url" helper attribute for linking to each category
         */
        if ($post && $post->categories->count()) {
            $post->categories->each(function($category) {
                $category->setUrl($this->categoryPage, $this->controller);
            });
        }

        return $post;
    }

    public function previousPost()
    {
        return $this->getPostSibling(-1);
    }

    public function nextPost()
    {
        return $this->getPostSibling(1);
    }

    protected function getPostSibling($direction = 1)
    {
        if (!$this->post) {
            return;
        }

        $method = $direction === -1 ? 'previousPost' : 'nextPost';

        if (!$post = $this->post->$method()) {
            return;
        }

        $postPage = $this->getPage()->getBaseFileName();

        $post->setUrl($postPage, $this->controller);

        $post->categories->each(function($category) {
            $category->setUrl($this->categoryPage, $this->controller);
        });

        return $post;
    }

    protected function checkEditor()
    {
        $backendUser = BackendAuth::getUser();

        return $backendUser && $backendUser->hasAccess('rainlab.blog.access_posts');
    }

    public function onSaveReviewButton()
    {
        $formValidation = [
            'author' => 'alpha_dash|min:2|max:25',
            'email' => 'email',
            'rating' => 'required',
            'content' => 'required|min:2|max:500'
        ];

        $validator = Validator::make(post(), $formValidation);

        // check Validator
        if ($validator->fails()) {
            return [
                'message' => $validator->messages()
            ];
        }

        return $this->saveComment();

    }

    /**
     * @return array
     */
    public function saveComment()
    {
        $model = new Review();
        $model->content = strip_tags(post('content'));
        $model->post_id = post('post_id');
        $model->rating = post('rating');

        if (Auth::check()) {
            $model->user_id = Auth::getUser()->id;
        }
        if ($model->save()) {
            return [
                'model' => $model
            ];
        }
    }
}
