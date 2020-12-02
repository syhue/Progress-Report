<?php

require_once "pdo.php";
require_once "home.php";

    // if (!session_id()) @
    session_start();

    if (isset($_POST['button_register']))  {

        if( (strlen($_POST['email_register'])==0) || (strlen($_POST['password_register'])==0) ){

            echo "<script>";
            echo "alert('Please fill in your email and password.')";
            echo "</script>";
        }

        elseif (isset($_POST['select_register'])){

            if ($_POST['select_register']=='student_register'){
            $hash = hash("sha256", $_POST['password_register']);
            $sql = "INSERT INTO student (student_email, password)
                      VALUES (:email, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':email' => $_POST['email_register'],
                ':password' => $hash));


            }

            elseif ($_POST['select_register']=='supervisor_register'){
            $hash = hash("sha256", $_POST['password_register']);
            $sql = "INSERT INTO supervisor (supervisor_email, password)
                      VALUES (:email, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':email' => $_POST['email_register'],
                ':password' => $hash));
            }

              $_SESSION['success'] = "Register Successfully";
              // Redirect the browser to index.php
              header("Location: index.php");
              return;
            }

        else {
          echo "<script>";
          echo "alert('Please select an option.')";
          echo "</script>";
        }


        }


    if (isset($_POST['button_login'])) {

        if ((strlen($_POST['email_login'])!=0) && (strlen($_POST['password_login'])!=0)){

            if(isset($_POST['select_login'])){

                if ($_POST['select_login']=='student_login'){


                    $email_login = $_POST['email_login'];
                    $hash = hash("sha256", $_POST['password_login']);


                    $stmt = $pdo->query("SELECT student_email, password FROM student WHERE `student_email` = '$email_login'");

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($hash == $row['password']) {

                            $_SESSION['success'] = "Log In Successfully";
                            $_SESSION['student_email'] = $row['student_email'];
                            header("Location: input.php?student_email=".$row['student_email']);
                            return;
                        }

                        else {

                            $_SESSION['error'] = "Wrong Password";

                            header("Location: index.php");
                            return;
                        }


                    }


                    elseif ($_POST['select_login']=='supervisor_login'){

                        echo $_POST['email_login'];
                        $email_login = $_POST['email_login'];
                        $hash = hash("sha256", $_POST['password_login']);
                        echo $hash;

                        $stmt = $pdo->query("SELECT supervisor_email, password FROM supervisor WHERE `supervisor_email` = '$email_login'");

                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                            if ($hash == $row['password']) {

                                $_SESSION['success'] = "Log In Successfully";

                                header("Location: input.php?supervisor_email=".$row['supervisor_email']);
                                return;
                            }

                            else {

                                $_SESSION['error'] = "Wrong Password";

                                header("Location: index.php");
                                return;
                            }


                        }



            }

            else {
                echo "<script>";
                echo "alert('Please select an option.')";
                echo "</script>";
            }


        }

        else {
          echo "<script>";
          echo "alert('Please fill in your email and password.')";
          echo "</script>";
        }

    }




    if ( isset($_SESSION['error']) ) {
          echo '<p style="color:red">'.$_SESSION['error']."</p>";
        unset($_SESSION['error']);
    }

    if ( isset($_SESSION['success']) ) {
          echo '<p style="color:green">'.$_SESSION['success']."</p>";
        unset($_SESSION['success']);
    }


?>


<!DOCTYPE html>
<html>
  <style>


        body {
          margin: 0;
          padding: 0;
          background-color: white;
        }

        .center {
            /* margin: auto; */
            width: 100%;
            background-color: white;
            padding-top: 2em;
            padding-bottom: 2em;
        }

        .headline {
          color: #17252A;
          font-family: 'PT Sans Narrow', sans-serif;
          font-size: 3.2em;
          font-weight: bolder;
          letter-spacing: -0px;
          line-height: 1.2;
          text-align: center;
          padding-top: 1em;
          padding-bottom: 0.2em;
          margin-bottom: 0.3em;
          /* border: 3px solid white; */
          /* margin-top: -50px;
          margin-left: -100px; */
          /* background-color: #3AAFA9; */
        }

        .black {
            color : rgb(200,200,200);
            font-size: 0.8em;
        }



        input {
            border: 2px solid #3AAFA9;
            width: 14em;
        }

        .button {
              padding: 10px 20px;
              font-size: 15px;
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

        .button:hover {background-color: #2B7A7B}

        .button:active {
              background-color: #2B7A7B;
              box-shadow: 0 5px #666;
              transform: translateY(4px);
            }

        .centering {
          position: relative;
          left: 50%;
          transform: translatex(-10em);
          /* border: solid 0.1em; */
          width: 20em;
        }

        .flex-container {
          display: flex;
          flex-direction: column ;
          background-color: white;
        }

        .flex-container > div {
          background-color: white;
          width: 8em;

          text-align: left;
          line-height: 2em;
          font-size: 1.3em;
        }

        .flex-horizontal {
          display: flex;
          flex-direction: row ;
          background-color: white;
        }

        .flex-horizontal > div {
          background-color: white;
          /* margin: 0.2em; */
          /* padding: 20px; */

        }



        .big-vertical {
          display: flex;
          flex-direction: column ;
          background-color: white;
          /* padding-bottom: 10em; */

        }

        .big-vertical > div {
          background-color: white;
          width: 8em;

          /* text-align: left; */
          /* line-height:8em; */
          font-size: 1.2em;
        }

        .margin-bottom{
          margin-bottom: 5em;
        }

        .flex-container-outside {
          display: flex;
          flex-direction: row ;
          text-align: center;
        }

        .flex-item-left {
          flex: 50%;
        }

        .flex-item-right {
          flex: 50%;
        }

        /* Responsive layout - makes a one column-layout instead of two-column layout */
        @media (max-width: 1000px) {
          .flex-container-outside {
            flex-direction: column;
          }
        }

        select {
          border-color: #3AAFA9;
          border-width: 2px ;
          width: 14.5em;
        }



  </style>
  <header>
    <div = class="headline center">
      <p>Progress Report <br><span class="black"  >Website</span>
        <br><span style="font-size:0.35em;font-weight: normal;letter-spacing:0px;
        color:black;font-family: 'Crimson Text', serif;">
        This website is to make record on daily progress. </span>
      </p>
    </div>
  </header>
  <body>
    <div class="flex-container-outside">
        <div class="flex-item-left">
          <div class="big-vertical centering">
            <center><h2>Register</h2></center>
              <form method="post" class="margin-bottom">
                <div>
                  <div class="flex-horizontal">
                    <div class="flex-container">
                      <div>Email Address: </div>
                      <div>Password: </div>
                      <div>Register as: </div>
                    </div>
                    <div class="flex-container">
                        <div><input type="email" name="email_register"></div>
                        <div><input type="password" name="password_register"></div>
                        <div>
                          <select size="1" name="select_register" class="user_type" id="user_type_register">
                              <option disabled selected value> -- select an option -- </option>
                              <option value="supervisor_register">Supervisor</option>
                              <option value="student_register">Student</option>
                          </select>
                        </div>
                      </div>
                  </div>
                </div>
                <center>
                  <button name="button_register" class="button">Submit</button>
                </center>
              </form>
            </div>
        </div>

        <div class="flex-item-right">
            <div class="big-vertical centering">
              <center><h2>Sign In</h2></center>
                <form method="post" class="margin-bottom">
                  <div>
                    <div class="flex-horizontal">
                      <div class="flex-container">
                        <div>Email Address: </div>
                        <div>Password: </div>
                        <div>Sign in as: </div>
                      </div>
                      <div class="flex-container">
                          <div><input type="email" name="email_login"/></div>
                          <div><input type="password" name="password_login"/></div>
                          <div>
                            <select size="1" name="select_login" class="user_type" id="user_type_login">
                                <option disabled selected value> -- select an option -- </option>
                                <option value="supervisor_login"/>Supervisor</option>
                                <option value="student_login"/>Student</option>
                            </select>
                          </div>
                        </div>
                    </div>
                  </div>
                  <center>
                    <button name="button_login" class="button">Submit</button>
                  </center>
                </form>
            </div>
        </div>
    </div>

    </body>
 </html>
