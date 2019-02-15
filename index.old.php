<!DOCTYPE html>
<html>
<header>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>PHP IEPESA</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/public/css/ionicons.min.css">
    <link rel="stylesheet" href="/public/css/bootstrap.css">
    
    <script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
</header>
<body>
    <main role="main" class="container">
        <div id="contenu">
            <?php 
            include_once("view/layout/nav.php"); 

            if(isset($_GET["action"]))
            {
                $action = $_GET["action"];
                if($action === "read")
                {
                    include_once("view/articles/read.php");
                }
                if($action === "write")
                {
                    include_once("view/articles/add.php");
                }
                if($action === "delete")
                {
                    include_once("view/articles/delete.php");
                }
            }
            else
            {
                include_once("view/articles/list.php");
            }

            ?>
            
        </div>
    <main>
</body>
</html>