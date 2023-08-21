"use strict";

//VARIABLES
let addNewBookBtn = document.getElementById("addNewBookBtn");
let deleteBookBtn = document.getElementById("deleteBookBtn");
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
            fetchAndPopulateBooks(); // Refresh the book list
        }).catch(error => console.error("Error:" + error));
    };
};


// Function to update book and fetch that into HTML
function updateBook() {
    let id = document.getElementById("idOfBook").value;
    let updatedTitle = document.getElementById("updateBookName").value;
    let updatedAuthor = document.getElementById("updateBookAuthor");

    if (id & updatedTitle & updatedAuthor) {
        
    }
}


// Function to delete book and fetch that into HTML
function deleteBook() {
    let IDOfDeletingBook = document.getElementById("IDOFBOOK").value;

    if (IDOfDeletingBook) {
        fetch("src/php/booksScript.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `id=${encodeURIComponent(IDOfDeletingBook)}`,
        })
        .then(response => response.json())
        .then(data => {
            fetchAndPopulateBooks(); // i think i must again change this function, cause when i delete something, it doesn't disappear from list of books
        }).catch(error => console.error("Error:" + error));
    };
};


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
