<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2 >Rapport </h2> 
</body>
</html>

<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "mydatabase";
$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Récupération des données de la table "etudiants"
$sql = "SELECT nom, prenom, email, SUM(heure_absence) as total_absences FROM etudiants GROUP BY email";
$resultat = mysqli_query($connexion, $sql);

// Affichage des données dans un tableau
if (mysqli_num_rows($resultat) > 0) {
    echo "<table>";
    echo "<tr><th>Nom</th><th>Prénom</th><th>Email</th><th>Heures d'absence</th></tr>";
    while ($ligne = mysqli_fetch_assoc($resultat)) {
        echo "<tr>";
        echo "<td>" . $ligne["nom"] . "</td>";
        echo "<td>" . $ligne["prenom"] . "</td>";
        echo "<td>" . $ligne["email"] . "</td>";
        echo "<td>" . $ligne["total_absences"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Aucun étudiant n'a été enregistré.";
}

// Fermer la connexion à la base de données
mysqli_close($connexion);
?>
