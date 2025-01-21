<?php 

if(empty($_POST['titre']) 
    || empty($_POST['artiste']) 
    || empty($_POST['description']) 
    || empty($_POST['image'])
    || strlen($_POST['description']) < 3
    || !filter_var($_POST['image'], FILTER_VALIDATE_URL)) {
        var_dump(empty($_POST['titre']));
        var_dump(empty($_POST['artiste']));
        var_dump(empty($_POST['description']));
        var_dump(empty($_POST['image']));
        var_dump(strlen($_POST['decription']) < 3);
        var_dump(!filter_var($_POST['image'], FILTER_VALIDATE_URL));
        die();
    header('Location: ajouter.php?erreur=true');
} else {
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $artiste = htmlspecialchars($_POST['artiste']);
    $image = htmlspecialchars($_POST['image']);

    include 'bdd.php';
    $bdd = connexion();

    $requete = $bdd->prepare('INSERT INTO oeuvres (titre, description, artiste, image) VALUES (?, ?, ?, ?)');
    $requete->execute([$titre, $description, $artiste, $image]);

    header('Location: oeuvre.php?id=' . $bdd->lastInsertId());
}