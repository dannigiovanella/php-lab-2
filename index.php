
<!--INNEHÅLL FÖR WEBBPLATSENS STARTSIDA-->


<!--head och header-->
<?php
//Sidans titel som skickas till header.php
//Titel sparas i variabeln pageTitle
$pageTitle = "Startsida";

//Inkluderar webbplatsens header
include "includes/header.php";
?>

<!--Innehåll för startsidan-->

<section>
    <!--Huvudrubrik -->
    <h2>Välkommen till min Bucketlist!</h2>

    <!--Kort text om webbplatsen -->
    <p>Skriv en lite förklarande text om innehållet på sidan. alt, info om uppgiften</p>

</section>

<?php
//Inkluderar footer
include "includes/footer.php";
?>
