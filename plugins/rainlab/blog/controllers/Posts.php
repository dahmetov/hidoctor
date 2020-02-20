<?php namespace RainLab\Blog\Controllers;

use Backend\Behaviors\RelationController;
use BackendMenu;
use Flash;
use Lang;
use Backend\Classes\Controller;
use October\Rain\Exception\ValidationException;
use RainLab\Blog\Models\Hour;
use RainLab\Blog\Models\Post;

class Posts extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ImportExportController',
        'Backend.Behaviors.RelationController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $importExportConfig = 'config_import_export.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = ['rainlab.blog.access_other_posts', 'rainlab.blog.access_posts'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('RainLab.Blog', 'blog', 'posts');
    }

    public function index()
    {
        $this->vars['postsTotal'] = Post::count();
        $this->vars['postsPublished'] = Post::isPublished()->count();
        $this->vars['postsDrafts'] = $this->vars['postsTotal'] - $this->vars['postsPublished'];

        $this->asExtension('ListController')->index();
    }

    public function create()
    {
        BackendMenu::setContextSideMenu('new_post');

        $this->bodyClass = 'compact-container';
        $this->addCss('/plugins/rainlab/blog/assets/css/rainlab.blog-preview.css');
        $this->addJs('/plugins/rainlab/blog/assets/js/post-form.js');

        return $this->asExtension('FormController')->create();
    }

    public function update($recordId = null)
    {
        $this->bodyClass = 'compact-container';
        $this->addCss('/plugins/rainlab/blog/assets/css/rainlab.blog-preview.css');
        $this->addJs('/plugins/rainlab/blog/assets/js/post-form.js');

        return $this->asExtension('FormController')->update($recordId);
    }

    public function export()
    {
        $this->addCss('/plugins/rainlab/blog/assets/css/rainlab.blog-export.css');

        return $this->asExtension('ImportExportController')->export();
    }

    public function listExtendQuery($query)
    {
        if (!$this->user->hasAnyAccess(['rainlab.blog.access_other_posts'])) {
            $query->where('user_id', $this->user->id);
        }
    }

    public function formExtendQuery($query)
    {
        if (!$this->user->hasAnyAccess(['rainlab.blog.access_other_posts'])) {
            $query->where('user_id', $this->user->id);
        }
    }

    public function formExtendFieldsBefore($widget)
    {
        if (!$model = $widget->model) {
            return;
        }

        if ($model instanceof Post && $model->isClassExtendedWith('RainLab.Translate.Behaviors.TranslatableModel')) {
            $widget->secondaryTabs['fields']['content']['type'] = 'RainLab\Blog\FormWidgets\MLBlogMarkdown';
        }
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $postId) {
                if ((!$post = Post::find($postId)) || !$post->canEdit($this->user)) {
                    continue;
                }

                $post->delete();
            }

            Flash::success(Lang::get('rainlab.blog::lang.post.delete_success'));
        }

        return $this->listRefresh();
    }

    /**
     * {@inheritDoc}
     */
    public function listInjectRowClass($record, $definition = null)
    {
        if (!$record->published) {
            return 'safe disabled';
        }
    }

    public function formBeforeCreate($model)
    {
        $model->user_id = $this->user->id;
    }

    public function onRefreshPreview()
    {
        $data = post('Post');

        $previewHtml = Post::formatHtml($data['content'], true);

        return [
            'preview' => $previewHtml
        ];
    }

    public function onRelationManageCreate()
    {
        $sessionKey = post('_session_key');
        if (post('_relation_field') !== 'hours') {
            return parent::onRelationManageCreate();
        }

        $this->initRelation(Post::find($this->params[0]), 'hours');
        $this->prepareVars();

        // Handle multi creation of opening hours.
        $weekdays = post('Hour.weekdays', []);
        if ( ! $weekdays) {
            throw new ValidationException(['weekdays' => 'Select at least one weekday']);
        }

        $data = post('Hour');

        foreach ($weekdays as $weekday) {
            $newModel              = new Hour();
            $newModel->weekday     = $weekday;
            $newModel->hours       = $data['hours'] ?? [];
            $newModel->note        = $data['note'] ?? [];
            $newModel->post_id = $this->params[0];
            $newModel->save(null, $sessionKey);
        }


        return $this->relationRefresh();
    }
}
