<?php 
    include 'inc/header.php'; 
    require_once '../config/database.php';

    $banner_list_sql = "SELECT * FROM banner_tbl ORDER BY is_active DESC";
    $banner_list_result = mysqli_query($conn, $banner_list_sql);

    $banner_count_sql = "SELECT COUNT(id) AS total FROM banner_tbl";
    $banner_count_result = mysqli_query($conn, $banner_count_sql);
    $banner_count = mysqli_fetch_assoc($banner_count_result);
?>


<div class="col-lg-12 col-md-12 col-sm-12" style="border: 2px solid #fbd0e3;padding: 20px;background: #FBF3F7;">
    <h5 style="font-size: 15px;font-weight: bold;">Banner List</h5>
    <span>Total row count: <b><?= $banner_count['total'] ?></b></span>
    <button type="button" id="addbanner" class="btn btn-sm btn-danger pull-right">Add Banner</button>
    <hr>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Banner Name</th>
                    <th>Banner Link</th>
                    <th>Banner Image</th>
                    <th>Description</th>
                    <th>Upload/Update Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size: 13px;">
                <?php 
                if (!empty($banner_list_result)) {
                    while($banner_listrow = mysqli_fetch_assoc($banner_list_result)) { 
                    if($banner_listrow['is_active'] == 1) {
                ?>
                    <tr style="background:  #F0F0F0;">
                        <td><b><?= $banner_listrow['banner_name'] ?></b></td>
                        <td><?= $banner_listrow['banner_url'] ?></td>
                        <td><img src="../uploads/<?= $banner_listrow['image'] ?>" alt="<?= $banner_listrow['banner_name'] ?>" class="img-thumbnail" width="80%"></td>
                        <td><?= $banner_listrow['comment'] ?></td>
                        <td><?= $banner_listrow['created_at'] ?></td>
                        <td><span class="label label-primary">Active</span></td>
                        <td><a href="upload.php?id=<?= $banner_listrow['id'] ?>"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
                    </tr>
                <?php 
                    }
                    else { ?>
                        <tr>
                            <td><b><?= $banner_listrow['banner_name'] ?></b></td>
                            <td><?= $banner_listrow['banner_url'] ?></td>
                            <td><img src="../uploads/<?= $banner_listrow['image'] ?>" alt="<?= $banner_listrow['banner_name'] ?>" class="img-thumbnail" width="80%"></td>
                            <td><?= $banner_listrow['comment'] ?></td>
                            <td><?= $banner_listrow['created_at'] ?></td>
                            <td><span class="label label-warning">Inactive</span></td>
                            <td><a href="upload.php?id=<?= $banner_listrow['id'] ?>"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
                        </tr>
                    <?php 
                        }
                    } 
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'inc/footer.php'; ?>

<script type="text/javascript">
    $('#addbanner').on("click", function(e) {
        window.location.href = "upload.php";
    });
</script>