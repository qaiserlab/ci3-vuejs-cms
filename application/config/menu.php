<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['menu'] = [
  /************************
  <id="_sidebar">
  ************************/
  'sidebar' => [
    'Dashboard' => [
      'icon' => 'dashboard',
      'title' => 'DASHBOARD',
      'permalink' => '',
    ],

    // 'Comments' => [
    //   'icon' => 'comments',
    //   'title' => 'COMMENTS',
    //   'permalink' => 'comments/all-data',
    // ],
    //
    
    'Media' => [
      'icon' => 'file-image-o',
      'title' => 'MEDIA',

      'child' => [

        'AllData' => [
          'title' => 'ALL_DATA',
          'permalink' => 'media/all-data',
        ],

        'NewData' => [
          'title' => 'ADD_NEW_DATA',
          'permalink' => 'media/add-new-data',
        ],

      ],
    ],

    'Posts' => [
      'icon' => 'paper-plane',
      'title' => 'POSTS',

      'child' => [

        'AllData' => [
          'title' => 'ALL_DATA',
          'permalink' => 'posts/all-data',
        ],

        'NewData' => [
          'title' => 'ADD_NEW_DATA',
          'permalink' => 'posts/add-new-data',
        ],

        'Categories' => [
          'title' => 'CATEGORIES',
          'permalink' => 'categories/all-data',
        ],

        'Tags' => [
          'title' => 'TAGS',
          'permalink' => 'tags/all-data',
        ],

      ],
    ],

    'Pages' => [
      'icon' => 'files-o',
      'title' => 'PAGES',

      'child' => [

        'AllData' => [
          'title' => 'ALL_DATA',
          'permalink' => 'pages/all-data',
        ],

        'NewData' => [
          'title' => 'ADD_NEW_DATA',
          'permalink' => 'pages/add-new-data',
        ],

      ],
    ],

    'Products' => [
      'icon' => 'cubes',
      'title' => 'PRODUCTS',

      'child' => [

        'AllData' => [
          'title' => 'ALL_DATA',
          'permalink' => 'products/all-data',
        ],

        'NewData' => [
          'title' => 'ADD_NEW_DATA',
          'permalink' => 'products/add-new-data',
        ],

        'Categories' => [
          'title' => 'CATEGORIES',
          'permalink' => 'product-categories/all-data',
        ],

      ],
    ],

    'Appearance' => [
      'icon' => 'paint-brush',
      'title' => 'APPEARANCE',

      'child' => [

        // 'Widgets' => [
        //     'title' => 'WIDGETS',
        //     'permalink' => 'widgets/all-data',
        // ],

        'Menus' => [
          'title' => 'MENUS',
          'permalink' => 'menus/all-data',
        ],

        'Banner' => [
          'title' => 'BANNER',
          'permalink' => 'banner/all-data',
        ],

      ],
    ],

  ],

  /************************
  <id="_panel">
  ************************/
  'panel' => [

    'MyAccount' => [
      'icon' => 'user',
      'title' => 'MY_ACCOUNT',
      'caption' => 'USER_PROFILE',
      'permalink' => 'my-account/user-profile',
    ],

    'Users' => [
      'icon' => 'users',
      'title' => 'USERS',
      'caption' => 'MANAGE_ALL_USER',
      'permalink' => 'users/all-data',
    ],

  ],

];
