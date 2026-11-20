<!--KLASS FÖR DATABASANSLUTNING-->

<?php

//Hämtar inställningarna för databasen från config
//Filen inkluderas bara en gång
require_once "includes/config.php";

//Klass för hantering av databasanslutning
class Database
{
    //Sparar anslutning till databasen
    //Kan bara användas inom denna klass
    //Anslutningen sparas i variabeln connection
    private $connection;

    //Funktion (Konstruktor) som körs när ett nytt Database objekt skapas
    public function __construct()
    {
        //Skapar en anslutning till databasen med PDO
        //Skickar med: vilken typ av databas, serveradress, port,  databasens namn, teckenkodning, användarnamn och lösen
        $this->connection = new PDO(
            "mysql:host=" . DB_HOST . ";port=3306;dbname=" . DB_NAME . ";charset=utf8mb4",
            DB_USER,
            DB_PASS
        );

        //Felhantering
        //Gör att PDO kan hantera databasfel med try/catch (istället för "or die")
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //Funktion som returnerar anslutningen så andra klasser kan använda den
    public function getConnection()
    {
        return $this->connection;
    }
}