<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'src/php/mainScript.php'; ?>

    <section id="booksListSection">
        <div id="booksList">
            <p>Naše knihy</p>

            <div id="bookItem">
                <p>Číslo: <?php echo $bookData["id"]; ?></p>
                <h4>Názov: <?php echo $bookData["title"]; ?></h4>
                <p>Autor: <?php echo $bookData["author"]; ?></p>
                <p>Požičaná: <?php echo $bookData["is_borrowed"]; ?></p>
            </div>

        </div>

        <div id="formToEditListOfBooks">  <!-- edit/delete/add book -->

        </div>
    </section>

    <section id="readersListSection">
        <div id="readersList">
            <p>Čitatelia</p>

            <div id="readerItem">
                <p>Číslo: <?php echo $readerData["id"]; ?></p>
                <h4>Meno: <?php echo $readerData["name"]; ?></h4>
                <p>OP: <?php echo $readerData["id_card"]; ?></p>
                <p>Dátum narodenia: <?php echo $readerData["birth_date"]; ?></p>
            </div>

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
