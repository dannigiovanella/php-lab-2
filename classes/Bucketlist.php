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

    //GET
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

    //ADD
    //Funktion som lägger till en ny post i bucketlist tabellen
    //Metoden add kan användas utanför klassen
    //Metoden förväntar sig värdena name och description i text och värdet priority i heltal.
    //Returnerar true eller false
    //id, completed och created_at i samma tabell hanteras automatiskt
    public function add(string $name, string $description, int $priority): bool
    {
        //SQL fråga som lägger till en ny post i tabellen
        //Values används för att ange vilka värden som ska sparas
        //variabeln sql tilldelas SQL koden
        //:name, :description, :priority fungerar som placeholders för värderna
        $sql = "INSERT INTO bucketlist (name, description, priority)
        VALUES (:name, :description, :priority)"; 

        //Hantering mot SQL injections
        //Förbereder SQL frågan med prepare innan den skickas till databasen
        //varibeln statement sparar den förberedda frågan
        $statement = $this->db->prepare($sql);


        //Kopplar ihop placeholders från VALUES med metodens parametrar
        //execute skickar värdena till den förberedda frågan och kör den mot databasen
        //Databasen kan använda dessa värden när ny post läggs till
        $statement->execute([
            ':name' => $name,
            ':description' => $description,
            ':priority' => $priority
        ]);

        //Returnerar om SQL frågan genomfördes
        //Kontrollerar om frågan påverkade minst en rad
        //returnerar true om post las till, annars false
        return $statement->rowCount() > 0;
    }


    //DELETE
    //Funktion som tar bort en post från bucketlist
    //Metoden delete kan användas utanför klassen
    //Tar emot heltal för att identifiera en post
    //Returnerar true eller false
    public function delete(int $id): bool
    {
        //SQL fråga som tar bort en post med ett visst ID
        //variabeln sql tilldelas SQL koden
        $sql = "DELETE FROM bucketlist WHERE id = :id";

        //Förbereder SQL frågan med prepare innan den skickas till databasen
        //varibeln statement sparar den förberedda frågan
        $statement = $this->db->prepare($sql);

        //Skickar id-värdet och kopplar det till placeholdern i SQL frågan
        //:id fungerar som placeholders för värdet
        $statement->execute([
        ':id' => $id
        ]);

        //Returnerar om SQL frågan genomfördes
        //Kontrollerar om frågan påverkade minst en rad
        // Returnerar true om en post togs bort, annars false
        return $statement->rowCount() > 0;
    }


    //UPDATE (klura på den här längre fram)

}