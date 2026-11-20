

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

//Kontrollerar om formuläret har skickats med POST metoden
//Använder SERVER för att information om förfrågan
//REQUEST_METHOD talar om vilken metod som användes
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Hämtar värdena från formuläret
    $name = $_POST["name"];
    $description = $_POST["description"];
    $priority = $_POST["priority"];

    //Lägger till en ny post i 
    //Omvandlar priority till int
    $bucketlist->add($name, $description, (int)$priority);
    
    //Skickar tillbaka besökaren till bucketlist sidan med Location
    //exit avslutar php körning
    header("Location: bucketlist.php");
    exit;

    }

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


     <!--Formulär-->

     <!--formulär för att lägga till en ny bucketlist post-->
    <section>

    <!--Rubrik-->
    <h2>Lägg till en ny post</h2>

     <!--Metod POST används för att skicka värden
     action visar på vilken sida som ska ta emot formulätet-->
    <form method="POST" action="bucketlist.php">

        <!--fält för postens namn-->
        <label for="name">Namn:</label>
        <input type="text" id="name" name="name">

        <!--Fält för postens beskrivning-->
        <label for="description">Beskrivning:</label>
        <textarea id="description" name="description"></textarea>

        <!--Val av prioritet-->
        <label for="priority">Prioritet:</label>
        <select id="priority" name="priority">
            <option value="">Välj prioritet</option>
            <option value="1">Hög</option>
            <option value="2">Medel</option>
            <option value="3">Låg</option>
        </select>

        <!--Knapp för att skicka formuläret-->
        <button type="submit">Lägg till</button>

    </form>

</section>

<?php
//Inkluderar footer
include "includes/footer.php";
?>
