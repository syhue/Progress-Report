<?php
  require_once "home.php";
  require_once "pdo.php";

  // A session is required
  session_start();


  if (( ! (isset($_SESSION['student_email']))) || (strlen($_SESSION['student_email']) < 1) )  {
      die('Log In is required to take actions');
  }



  if (isset($_POST['submit-button'])) {
    if(strlen($_POST['task'])==0 || strlen($_POST['description'])==0 || !isset($_POST['date'])){
      echo "<script>";
      echo "alert('Please fill in the date, task and description field.')";
      echo "</script>";
    }
    else {
      $sql = "INSERT INTO progress (date, task, description)
                VALUES (:date, :task, :description)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
          ':date' => $_POST['date'],
          ':task' => $_POST['task'],
          ':description' => $_POST['description']));

      $_SESSION['success'] = " Recorded successfully.";
      // Redirect the browser to index.php
      header("Location:view.php?student_email=".$_SESSION['student_email']);
      return;

    }

  }


  if (isset($_POST['logout-button'])) {
    header("Location:logout.php");
    }

  if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
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
    /* padding-top: 2em; */
    padding-left: 3em;
    padding-right: 3em;
    padding-bottom: 3em;
    font-size: 1.5em;
    font-family: 'Crimson Text', sans-serif;
    width: 22em;
    /* border: solid black 1px; */
  }

  .centering {
    position: relative;
    left: 50%;
    transform: translatex(-14em);
    /* border: solid 0.1em; */
  }

  .button {
    padding: 10px 20px;
    font-size: 15px;
    font-weight:normal;
    text-align: center;
    cursor: pointer;
    outline: none;
    color: #fff;
    background-color: #17252A;
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px #999;
    margin-left: 1em;
    margin-top: 1em;
  }

  .button:hover {
    background-color: #2B7A7B;
    color: white;
    font-weight: bold;
  }

  .button:active {
    background-color: #2B7A7B;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
  }


  </style>

<body>
  <div class="header">
    <h1>Today, New Day.</h1>
    <p>  <?php
      echo "Today is ".date("l").", ".date("Y/m/d").".";
      ?></p>
    </div>

  <form method="post" class="form centering">
    <p>Date:
      <input type="date" name="date"></p>
    <p>Task: <br>
      <textarea type="text" name="task" rows="5em" cols="70em"></textarea></p>
    <p>Description:  <br>
      <textarea name="description" rows="20em" cols="70em"></textarea>
    <center>
      <button name="submit-button" class="button">Submit</button>
      <button name="logout-button" class="button">Log Out</button>
    </center>
    </form>


</body>
</html>
