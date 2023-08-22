<?php

require "mainScript.php";

// Update
function updateBook($id, $title, $author) {
    global $conn;
    $sql = "UPDATE books SET title='$title', author='$author' WHERE id=$id";
    $conn->query($sql);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['title']) && isset($_POST['author'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    updateBook($id, $title, $author);
    echo json_encode(array('message' => 'Book updated successfully.'));
    exit;
}

// Create
function addBook($title, $author) {
    global $conn;
    $sql = "INSERT INTO books (title, author, is_borrowed) VALUES ('$title', '$author', 0)";
    $conn->query($sql);
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["title"]) && isset($_POST["author"])) {
    $title = $_POST["title"];
    $author = $_POST["author"];
    addBook($title, $author);
    echo json_encode(array("message" => "Book added successfully."));
    exit;
}

// Delete
function deleteBook($id) {
    global $conn;
    $sql = "DELETE FROM books WHERE id=$id";
    $conn->query($sql);
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    deleteBook($id);
    echo json_encode(array("message" => "Book removed successfully."));
    exit;
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
// Fetch all books and return JSON response
$booksData = getAllBooks();
header('Content-Type: application/json');
echo json_encode($booksData);



?>