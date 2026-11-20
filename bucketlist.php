<!--Innehåll för sida för Bucketlist-->

<!--KVAR ATT GÖRA: Fixa så man kan ändra/uppdatera om man är klar med en post-->

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

//SKICKA OCH TA BORT

//Kontrollerar om formuläret har skickats med POST metoden
//Använder SERVER för att information om förfrågan
//REQUEST_METHOD talar om vilken metod som användes. Metod POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //Kontrollerar om användaren vill ta bort en post
//isset kontrollerar om värde skickats och om det är null
//POST används för att hämta värden som skickats från formuläret
    if (isset($_POST["delete"])) {
        //Hämtar id för posten som ska tas bort
        $id = $_POST["id"];

        //Tar bort posten från databasen med dess ID
        //Omvabdlar värdet till int
        $bucketlist->delete((int) $id);

    } else {
        //Hämtar värdena från formuläret med POST
        $name = $_POST["name"];
        $description = $_POST["description"];
        $priority = $_POST["priority"];

        //Lägger till en ny post i 
        //Omvandlar priority till int
        $bucketlist->add($name, $description, (int) $priority);

        //Skickar tillbaka besökaren till bucketlist sidan med Location
        //exit avslutar php körning
        header("Location: bucketlist.php");
        exit;
    }
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

            <!--Visar postens prioritet
            Skriver ut beroende på vad som valts. Från 1 som högst till 3 som lägst-->
            <p>Prioritet:
                <?php
                if ($post['priority'] == 1) {
                    echo "Hög";
                } elseif ($post['priority'] == 2) {
                    echo "Medel";
                } elseif ($post['priority'] == 3) {
                    echo "Låg";
                }
                ?>
            </p>
            <!--visar när posten skapades
            created at hämtar datum och tid från db
            strtotime omvandlar datumet format som date kan arbeta med
            date "Y-m-d" formaterar datumet så att det visas som tex 2026-11-20-->
            <p>Skapad:
                <?php echo date("Y-m-d", strtotime($post['created_at'])); ?>
            </p>


            <!--Ta bort en post-->
            <!--Formulär för att ta bort post. Formulär skickas med metod POST-->
            <form method="POST" action="bucketlist.php">

                <!--Skickar med postens id till php-->
                <!--hidden döljer fält på sidan-->
                <input type="hidden" name="id" value="<?php echo $post['id']; ?>">

                <!--Knapp för att ta bort posten-->
                <button type="submit" name="delete" value="1">Ta bort</button>

            </form>
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