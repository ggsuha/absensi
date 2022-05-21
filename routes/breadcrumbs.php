<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('admin.dashboard'));
});

// Home > Blog
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('admin.dashboard'));
});

// Home > Event
Breadcrumbs::for('event', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Event', route('admin.event.index'));
});

// Home > Event > Add New
Breadcrumbs::for('event.add', function (BreadcrumbTrail $trail) {
    $trail->parent('event');
    $trail->push('Add New', route('admin.event.create'));
});

// Home > Event > Edit
Breadcrumbs::for('event.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('event');
    $trail->push('Edit Event');
});

// Home > Event > Participant
Breadcrumbs::for('event.participant', function (BreadcrumbTrail $trail, $event) {
    $trail->parent('event');
    $trail->push('Participant', route('admin.event.participant', ['event' => $event]));
});
