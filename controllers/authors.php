<?php

# GET /author
function authors_index() {
    set('authors', find_authors());
    return html('authors/index.html.php');
}

# GET /authors/:id
function authors_show() {
    $author = get_author_or_404();
    set('author', $author);
    return html('authors/show.html.php');
}

# GET /authors/:id/edit
function authors_edit() {
    $author = get_author_or_404();
    set('author', $author);
    return html('authors/edit.html.php');
}

# PUT /authors/:id
function authors_update() {
    $author_data = author_data_from_form();
    $author = get_author_or_404();
    $author = make_author_obj($author_data, $author);

    update_author_obj($author);
    redirect('authors');
}

# GET /authors/new
function authors_new() {
    $author_data = author_data_from_form();
    set('author', make_author_obj($author_data));
    return html('authors/new.html.php');
}

# POST /authors
function authors_create() {
    $author_data = author_data_from_form();
    $author = make_author_obj($author_data);

    create_author_obj($author);
    redirect('authors');
}

# DELETE /authors/:id
function authors_destroy() {
    delete_author_by_id(filter_var(params('id'), FILTER_VALIDATE_INT));
    redirect('authors');
}

function get_author_or_404() {
    $author = find_author_by_id(filter_var(params('id'), FILTER_VALIDATE_INT));
    if (is_null($author)) {
        halt(NOT_FOUND, "This author doesn't exist.");
    }
    return $author;
}

function author_data_from_form() {
    return isset($_POST['author']) && is_array($_POST['author']) ? $_POST['author'] : array();
}
