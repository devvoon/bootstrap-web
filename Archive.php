<?php
    require("config/config.php");
    require("lib/db.php");
    require("sql/select.php");
    $conn = db_init($config["host"], $config["dbuser"], $config["dbpw"], $config["dbname"]);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="image/icon.jpg">

        <title>DaWoon's World</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/blog.css" rel="stylesheet">
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="blog-masthead">
                <div class="container">
                    <nav class="blog-nav">
                        <a class="blog-nav-item" href="index.php">Home</a>
                        <a class="blog-nav-item" href="About.php">About</a>
                        <a class="blog-nav-item active" href="Archive.php">Archive</a>
                    </nav>
                </div>
            </div>
        </nav> <!-- /.navbar -->

        <div class="blog-header" >
            <div class="container">
                <h1 class="blog-title">Archive. DawoonJeong</h1>
                <p class="blog-description">정다운의 이야기를 들어보세요.</p>
            </div>
        </div> <!-- /.blog-header -->

        <div class="container">
            <div class="row">
                <div class="col-sm-8 blog-main">
                    <div class="blog-post">
                        <!-- result -->
                        <?php
                            if (empty($_GET['list'])==false){
                                $SelectPost= fnGetPost($_GET['list']);
                                $result = mysqli_query($conn,$SelectPost);

                            }else{
                                $Today = date('Y-m-d');
                                /*$SelectLastPost= fnGetPost('2015-07');*/
                                $SelectLastPost = fnGetLastPost($Today);
                                $result = mysqli_query($conn,$SelectLastPost);
                                }
                            while($row= mysqli_fetch_assoc($result)){
                                echo '<p class="blog-post-title">'.$row['title'].'</p>'."\n";
                                echo '<p class="blog-post-meta">'.$row['register_date'].'</p>'."\n";
                                echo '<p>'.$row['post'].'</p>'."\n";
                                echo '<hr class="featurette-divider">';
                            }
                         ?>
                    </div><!-- /.blog-post -->
                </div><!-- /.blog-main -->

                <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
                    <div class="sidebar-module">
                        <h4>Archives</h4>
                        <ol class="list-unstyled">
                            <!--<li><a href="Archive.php">January 2017</a></li>-->
                            <?php
                                /*리스트 불러오기*/
                                $SelectList = fnSqlDate();
                                $result = mysqli_query($conn,$SelectList);   /* query */;
                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<li><a href="Archive.php?list='.$row['register_date'].'">'.$row['register_date'].'</a></li>'."\n";
                                }
                             ?>
                        </ol>
                    </div>
                    <div class="sidebar-module">
                        <h4>Elsewhere</h4>
                        <ol class="list-unstyled">
                            <li><a href="https://github.com/iamdawoonjeong/blog/">Github</a></li>
                            <li><a href="https://www.instagram.com/da.woon.jeong/">Instagram</a></li>
                        </ol>
                    </div>
                </div><!-- /.blog-sidebar -->
            </div><!-- /.row -->
        </div><!--/.container-->

        <!-- FOOTER -->
        <footer class="blog-footer">
            <p>&copy; 2017 DawoonJeong, Inc. All rights reserved.
            <p><a href="Archive.php">Back to top</a></p>
        </footer>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
