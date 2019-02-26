<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title><?= $title ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="icon" href="/public/img/favicon.ico" />
    <link rel="stylesheet" href="/public/css/bootstrap.css">
    
    <script src="/public/js/jquery3.3.1.min.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
</head>
<body>
    <header>
        <?php include_once("layout/nav.php"); ?>
    </header>
    <main role="main" class="container">
        <?php if (isset($message) && $message != null): ?>
            <div id="globaleMsg" class="alert <?= $message->getStatus() ?> alert-dismissible fade show" role="alert">
                <strong><?= $message->getName() ?></strong>
                <?= $message->getDescription() ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif?>
        <div id="content">
           <?= $content ?>            
        </div>
    <main>
    <footer>
    </footer>
</body>
</html>