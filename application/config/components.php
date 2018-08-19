<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['components'] = [

  'Login' => [

    'Tools' => [
      'Alert' => false,
      'Confirm' => false,
      'Splash' => false,
    ],

    'Components' => [
      'Button' => true,
      'Alert' => true,
      'Link' => true,
      'Textbox' => true,
      'Panel' => true,
      'Widget' => true,
    ],

  ],

  'Dashboard' => [

    'Tools' => [
      'Alert' => true,
      'Confirm' => true,
      'Splash' => true,
    ],

    'Components' => [
      'Alert' => true,
      'Button' => true,
      'Checkbox' => true,
      'Col' => true,
      'Container' => true,
      'Datepicker' => true,
      'Image' => true,
      'Link' => true,
      'Panel' => true,
      'Radio' => true,
      'Row' => true,
      'Select' => true,
      'Table' => true,
      'Textarea' => true,
      'Textbox' => true,
      'Widget' => true,
      'DataTable' => true,
      'Menu' => true,
      'Header' => true,
      'Media' => true,
      'Wysi' => true,
    ],

  ],

  'Site' => [

    'Tools' => [
      'Alert' => true,
      'Confirm' => true,
      'Splash' => true,
    ],

    'Components' => [
      'Button' => true,
      'DataTable' => false,
      'Alert' => true,
      'Select' => true,
      'Radio' => true,
      'Textbox' => true,
      'Textarea' => true,
      'Wysi' => false,
      'Image' => true,
      'Datepicker' => true,
      'Menu' => false,
    ],

  ],

];
