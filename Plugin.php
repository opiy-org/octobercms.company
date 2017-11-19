<?php namespace Opiy\Company;

use Backend;
use Backend\Facades\BackendAuth;
use System\Classes\PluginBase;

/**
 * Employees Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'opiy.company::lang.plugin.name',
            'description' => 'opiy.company::lang.plugin.description',
            'author' => 'Opiy',
            'icon' => 'icon-building',
        ];
    }

    public function registerNavigation()
    {
        return [
            'company' => [
                'label' => 'opiy.company::lang.plugin.name',
                'url' => Backend::url('opiy/company/' . $this->startPage()),
                'icon' => 'icon-building',
                'permissions' => ['opiy.company.*'],
                'order' => 500,
                'sideMenu' => [
                    'employees' => [
                        'label' => 'opiy.company::lang.employees.menu_label',
                        'icon' => 'icon-user',
                        'url' => Backend::url('opiy/company/employees'),
                        'permissions' => ['opiy.company.access_employees'],
                    ],
                    'roles' => [
                        'label' => 'opiy.company::lang.roles.menu_label',
                        'icon' => 'icon-briefcase',
                        'url' => Backend::url('opiy/company/roles'),
                        'permissions' => ['opiy.company.access_employees'],
                    ],
                    'projects' => [
                        'label' => 'opiy.company::lang.projects.menu_label',
                        'icon' => 'icon-wrench',
                        'url' => Backend::url('opiy/company/projects'),
                        'permissions' => ['opiy.company.access_projects'],
                    ],
                    'services' => [
                        'label' => 'opiy.company::lang.services.menu_label',
                        'icon' => 'icon-certificate',
                        'url' => Backend::url('opiy/company/services'),
                        'permissions' => ['opiy.company.access_services'],
                    ],
                    'properties' => [
                        'label' => 'opiy.company::lang.properties.menu_label',
                        'icon' => 'icon-location-arrow',
                        'url' => Backend::url('opiy/company/properties'),
                        'permissions' => ['opiy.company.access_properties'],
                    ],
                    'galleries' => [
                        'label' => 'opiy.company::lang.galleries.menu_label',
                        'icon' => 'icon-photo',
                        'url' => Backend::url('opiy/company/galleries'),
                        'permissions' => ['opiy.company.access_galleries'],
                    ],
                    'testimonials' => [
                        'label' => 'opiy.company::lang.testimonials.menu_label',
                        'icon' => 'icon-comment',
                        'url' => Backend::url('opiy/company/testimonials'),
                        'permissions' => ['opiy.company.access_testimonials'],
                    ],
                    'links' => [
                        'label' => 'opiy.company::lang.links.menu_label',
                        'icon' => 'icon-link',
                        'url' => Backend::url('opiy/company/links'),
                        'permissions' => ['opiy.company.access_links'],
                    ],
                    'tags' => [
                        'label' => 'opiy.company::lang.tags.menu_label',
                        'icon' => 'icon-tag',
                        'url' => Backend::url('opiy/company/tags'),
                        'permissions' => ['opiy.company.access_tags'],
                    ],
                ],
            ],
        ];
    }

    public function startPage($page = 'projects')
    {
        $user = BackendAuth::getUser();
        $permissions = array_reverse(array_keys($this->registerPermissions()));
        if (!isset($user->permissions['superuser']) && $user->hasAccess('opiy.company.*')) {
            foreach ($permissions as $access) {
                if ($user->hasAccess($access)) {
                    $page = explode('_', $access)[1];
                }
            }
        }
        return $page;
    }

    public function registerPermissions()
    {
        return [
            'opiy.company.access_employees' => [
                'label' => 'opiy.company::lang.employee.list_title',
                'tab' => 'opiy.company::lang.plugin.name',
            ],
            'opiy.company.access_projects' => [
                'label' => 'opiy.company::lang.project.list_title',
                'tab' => 'opiy.company::lang.plugin.name',
            ],
            'opiy.company.access_services' => [
                'label' => 'opiy.company::lang.service.list_title',
                'tab' => 'opiy.company::lang.plugin.name',
            ],
            'opiy.company.access_galleries' => [
                'label' => 'opiy.company::lang.gallery.list_title',
                'tab' => 'opiy.company::lang.plugin.name',
            ],
            'opiy.company.access_links' => [
                'label' => 'opiy.company::lang.link.list_title',
                'tab' => 'opiy.company::lang.plugin.name',
            ],
            'opiy.company.access_testimonials' => [
                'label' => 'opiy.company::lang.testimonial.list_title',
                'tab' => 'opiy.company::lang.plugin.name',
            ],
            'opiy.company.access_tags' => [
                'label' => 'opiy.company::lang.tag.list_title',
                'tab' => 'opiy.company::lang.plugin.name',
            ],
            'opiy.company.access_company' => [
                'label' => 'opiy.company::lang.company.list_title',
                'tab' => 'opiy.company::lang.plugin.name',
            ],
        ];
    }

    public function registerComponents()
    {
        return [
            'Opiy\Company\Components\Employees' => 'Employees',
            'Opiy\Company\Components\Roles' => 'Roles',
            'Opiy\Company\Components\Projects' => 'Projects',
            'Opiy\Company\Components\Services' => 'Services',
            'Opiy\Company\Components\Galleries' => 'Galleries',
            'Opiy\Company\Components\Company' => 'Company',
            'Opiy\Company\Components\Testimonials' => 'Testimonials',
            'Opiy\Company\Components\Links' => 'Links',
            'Opiy\Company\Components\Tags' => 'Tags',
        ];
    }

    public function registerSettings()
    {
        return [
            'company' => [
                'label' => 'opiy.company::lang.plugin.name',
                'description' => 'opiy.company::lang.settings.description',
                'category' => 'system::lang.system.categories.system',
                'icon' => 'icon-building-o',
                'class' => 'Opiy\Company\Models\Company',
                'order' => 500,
                'keywords' => 'opiy.company::lang.settings.label',
                'permissions' => ['opiy.company.access_company'],
            ],
        ];
    }

    public function register()
    {
        set_exception_handler([$this, 'handleException']);
    }

    public function handleException($e)
    {
        if (!$e instanceof Exception) {
            $e = new \Symfony\Component\Debug\Exception\FatalThrowableError($e);
        }
        $handler = $this->app->make('Illuminate\Contracts\Debug\ExceptionHandler');
        $handler->report($e);
        if ($this->app->runningInConsole()) {
            $handler->renderForConsole(new ConsoleOutput, $e);
        } else {
            $handler->render($this->app['request'], $e)->send();
        }
    }
}
