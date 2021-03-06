<HTML>
  <HEAD>
    <link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />
    <link href="css/defaultstyle.css" type="text/css" rel="stylesheet"/>
    <link href="css/stylesheet.css" type="text/css" rel="stylesheet"/>
    <?php
    session_start();
    include "php/Connection.php";
    include "php/Authentication.php";
    $conn = new Connection();
    $conn->conn();
    $conn->selectDB("proposalsDatabase");
    $auth = new Authentication();

    $user = $_POST["userLog"];
    $psw = $_POST["pswLog"];
    ?>

  </HEAD>
  <BODY>
    <?php
    echo '<div class="container">
    <div class="topbar">
    <div class="titleDiv">
    <h1> <a href="index.php"> Political Proposals </a> </h1>
    </div> </div>
    <div class="advise">';
    //query to search the user in normal users
    if($auth->AuthUser($user,$psw)) {

      $_SESSION["logged"] = true;
      $_SESSION["user"] = $user;
      $_SESSION["admin"] = false;
      echo "<p class=\"white-p\"> Benvenuto '$user' ti stiamo rispedendo alla home page</p><p class=\"white-p\"> se non vuoi attendere oltre premi <a class=\"white-a\" href=\"index.php\"> qui </a> </p>";
      header("refresh:5,url=index.php");

    }
    //query to search the user in admin users
    else if( $auth->AuthAdmin($user,$psw) ) {

      $_SESSION["logged"] = true;
      $_SESSION["user"] = $user;
      $_SESSION["admin"] = true;
      echo "<p class=\"white-p\"> Benvenuto admin '$user' ti stiamo rispedendo alla home page </p><p class=\"white-p\"> se non vuoi attendere oltre premi  <a class=\"white-a\" href=\"index.php\"> qui </a></p> ";
      header("refresh:5,url=index.php");

    }

    else
    echo "<p class=\"white-p\">Utente non trovato, username o password errate la preghiamo di riprovare. </p><p class=\"white-p\"> Altrimenti può registrarsi   <a class=\"white-a\"href=\"registrati.php\">qui </a> </p>";

    echo '</div></div>';
    $conn->closeConn();
    ?>

  </BODY>
</HTML>
