<?php

require "mainScript.php";

// Create
function addBook($title, $author) {
    global $conn;
    $sql = "INSERT INTO books (title, author) VALUES ('$title', '$author')";
    $conn->query($sql);
}

// Read
function getAllBooks() {
    global $conn;
    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);
    $books = [];
    while ($row = $result->fetch_assoc()) {
        $listOfBooks[] = $row;
    }
    
    header('Content-Type: application/json');
    echo json_encode($listOfBooks);
}

// Update
function updateBook($id, $title, $author) {
    global $conn;
    $sql = "UPDATE books SET title='$title', author='$author' WHERE id=$id";
    $conn->query($sql);
}

// Delete
function deleteBook($id) {
    global $conn;
    $sql = "DELETE FROM books WHERE id=$id";
    $conn->query($sql);
}

?>