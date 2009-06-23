<?php

function find_objects_by_sql($sql = '', $params = array()) {
    $db = option('db_conn');

    $result = array();
    $stmt = $db->prepare($sql);
    if ($stmt->execute($params)) {
        while ($obj = $stmt->fetch(PDO::FETCH_OBJ)) {
            $result[] = $obj;
        }
    }
    return $result;
}

function find_object_by_sql($sql = '', $params = array()) {
    $db = option('db_conn');

    $stmt = $db->prepare($sql);
    if ($stmt->execute($params) && $obj = $stmt->fetch(PDO::FETCH_OBJ)) {
        return $obj;
    }
    return null;
}

function make_model_object($params, $obj = null) {
    if (is_null($obj)) {
        $obj = new stdClass();
    }
    foreach ($params as $key => $value) {
        $obj->$key = $value;
    }
    return $obj;
}

function delete_object_by_id($obj_id, $table) {
    $db = option('db_conn');

    $stmt = $db->prepare("DELETE FROM `$table` WHERE id = ?");
    $stmt->execute(array($obj_id));
}

function add_colon($x) { return ':' . $x; };

function create_object($object, $table, $obj_columns = array()) {
    $db = option('db_conn');

    $sql =
        "INSERT INTO `$table` (" .
        implode(', ', $obj_columns) .
        ') VALUES (' .
        implode(', ', array_map('add_colon', $obj_columns)) . ')';

    $stmt = $db->prepare($sql);
    foreach ($obj_columns as $column) {
        $stmt->bindValue(':' . $column, $object->$column);
    }

    $stmt->execute();
    return $db->lastInsertId();
}

function name_eq_colon_name($x) { return $x . ' = :' . $x; };

function update_object($object, $table, $obj_columns = array()) {
    $db = option('db_conn');

    $sql =
        "UPDATE `$table` SET " .
        implode(', ', array_map('name_eq_colon_name', $obj_columns)) .
        ' WHERE id = :id';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $object->id);
    foreach ($obj_columns as $column) {
        $stmt->bindValue(':' . $column, $object->$column);
    }

    return $stmt->execute();
}
