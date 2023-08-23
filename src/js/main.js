"use strict";

const borrowedBooksMap = new Map();  // Map: book_id => reader_id
// !!!!!READER SECTION!!!!!

// VARIABLES
let addNewReaderBtn = document.getElementById("addNewReaderBtn");
let deleteReaderBtn = document.getElementById("deleteReaderBtn");
let updateReaderBtn = document.getElementById("updateReaderBtn");

// FUNCTIONS
// Function to add a new reader
function addNewReader() {
    let name = document.getElementById("addReaderName").value;
    let id_card = document.getElementById("addReaderId").value;
    let birth_date = document.getElementById("addReaderBirthDate").value;

    if (name && id_card && birth_date) {
        fetch("src/php/readersScript.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `name=${encodeURIComponent(name)}&id_card=${encodeURIComponent(id_card)}&birth_date=${encodeURIComponent(birth_date)}`,
        })
        .then(response => response.json())
        .then(data => {
            console.log("Reader added:", data);
            fetchAndPopulateReaders();
        }).catch(error => console.error("Error:", error));
    };
}

// Function to update reader and fetch that into HTML
function updateReader() {
    const id = parseInt(document.getElementById("idOfReader").value);
    const name = document.getElementById("updateReaderName").value;
    const id_card = document.getElementById("updateReaderId").value;
    const birth_date = document.getElementById("updateReaderBirthDate").value;
    
    if (!isNaN(id) && name && id_card && birth_date) {
        fetch("src/php/readersScript.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `id=${encodeURIComponent(id)}&name=${encodeURIComponent(name)}&id_card=${encodeURIComponent(id_card)}&birth_date=${encodeURIComponent(birth_date)}`,
        })
        .then(response => response.json())
        .then(data => {
            console.log("Reader updated:", data);
            fetchAndPopulateReaders();
        }).catch(error => console.error("Error:", error));
    };
}

// Function to delete reader and fetch that into HTML
function deleteReader() {
    const id = parseInt(document.getElementById('IDOFREADER').value); // Convert to integer
    
    if (!isNaN(id)) {
        fetch("src/php/readersScript.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `id=${encodeURIComponent(id)}`,
        })
        .then(response => response.json())
        .then(data => {
            console.log("Reader deleted:", data);
            fetchAndPopulateReaders();
        }).catch(error => console.error("Error:", error));
    };
}

// Function to fetch readers data and populate HTML
function fetchAndPopulateReaders() {
    fetch("src/php/readersScript.php")
    .then(response => response.json())
    .then(data => {
        const readersListContainer = document.getElementById("readersList");
        readersListContainer.innerHTML = "";
        
        data.forEach(reader => {
            const readerItem = document.createElement("div");
            readerItem.classList.add("readerItem");
            readerItem.innerHTML = `
                <p>Číslo: ${reader.id}</p>
                <h4>Meno: ${reader.name}</h4>
                <p>Číslo OP: ${reader.id_card}</p>
                <p>Dátum narodenia: ${reader.birth_date}</p>
            `;
            readersListContainer.appendChild(readerItem);
        });
    }).catch(error => console.error("Error:", error));
}

fetchAndPopulateReaders();

// LISTENERS
addNewReaderBtn.addEventListener("click", addNewReader);
deleteReaderBtn.addEventListener("click", deleteReader);
updateReaderBtn.addEventListener("click", updateReader);









// !!!!!BOOK SECTION!!!!

//VARIABLES
let addNewBookBtn = document.getElementById("addNewBookBtn");
let deleteBookBtn = document.getElementById("deleteBookBtn");
let updateBookBtn = document.getElementById("updateBookBtn");

// FUNCTIONS
// Function to add a new book
function addNewBook() {
    let title = document.getElementById("addBookName").value;
    let author = document.getElementById("addBookAuthor").value;

    if (title && author) {
        fetch("src/php/booksScript.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `title=${encodeURIComponent(title)}&author=${encodeURIComponent(author)}`,
        })
        .then(response => response.json())
        .then(data => {
            console.log("Book added:", data);
            fetchAndPopulateBooks();
        }).catch(error => console.error("Error:", error));
    };
};

// Function to update book and fetch that into HTML
function updateBook() {
    const id = parseInt(document.getElementById("idOfBook").value);
    const title = document.getElementById("updateBookName").value;
    const author = document.getElementById("updateBookAuthor").value;
    
    if (!isNaN(id) && title && author) {
        fetch("src/php/booksScript.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `id=${encodeURIComponent(id)}&title=${encodeURIComponent(title)}&author=${encodeURIComponent(author)}`,
        })
        .then(response => response.json())
        .then(data => {
            console.log("Book updated:", data);
            fetchAndPopulateBooks();
        }).catch(error => console.error("Error:", error));
    };
};

// Function to delete book and fetch that into HTML
function deleteBook() {
    const id = parseInt(document.getElementById('IDOFBOOK').value); // Convert to integer
    
    if (!isNaN(id)) {
        fetch("src/php/booksScript.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `id=${encodeURIComponent(id)}`,
        })
        .then(response => response.json())
        .then(data => {
            console.log("Book deleted:", data);
            fetchAndPopulateBooks();
        }).catch(error => console.error("Error:", error));
    };
};

// Function to fetch books data and populate HTML
async function fetchAndPopulateBooks() {
    try {
        const response = await fetch("src/php/booksScript.php");
        const data = await response.json();

        const booksListContainer = document.getElementById("booksList");
        booksListContainer.innerHTML = "";

        for (const book of data) {
            const bookItem = document.createElement("div");
            bookItem.classList.add("bookItem");
            let bookMark = parseInt(book.is_borrowed);
            let bookId = parseInt(book.id);
            bookItem.innerHTML = `
                <p>Číslo: ${bookId}</p>
                <h4>Názov: ${book.title}</h4>
                <p>Autor: ${book.author}</p>
                <p>Požičaná: ${bookMark}</p>`;

            if (bookMark === 1 && borrowedBooksMap.has(bookId)) {
                const reader_id = borrowedBooksMap.get(bookId);
                console.log(reader_id);
                const readerNameResponse = await fetch(`src/php/readersScript.php?id=${encodeURIComponent(reader_id)}`);
                const readerData = await readerNameResponse.json();
                const readerName = readerData.reader_name;
                bookItem.innerHTML += `<p>Čitateľ: ${readerName}</p>`;
            };
            console.log(bookItem);
            booksListContainer.appendChild(bookItem);
        };
    } catch (error) {
        console.error("Error:", error);
    };
};




fetchAndPopulateBooks();

// LISTENERS
addNewBookBtn.addEventListener("click", addNewBook);
deleteBookBtn.addEventListener("click", deleteBook);
updateBookBtn.addEventListener("click", updateBook);













// !!!!!!LOANS SECTION!!!!!!!

// VARIABLES
let loanBookBtn = document.getElementById("loanBookBtn");
let returnBookBtn = document.getElementById("returnBookBtn");
let loanedBookIdDisplay = document.getElementById("loanedBookIdDisplay");

// FUNCTIONS
// Function to loan a book
function loanBook() {
    const book_id = parseInt(document.getElementById("idOfBookToLoan").value);
    const reader_id = parseInt(document.getElementById("idOfReaderToLoan").value);
    const loan_date = document.getElementById("dateFromBookLoan").value;
    
    if (!isNaN(book_id) && !isNaN(reader_id) && loan_date) {
        fetch("src/php/loansScript.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `book_id=${encodeURIComponent(book_id)}&reader_id=${encodeURIComponent(reader_id)}&loan_date=${encodeURIComponent(loan_date)}`,
        })
        .then(response => response.json())
        .then(data => {
            console.log("Book loaned:", data);
            let loanId = parseInt(data.loan_id);
            let readerName = data.reader_name;
            loanedBookIdDisplay.textContent = `ID objednávky: ${loanId}, vypožičal ${readerName}`; // Display loaned book ID
            borrowedBooksMap.set(book_id, reader_id);
            console.log(borrowedBooksMap);
            fetchAndPopulateBooks();
            console.log(borrowedBooksMap);
        }).catch(error => console.error("Error:", error));
    };
};


// Function to return a book
function returnBook() {
    const loan_id = parseInt(document.getElementById("idOfBookToReturn").value);
    const return_date = document.getElementById("dateUntilBookLoan").value;
    
    if (!isNaN(loan_id) && return_date) {
        fetch("src/php/loansScript.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `loan_id=${encodeURIComponent(loan_id)}&return_date=${encodeURIComponent(return_date)}`,
        })
        .then(response => response.json())
        .then(data => {
            console.log("Book returned:", data);
            let bookID = parseInt(data.book_id);
            console.log(typeof(bookID));
            borrowedBooksMap.delete(bookID);
            fetchAndPopulateBooks();
            loanedBookIdDisplay.textContent = "";
            console.log(borrowedBooksMap)
        }).catch(error => console.error("Error:", error));
    };
};

// LISTENERS
loanBookBtn.addEventListener("click", loanBook);
returnBookBtn.addEventListener("click", returnBook);
