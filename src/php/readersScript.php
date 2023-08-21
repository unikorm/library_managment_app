<?php

require_once "mainScript.php";

// Create
function addReader($name, $email) {
    global $conn;
    $sql = "INSERT INTO readers (name, email) VALUES ('$name', '$email')";
    $conn->query($sql);
}

// Read
function getAllReaders() {
    global $conn;
    $sql = "SELECT * FROM readers";
    $result = $conn->query($sql);
    $readers = [];
    while ($row = $result->fetch_assoc()) {
        $readers[] = $row;
    }
    return $readers;
}

// Update
function updateReader($id, $name, $email) {
    global $conn;
    $sql = "UPDATE readers SET name='$name', email='$email' WHERE id=$id";
    $conn->query($sql);
}

// Delete
function deleteReader($id) {
    global $conn;
    $sql = "DELETE FROM readers WHERE id=$id";
    $conn->query($sql);
}

?>