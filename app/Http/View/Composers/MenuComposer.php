<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class MenuComposer
{
    protected $defaultMenu = [
        [
            'title' => 'Главная',
            'href' => '/',
        ],
        [
            'title' => 'О проекте',
            'href' => '/about',
        ],
    ];
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
    protected $otherMenu = [
        [
            'title' => 'Проекты',
            'href' => '/dash/projects',
        ],
        [
            'title' => 'Задачи',
            'href' => '/dash/tasks',
        ],
    ];

    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $menu = $this->defaultMenu;
        if (request()->user()) {
            if (request()->user()->hasRole('admin')) {
                $menu = array_merge($menu, $this->adminMenu);
            } elseif (request()->user()->hasRole('manager') || request()->user()->hasRole('developer') || request()->user()->hasRole('client')) {
                $menu = array_merge($menu, $this->otherMenu);
            }
        }

        $view->with(['menu' => $menu]);
    }
}
