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
    $stmt = $db->prepare("DELETE FROM `$table` WHERE id = :id ");
    $stmt->bindParam(':id', $obj_id);
    $stmt->execute();
}

function add_colon($x) { return ':' . $x; };

function create_object($object, $table) {
    $db = option('db_conn');

    $vars = get_object_vars($object);
    unset($vars['id']);

    $sql =
        "INSERT INTO `$table` (" .
        implode(', ', array_keys($vars)) .
        ') VALUES (' .
        implode(', ', array_map('add_colon', array_keys($vars))) . ')';

    $stmt = $db->prepare($sql);
    foreach ($vars as $key => $value) {
        $stmt->bindValue(':' . $key, $value);
    }

    $stmt->execute();
    return $db->lastInsertId();
}

function name_eq_colon_name($x) { return $x . ' = :' . $x; };

function update_object($object, $table) {
    $db = option('db_conn');

    $vars = get_object_vars($object);
    $id = $vars['id'];
    unset($vars['id']);

    $sql =
        "UPDATE `$table` SET " .
        implode(', ', array_map('name_eq_colon_name', array_keys($vars))) .
        ' WHERE id = :id';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $id);
    foreach ($vars as $key => $value) {
        $stmt->bindValue(':' . $key,  $value);
    }

    return $stmt->execute();
}
