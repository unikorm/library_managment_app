<?php

require_once "mainScript.php";

// Create
function addLoan($bookId, $readerId, $loanDate) {
    global $conn;
    $sql = "INSERT INTO loans (book_id, reader_id, loan_date) VALUES ('$bookId', '$readerId', '$loanDate')";
    $conn->query($sql);
}

// Update (for returning a book)
function returnBook($bookId) {
    global $conn;
    $sql = "UPDATE loans SET return_date = NOW() WHERE book_id = $bookId AND return_date IS NULL";
    $conn->query($sql);
}
?>
