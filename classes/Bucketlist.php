//Klass som hanterar innehåll i Bucketlist

<?php

//Skapar klassen Bucketlist
class Bucketlist
{
    //Sparar anslutningen till databasen i varibeln/egenskap db
    //Privat egenskap som bara används inom denna klass
    private $db;

    //Konstruktor
    //Funktion som tar emot databaskopplingen när ett nytt objekt skapas
    public function __construct(PDO $db)
    {
        //Sparar databaskopplingen i klassens egenskap
        $this->db = $db;
    }


    //Metoder

    //Funktion som hämtar alla poster från bucketlist tabellen
    //Metod getAll kan användas utanför klassen
    //metoden returnerar en array
    public function getAll(): array
    {
    //SQL-fråga som hämtar alla poster
    $sql = "SELECT * FROM bucketlist";

    //Skickar SQL-frågan till databasen och hämtar resultat
    //Resultatet sparas i vaiabeln result
    $result = $this->db->query($sql);

    //Hämtar alla rader och returnerar resultatet som en array
    return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
}