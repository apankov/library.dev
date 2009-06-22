<?php

# GET /author
function authors_list() {
    set('authors', find_authors());
    return html('authors/list.html.php');
}

# GET /authors/:id/show
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

# POST /authors/:id/edit
function authors_update() {
    $author_data = isset($_POST['author']) && is_array($_POST['author']) ? $_POST['author'] : array();
    unset($author_data['id']);
    $author = get_author_or_404();
    $author = make_author_obj($author_data, $author);

    update_author_obj($author);
    redirect('/authors');
}

# GET /authors/new
function authors_new() {
    $author_data = isset($_POST['author']) && is_array($_POST['author']) ? $_POST['author'] : array();
    set('author', make_author_obj($author_data));
    return html('authors/new.html.php');
}

# POST /authors/new
function authors_create() {
    $author_data = isset($_POST['author']) && is_array($_POST['author']) ? $_POST['author'] : array();
    $author = make_author_obj($author_data);

    create_author_obj($author);
    redirect('/authors');
}

# POST /authors/:id/delete
function authors_delete() {
    delete_author_by_id(intval(params('id')));
    redirect('/authors');
}

function get_author_or_404() {
    $author = find_author_by_id(intval(params('id')));
    if (is_null($author)) {
        halt(NOT_FOUND, "This author doesn't exist.");
    }
    return $author;
}
