<?php

require_once "mainScript.php";

// Fetch reader's name by ID
function getReaderName($reader_id) {
    global $conn;
    $query = "SELECT name FROM readers WHERE id = $reader_id";
    $result = $conn->query($query);
    $readerName = "";
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $readerName = $row["name"];
    }
    return array("reader_name" => $readerName);
}
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $reader_id = $_GET["id"];
    $getReaderName = getReaderName($reader_id);
    $readerName = $getReaderName["reader_name"];
    echo json_encode(array("reader_name" => $readerName));
    exit;
}

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

?>