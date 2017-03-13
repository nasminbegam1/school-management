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

Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Dashboard', route('dashboard'));
});

Breadcrumbs::register('user_list', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('User List', route('user_list'));
});
Breadcrumbs::register('role_assign', function($breadcrumbs,$id)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('User List', 'javascript:void(0);');
    $breadcrumbs->push('Role Assign', route('role_assign',$id));
});
Breadcrumbs::register('edit_profile', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Edit Profile', route('edit_profile'));
});
Breadcrumbs::register('account_settings', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Account Settings', route('account_settings'));
});

Breadcrumbs::register('usertype_list', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('User Type', 'javascript:void(0);');
    $breadcrumbs->push('List', route('usertype_list'));
});
Breadcrumbs::register('usertype_create', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('User Type', route('usertype_list'));
    $breadcrumbs->push('Create', route('usertype_create'));
});
Breadcrumbs::register('usertype_edit', function($breadcrumbs,$id)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('User Type', route('usertype_list'));
    $breadcrumbs->push('Edit', route('usertype_edit',$id));
});

Breadcrumbs::register('school_modlues_list', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('School Module List', route('school_modlues_list'));
    $breadcrumbs->push('Add', route('school_modlues_add'));
});
Breadcrumbs::register('school_modlues_add', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('School Module List', route('school_modlues_list'));
    $breadcrumbs->push('Add', route('school_modlues_add'));
});
Breadcrumbs::register('school_modlues_edit', function($breadcrumbs,$id)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('School Module List', route('school_modlues_list'));
    $breadcrumbs->push('Edit', route('school_modlues_edit',$id));
});