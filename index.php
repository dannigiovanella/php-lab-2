<!--INNEHÅLL FÖR WEBBPLATSENS STARTSIDA
Innehåller information om uppgift-->


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

    <!--Kort text om webbplatsen och uppgiften-->
    <p>Den här webbplatsen är skapad som en del i kursen Webbutveckling med WordPress. Uppgiften syftar till att lära
        sig programmeringsspråket PHP genom att skapa en webbplats för en Bucketlist med hjälp av HTML, CSS och
        objektorienterad PHP där information lagras och hämtas från en databas, och genom att arbeta med detta på ett
        praktiskt sätt också kunna förstå hur de olika delarna hänger ihop i ett projekt.</p>

    <p>Webbplatsen innehåller en bucketlist där det går att lägga till nya saker i sin lista genom ett formulär, ta bort
        en post om man skulle känna att detta vill jag verkligen inte göra längre, eller markera sådant man redan gjort
        som avklarat.</p>
</section>

<!--Reflektioner kring PHP-->
<section>
    <!--Reflektioner-->
    <h3>Refletioner kring PHP</h3>
    <p>Jag tyckte att PHP var relativt enkelt att sätta sig in i och arbeta med. Jag uppskattade hur man kunde dela upp
        projektet i olika filer med återanvändbara komponenter som exempelvis för header och footer. Detta gjorde det
        enklare att arbete med enskilda delar av webbplatsen och slippa uppdatera varje sida separat vid ändringar.</p>

    <p>Dock upplevde jag att det kändes rörigt att blanda ihop PHP och HTML i samma fil då det kunde bli ganska mycket
        kod runt den HTML-koden som bygger upp sidans innehåll. För mig kändes det då svårt att navigera i filen och få
        en bra överblick över sidans innehåll och struktur. Jag tror säkert att det finns sätt där man kan jobba på ett
        mer effektivt och organiserat sätt med PHP, men utifrån mitt utgångsläge där jag fortfarande lär mig och testar
        mig fram så upplevde jag detta arbetssätt som ganska rörigt.</p>


    <!--Reflektioner kring databas, sql och pdo-->
    <h3>Databas, SQL och PDO</h3>
    <p>Att jobba med SQL-frågor i PHP kändes också det relativt enkelt. Metoderna för att hämta, lägga till, ta bort och
        uppdatera hade likandande struktur, så när jag väl hade förstått strukturen av en metod och hur den fungerade
        var det lättare att förstå hur jag kunde jobba vidare med de andra.</p>

    <p>För koppling till databasen användes PDO. Valet grundades på att det passade bra med uppgiftens objektorienterade
        upplägg, men framför allt då detta kan användas med flera olika databassystem vilket jag ser kan vara användbart
        i kommande projekt.</p>

    <p>Arbetet med PDO krävde lite mer egen efterforskning och läsning av dokumentation för att förstå hur det
        fungerade. Även om det var en del att sätta sig in i så kändes dock dokumentationen inte allt för svår att följa
        och det fanns mycket användbart att testa sig fram med, exempelvis PDOs egen felhantering för att kunna fånga
        upp fel vid anrop mot databasen.</p>

    <p>Att jobba med PHP tillsammans med dessa olika delar och verktyg har fungerat bra och har gett mycket kunskap om
        nya tekniker och hur man kan jobba med dessa.</p>
</section>

<?php
//Inkluderar footer
include "includes/footer.php";
?>