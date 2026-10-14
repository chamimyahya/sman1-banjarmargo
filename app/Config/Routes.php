<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Public routes
$routes->get('/', 'Home::index');
$routes->get('/sitemap.xml', 'Sitemap::index');

// News
$routes->get('/news', 'News::index');
$routes->get('/news/search', 'News::search');
$routes->get('/news/(:any)', 'News::detail/$1');
$routes->post('/news/(:any)/comment', 'News::comment/$1');

// Downloads
$routes->get('/downloads', 'Downloads::index');

// Contact
$routes->get('/contact', 'Contact::index');
$routes->post('/contact/send', 'Contact::send');

// Auth
$routes->get('/login', 'Admin\Auth::login');
$routes->post('/login/attempt', 'Admin\Auth::attempt');
$routes->post('/logout', 'Admin\Auth::logout');

// Admin downloads
$routes->presenter('/admin/downloads', [
    'controller' => 'Admin\Downloads',
    'placeholder' => '(:num)',
]);
$routes->post('/admin/downloads/reorder', 'Admin\Downloads::reorder');

// Admin dashboard
$routes->get('/admin', 'Admin\Dashboard::index');
$routes->get('/admin/dashboard', 'Admin\Dashboard::index');

// Admin settings
$routes->get('/admin/settings', 'Admin\Settings::index');
$routes->post('/admin/settings/save', 'Admin\Settings::save');

// Admin CRUD
$routes->post('/admin/news/quick-update/(:num)', 'Admin\News::quickUpdate/$1');
$routes->presenter('/admin/news', [
    'controller' => 'Admin\News',
    'placeholder' => '(:num)',
]);
$routes->presenter('/admin/teachers', [
    'controller' => 'Admin\Teachers',
    'placeholder' => '(:num)',
]);
$routes->post('/admin/teachers/reorder', 'Admin\Teachers::reorder');
$routes->presenter('/admin/programs', [
    'controller' => 'Admin\Programs',
    'placeholder' => '(:num)',
]);
$routes->presenter('/admin/extracurriculars', [
    'controller' => 'Admin\Extracurriculars',
    'placeholder' => '(:num)',
]);
$routes->presenter('/admin/achievements', [
    'controller' => 'Admin\Achievements',
    'placeholder' => '(:num)',
]);
$routes->presenter('/admin/testimonials', [
    'controller' => 'Admin\Testimonials',
    'placeholder' => '(:num)',
]);
$routes->presenter('/admin/events', [
    'controller' => 'Admin\Events',
    'placeholder' => '(:num)',
]);
$routes->presenter('/admin/gallery', [
    'controller' => 'Admin\Gallery',
    'placeholder' => '(:num)',
]);
$routes->post('/admin/gallery/reorder', 'Admin\Gallery::reorder');
$routes->post('/admin/faq/reorder', 'Admin\Faq::reorder');
$routes->post('/admin/testimonials/reorder', 'Admin\Testimonials::reorder');
$routes->post('/admin/extracurriculars/reorder', 'Admin\Extracurriculars::reorder');
$routes->post('/admin/achievements/reorder', 'Admin\Achievements::reorder');
$routes->post('/admin/programs/reorder', 'Admin\Programs::reorder');
$routes->presenter('/admin/faq', [
    'controller' => 'Admin\Faq',
    'placeholder' => '(:num)',
]);
$routes->presenter('/admin/users', [
    'controller' => 'Admin\Users',
    'placeholder' => '(:num)',
]);

// Admin uploads
$routes->get('/admin/uploads', 'Admin\Uploads::index');
$routes->post('/admin/uploads/delete', 'Admin\Uploads::delete');

// Admin profile
$routes->get('/admin/profile', 'Admin\Profile::index');
$routes->post('/admin/profile/save', 'Admin\Profile::update');

// Admin messages
$routes->get('/admin/messages', 'Admin\Messages::index');
$routes->get('/admin/messages/(:num)', 'Admin\Messages::show/$1');
$routes->post('/admin/messages/delete/(:num)', 'Admin\Messages::delete/$1');

// Admin comments
$routes->get('/admin/comments', 'Admin\Comments::index');
$routes->post('/admin/comments/approve/(:num)', 'Admin\Comments::approve/$1');
$routes->post('/admin/comments/reject/(:num)', 'Admin\Comments::reject/$1');
$routes->post('/admin/comments/delete/(:num)', 'Admin\Comments::delete/$1');

// Admin pages
$routes->presenter('/admin/pages', [
    'controller'   => 'Admin\Pages',
    'placeholder'  => '(:num)',
]);

// Admin menus
$routes->presenter('/admin/menus', [
    'controller'   => 'Admin\Menus',
    'placeholder'  => '(:num)',
]);
$routes->post('/admin/menus/reorder', 'Admin\Menus::reorder');

// Public pages (catch-all — must be last)
$routes->get('/(:any)', 'Pages::view/$1');
