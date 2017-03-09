<?php
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('<i class="iconfa-home"></i>', route('login'));
});
Breadcrumbs::register('screen_list', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Screen', 'javascript:void(0);');
    $breadcrumbs->push('List', route('screen_list'));
});


?>