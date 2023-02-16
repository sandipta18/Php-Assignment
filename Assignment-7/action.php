<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style1.css">
</head>

<body>

    <div class="wrapper tabled">
  <div class="stage" id="page1">
    <div class="middled">

      <h2>Welcome</h2>

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
        <a href="../Assignment-5/index.php">
          <span class="thin">Task</span><span class="thick">~6</span>
        </a>

      </div>
      <br>
      <form action="query.php" method="POST">
      <input type="tel" name="query" placeholder="query" required><br>
      <input type="submit" name="" value="Submit"><br><br>
      </form>
      <a href="logout.php">Logout</a>
    </div>

  </div>
</div>

</body>

</html>