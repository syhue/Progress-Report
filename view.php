<?php
  require_once "home.php";
  require_once "pdo.php";

  // A session is required
  session_start();


  //echo '$_SESSION['countPos']';
    if (isset($_POST['logout-button'])) {
        header("Location:logout.php");
    }
  // echo (": ".$_SESSION['countPos']);
  // echo '</ul>';
    if (( ! (isset($_SESSION['student_email']))) || (strlen($_SESSION['student_email']) < 1) )  {
        die('Log In is required to take actions');
    }


    if ( isset($_SESSION['success']) ) {
         echo '<p style="color:green">'.$_SESSION['success']."</p>";
        unset($_SESSION['success']);
    }
 ?>

<!DOCTYPE html>
<html>
<style>
  .header {
  padding: 5em;
  text-align: center;
  background: white;
  }

  .header h1 {
    font-size: 50px;
  }

  .form {
    padding-left: 0em;
    padding-bottom: 3em;
    font-size: 1.5em;
    font-family: 'Crimson Text', sans-serif;
    width:auto;
    /* border: solid black 1px; */
  }

  .centering {
    position: relative;
    left: 50%;
    transform: translatex(-16em);
    /* border: solid 0.1em; */
  }

  .button {
    padding: 8px 15px;
    font-size: 15px;
    font-weight:normal;
    text-align: center;
    cursor: pointer;
    outline: none;
    background-color: #2B7A7B;
    color: white;
    border: none;
    border-radius: 15px;
    box-shadow: 0 2px #999;
    margin-left: 1em;
    margin-top: 1em;
  }

  .button:hover {

    color: #17252A;
    background-color: #DEF2F1;

  }

  .button:active {
    background-color: #2B7A7B;
    box-shadow: 0 2px #666;
    transform: translateY(4px);
  }

  .view{
    font-family: Times, 'Times New Roman', serif;
    text-align: left;
    width: 36em;
    /* border: solid black 1px; */
    position: relative;
    left: 50%;
    transform: translatex(-18em);
  }

  .title_design{
      font-size: 1.2em;
      text-align: center;
      text-decoration-style: wavy;
      font-variant: small-caps;
  }


  .date_design{
      font-size: 1.2em;
      text-align: center;
      text-decoration-style: wavy;
      font-variant: small-caps;
      padding-bottom: 0.8em;
  }

  #task{
    font : 1.2em;
    width : 26em; height : 5em;
    border: 3px solid #2B7A7B;
    border-radius: 0.3em;
    border-style: ridge;
    left: 50%;
    transform: translatex(3em);
    padding: 2em;
  }

  #description{
    font : 1.2em;
    width : 26em; height : 10em;
    border: 3px solid #2B7A7B;
    border-radius: 0.3em;
    border-style: ridge;
    left: 50%;
    transform: translatex(3em);
    padding: 2em;
    margin-bottom: 4em;
  }





  </style>

<body>
  <div class="header">
    <h1>Peace.</h1>
    <p>Let's check what we have done.</p>
    </div>
  <form method="post" class="form">
    <center>
      <div>Date:
      <input type="date" name="datee" value="date">
      <button name="button" class="button">Submit</button>
      <button name="view_all" class="button">View All</button>
      <button name="logout-button" class="button">Log Out</button>
      </div>
      </center>
    </form>

    <?php


      if (isset($_POST['button'])){
        if(isset($_POST['datee'])){
            $datee = $_POST['datee'];
            $stmt = $pdo->query("SELECT date, task, description FROM progress WHERE `date` = '$datee'");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo '<div class="view">';
            echo '<p class="title_design">Date: ';
            echo htmlentities($row['date']);
            echo '</p>';
            echo '<br><p class="title_design"> Task: </p>';
            echo '<p id="task">';
            echo htmlentities($row['task']);
            echo '</p>';
            echo '<br><p class="title_design"> Description: </p> ';
            echo '<p id="description">';
            echo htmlentities($row['description']);
            echo '</p>';
            echo '</div>';
        }

      }


      if (isset($_POST['view_all'])) {

        $stmt = $pdo->query("SELECT progress_id, date, task, description FROM progress ");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="view">';
        echo '<p class="title_design"> Date: ';
        echo (htmlentities($row['date']));
        echo '</p>';
        echo '<br><p class="title_design"> Task: </p>';
        echo '<p id="task">';
        echo htmlentities($row['task']);
        echo '</p>';
        echo '<br><p class="title_design"> Description: </p> ';
        echo '<p id="description">';
        echo htmlentities($row['description']);
        echo '</p>';
        echo '</div><br>';
        }
      }
    ?>

</body>
</html>
