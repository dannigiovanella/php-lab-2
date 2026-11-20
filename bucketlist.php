

<!--Innehåll för sida för Bucketlist-->

<!--Att lägga till: Formulär för att lägga till saker.
    Visa sparade saker från databasen.-->

<?php

//Koppling till databas

//Hämtar klasserna för att hantera databas och innehåll
require_once "classes/Database.php";
require_once "classes/Bucketlist.php";

//Databasanslutning

//Skapar ett objekt för databaskopplingen
//Sparas i varibeln database
$database = new Database();

//Hämtar databaskopplingen
//Sparar i variabeln connection
$connection = $database->getConnection();

//Skapar ett Bucketlist objekt med databaskopplingen
//Sparas i bucketlist
$bucketlist = new Bucketlist($connection);

//HÄMTAR
//Hämtar alla poster från databasen
//Sparas o posts
$posts = $bucketlist->getAll();

//head och header

//Sidans titel som skickas till header.php
//Titel sparas i variabeln pageTitle
$pageTitle = "Min Bucketlist";

//Inkluderar header
include "includes/header.php";
?>

<!--Bucketlistens innehåll-->

<section>

    <!--Huvudrubrik -->
    <h2>Min Bucketlist</h2>

    <!--Kort text om sidan-->
    <p>Skriv lite om bucketlisten</p>

    <!--Skriver ut Bucketlistan-->

    <!--Loopar igenom alla poster i posts
    post representerar varje enskild post i listan-->
     <?php foreach ($posts as $post): ?>

        <!--Skriver ut post i bucketlisten med namn och beskrivning
        Tillåter specialtecken-->
        <article>
            <h3><?php echo htmlspecialchars($post["name"]); ?></h3>
            <p><?php echo htmlspecialchars($post["description"]); ?></p>
        </article>

    <?php endforeach; ?>


</section>

<?php
//Inkluderar footer
include "includes/footer.php";
?>
