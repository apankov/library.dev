<?php

require_once('lib/limonade.php');

function configure() {
    $env = $_SERVER['HTTP_HOST'] == 'library.dev' ? ENV_DEVELOPMENT : ENV_PRODUCTION;
    $dsn = $env == ENV_PRODUCTION ? 'sqlite:db/prod.db' : 'sqlite:db/dev.db';
    $db = new PDO($dsn);
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    option('env', $env);
    option('dsn', $dsn);
    option('db_conn', $db);
    option('debug', true);
}

function after($output) {
    $time = number_format( (float)substr(microtime(), 0, 10) - LIM_START_MICROTIME, 6);
    $output .= "<!-- page rendered in $time sec., on " . date(DATE_RFC822)."-->";
    return $output;
}

layout('layout/default.html.php');

// main controller
dispatch('/', 'main_page');

// authors controller
dispatch('/authors', 'authors_list');
dispatch('/authors/:id/show', 'authors_show');
dispatch('/authors/:id/edit', 'authors_edit');
dispatch('/authors/new', 'authors_new');
dispatch_post('/authors/new', 'authors_create');
dispatch_post('/authors/:id/edit', 'authors_update');
dispatch_post('/authors/:id/delete', 'authors_delete');

// books controller
dispatch('/books', 'books_list');
dispatch('/books/:id/show', 'books_show');
dispatch('/books/:id/edit', 'books_edit');
dispatch('/books/new', 'books_new');
dispatch_post('/books/new', 'books_create');
dispatch_post('/books/:id/edit', 'books_update');
dispatch_post('/books/:id/delete', 'books_delete');

run();
