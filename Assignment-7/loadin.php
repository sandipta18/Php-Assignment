<!-- Loading Animation -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="css/style6.css"> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Alex+Brush" rel="stylesheet">
  <style>

#loading {
    display: flex;
    position: fixed;
    z-index: 100;
    width: 100%;
    height: 100%;
    background-color: rgba(192, 192, 192, 0.5);
    background-image: url("https://i.stack.imgur.com/MnyxU.gif");
    background-repeat: no-repeat;
    background-position: center;
  }
  </style>
  <title>Document</title>
</head>

<body>


  <div class="page">
  </div>
  <div id="loading"></div>
</body>

</html>
<script>
  const wait = (delay = 0) =>
    new Promise(resolve => setTimeout(resolve, delay));

  const setVisible = (elementOrSelector, visible) =>
    (typeof elementOrSelector === 'string' ?
      document.querySelector(elementOrSelector) :
      elementOrSelector
    ).style.display = visible ? 'block' : 'none';

  setVisible('.page', false);
  setVisible('#loading', true);

  document.addEventListener('DOMContentLoaded', () =>
    wait(1000).then(() => {
      setVisible('.page', true);
      setVisible('#loading', false);
    }));
</script>