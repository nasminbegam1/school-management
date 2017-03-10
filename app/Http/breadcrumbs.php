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
Breadcrumbs::register('screen_create', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Screen', route('screen_list'));
    $breadcrumbs->push('Create', route('screen_create'));
});
Breadcrumbs::register('screen_edit', function($breadcrumbs,$id)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Screen', route('screen_list'));
    $breadcrumbs->push('Edit', route('screen_edit',$id));
});