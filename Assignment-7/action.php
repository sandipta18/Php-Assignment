<!-- If login is successfull this page will open -->
<?php

session_start();
if ($_SESSION['set'] == false) {
  header('location: ../Assignment-7/index.php');
}
include 'loadin.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <link rel="stylesheet" href="css/style1.css">
</head>

<body>

  <!-- This section will help to redirect user to the desired location -->
  <div class="wrapper tabled">
    <div class="stage" id="page1">
      <div class="middled">
        <h2>Welcome <?php
                    if (isset($_SESSION['name'])) {
                      echo ucwords(strtolower($_SESSION['name']));
                    }
                    ?>
        </h2>
        <!-- This branch of section will contain the links of other tasks -->
        <div class="link-1">
          <a href="../Assignment-1/index.php">
            <span class="thin">Task</span><span class="thick">~1</span>
          </a>

        </div>

        <div class="link-2">
          <a href="../Assignment-2/index.php">
            <span class="thin">Task</span><span class="thick">~2</span>
          </a>

        </div>

        <div class="link-3">
          <a href="../Assignment-3/index.php">
            <span class="thin">Task</span><span class="thick">~3</span>
          </a>

        </div>

        <div class="link-4">
          <a href="../Assignment-4/index.php">
            <span class="thin">Task</span><span class="thick">~4</span>
          </a>

        </div>


        <div class="link-6">
          <a href="../Assignment-5/index.php">
            <span class="thin">Task</span><span class="thick">~5</span>
          </a>

        </div>

        <div class="link-7">
          <a href="../Assignment-6/index.php">
            <span class="thin">Task</span><span class="thick">~6</span>
          </a>

        </div>
        <div class="link-2">
          <a href="../Assignment-7/index.php">
            <span class="thin">Task</span><span class="thick">~7</span>
          </a>

        </div>
        <br>
        <!-- Will take query input from user and redirect accordingly -->
        <form action="query.php" method="GET">
          <input type="tel" name="q" placeholder=" Query" required><br><span><?php echo $_SESSION['error']; ?></span>
          <input type="submit" name="" value="Submit"><br><br>
        </form>
        <!-- It will facilitate logout -->

        <a href="logout.php">Logout</a>


        <!-- HTML !-->
        <button class="button-74" role="button"><a href="delete.php">Delete Account </a></button>


      </div>
    </div>
  </div>

  <?php include 'popup.html'; ?>
</body>

</html>