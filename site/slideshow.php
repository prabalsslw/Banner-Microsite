<?php require_once '../config/database.php'; 
    
    $banner_list_sql = "SELECT * FROM banner_tbl WHERE is_active = '1' ORDER BY is_active DESC";
    $banner_list_result = mysqli_query($conn, $banner_list_sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>bKash Banner Slider</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script type=“text/javascript” src=“https://cdn.capp.bka.sh/scripts/webview_bridge.js”></script>
        <style type="text/css">
            html {
                height: 100%;
            }
            body { 
                height: 100%;
            }
            img{
                display: block;
            }
        </style>
    </head>
    <body>
        <!--<div class="container-fluid">-->
        <!--    <div class="col-md-12">-->
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php 
                        $i = 0;
                        while($banner_listrow = mysqli_fetch_assoc($banner_list_result)) { 
                            $i++;
                        ?>
                        <div class="item <?= ($i == 1) ? 'active' : '' ?>">
                            <a href="<?= $banner_listrow['banner_url'] ?>" target="_blank"><img src="../uploads/<?= $banner_listrow['image'] ?>" alt="<?= $banner_listrow['banner_name'] ?>" class="fill"></a>
                        </div>
                        <?php } ?>
                        <br><br><br>
                        <ol class="carousel-indicators">
                            <?php for($j = 0; $j < $i; $j++) { ?>
                                <li style="color:lavenderblush;background: #E2136E;" data-target="#carousel-example-generic" data-slide-to="<?= $j ?>" class="<?= ($j== 0) ? 'active' : '' ?>"></li>
                            <?php } ?>
                        </ol>
                        
                    </div>
                    <!-- Controls -->
                  <!--   <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                    </a> -->
                </div>
        <!--    </div>-->
        <!--</div>-->
    </body>
    <script>
        $('.carousel').carousel({
            interval: 6000
        })

    </script>
</html>