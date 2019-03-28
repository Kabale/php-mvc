<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Test website for iepsa">
    <meta name="author" content="Vincent Schandeler">
    
    <title><?= $this->getContext()->getTitle() ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="icon" href="/public/img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/public/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/vendor/twbs/bootstrap/dist/css/bootstrap.css">
    
    <script src="/public/js/jquery3.3.1.min.js"></script>
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    
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