<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class MenuComposer
{
    protected $adminMenu = [
        [
            'title' => 'Пользователи',
            'href' => '/admin/',
        ],
        [
            'title' => 'Отчеты',
            'href' => '/admin/reports/',
        ],
    ];
    protected $workerMenu = [
        [
            'title' => 'Проекты',
            'href' => '/work/projects/',
        ],
        [
            'title' => 'Задачи',
            'href' => '/work/tasks/',
        ],
    ];
    protected $clientMenu = [
        [
            'title' => 'Проекты',
            'href' => '/home/projects/',
        ],
        [
            'title' => 'Задачи',
            'href' => '/home/tasks/',
        ],
    ];

    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $menu = [];
        if (request()->user()->hasRole('admin')) {
            $menu = $this->adminMenu;
        } elseif (request()->user()->hasRole('manager') || request()->user()->hasRole('developer')) {
            $menu = $this->workerMenu;
        } else {
            $menu = $this->clientMenu;
        }

        $view->with('menu', $menu);
    }
}
