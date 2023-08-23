<?php

require "mainScript.php";

// Update
function updateBook($id, $title, $author) {
    global $conn;
    $sql = "UPDATE books SET title='$title', author='$author' WHERE id=$id";
    $conn->query($sql);
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["author"])) {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $author = $_POST["author"];
    updateBook($id, $title, $author);
    echo json_encode(array("message" => "Book updated successfully."));
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
    $loanCheckQuery = "SELECT COUNT(*) FROM loans WHERE book_id = $id AND return_date IS NULL";
    $loanCheckResult = $conn->query($loanCheckQuery);
    $activeLoans = $loanCheckResult->fetch_assoc()["COUNT(*)"];

    if ($activeLoans > 0) {
        echo json_encode(array("message" => "Book has active loans and cannot be deleted."));
    } else {
        $sql = "DELETE FROM books WHERE id = $id";
        $conn->query($sql);
        echo json_encode(array("message" => "Book removed successfully."));
    }
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    deleteBook($id);
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
// all books in JSON
$booksData = getAllBooks();
header('Content-Type: application/json');
echo json_encode($booksData);

?>