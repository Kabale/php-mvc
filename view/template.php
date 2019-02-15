<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title><?= $title ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/public/css/ionicons.min.css">
    <link rel="stylesheet" href="/public/css/bootstrap.css">
    
    <!--<script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script>-->
    <script src="/public/js/bootstrap.min.js"></script>
</head>
<body>
    <header>
        <?php include_once("layout/nav.php"); ?>
    </header>
    <main role="main" class="container">
        <div id="content">
           <?= $content ?>            
        </div>
    <main>
    <footer>
    </footer>
</body>
</html>