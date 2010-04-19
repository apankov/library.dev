<?php

function find_books() {
    $sql =
        "SELECT " .
        "b.id as id, b.title as title, b.year as year, b.author_id as author_id, " .
        "a.name as author_name, a.birthday as author_birthdady, a.bio as author_bio " .
        "FROM books b " .
        "LEFT JOIN authors a ON a.id=b.author_id";
    return find_objects_by_sql($sql);
}

function find_book_by_id($id) {
    $sql =
        "SELECT " .
        "b.id as id, b.title as title, b.year as year, b.author_id as author_id, " .
        "a.name as author_name, a.birthday as author_birthdady, a.bio as author_bio " .
        "FROM books b " .
        "LEFT JOIN authors a ON a.id=b.author_id " .
        "WHERE b.id=:id";
    return find_object_by_sql($sql, array(':id' => $id));
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

function update_book_obj($book_obj) {
    return update_object($book_obj, 'books', book_columns());
}

function create_book_obj($book_obj) {
    return create_object($book_obj, 'books', book_columns());
}

function delete_book_obj($man_obj) {
    delete_object_by_id($man_obj->id, 'books');
}

function delete_book_by_id($book_id) {
    delete_object_by_id($book_id, 'books');
}

function make_book_obj($params, $obj = null) {
    return make_model_object($params, $obj);
}

function book_columns() {
    return array('title', 'author_id', 'year');
}

function book_data_filters() {
    return array(
        'book[title]' => FILTER_SANITIZE_SPECIAL_CHARS,
        'book[author_id]' => array("filter"  => FILTER_VALIDATE_INT,
                             "flags"   => FILTER_FLAG_ARRAY,
                             "options" => array("min_range" => 1)),
        'book[year]' => array("filter"  => FILTER_VALIDATE_INT,
                        "flags"   => FILTER_FLAG_ARRAY,
                        "options" => array("min_range" => 0)),
    );
}
