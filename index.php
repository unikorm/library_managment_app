<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'src/php/mainScript.php'; ?>

    <section id="booksList">
        <p>Naše knihy</p>
        <ul>
            <li></li>              <!-- when somebody will have borrowed book, there must be name of him/her -->
        </ul>

        <div id="formToEditListOfBooks">  <!-- edit/delete/add book -->

        </div>
    </section>

    <section id="readersList">
        <p>Čitatelia</p>
        <ul>
            <li></li>
        </ul>

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
