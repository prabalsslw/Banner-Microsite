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
        <style type="text/css">
            body { padding: 0; margin: 0; }
            img { min-width: 100%; min-height: 100%;}
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                   <!--  <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol> -->
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
            </div>
        </div>
    </body>
</html>