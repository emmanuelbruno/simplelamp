<!DOCTYPE html>
<html>
    <head>
        <title>PHP Test</title>
    </head>
    <body>
        <?php echo '<p>Hello World</p>'; ?>

 <?php
$servername = 'db';
$username = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
$dbname = getenv('MYSQL_DATABASE');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql_create = "CREATE TABLE IF NOT EXISTS personne (
    id INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    age INT,
    PRIMARY KEY (id)
) ENGINE=InnoDB;";
if ($conn->query($sql_create) === TRUE) {
  echo "Table personne crée<BR/>";
} else {
  echo "Erreur de creation detable: " . $conn->error;
}


// Exemple d'insertion de données
$sql_insert = "INSERT INTO personne (nom, prenom, age) VALUES ('Doe', 'John', 30)";
if ($conn->query($sql_insert) === TRUE) {
    echo "Données insérées avec succès !<BR/>";
} else {
    echo "Erreur lors de l'insertion des données : " . $conn->error;
}

$sql = "SELECT id, nom, prenom, age FROM personne";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Nom: " . $row["nom"]. " " . $row["prenom"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?> 

    </body>
</html>
