<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class MenuComposer
{
    protected $adminMenu = [
        [
            'title' => 'Пользователи',
            'href' => '/dash/users',
        ],
        [
            'title' => 'Отчеты',
            'href' => '/dash/reports',
        ],
    ];
    protected $developerMenu = [
        [
            'title' => 'Задачи',
            'href' => '/dash/tasks',
        ],
    ];
    protected $otherMenu = [
        [
            'title' => 'Проекты',
            'href' => '/dash/projects',
        ],
    ];

    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $menu = [];
        if (request()->user()) {
            if (request()->user()->hasRole('admin')) {
                $menu = array_merge($menu, $this->adminMenu);
            }

            if (request()->user()->hasRole('developer')) {
                $menu = array_merge($menu, $this->developerMenu);
            }

            if (request()->user()->hasRole('manager') || request()->user()->hasRole('client')) {
                $menu = array_merge($menu, $this->otherMenu);
            }
        }

        $view->with(['menu' => $menu]);
    }
}
