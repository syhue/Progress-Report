
<!DOCTYPE HTML>

<html lang="en">

<head>
    <title>Progress Report</title>
    <link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=PT Sans Narrow">


</head>

<style>

        .navbarleft{
            overflow: hidden;
            float: left;
            background-color: #17252A;
            margin:0;
            padding:0;
            position: relative;
            top:0%;
            width: 100%;
            border-bottom: 0.2em solid;
            border-color: white

        }

        .navbarleft a{
            float: left;
            font-size: 1.2em;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;

        }

        .navbarright{
            float: right !important;
            background-color: #17252A;

            }

        .navbarright a{
            float: right;
            font-size: 1.2em;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            }

        .dropdown {
            float: left;
            overflow: hidden;
            }

        .dropdown .dropbtn {
            font-size: 1.2em;
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
            }


        .navbarleft a:hover, .navbarright a:hover,  .dropdown:hover, .dropbtn{
            background-color: #DEF2F1;
            color: #17152A;
            font-weight: bold;
            }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: black;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px #606F82;
            z-index: 1;
            }

        .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
        }

        .dropdown-content a:hover {
        background-color: ;
        }

        .dropdown:hover .dropdown-content {
        display: block;
        }

        .white-margin{
            border: 400em;
            border-color: white;
            border-radius: inherit;
        }

        body {
          margin: 0;
          padding: 0;
          background-color: white;
        }


        .center {
            margin: auto;
            width: 100%;
            background-color: #3AAFA9;
            padding-top: 20px;
            padding-bottom: 20px;
        }




        .headline {
          color: white;
          font-family: 'PT Sans Narrow', sans-serif;
          font-size: 1.2em;
          font-weight: bolder;
          letter-spacing: -0.2px;
          line-height: 1;
          text-align: center;
          /* border: 3px solid green; */
          /* margin-top: -50px;
          margin-left: -100px; */
          /* background-color: #3AAFA9; */
        }


          .black {
            color : #17252A !important;
            font-size: 2em;
          }


          input, textarea {
            border: 2px solid #3AAFA9;
          }

</style>

<body>


    <div class="navbarleft" >
        <a href="index.php">Home</a>
        <!-- <a href="about.php">About</a> -->
        <a href="input.php">Input Record</a>
        <a href="view.php">View Record</a>
        <!-- <div class="dropdown" href="progress.php">
          <button class="dropbtn">Progress</button>
          <div class="dropdown-content">
            <a href="input.php">Input</a>
            <a href="view.php">View</a>
            </div>
        </div> -->
        <a class="navbarright" href="index.php#login" name="login"  >Sign In</a>
        <a class="navbarright" href="index.php#register">Register</a>
      </div>


</body>
</html>
