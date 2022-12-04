<?php 
    include 'header.php';
    if (isset($_COOKIE["user"])) {
        $user = $_COOKIE["user"];
        foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
            $permission = $row['phanquyen'];
        }
        if ($permission==1) {
            if (isset($_GET["id"])) {
                selectAll("DELETE FROM binhluan WHERE id={$_GET['id']}");
                header('location:comment.php');
                die();
            }
            ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row ">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body addfont">
                        <h4 class="card-title">Bình Luận </h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="addfont">
                                        <th>STT</th>
                                        <th style="width: 500px" >Tên Sản Phẩm</th>
                                        <th>Khách Hàng</th>
                                        <th>Nội dung</th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                          <!-- <a type="button" class="btn btn-success btn-fw addfont" style="width: 162px" href="addcategory.php">Thêm Danh Mục</a> -->
                                          Chức Năng
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                $stt=1;
                                $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:8;
                                $current_page = !empty($_GET['page'])?$_GET['page']:1;
                                $offset = ($current_page - 1) * $item_per_page;
                                $numrow = rowCount("SELECT * FROM binhluan");
                                $totalpage = ceil($numrow / $item_per_page);
                                foreach (selectAll("SELECT * FROM binhluan LIMIT $item_per_page OFFSET $offset") as $row) {
                                ?>
                                    <tr class="addfont">
                                        <td><?= $stt++ ?></td>
                                        <td>
                                          <?php 
                                            foreach (selectAll("SELECT * FROM sanpham WHERE id={$row['id_sanpham']}") as $item) {
                                            echo $item['ten'];
                                          }
                                          ?>
                                        </td>
                                        <td>
                                          <?php 
                                            foreach (selectAll("SELECT * FROM taikhoan WHERE id={$row['id_taikhoan']}") as $item) {
                                            echo $item['hoten'];
                                          }
                                          ?>
                                        </td>
                                        <td class="addfont" >
                                          <p class="addfont" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 250px; padding-top: 12px;"><?= $row['noidung'] ?></p>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                        <a type="button" class="btn btn-primary btn-icon-text" href="../detail.php?id=<?= $row['id_sanpham']?>#contact-tab">
                                        <i class="mdi mdi-file-check btn-icon-prepend"></i>Xem</a>
                                        <a type="button" class="btn btn-danger btn-icon-text" href="?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có muốn xóa bình luận này không ?')">
                                        <i class="mdi mdi-delete btn-icon-prepend"></i> Xóa </a>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                            <div class="col-lg-12">
                                <div class="pageination">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            <?php for($num = 1; $num <=$totalpage;$num++) { ?>
                                                <?php 
                                                    if ($num != $current_page){ 
                                                ?>
                                                    <?php if ($num > $current_page-3 && $num < $current_page+3){ ?>
                                                    <li class="page-item"><a class="btn btn-outline-secondary" href="?per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a></li>
                                                    <?php } ?>
                                                <?php 
                                                } 
                                                else{ 
                                                ?>
                                                    <strong class="page-item"><a class="btn btn-outline-secondary"><?=$num?></a></strong>
                                                <?php 
                                                }
                                            } 
                                            ?>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="./js/search.js?v=<?php echo time()?>"></script>
    <?php
}
}
include 'footer.php';
?>

