<?php
/**
 * @var array $data
 */
?>

<?php $title = $data['title'] ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/assets/css/style.css?t=<?php echo(microtime(true) . mt_rand()); ?>" type="text/css"/>
    <title><?php echo $title ?></title>
</head>
<body class="d-flex flex-column min-vh-100" oncopy="return false;" onmousedown="return false;" onclick="return true;"
      oncontextmenu="return false;" ondragstart="return false;" onselect="return false;" onload="clearData();"
      onblur="clearData(); window.focus(); window.onblur = clearData;">