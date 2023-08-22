<?php

require_once "mainScript.php";

// Loan a book
function loanBook($book_id, $reader_id, $loan_date) {
    global $conn;
    $sql = "INSERT INTO loans (book_id, reader_id, loan_date) VALUES ($book_id, $reader_id, '$loan_date')";
    $conn->query($sql);
    $loan_id = $conn->insert_id;
    $updateSql = "UPDATE books SET is_borrowed = 1 WHERE id = $book_id";
    $conn->query($updateSql);

    $readerQuery = "SELECT name FROM readers WHERE id = $reader_id";
    $readerResult = $conn->query($readerQuery);
    $readerName = "";
    if ($readerResult->num_rows === 1) {
        $readerRow = $readerResult->fetch_assoc();
        $readerName = $readerRow["name"];
    }
    return array("loan_id" => $loan_id, "reader_name" => $readerName);
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["book_id"]) && isset($_POST["reader_id"]) && isset($_POST["loan_date"])) {
    $book_id = $_POST["book_id"];
    $reader_id = $_POST["reader_id"];
    $loan_date = $_POST["loan_date"];
    $loan_id_and_reader = loanBook($book_id, $reader_id, $loan_date);
    $loan_id = $loan_id_and_reader["loan_id"];
    $readerName = $loan_id_and_reader["reader_name"];  
    echo json_encode(array("message" => "Book loaned successfully.", "loan_id" => $loan_id, "reader_name" => $readerName));
    exit;
}

// Return a book
function returnBook($loan_id, $return_date) {
    global $conn;
    $bookIdQuery = "SELECT book_id FROM loans WHERE id = $loan_id";
    $result = $conn->query($bookIdQuery);
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $book_id = $row["book_id"];

        $updateLoanSql = "UPDATE loans SET return_date = '$return_date' WHERE id = $loan_id";
        $conn->query($updateLoanSql);
        $updateBookSql = "UPDATE books SET is_borrowed = 0 WHERE id = $book_id";
        $conn->query($updateBookSql);
    }
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["loan_id"]) && isset($_POST["return_date"])) {
    $loan_id = $_POST["loan_id"];
    $return_date = $_POST["return_date"];
    
    returnBook($loan_id, $return_date);
    echo json_encode(array("message" => "Book returned successfully."));
    exit;
}

?>
