"use strict";

//VARIABLES
let addNewBookBtn = document.getElementById("addNewBookBtn");
let deleteBookBtn = document.getElementById("deleteBookBtn");
let updateBookBtn = document.getElementById("updateBookBtn");
let lastDisplayedBookId = 0;

// FUNCTIONS
// Function to add a new book
function addNewBook() {
    let title = document.getElementById("addBookName").value;
    let author = document.getElementById("addBookAuthor").value;

    if (title && author) {
        fetch("src/php/booksScript.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `title=${encodeURIComponent(title)}&author=${encodeURIComponent(author)}`,
        })
        .then(response => response.json())
        .then(data => {
            console.log('Book added:', data);
            fetchAndPopulateBooks(); // Refresh the book list
        }).catch(error => console.error("Error:", error));
    };
};


// Function to update book and fetch that into HTML
function updateBook() {
    const id = parseInt(document.getElementById('idOfBook').value);
    const title = document.getElementById('updateBookName').value;
    const author = document.getElementById('updateBookAuthor').value;
    
    if (!isNaN(id) && title && author) {
        fetch('src/php/booksScript.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${encodeURIComponent(id)}&title=${encodeURIComponent(title)}&author=${encodeURIComponent(author)}`,
        })
        .then(response => response.json())
        .then(data => {
            console.log('Book updated:', data);
            fetchAndPopulateBooks(); // Refresh the book list after updating a book
        })
        .catch(error => console.error('Error:', error));
    }
}


// Function to delete book and fetch that into HTML
function deleteBook() {
    const id = parseInt(document.getElementById('IDOFBOOK').value); // Convert to integer
    
    if (!isNaN(id)) { // Check if id is a valid number
        fetch('src/php/booksScript.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${encodeURIComponent(id)}`,
        })
        .then(response => response.json())
        .then(data => {
            console.log('Book deleted:', data);
            fetchAndPopulateBooks(); // Refresh the book list after deleting a book
        })
        .catch(error => console.error('Error:', error));
    }
}


// Function to fetch books data and populate HTML
function fetchAndPopulateBooks() {
    fetch("src/php/booksScript.php")
    .then(response => response.json())
    .then(data => {
        const booksListContainer = document.getElementById("booksList");
        const newBooks = data.filter(book => book.id > lastDisplayedBookId);  // Filter only new books based on the last displayed book ID
            newBooks.forEach(book => {
            const bookItem = document.createElement("div");
            bookItem.classList.add("bookItem");
            bookItem.innerHTML = `
                <p>Číslo: ${book.id}</p>
                <h4>Názov: ${book.title}</h4>
                <p>Autor: ${book.author}</p>
                <p>Požičaná: ${book.is_borrowed}</p>
            `;
            booksListContainer.appendChild(bookItem);
            lastDisplayedBookId = book.id;  // Update the lastDisplayedBookId
        });
    }).catch(error => console.error("Error:", error));
};

fetchAndPopulateBooks();


// LISTENERS
// Attach click event to the "Pridať" button
addNewBookBtn.addEventListener("click", addNewBook);
deleteBookBtn.addEventListener("click", deleteBook);
updateBookBtn.addEventListener("click", updateBook);
