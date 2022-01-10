<?php 
	session_start();
    if(empty($_SESSION['userid']) && empty($_SESSION['username']))
    {
        header("Location: index.php");
        exit;   
    }
    require_once '../config/database.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(!empty($_POST['banner_up_btn'])) {
			if(!empty($_POST['banner_name']) && !empty($_POST['banner_url']) && !empty($_FILES["banner_image"]["name"])) {

				$banner_name = (!empty($_POST["banner_name"])) ? $_POST["banner_name"] : '';
				$banner_url = (!empty($_POST["banner_url"])) ? $_POST["banner_url"] : '';
				$description = (!empty($_POST["description"])) ? $_POST["description"] : '';
				
				$target_dir = "../uploads/";
				$target_file = $target_dir . $_FILES["banner_image"]["name"];
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				if ($imageFileType == 'png') {
					$filesize = $_FILES["banner_image"]["size"];
					if($filesize > 2000000) {
						$_SESSION['errorMsg'] = "File is too large!";
						header("Location: upload.php");
						exit;
					}
					else {
						$logo = date("YmdHi").uniqid().'.'.$imageFileType;
						$banner_insert_sql = "INSERT INTO banner_tbl (banner_name, banner_url, image, comment) VALUES ('$banner_name', '$banner_url', '$logo', '$description')";

						if (mysqli_query($conn, $banner_insert_sql)) {
							move_uploaded_file($_FILES["banner_image"]["tmp_name"], $target_dir.$logo);
						  	$_SESSION['successMsg'] = "Banner created successfully.";
						  	header("Location: bannerlist.php");
							exit;
						} else {
						  	$_SESSION['errorMsg'] = "Error in database!";
						  	// echo "Error: " . $merchant_insert_sql . "<br>" . mysqli_error($conn);
						  	header("Location: upload.php");
							exit;
						}
					}
				}
				else {
					$_SESSION['errorMsg'] = "File format not supported!";
					header("Location: upload.php");
					exit;
				}
			}
			else {
				$_SESSION['errorMsg'] = "Invalid Data!";
				header("Location: upload.php");
				exit;
			}
		}
		else if(!empty($_POST['banner_edit_btn'])) {
			if(!empty($_POST['id']) && !empty($_POST['banner_name']) && !empty($_POST['banner_url'])) {

				$ids = $_POST['id'];
				$banner_name = (!empty($_POST["banner_name"])) ? $_POST["banner_name"] : '';
				$banner_url = (!empty($_POST["banner_url"])) ? $_POST["banner_url"] : '';
				$description = (!empty($_POST["description"])) ? $_POST["description"] : '';
				$status = (!empty($_POST["status"])) ? $_POST["status"] : '';
				$oldimage = (!empty($_POST["oldimage"])) ? $_POST["oldimage"] : '';
				
				if(!empty($_FILES["banner_image"]["name"])) {
					$target_dir = "../uploads/";
					$target_file = $target_dir . $_FILES["banner_image"]["name"];
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

					if ($imageFileType == 'png') {
						$filesize = $_FILES["banner_image"]["size"];
						if($filesize > 2000000) {
							$_SESSION['errorMsg'] = "File is too large!";
							header("Location: bannerlist.php");
							exit;
						}
						else {
							$logo = date("YmdHi").uniqid().'.'.$imageFileType;
							$banner_update_sql = "UPDATE banner_tbl SET banner_name = '$banner_name', banner_url = '$banner_url', image = '$logo', comment = '$description', is_active = '$status' WHERE id = '$ids'";

							if (mysqli_query($conn, $banner_update_sql)) {
								move_uploaded_file($_FILES["banner_image"]["tmp_name"], $target_dir.$logo);
							  	$_SESSION['successMsg'] = "Banner updated successfully.";
							  	header("Location: bannerlist.php");
								exit;
							} else {
							  	$_SESSION['errorMsg'] = "Error in database!";
							  	echo "Error: " . $banner_update_sql . "<br>" . mysqli_error($conn);
							  	// header("Location: bannerlist.php");
								exit;
							}
						}
					}
					else {
						$_SESSION['errorMsg'] = "File format not supported!";
						header("Location: bannerlist.php");
						exit;
					}
				}
				else {
					$banner_update_sql = "UPDATE banner_tbl SET banner_name = '$banner_name', banner_url = '$banner_url', image = '$oldimage', comment = '$description', is_active = '$status' WHERE id = '$ids'";

					if (mysqli_query($conn, $banner_update_sql)) {
					  	$_SESSION['successMsg'] = "Banner updated successfully.";
					  	header("Location: bannerlist.php");
						exit;
					} else {
					  	$_SESSION['errorMsg'] = "Error in database!";
					  	echo "Error: " . $banner_update_sql . "<br>" . mysqli_error($conn);
					  	// header("Location: bannerlist.php");
						exit;
					}
				}

				
			}
			else {
				$_SESSION['errorMsg'] = "Invalid Data!";
				header("Location: bannerlist.php");
				exit;
			}
		}
	}
	else {
		$_SESSION['errorMsg'] = "Method not allowed!";
		header("Location: upload.php");
		exit;
	}
?>
