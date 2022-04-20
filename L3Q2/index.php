<?php session_start();  //starting session
if (! isset($_SESSION['startNum'])){
  $_SESSION['startNum'] = rand(1,20);
}

$message = false;
  if (! isset($_GET['guess']) ) {
    $_SESSION['attempt'] = 0;
  } else if ( strlen($_GET['guess']) < 1 ) {
    $_SESSION['attempt']++;
    $message = "<p align=center>[Attempt ". $_SESSION['attempt'] . "] - Enter your guess</p>";
  } else if ( ! is_numeric($_GET['guess']) ) {
    $_SESSION['attempt']++;
    $message = "<p align=center>[Attempt ". $_SESSION['attempt'] ."] - \"".$_GET['guess']."\" is not a number</p>";
  } else if ( $_GET['guess'] < $_SESSION['startNum'] ) {
    $_SESSION['attempt']++;
    $message = "<p align=center>[Attempt ". $_SESSION['attempt'] ."] - ".$_GET['guess']." is too low</p>";
  } else if ( $_GET['guess'] > $_SESSION['startNum']) {
    $_SESSION['attempt']++;
    $message = "<p align=center>[Attempt ". $_SESSION['attempt'] ."] - ".$_GET['guess']." is too high</p>";
  } else {
    $_SESSION['attempt']++;
    $_GET['restart'] = 1;
    $message = "<p align=center>CONGRATULATION!<br>You are right with ". $_SESSION['attempt'] ." Attempts<br> The correct number is ". $_SESSION['startNum']."</p>";
    if (isset($_GET['restart'])){
      $_SESSION['attempt'] = 0 ;
      $_SESSION['startNum'] = rand(1,20);
    }
  }
  //game will restart is correct guess or press restart button.

  if (isset($_GET['restart'])){
    $_SESSION['startNum'] = rand(1,20);
  }

  $oldguess = isset($_GET['guess']) ? $_GET['guess'] : '';

?>

<html>
<head>
  <link type="text/css" rel="stylesheet" href="style.css">
</head>

  <body>
    <title> Harith Thaqif PHP guessing game </title>
<div id="head">
    <h1> Welcome to my guessing game </h1>
</div>

<div id="form">
<form method="get">
  <p>TRY YOUR "<span style="font-weight:bold; color:#b0bdff;">LUCK</span>"</p>
  <p>Guess any number between 1-20!</p>
  <hr>
    <input type="text" id="guess" name="guess" placeholder="1-20" value="<?= htmlentities($oldguess) ?>"/></input>
    <br>
    <input type="submit" ></input>
</form>
</div>

  <?php
  if ($message !== false){
    echo ("<p>$message</p>\n");
  }
  ?>

  <hr>
  <form method="get">
    <button name="restart" id="restart" value="1">Restart</button>
  </form>

  </body>
  </html>
