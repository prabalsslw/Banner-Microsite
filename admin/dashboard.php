<?php 
    include 'inc/header.php'; 
    require_once '../config/database.php';

    $banner_count_sql = "SELECT SUM(is_active = 1) AS active, SUM(is_active = 0) AS inactive FROM banner_tbl WHERE is_active = 1 OR is_active = 0";
    $banner_count_result = mysqli_query($conn, $banner_count_sql);
    $banner_count = mysqli_fetch_assoc($banner_count_result);

    $user_count_sql = "SELECT count(*) AS usrcnt FROM users";
    $user_count_result = mysqli_query($conn, $user_count_sql);
    $user_count = mysqli_fetch_assoc($user_count_result);

    $banner_list_sql = "SELECT * FROM banner_tbl WHERE is_active = '1' ORDER BY is_active DESC";
    $banner_list_result = mysqli_query($conn, $banner_list_sql);
?>

<div class="col-md-3">
    <div class="panel-group" id="accordion">
        <div class="panel panel-primary" style="border-radius: 0px;">
            <div class="panel-heading" style="border-radius: 0px;">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><span class="glyphicon glyphicon-list"></span></a>
                </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse in">
                <ul class="list-group">
                    
                    <li class="list-group-item"><span class="badge badge-info"><?= $banner_count['active'] ?></span> Active Banner</li>
                    <li class="list-group-item"><span class="badge"><?= $banner_count['inactive'] ?></span> Inactive Banner</li>
                    <li class="list-group-item"><span class="badge"><?= $user_count['usrcnt'] ?></span> Total User</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="col-md-9">
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
                <img src="../uploads/<?= $banner_listrow['image'] ?>" alt="<?= $banner_listrow['banner_name'] ?>" style="width: 100%;height: auto;">
                <div class="carousel-caption">
                    <h3><?= $banner_listrow['banner_name'] ?></h3>
                    <p><?= $banner_listrow['banner_url'] ?></p>
                </div>   
            </div>
            <?php } ?>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<?php include 'inc/footer.php'; ?>