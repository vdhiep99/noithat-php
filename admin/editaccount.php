<?php 
    include 'header.php';
    if (isset($_COOKIE["user"])) {
        $user = $_COOKIE["user"];
        foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
            $permission = $row['phanquyen'];
        }
        if ($permission==1) {
            if (isset($_GET["id"])) {
                foreach (selectAll("SELECT * FROM taikhoan WHERE id={$_GET['id']}") as $item) {
                    $taikhoan = $item['taikhoan'];
                    $matkhau = $item['matkhau'];
                    $hoten = $item['hoten'];
                    $phanquyen = $item['phanquyen'];
                 }
            }
            if (isset($_POST['sua'])) {
                $ten = $_POST["ten"];
                $phanquyen = $_POST["phanquyen"];
                $email = $_POST["email"];
                $ten = $_POST["ten"];
                if($email == $taikhoan){
                    selectAll("UPDATE `taikhoan` SET `taikhoan`='$email',`hoten`='$ten',`phanquyen`='$phanquyen' WHERE id={$_GET["id"]}");
                    setcookie("user", null, -1, '/');
                    header('location:../login.php');
                    die();
                } 
                else{
                  if(rowCount("SELECT * FROM taikhoan WHERE taikhoan='$email'")>0){
                    echo "<script>alert('Lỗi: Tài khoản(Email) đã tồn tại!')</script>";
                  }
                  else{
                    selectAll("UPDATE `taikhoan` SET `taikhoan`='$email',`hoten`='$ten',`phanquyen`='$phanquyen' WHERE id={$_GET["id"]}");
                    setcookie("user", null, -1, '/');
                    header('location:../login.php');
                    die();
                  }
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
                            <h4 class="card-title">Sửa Tài Khoản</h4>
                            <form class="forms-sample" action="" method="post" enctype="multipart/form-data">

                              <div class="form-group">
                                <label for="exampleInputName1">Họ Tên</label>
                                <input type="text" name = "ten" value="<?= $hoten ?>" required class="form-control text-light" placeholder="Nhập họ và tên">
                              </div>

                              <div class="form-group ">
                                <label for="exampleInputName1">Tài Khoản(Email)</label>
                                <input type="text" name ="email" value="<?= $taikhoan ?>" required class="form-control text-light" placeholder="Nhập email">
                              </div>
                              
                              <div class="form-group">
                                <label for="exampleInputEmail3">Loại Tài Khoản</label>
                                <select required name="phanquyen" id="input" class="form-control text-light">
                                    <option value="1">Admin</option>
                                    <option value="0">Khách hàng</option>
                                </select>
                              </div>
                              <button type="submit" name="sua" class="btn btn-primary mr-2" onclick="return confirm('Sau khi sửa thành công vui lòng đăng nhập lại tài khoản?')">Sửa Tài Khoản</button>
                              <a class="btn btn-dark" href="account.php" >Hủy</a>
                            </form>
                          </div>
                        </div>
                        </div>
                    </div>
                </div>
            <?php
        }else{
          header('location:../login.php');
          die();
        }
    }
    include 'footer.php';
?>