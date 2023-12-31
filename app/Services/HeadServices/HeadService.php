<?php

namespace App\Services\HeadServices;

class HeadService
{
    public function dashboardData(){
        return [
            $prefix = 'head',
            'role' => 'head',
            'mySchool' => \App\models\User::with('school')->first(),
            'posts' => \App\Models\Post::all(),

            'routes' => [
              0 => 
              [
                'menu_title' => 'Navigation',
                // 'icon' => 'mdi-view-dashboard-outline',
                // 'route' => 'head.dashboard',
                'levelOne' => 
                [
                  0 => 
                  [
                    'title' => 'Dashboard',
                    'icon' => 'mdi-view-dashboard-outline',
                    'route' => 'head.pageOne',
                  ],
                ],
              ],
              1 => 
              [
                'menu_title' => 'Apps',
                // 'icon' => 'mdi-view-dashboard-outline',
                // 'route' => 'head.dashboard',
                'levelOne' => 
                [
                  0 => 
                  [
                    'title' => 'Users',
                    'icon' => 'mdi-numeric-1',
                    'route' => 'head.pageOne',
                    'dropdown' => true,
                    'levelTwo' => 
                    [
                      0 => 
                      [
                        'title' => 'Student',
                        'icon' => 'mdi-school-outline',
                        'route' => 'head.pageOne',
                      ],
                      1 => 
                      [
                        'title' => 'Hall Fees',
                        'icon' => 'mdi-cash-multiple',
                        'route' => 'head.pageOne',
                      ],
                      2 => 
                      [
                        'title' => 'Other Fees',
                        'icon' => 'mdi-cash-multiple',
                        'route' => 'head.pageOne',
                      ],
                      3 => 
                      [
                        'title' => 'Pre-Form One Fee',
                        'icon' => 'mdi-cash-multiple',
                        'route' => 'head.pageOne',
                      ],
                    ],
                  ],
                  1 => 
                  [
                    'title' => 'Email',
                    'icon' => 'mdi-email-outline',
                    'route' => 'head.pageOne',
                  ],
                  2 => 
                  [
                    'title' => 'Donors',
                    'icon' => 'mdi-handshake-outline',
                    'route' => 'head.pageOne',
                  ],
                  3 => 
                  [
                    'title' => 'Announcements',
                    'icon' => 'mdi-bullhorn-outline',
                    'route' => 'head.pageOne',
                  ],
                ],
              ],
            ]

            // 'routes'=> [
            //     0 => [
            //       'title' => 'Home HEAD',
            //       'icon' => 'mdi-view-dashboard-outline',
            //       'route' => $prefix . '.dashboard',
            //     ],
            //     1 => [
            //       'title' => 'pageOne',
            //       'icon' => 'mdi-numeric-1',
            //       'route' => $prefix . '.pageOne',
            //     ],
            //     2 => [
            //       'title' => 'pageTwo',
            //       'icon' => 'mdi-numeric-2',
            //       'route' => $prefix . '.pageTwo',
            //     ],
            //     3 => [
            //       'title' => 'pageThree',
            //       'icon' => 'mdi-numeric-3',
            //       'route' => $prefix . '.pageThree',
            //     ],
            //     4 => [
            //       'title' => 'pageFour',
            //       'icon' => 'mdi-numeric-4',
            //       'route' => $prefix . '.pageFour',
            //     ],
            //     5 => [
            //       'title' => 'pageFive',
            //       'icon' => 'mdi-numeric-5',
            //       'route' => $prefix . '.pageFive',
            //     ],
            //     6 => [
            //       'title' => 'pageSix',
            //       'icon' => 'mdi-numeric-6',
            //       'route' => $prefix . '.pageSix',
            //     ],
            //     7 => [
            //       'title' => 'pageSeven',
            //       'icon' => 'mdi-numeric-7',
            //       'route' => $prefix . '.pageSeven',
            //     ],
            //   ],
        ];
    }
}