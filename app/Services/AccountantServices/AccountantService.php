<?php

namespace App\Services\AccountantServices;

class AccountantService
{
    public function dashboardData(){
        return [
            $prefix = 'accountant',
            'role' => 'accountant',
            'posts' => \App\Models\Post::all(),
            'mySchool' => \App\models\User::with('school')->first(),
            'routes'=> [
                0 => [
                  'title' => 'Home acntnt',
                  'icon' => 'mdi-view-dashboard-outline',
                  'route' => $prefix . '.dashboard',
                ],
                1 => [
                  'title' => 'pageOne',
                  'icon' => 'mdi-numeric-1',
                  'route' => $prefix . '.pageOne',
                ],
                2 => [
                  'title' => 'pageTwo',
                  'icon' => 'mdi-numeric-2',
                  'route' => $prefix . '.pageTwo',
                ],
                3 => [
                  'title' => 'pageThree',
                  'icon' => 'mdi-numeric-3',
                  'route' => $prefix . '.pageThree',
                ],
                4 => [
                  'title' => 'pageFour',
                  'icon' => 'mdi-numeric-4',
                  'route' => $prefix . '.pageFour',
                ],
                5 => [
                  'title' => 'pageFive',
                  'icon' => 'mdi-numeric-5',
                  'route' => $prefix . '.pageFive',
                ],
                6 => [
                  'title' => 'pageSix',
                  'icon' => 'mdi-numeric-6',
                  'route' => $prefix . '.pageSix',
                ],
                7 => [
                  'title' => 'pageSeven',
                  'icon' => 'mdi-numeric-7',
                  'route' => $prefix . '.pageSeven',
                ],
              ],
        ];
    }
}