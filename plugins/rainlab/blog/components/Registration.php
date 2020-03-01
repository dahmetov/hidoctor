<?php namespace RainLab\Blog\Components;

use Event;
use BackendAuth;
use Flash;
use Validator;
use Auth;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use RainLab\Blog\Models\Post as BlogPost;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Registration extends ComponentBase
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
        ];
    }

    public function getCategoryPageOptions()
    {
    }

    public function init()
    {

    }

    public function onRun()
    {
    }

    protected function loadPost()
    {
        debug(post('slug'));
        if (!$slug = $this->property('slug')) {
            if(!$slug = post('slug')) {
                return null;
            }
        }
        debug($slug);

        $post = new \RainLab\Blog\Models\Post();

        $post = $post->where('slug', $slug);

        $post = $post->first();

        return $post ?: null;
    }

    /**
     * @return array
     */
    public function onSaveRegistrationButton()
    {
        $formValidation = [
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ];

        $validator = Validator::make(post(), $formValidation);


        // check Validator
        if ($validator->fails()) {
            debug($validator->messages());
            return Flash::error($validator->messages());
            return;
        }

        return $this->saveRegistration();

    }

    /**
     * @return array
     */
    public function saveRegistration()
    {
        $model = new \RainLab\Blog\Models\Registration();
        $model->date = post('date');
        $model->comment = post('comment');
        $post = $this->loadPost();
        $model->post_id = $post->id;

        if (Auth::check()) {
            $model->user_id = Auth::getUser()->id;
        }
        if ($model->save()) {
            Flash::success('Заявка успешно оставлена');
        }
    }


}
