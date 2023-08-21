"use strict";
//variables
let booksList = document.getElementById("booksList");


document.getElementById("").addEventListener("click", () => {
    fetch("script.php") // Replace with your PHP endpoint
        .then(response => response.json())
        .then(data => {
            // Update UI or perform actions based on the response data
            console.log(data.message);
        })
        .catch(error => {
            console.error("An error occurred:", error);
        });
});
