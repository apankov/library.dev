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

// books controller
dispatch_get   ('books',          'books_index');
dispatch_post  ('books',          'books_create');
dispatch_get   ('books/new',      'books_new');
dispatch_get   ('books/:id/edit', 'books_edit');
dispatch_get   ('books/:id',      'books_show');
dispatch_put   ('books/:id',      'books_update');
dispatch_delete('books/:id',      'books_destroy');

// authors controller
dispatch_get   ('authors',          'authors_index');
dispatch_post  ('authors',          'authors_create');
dispatch_get   ('authors/new',      'authors_new');
dispatch_get   ('authors/:id/edit', 'authors_edit');
dispatch_get   ('authors/:id',      'authors_show');
dispatch_put   ('authors/:id',      'authors_update');
dispatch_delete('authors/:id',      'authors_destroy');

run();
