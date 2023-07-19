<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    ?>
    <div class="main-content">
        <h1>Thêm sản phẩm</h1>
        <div id="content-box">
            <?php
            if (isset($_GET['action']) && $_GET['action'] == 'add') {
                if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price'])) {
                    $galleryImages = array();
                    if (empty($_POST['name'])) {
                        $error = "Bạn phải nhập tên sản phẩm";
                    } elseif (empty($_POST['price'])) {
                        $error = "Bạn phải nhập giá sản phẩm";
                    } elseif (!empty($_POST['price']) && is_numeric(str_replace('.', '', $_POST['price'])) == false) {
                        $error = "Giá nhập không hợp lệ";
                    }
                    if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
                        $uploadedFiles = $_FILES['image'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $image = $result['path'];
                        }
                    }
                    if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) {
                        $uploadedFiles = $_FILES['gallery'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $galleryImages = $result['uploaded_files'];
                        }
                    }
                    if (!isset($error)) {
                        $result = mysqli_query($con, "INSERT INTO `product` (`id`, `name`, `image`, `price`, `content`, `created_time`, `last_updated`) VALUES (NULL, '" . $_POST['name'] . "','" . $image . "', " . str_replace('.', '', $_POST['price']) . ", '" . $_POST['content'] . "', " . time() . ", " . time() . ");");
                        if (!$result) {
                            $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                        }
//                        else {
//                            if (!empty($galleryImages)) {
//                                $inserted_id = ($_GET['action'] == 'edit' && !empty($_GET['id'])) ? $_GET['id'] : $con->insert_id;
//                                $insertValues = "";
//                                foreach ($galleryImages as $path) {
//                                    if (empty($insertValues)) {
//                                        $insertValues = "(NULL, " . $inserted_id . ", '" . $path . "', " . time() . ", " . time() . ")";
//                                    } else {
//                                        $insertValues .= ",(NULL, " . $inserted_id . ", '" . $path . "', " . time() . ", " . time() . ")";
//                                    }
//                                }
//                                $result = mysqli_query($con, "INSERT INTO `image_library` (`id`, `product_id`, `path`, `created_time`, `last_updated`) VALUES " . $insertValues . ";");
//                            }
//                        }
                    }
                } else {
                    $error = "Bạn chưa nhập thông tin sản phẩm.";
                }
                ?>
                <div class = "container">
                    <div class = "error"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                    <a href = "product_listing.php">Quay lại danh sách sản phẩm</a>
                </div>
            <?php } else { ?>
                <form id="product-form" method="POST" action="?action=add"  enctype="multipart/form-data">
                    <input type="submit" title="Lưu sản phẩm" value="" />
                    <div class="clear-both"></div>
                    <div class="wrap-field">
                        <label>Tên sản phẩm: </label>
                        <input type="text" name="name" value="" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Giá sản phẩm: </label>
                        <input type="text" name="price" value="" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>Ảnh đại diện: </label>
                        <div class="right-wrap-field">
                            <input type="file" name="image" />
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <?php /*
                    <div class="wrap-field">
                        <label>Thư viện ảnh: </label>
                        <div class="right-wrap-field">
                            <input multiple="" type="file" name="gallery[]" />
                        </div>
                        <div class="clear-both"></div>
                    </div>*/?>
                    <div class="wrap-field">
                        <label>Nội dung: </label>
                        <textarea name="content" id="product-content"></textarea>
                        <div class="clear-both"></div>
                    </div>
                </form>
                <div class="clear-both"></div>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('product-content');
                </script>
            <?php } ?>
        </div>
    </div>

    <?php
}
include './footer.php';
?>