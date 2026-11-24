<!--Innehåll för sida för Bucketlist-->

<!--KVAR ATT GÖRA: Fixa så man kan ändra/uppdatera om man är klar med en post
SNYGGA TILL FILEN! VALIDERING SEPARAT?-->

<?php
//STARTAR SESSION
//Startar en session för att kunna spara information mellan sidladdningar
session_start();

//HÄMTAR KLASSER
//Hämtar klasserna som behövs för databaskoppling och bucketlist

//Hämtar klasserna för att hantera databas och innehåll
require_once "classes/Database.php";
require_once "classes/Bucketlist.php";

//DATABASANSLUTNING
//Skapar ett Database-objekt och hämtar databaskopplingen
//Sparas i varibeln database
$database = new Database();

//Hämtar databaskopplingen
//Sparar i variabeln connection
$connection = $database->getConnection();

//Skapar ett Bucketlist objekt med databaskopplingen
//Sparas i bucketlist
$bucketlist = new Bucketlist($connection);

//FELMEDDELANDEN
//Variabler som sparar eventuella felmeddelanden
$nameError = "";
$descriptionError = "";
$priorityError = "";


// HANTERAR POST
// Kontrollerar om ett formulär har skickats till sidan

//Kontrollerar om formuläret har skickats med POST metoden
//Använder SERVER för att information om förfrågan
//REQUEST_METHOD talar om vilken metod som användes. Metod POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //KONTROLLERAR OM EN POST SKA TAS BORT
    //isset kontrollerar om ett värde finns och inte är null
    //POST används för att hämta värden som skickats från formuläret
    if (isset($_POST["delete"])) {
        //Hämtar id för posten som ska tas bort
        $id = $_POST["id"];

        //Tar bort posten från databasen med dess ID
        //Omvabdlar värdet till int
        $bucketlist->delete((int) $id);

        //HANTERAR ÄNDRING AV STATUS PÅ EN POST
    } elseif (isset($_POST["completed"])) {

        //Hämtar ID för posten som ska ändras
        $id = $_POST["id"];

        //Ändrar postens status mellan slutförd och inte slutförd
        $bucketlist->toggleCompleted((int) $id);

        //HANTERAR TILLÄGG AV NY POST
        //Hämtar formulärvärden och kontrollerar att de är giltiga
    } else {
        //HÄMTAR FORMULÄRVÄRDEN
        //Hämtar värdena som skickats från formuläret med POST
        $name = $_POST["name"];
        $description = $_POST["description"];
        $priority = $_POST["priority"];

        //SPARAR FORMULÄRVÄRDEN I SESSIONEN
        //Gör det möjligt att behålla värdena om valideringen misslyckas
        $_SESSION["name"] = $name;
        $_SESSION["description"] = $description;
        $_SESSION["priority"] = $priority;

        //VALIDERAR FORMULÄRFÄLTEN

        //Kontrollerar att namnet inte är tomt
        if (empty(trim($name))) {

            //Sparar ett felmeddelande om namnet är tomt
            $nameError = "Du måste fylla i ett namn.";
        }

        //Kontrollerar att beskrivningen inte är tom
        if (empty(trim($description))) {

            //Sparar ett felmeddelande om beskrivningen är tom
            $descriptionError = "Du måste fylla i en beskrivning.";
        }

        //Kontrollerar att prioriteten är ett av de tillåtna värdena
        //in_array används för att gå igenom arrayen
        if (!in_array($priority, ["1", "2", "3"])) {

            //Sparar ett felmeddelande om prioriteten är ogiltig
            $priorityError = "Du måste välja prioritet.";
        }

        //SPARAR FELMEDDELANDEN I SESSIONEN
        $_SESSION["nameError"] = $nameError;
        $_SESSION["descriptionError"] = $descriptionError;
        $_SESSION["priorityError"] = $priorityError;

        //KONTROLLERAR OM VALIDERINGEN HAR LYCKATS
        //om inga fel hittats läggs post till i databasen
        if (empty($nameError) && empty($descriptionError) && empty($priorityError)) {

            //Lägger till en ny post i 
            //Omvandlar priority till int
            $bucketlist->add($name, $description, (int) $priority);

            //Tömmer de sparade formulärvärdena och felmeddelandena när formulär skickats
            unset($_SESSION["name"]);
            unset($_SESSION["description"]);
            unset($_SESSION["priority"]);
            unset($_SESSION["nameError"]);
            unset($_SESSION["descriptionError"]);
            unset($_SESSION["priorityError"]);
        }
    }

    //Skickar tillbaka besökaren till bucketlist sidan med Location
    //Om det finns valideringsfel skickas besökaren till formuläret
    if (!empty($nameError) || !empty($descriptionError) || !empty($priorityError)) {

        header("Location: bucketlist.php#add-form");

    } else {
        header("Location: bucketlist.php");
    }

    exit;
}

//HÄMTAR DATA FRÅN DATABASEN
//Hämtar bucketlistens poster från databasen
$posts = $bucketlist->getAll();

//HÄMTAR FORMULÄRVÄRDEN FRÅN SESSIONEN
//Hämtar sparade värden eller använder tomma strängar om inga finns
$name = $_SESSION["name"] ?? "";
$description = $_SESSION["description"] ?? "";
$priority = $_SESSION["priority"] ?? "";

//HÄMTAR FELMEDDELANDEN FRÅN SESSIONEN
//Hämtar sparade felmeddelanden eller använder tomma strängar
$nameError = $_SESSION["nameError"] ?? "";
$descriptionError = $_SESSION["descriptionError"] ?? "";
$priorityError = $_SESSION["priorityError"] ?? "";

//TÖMMER SESSIONEN
//Tar bort de sparade värdena efter att de har hämtats
unset($_SESSION["name"]);
unset($_SESSION["description"]);
unset($_SESSION["priority"]);
unset($_SESSION["nameError"]);
unset($_SESSION["descriptionError"]);
unset($_SESSION["priorityError"]);

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

        <!--Visar en enskild post-->

        <!--Visar en enskild post och lägger till en klass om posten är markerad slutförd-->
        <article class="<?php echo $post["completed"] == 1 ? 'completed' : ''; ?>">
            <!--Postens namn och beskrivning-->
            <h3><?php echo htmlspecialchars($post["name"]); ?></h3>
            <p><?php echo htmlspecialchars($post["description"]); ?></p>

            <!--Visar postens prioritet-->
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
            <!--visar datum när posten skapades-->
            <p>Skapad:
                <?php echo date("Y-m-d", strtotime($post['created_at'])); ?>
            </p>

            <!--UPDATE COMPLETED-->
            <!--Formulär för att ändra status på en post. Formulär skickas med metod POST-->
            <form method="POST" action="bucketlist.php">

                <!--Skickar med postens id till php-->
                <!--hidden döljer fält på sidan-->
                <input type="hidden" name="id" value="<?php echo $post["id"]; ?>">

                <?php
                //Kontrollerar om posten är slutförd eller inte
                if ($post["completed"] == 0): ?>

                    <!--Knapp för att markera posten som slutförd-->
                    <button type="submit" name="completed" value="1">Markera som slutförd</button>

                <?php else: ?>

                    <!--Knapp för att ångra markeringen-->
                    <button type="submit" name="completed" value="1">Ångra slutförd</button>

                <?php endif; ?>
            </form>

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

<!--formulär för att lägga till en ny bucketlist post (id används dör omdirigering)-->
<section id="add-form">

    <!--Rubrik-->
    <h2>Lägg till en ny post</h2>

    <!--Metod POST används för att skicka värden
     action visar på vilken sida som ska ta emot formulätet-->
    <form method="POST" action="bucketlist.php">

        <!--fält för postens namn-->
        <label for="name">Namn:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">

        <!--Kontrollerar att variabeln $nameError inte är tom-->
        <?php if (!empty($nameError)): ?>
            <!--Visar felmeddelande om namnet är tomt -->
            <p class="error-message">
                <?php echo htmlspecialchars($nameError); ?>
            </p>
        <?php endif; ?>

        <!--Fält för postens beskrivning-->
        <label for="description">Beskrivning:</label>
        <textarea id="description" name="description"><?php echo htmlspecialchars($description); ?></textarea>

        <!--Kontrollerar att variabeln $descriptionError inte är tom-->
        <?php if (!empty($descriptionError)): ?>
            <!-- Visar felmeddelande om beskrivningen är tom -->
            <p class="error-message">
                <?php echo htmlspecialchars($descriptionError); ?>
            </p>
        <?php endif; ?>

        <!--Val av prioritet-->
        <label for="priority">Prioritet:</label>
        <select id="priority" name="priority">
            <option value="" <?php if ($priority == "")
                echo "selected"; ?>>Välj prioritet</option>
            <option value="1" <?php if ($priority == "1")
                echo "selected"; ?>>Hög</option>
            <option value="2" <?php if ($priority == "2")
                echo "selected"; ?>>Medel</option>
            <option value="3" <?php if ($priority == "3")
                echo "selected"; ?>>Låg</option>
        </select>

        <!--Kontrollerar att variabeln $priorityError inte är tom-->
        <?php if (!empty($priorityError)): ?>
            <!-- Visar felmeddelande om prioriteten är ogiltig -->
            <p class="error-message">
                <?php echo htmlspecialchars($priorityError); ?>
            </p>
        <?php endif; ?>

        <!--Knapp för att skicka formuläret-->
        <button type="submit">Lägg till</button>

    </form>

</section>

<?php
//Inkluderar footer
include "includes/footer.php";
?>