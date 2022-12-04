<?php 
    include 'header.php';
    if (isset($_COOKIE["user"])) {
        $user = $_COOKIE["user"];
        foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
            $permission = $row['phanquyen'];
        }
        if ($permission==1) {
            if (isset($_POST['them'])) {
                $danhmuc = $_POST["danhmuc"];
                if(rowCount("SELECT * FROM danhmuc WHERE danhmuc='$danhmuc'")>0){
                    echo "<script>alert('Danh mục đã tồn tại!')</script>";
                }else{
                    selectAll("INSERT INTO danhmuc VALUES (NULL,'$danhmuc')");
                    header('location:category.php');
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
                                <h4 class="card-title">Danh Mục Sản Phẩm </h4>
                                <div class="table-responsive">
                                <form action="" method="post" class="card-body">
                                    <div class="form-group">
                                    <input type="text" class="form-control text-light" name="danhmuc" required placeholder="Danh Mục Sản Phẩm" >
                                    <button type="submit" class="btn btn-success btn-fw" style=" margin-top:30px;" name="them">Thêm Danh Mục</button>
                                    </div>
                                </form>
                                </div>
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
