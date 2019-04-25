<?php


session_start();

if(!isset($_SESSION["utilisateurs"])) {

    $_SESSION["utilisateurs"] = array(

        array(

            "task" => "Manger"),

        array(

            "task" => "Boire" ),

        array(

            "task" => "Acheter à manger et à boire",)
    );

}


if(isset($_GET["index"])) {


    $index = intval($_GET["index"]);


    unset($_SESSION["utilisateurs"][$index]);

}

if(isset($_POST["task"])) {


    $nouvelUtilisateur = array(

        "task" => $_POST["task"]

    );

    if(isset($_POST["index"]) && $_POST["index"] != "") {

        $index = $_POST["index"];

        $_SESSION["utilisateurs"][$index] = $nouvelUtilisateur;

    } else {

        $_SESSION["utilisateurs"][] = $nouvelUtilisateur;

    }

}


function afficheUtilisateur($utilisateur, $index) {

    echo

    "<tr>

        <td>" . $utilisateur["task"] . "</td>

        <td><a href='todolist.php?index=" . $index . "'>X</a></td>
        <br><br>
    </tr>";

}


 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>To Do List</title>
  </head>


  <body>

    <style>
      a { text-decoration: none; font-weight: bold; color: red; font-family: sans-serif; font-size: 18px; margin-left: 10px;}
      table {width: 50%; height: 40px; margin: 50px auto;}
      #do {width: 40%; height: 40px; border: 1px solid;}
      #del {width: 10%; height: 40px; border: 1px solid;}
    </style>



    <h1 style="text-align:center; font-size: 72px;">To Do List</h1>
    <form class="" action="todolist.php" method="post" style="text-align: center;">

      <input type="text" name="task" placeholder="Ajouter une tâche...">
      <input type="submit" name="submit" value="Ajouter">
      <!-- <input type="submit" name="delete" value="Supprimer"> -->

      <table>
        <tr>
          <th id="do" style="text-transform: uppercase;">à faire</th>
          <th id="del" style="text-transform: uppercase;">Supprimer</th>
        </tr>
        <?php

        foreach($_SESSION["utilisateurs"] as $index => $utilisateur) { ?>

            <?php afficheUtilisateur($utilisateur, $index); ?>

        <?php } ?>
      </table>

    </form>

  </body>

</html>
