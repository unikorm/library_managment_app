<?php

require_once "mainScript.php";

// Update
function updateReader($id, $name, $id_card, $birth_date) {
    global $conn;
    $sql = "UPDATE readers SET name='$name', id_card='$id_card', birth_date='$birth_date' WHERE id=$id";
    $conn->query($sql);
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["id_card"]) && isset($_POST["birth_date"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $id_card = $_POST["id_card"];
    $birth_date = $_POST["birth_date"];
    updateReader($id, $name, $id_card, $birth_date);
    echo json_encode(array("message" => "Reader updated successfully."));
    exit;
}

// Create
function createReader($name, $id_card, $birth_date) {
    global $conn;
    $sql = "INSERT INTO readers (name, id_card, birth_date) VALUES ('$name', '$id_card', '$birth_date')";
    $conn->query($sql);
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["name"]) && isset($_POST["id_card"]) && isset($_POST["birth_date"])) {
    $name = $_POST["name"];
    $id_card = $_POST["id_card"];
    $birth_date = $_POST["birth_date"];
    createReader($name, $id_card, $birth_date);
    echo json_encode(array("message" => "Reader added successfully."));
    exit;
}

// Delete
function deleteReader($id) {
    global $conn;
    $sql = "DELETE FROM readers WHERE id=$id";
    $conn->query($sql);
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    deleteReader($id);
    echo json_encode(array("message" => "Reader removed successfully."));
    exit;
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
// all readers in JSON
$readersData = getAllReaders();
header('Content-Type: application/json');
echo json_encode($readersData);

// Fetch reader names for the given book_id
function getReaderNameForBook($book_id) {
    global $conn;
    $sql = "SELECT readers.name FROM readers
            INNER JOIN loans ON readers.id = loans.reader_id
            WHERE loans.book_id = $book_id";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        return $row['name'];
    }
    return null;
}
// Check if a book_id parameter is provided in the URL
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    $readerName = getReaderNameForBook($book_id);
    header('Content-Type: application/json');
    echo json_encode(['name' => $readerName]);
}


?>