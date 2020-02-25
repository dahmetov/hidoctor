<?php namespace Bedard\BlogTags;

use Backend;
use Bedard\BlogTags\Models\Tag;
use Config;
use Event;
use System\Classes\PluginBase;
use RainLab\Blog\Controllers\Specializations as SpecializationsController;
use RainLab\Blog\Models\Post as PostModel;
use RainLab\Blog\Models\Specialization as SpecializationModel;

/**
 * BlogTags Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * @var array   Require the RainLab.Blog plugin
     */
    public $require = ['RainLab.Blog'];

    /**
     * Returns information about this plugin
     *
     * @return  array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'bedard.blogtags::lang.plugin.name',
            'description' => 'bedard.blogtags::lang.plugin.description',
            'author'      => 'Scott Bedard',
            'icon'        => 'icon-tags',
            'homepage'    => 'https://github.com/scottbedard/blogtags'
        ];
    }

    /**
     * Register components
     *
     * @return  array
     */
    public function registerComponents()
    {
        return [
            'Bedard\BlogTags\Components\BlogTags'      => 'blogTags',
            'Bedard\BlogTags\Components\BlogTagSearch' => 'blogTagSearch',
            'Bedard\BlogTags\Components\BlogRelated'   => 'blogRelated'
        ];
    }

    public function boot()
    {
        // extend the blog navigation
        Event::listen('backend.menu.extendItems', function($manager) {
           $manager->addSideMenuItems('RainLab.Blog', 'blog', [
                'tags' => [
                    'label' => 'bedard.blogtags::lang.navigation.tags',
                    'icon'  => 'icon-tags',
                    'code'  => 'tags',
                    'owner' => 'RainLab.Blog',
                    'url'   => Backend::url('bedard/blogtags/tags')
                ]
            ]);
        });

        // extend the post form
        SpecializationsController::extendFormFields(function($form, $model, $context) {
            if (!$model instanceof SpecializationModel) {
                return;
            }

            $form->addSecondaryTabFields([
                'tags' => [
                    'label' => 'bedard.blogtags::lang.form.label',
                    'mode'  => 'relation',
                    'tab'   => 'rainlab.blog::lang.post.tab_categories',
                    'type'  => 'taglist'
                ]
            ]);
        });
    }
}
