"use strict";
//variables


// functions

// Function to fetch books data and populate HTML
function fetchAndPopulateBooks() {
    fetch("src/php/booksScript.php")
    .then(response => response.json())
    .then(data => {
        const booksListContainer = document.getElementById("booksList");
            data.forEach(book => {
                const bookItem = document.createElement("div");
                bookItem.classList.add("bookItem");
                bookItem.innerHTML = `
                    <p>Číslo: ${book.id}</p>
                    <h4>Názov: ${book.title}</h4>
                    <p>Autor: ${book.author}</p>
                    <p>Požičaná: ${book.is_borrowed}</p>
                `;
                booksListContainer.appendChild(bookItem);
            });
        })
    .catch(error => console.error("Error:", error));
};

fetchAndPopulateBooks();
