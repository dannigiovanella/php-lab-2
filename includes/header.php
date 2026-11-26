<!--WEBBPLATSENS HEADER
Innehåller information om sidan och en navigationsmeny-->

<?php
//Hämtar sidans titel om den har angetts
//Om ingen titel har angetts används Bucketlist
$pageTitle = $pageTitle ?? "Bucketlist";
?>

<!--Webbplatsens head med nödvändig info för varje sida-->
<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Varje sidas titel. Tillåts inkludera specialtecken-->
    <title><?php echo htmlspecialchars($pageTitle); ?></title>

    <!--Koppling till CSS-->
    <link rel="stylesheet" href="css/style.css">
</head>

<!--Body stängs i footer-->

<body>

    <!--Webbplatsens gemensamma header med navigering-->
    <header>

        <!--Huvudrubrik och webbplatsens namn-->
        <h1>Min Bucketlist</h1>

        <!--Huvudnavigation-->
        <nav>
            <ul>
                <li><a href="index.php">Startsida</a></li>
                <li><a href="bucketlist.php">Bucketlist</a></li>
                <li><a href="ai.php">AI i arbetsprocess</a></li>
            </ul>
        </nav>

    </header>

    <!--Här börjar innehållet för varje respektive sida. Stängs i footer-->
    <main>