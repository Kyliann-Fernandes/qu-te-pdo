<?php
    include 'connec.php';
    $pdo = new PDO(DSN, USER, PASSWORD);

if (!empty($_POST)){
    $data = array_map('trim', $_POST);
    $data = array_map('htmlentities', $_POST);

    $query = 'INSERT INTO friends (firstname, lastname) VALUES(:firstname, :lastname)';
    $statement = $pdo->prepare($query);
    $statement->bindValue(':firstname',$data['firstname']);
    $statement->bindValue(':lastname',$data['lastname']);
    $statement->execute();
}

?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
        </tr>
    </thead>
    <tbody>
    <?php

    $sqlSelectFriends = "SELECT * FROM friends";

    $resultat = $pdo->query($sqlSelectFriends);
   
    $resultats = $resultat->fetchAll();

    foreach ($resultats as $key => $value) {
        echo'<tr>';
            echo'<td>'.$value['id'].'</td>';
            echo'<td>'.$value['lastname'].'</td>';
            echo'<td>'.$value['firstname'].'</td>';
        echo'</tr>';
    }
    ?>

    </tbody>
</table>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire</title>
</head>
<body>
 <form method="POST" target="">
     <h2>FORMULAIRE DE CREATION D'UN FRIEND</h2>
    <div>
        <label for="lastname">Nom</label>
        <input type="text" id="lastname" name="lastname" value ="<?php if(isset($_POST['lastname'])); ?>" required>
    </div>
     <p></p>
    <div>
        <label for="firstname">Prénom</label>
        <input type="text" id="firstname" name ="firstname" value ="<?php if(isset($_POST['firstname'])); ?>"required>
    </div>
     <p></p>
     <div class="button">
        <button type="submit">Créer le nouvel ami</button>
    </div>
  </form>
 </body>
</html>