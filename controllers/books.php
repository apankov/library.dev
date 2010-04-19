<?php

# GET /books
function books_index() {
    set('books', find_books());
    return html('books/index.html.php');
}

# GET /books/:id
function books_show() {
    $book = get_book_or_404();
    set('book', $book);
    return html('books/show.html.php');
}

# GET /books/:id/edit
function books_edit() {
    $book = get_book_or_404();
    set('book', $book);
    set('authors', find_authors());
    return html('books/edit.html.php');
}

# PUT /books/:id
function books_update() {
    $book_data = book_data_from_form();
    $book = get_book_or_404();
    $book = make_book_obj($book_data, $book);

    update_book_obj($book);
    redirect('books');
}

# GET /books/new
function books_new() {
    $book_data = book_data_from_form();
    set('book', make_book_obj($book_data));
    set('authors', find_authors());
    return html('books/new.html.php');
}

# POST /books
function books_create() {
    $book_data = book_data_from_form();
    $book = make_book_obj($book_data);

    create_book_obj($book);
    redirect('books');
}

# DELETE /books/:id
function books_destroy() {
    delete_book_by_id(filter_var(params('id'), FILTER_VALIDATE_INT));
    redirect('books');
}

function get_book_or_404() {
    $book = find_book_by_id(filter_var(params('id'), FILTER_VALIDATE_INT));
    if (is_null($book)) {
        halt(NOT_FOUND, "This book doesn't exist.");
    }
    return $book;
}

function book_data_from_form() {
    return isset($_POST['book']) && is_array($_POST['book']) ? $_POST['book'] : array();
}
