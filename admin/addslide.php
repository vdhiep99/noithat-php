<?php 
    include 'header.php';

    if (isset($_COOKIE["user"])) {
        $user = $_COOKIE["user"];
        foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
            $permission = $row['phanquyen'];
        }
        if ($permission==1) {
            if (isset($_POST['them'])) {
                $ten = $_POST["ten"];
                $link = $_POST['link'];
                $mota = $_POST["mota"];
                $anh1 = $_FILES['anh1']['name'];
                $tmp1 = $_FILES['anh1']['tmp_name'];
                $type1 = $_FILES['anh1']['type'];
                $dir = '../img/slide/';
                move_uploaded_file($tmp1, $dir . $anh1);
                if (empty($_FILES['anh1']['name'])) {
                    $error = 'Vui lòng chọn ảnh';
                }else{
                    selectAll("INSERT INTO slide VALUES(NULL,'$ten','$link','$anh1','$mota')");
                    header('location:slide.php');
                    die();
                }
            }
        ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row ">
                        <div class="col-12 grid-margin">
                        <div class="card">
                  <div class="card-body addfont">
                    <h4 class="card-title addfont">Sửa Slide</h4>
                    <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                    <?php 
                        if (isset($error)) {
                            ?>
                                <p class="text-danger"><?= $error ?></p>
                            <?php
                        }
                    ?>
                      <div class="form-group addfont">
                        <label for="exampleInputName1">Tiêu Đề Slide</label>
                        <input type="text" name = "ten" required class="form-control text-light" placeholder="Nhập tiêu đề slide">
                      </div>

                      <div class="form-group addfont">
                        <label for="exampleInputName1">Link </label>
                        <input type="text" name ="link" required class="form-control text-light" placeholder="Nhập link">
                      </div>

                      <div class="form-group addfont">
                        <label>Ảnh Slide</label>
                        <input type="file" name="anh1" class="form-control">
                      </div>

                      <div class="form-group addfont">
                        <label for="exampleTextarea1">Mô Tả</label>
                        <textarea type="text"  name ="mota" required class="form-control text-light" rows="3" style="line-height: 2" placeholder="Nhập mô tả ngắn gọn"></textarea>
                      </div>

                      
                      <button type="submit" name="them" class="btn btn-primary mr-2">Thêm Slide</button>
                      <a class="btn btn-dark" href="slide.php" >Hủy</a>
                    </form>
                  </div>
                </div>
                        </div>
                    </div>
                </div>
            <?php
        }
    }
    include 'footer.php';
?>