<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="src/js/main.js"></script>
</head>
<body>
    <?php include 'src/php/mainScript.php'; ?>

    <section id="booksListSection">
        <div id="booksList">
            <p>Naše knihy</p>

            

        </div>

        <div id="formToEditListOfBooks">  <!-- edit/delete/add book -->
            <div id="addBook">
                <input type="text" id="addBookName" placeholder="Názov knihy">
                <input type="text" id="addBookAuthor" placeholder="Autor knihy">
                <button id="addNewBookBtn" type="button">Pridať</button>
            </div>
            <div id="updateBook">
                <input type="text" id="idOfBook" placeholder="ID knihy">
                <input type="text" id="updateBookName" placeholder="Uprav názov knihy">
                <input type="text" id="updateBookAuthor" placeholder="Uprav meno autora">
                <button id="updateBookBtn">Upraviť</button>
            </div>
            <div id="deleteBook">
                <input type="text" id="IDOFBOOK" placeholder="ID knihy na vymazanie">
                <button id="deleteBookBtn">Vymazať</button>
            </div>
        </div>
    </section>

    <section id="readersListSection">
        <div id="readersList">
            <p>Čitatelia</p>

            

        </div>

        <div id="formToEditListOfReaders">    <!-- edit/delete/add reader -->

        </div>
    </section>

    <section id="loanReturnForms">
        <div id="loanForm">       <!-- loan a book by her id,  by readers id (from date) -->

        </div>
        <div id="returnForm">     <!-- return a book  by her id (till date)-->

        </div>
    </section>

</body>
</html>
