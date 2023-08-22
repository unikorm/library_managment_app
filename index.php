<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="src/js/main.js" defer></script>
</head>
<body>
    <?php include 'src/php/mainScript.php'; ?>

    <section id="booksListSection">
        <p>Naše knihy</p>
        <div id="booksList">

            

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
        <p>Čitatelia</p>
        <div id="readersList">

            

        </div>

        <div id="formToEditListOfReaders">    <!-- edit/delete/add reader -->
            <div id="addReader">
                <input type="text" id="addReaderName" placeholder="Tvoje Meno">
                <input type="text" id="addReaderId" placeholder="Číslo OP">
                <input type="text" id="addReaderBirthDate" placeholder="Narodení(1998-03-22)">
                <button id="addNewReaderBtn" type="button">Pridať</button>
            </div>
            <div id="updateReader">
                <input type="text" id="idOfReader" placeholder="ID Čitateľa">
                <input type="text" id="updateReaderName" placeholder="Tvoje nové Meno">
                <input type="text" id="updateReaderId" placeholder="Nové číslo OP">
                <input type="text" id="updateReaderBirthDate" placeholder="Noví dátum (1998-03-22)">
                <button id="updateReaderBtn">Upraviť</button>
            </div>
            <div id="deleteReader">
                <input type="text" id="IDOFREADER" placeholder="ID Čitateľa na vymazanie">
                <button id="deleteReaderBtn">Vymazať</button>
            </div>
        </div>
    </section>

    <section id="loanReturnForms">
        <div id="loanForm">   
            <!-- loan a book by her id,  by readers id (from date) -->
            <input type="text" id="idOfBookToLoan" placeholder="ID knihy na vypožičanie">
            <input type="text" id="idOfReaderToLoan" placeholder="ID čitateľa">
            <input type="text" id="dateFromBookLoan" placeholder="Od kedy požičiava">
            <button id="loanBookBtn">Požičať</button>
            <p id="loanedBookIdDisplay"></p>
        </div>

        <div id="returnForm"> 
        <!-- return a book  by her id (till date)-->
            <input type="text" id="idOfBookToReturn" placeholder="ID tvojej objednávky">
            <input type="text" id="dateUntilBookLoan" placeholder="Dátum vrátenia">
            <button id="returnBookBtn">Vrátiť</button>
        </div>
    </section>

</body>
</html>
