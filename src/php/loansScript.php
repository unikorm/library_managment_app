<?php

require_once "mainScript.php";

// Loan a book
function loanBook($book_id, $reader_id, $loan_date) {
    global $conn;
    $sql = "INSERT INTO loans (book_id, reader_id, loan_date) VALUES ($book_id, $reader_id, '$loan_date')";
    $conn->query($sql);
    return $conn->insert_id; // Return the loan ID
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["book_id"]) && isset($_POST["reader_id"]) && isset($_POST["loan_date"])) {
    $book_id = $_POST["book_id"];
    $reader_id = $_POST["reader_id"];
    $loan_date = $_POST["loan_date"];
    $loan_id = loanBook($book_id, $reader_id, $loan_date); // Get the loan ID 
    echo json_encode(array("message" => "Book loaned successfully.", "loan_id" => $loan_id));
    exit;
}

// Return a book
function returnBook($loan_id, $return_date) {
    global $conn;
    $sql = "UPDATE loans SET return_date = '$return_date' WHERE id = $loan_id";
    $conn->query($sql);
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["loan_id"]) && isset($_POST["return_date"])) {
    $loan_id = $_POST["loan_id"];
    $return_date = $_POST["return_date"];
    
    returnBook($loan_id, $return_date);
    echo json_encode(array("message" => "Book returned successfully."));
    exit;
}

?>
