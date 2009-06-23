<?php

function find_authors() {
    return find_objects_by_sql("SELECT * FROM `authors`");
}

function find_author_by_id($id) {
    $sql =
        "SELECT * " .
        "FROM authors " .
        "WHERE id=:id";
    return find_object_by_sql($sql, array(':id' => $id));
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

function update_author_obj($author_obj) {
    return update_object($author_obj, 'authors', author_columns());
}

function create_author_obj($author_obj) {
    return create_object($author_obj, 'authors', author_columns());
}

function delete_author_obj($man_obj) {
    delete_object_by_id($man_obj->id, 'authors');
}

function delete_author_by_id($author_id) {
    delete_object_by_id($author_id, 'authors');
}

function make_author_obj($params, $obj = null) {
    return make_model_object($params, $obj);
}

function author_columns() {
    return array('name', 'birthday', 'bio');
}
