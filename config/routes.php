<?php
declare(strict_types=1);
use function FastRoute\simpleDispatcher;
use FastRoute\RouteCollector;

use App\Controllers\ShirtOrderShowAll;
use App\Controllers\ShirtOrderStore;
use App\Controllers\ShirtOrderUpdate;
use App\Controllers\ShirtOrderDelete;
use App\Controllers\ShirtOrderShowOne;
use App\Controllers\ShirtOrderEdit;
use App\Controllers\ShirtOrderCreate;
use App\Controllers\ShirtOrderRefresh;

return simpleDispatcher(function (RouteCollector $r) {
    $r->get('/all', ShirtOrderShowAll::class);
    $r->post('/store', ShirtOrderStore::class);
    $r->post('/update', ShirtOrderUpdate::class);
    $r->get('/delete/{id}', ShirtOrderDelete::class);
    $r->get('/one/{id}', ShirtOrderShowOne::class);
    $r->get('/edit/{id}', ShirtOrderEdit::class);
    $r->get('/create', ShirtOrderCreate::class);
    $r->get('/refresh', ShirtOrderRefresh::class);
});