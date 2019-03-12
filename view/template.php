<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title><?= $this->getContext()->getTitle() ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="icon" href="/public/img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/public/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/public/css/mapquest.css"/>
    
    <script src="/public/js/jquery3.3.1.min.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
    <script src="/public/js/mapquest.js"></script>
</head>
<body>
    <header>
        <?php include_once("layout/navigation.php"); ?>
    </header>
    <main role="main" class="container">
        <?php include_once("layout/message.php"); ?>
        <div id="content">
           <?= $content ?>            
        </div>
    <main>
    <footer>
    </footer>
</body>
</html>