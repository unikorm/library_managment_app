<?php

require "mainScript.php";

// Create
function addBook($title, $author, $isbn) {
    global $conn;
    $sql = "INSERT INTO books (title, author, isbn) VALUES ('$title', '$author', '$isbn')";
    $conn->query($sql);
}

// Read
function getAllBooks() {
    global $conn;
    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);
    $books = [];
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
    return $books;
}

// Update
function updateBook($id, $title, $author, $isbn) {
    global $conn;
    $sql = "UPDATE books SET title='$title', author='$author', isbn='$isbn' WHERE id=$id";
    $conn->query($sql);
}

// Delete
function deleteBook($id) {
    global $conn;
    $sql = "DELETE FROM books WHERE id=$id";
    $conn->query($sql);
}

?>