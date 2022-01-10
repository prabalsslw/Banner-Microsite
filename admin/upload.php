<?php 
    include 'inc/header.php'; 
    require_once '../config/database.php';
?>

<br><br>
<?php if(isset($_GET['id']) && $_GET['id'] != "") { 
    $id = $_GET['id'];
    $banner_list_sql = "SELECT * FROM banner_tbl WHERE id = '$id' LIMIT 1";
    $banner_list_result = mysqli_query($conn, $banner_list_sql);
    $banner_info = mysqli_fetch_assoc($banner_list_result);
    // print_r($banner_info);
?>
<div class="col-md-8 col-md-offset-2" style="border: 2px solid #fbd0e3;padding: 20px;background: #FBF3F7;">
    <form method="post" enctype="multipart/form-data" action="upload_action.php">
        <h5 style="font-size: 15px;font-weight: bold;">Update Banner</h5><hr>
        <div class="col-md-6">
            <div class="form-group">
                <label for="banner_name" style="font-size: 13px;">Banner Label</label>
                <input type="hidden" name="id" value="<?= $banner_info['id'] ?>">
                <input type="text" class="form-control" name="banner_name" required autocomplete="off" autofocus style="border-radius: 0px; border: 0px; height: 40px;" placeholder="Banner Label" value="<?= $banner_info['banner_name'] ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="banner_url" style="font-size: 13px;">Link</label>
                <input type="url" class="form-control" name="banner_url" required autocomplete="off" style="border-radius: 0px; border: 0px; height: 40px;" placeholder="Link" value="<?= $banner_info['banner_url'] ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="banner_image" style="font-size: 13px;">Banner Image</label>
                <input type="file" class="form-control" name="banner_image" autocomplete="off" style="border-radius: 0px; border: 0px; height: 40px;" value="<?= $banner_info['image'] ?>">
                <input type="hidden" name="oldimage" value="<?= $banner_info['image'] ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="status" style="font-size: 13px;">Status</label>
                <select class="form-control" name="status" style="border-radius: 0px; border: 0px; height: 40px;" required>
                    <?php if($banner_info['is_active'] == 1){ ?>
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    <?php } else { ?>
                        <option value="1">Active</option>
                        <option value="0" selected>Inactive</option>
                    <?php } ?>
                </select>

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <img src="../uploads/<?= $banner_info['image'] ?>" class="img-thumbnail">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="description" style="font-size: 13px;">Description</label>
                <textarea class="form-control" rows="2" name="description" style="border-radius: 0px; border: 0px;" placeholder="Description"><?= $banner_info['comment'] ?></textarea>
            </div>
            <br>
            <input type="submit" class="btn btn-warning pull-right" name="banner_edit_btn" value="Update" style="background: #E2136E;">
        </div>
        
    </form> 
</div>
<?php } else { ?>
<div class="col-md-8 col-md-offset-2" style="border: 2px solid #fbd0e3;padding: 20px;background: #FBF3F7;">
    <form method="post" enctype="multipart/form-data" action="upload_action.php">
        <h5 style="font-size: 15px;font-weight: bold;">Upload Banner</h5><hr>
        <div class="col-md-12">
            <div class="form-group">
                <label for="banner_name" style="font-size: 13px;">Banner Label</label>
                <input type="text" class="form-control" name="banner_name" required autocomplete="off" autofocus style="border-radius: 0px; border: 0px; height: 40px;" placeholder="Banner Label">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="banner_url" style="font-size: 13px;">Link</label>
                <input type="url" class="form-control" name="banner_url" required autocomplete="off" style="border-radius: 0px; border: 0px; height: 40px;" placeholder="Link">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="banner_image" style="font-size: 13px;">Banner Image</label>
                <input type="file" class="form-control" name="banner_image" required autocomplete="off" style="border-radius: 0px; border: 0px; height: 40px;">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description" style="font-size: 13px;">Description</label>
                <textarea class="form-control" rows="2" name="description" style="border-radius: 0px; border: 0px;" placeholder="Description"></textarea>
            </div>
            <br>
            <input type="submit" class="btn btn-danger pull-right" name="banner_up_btn" value="Upload" style="background: #E2136E;">
        </div>
        
    </form> 
</div>

<?php }
include 'inc/footer.php'; 
?>