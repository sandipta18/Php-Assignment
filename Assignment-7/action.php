
<!-- If login is successfull this page will open -->
<?php session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style1.css">
    <style>
    input {
  display: block;
  margin: 2em auto;
  border: none;
  padding: 0;
  width: 10.5ch;
  background: repeating-linear-gradient(90deg, dimgrey 0, dimgrey 1ch, transparent 0, transparent 1.5ch) 0 100%/10ch 2px no-repeat;
  font: 5ch droid sans mono, consolas, monospace;
  letter-spacing: 0.5ch;
}
input:focus {
  outline: none;
  color: dodgerblue;
}
    </style>
</head>

<body>
  <!-- This section will help to redirect user to the desired location -->
    <div class="wrapper tabled">
  <div class="stage" id="page1">
    <div class="middled">

      <h2>Welcome User</h2>
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
      <input type="tel" name="q" placeholder=" Query" required><br>
      <input type="submit" name="" value="Submit"><br><br>
      </form>
      <a href="logout.php">Logout</a>
    </div>

  </div>
</div>

</body>

</html>