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
                $phanquyen = $_POST["phanquyen"];
                $email = $_POST["email"];
                $ten = $_POST["ten"];
                $matkhau = $_POST["matkhau"];
                if(rowCount("SELECT * FROM taikhoan WHERE taikhoan='$email'")>0){
                  echo "<script>alert('Tài khoản(Email) đã tồn tại!')</script>";
                }
                else{
                  selectAll("INSERT INTO taikhoan VALUES(null,'$email','$matkhau','$ten','','','',$phanquyen,0)");
                  header('location:account.php');
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
                  <div class="card-body">
                    <h4 class="card-title">Thêm Tài Khoản</h4>
                    <form class="forms-sample" action="" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                        <label for="exampleInputName1">Họ Tên</label>
                        <input type="text" name = "ten" required class="form-control text-light" placeholder="Nhập họ và tên">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Tài Khoản(Email)</label>
                        <input type="email" name ="email" required class="form-control text-light" placeholder="Nhập email">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Mật Khẩu</label>
                        <input type="password" name ="matkhau" required class="form-control text-light" placeholder="Nhập mật khẩu">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail3">Loại Tài Khoản</label>
                        <select required name="phanquyen" id="input" class="form-control text-light">
                            <option value="1">Admin</option>
                            <option value="0">Khách hàng</option>
                        </select>
                      </div>
                      <button type="submit" name="them" class="btn btn-primary mr-2">Thêm Tài Khoản</button>
                      <a class="btn btn-dark" href="account.php" >Hủy</a>
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