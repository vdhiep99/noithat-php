<?php
include 'header.php';
if (isset($_COOKIE["user"])) {
  $user = $_COOKIE["user"];
  foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
    $permission = $row['phanquyen'];
  }

  if ($permission == 1) {
    if (isset($_GET["id"])) {
      if (rowCount("SELECT * FROM sanpham WHERE id={$_GET['id']} && status=1 ") > 0) {
        selectall("UPDATE sanpham SET status=0 WHERE id={$_GET["id"]} && status=1");
        header('location:product.php');
        die();
      } else {
        selectall("UPDATE sanpham SET status=1 WHERE id={$_GET["id"]} && status=0");
        header('location:product.php');
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
                <h4 class="card-title addfont">Sản Phẩm </h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="addfont" style="width: 20px">STT</th>
                        <th class="addfont" style="width: 400px">Tên Sản Phẩm</th>
                        <th class="addfont">Danh Mục</th>
                        <th class="addfont" style="width:20px">Số Lượng</th>
                        <th class="addfont"> Giá </th>
                        <th class="addfont">Ảnh Sản Phẩm</th>
                        <th class="addfont">Trạng Thái</th>
                        <th></th>
                        <th><a type="button" class="btn btn-success btn-fw" style="width: 204px" href="addproduct.php">Thêm Sản Phẩm</a></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $stt = 1;
                      $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 8;
                      $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
                      $offset = ($current_page - 1) * $item_per_page;
                      $numrow = rowCount("SELECT * FROM sanpham WHERE status = 0");
                      $totalpage = ceil($numrow / $item_per_page);
                      foreach (selectAll("SELECT * FROM sanpham INNER JOIN danhmuc ON sanpham.id_danhmuc = danhmuc.id_dm LIMIT $item_per_page OFFSET $offset") as $row) {
                      ?>
                        <tr class="addfont" >
                          <td style="padding: 0.74rem ;font-size: 0.75rem" ><?= $stt++ ?></td>
                          <td style="padding: 0.74rem ;font-size: 0.75rem" >
                            <span><?= $row['ten'] ?></span>
                          </td>
                          <td style="padding: 0.74rem ;font-size: 0.75rem">
                            <?= ($row['danhmuc']) ?>
                          </td>
                          <td style="padding: 0.74rem ;font-size: 0.75rem">
                            <?=($row['soluong'])?>
                          </td>
                          <td style="padding: 0.74rem ;font-size: 0.75rem"><?= number_format($row['gia']) ?>đ</td>
                          <td>
                            <img src="../img/product/<?= $row['anh1'] ?>" width="100" alt="">
                            <img src="../img/product/<?= $row['anh2'] ?>" width="100" alt="">
                            <img src="../img/product/<?= $row['anh3'] ?>" width="100" alt="">
                          </td>
                          <td style="padding: 0.74rem ;font-size: 0.75rem">
                            <?php
                            $status = $row['status'];
                            if ($status == 0) {
                            ?>
                              <span>Đang Bán</span>
                            <?php
                            } else {
                            ?>
                              <span>Không Kinh Doanh</span>
                            <?php
                            }
                            ?>
                          </td>
                          <td><?= rowCount("SELECT * FROM sanpham WHERE id={$row['id']}") ?></td>
                          <td>
                            <a style="font-size: 0.75rem" type="button" class="btn btn-primary btn-icon-text" href="editproduct.php?id=<?= $row['id'] ?>">
                              <i style="font-size: 0.75rem" class="mdi mdi-file-check btn-icon-prepend"></i> Sửa </a>
                            <a style="font-size: 0.75rem" type="button" class="btn btn-danger btn-icon-text" href="?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có muốn xóa danh mục này không ?')">
                              <i class="mdi mdi-delete btn-icon-prepend"></i> Xóa </a>
                            <?php
                            $status = $row['status'];
                            if ($status == 0) {
                            ?>
                              <a style="font-size: 0.75rem" type="button" class="btn btn-danger btn-icon-text" style="width: 120px" href="?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có muốn dừng kinh doanh sản phẩm này không?')">
                                <i style="font-size: 0.75rem" class="mdi mdi-cart-off btn-icon-prepend"></i> Dừng Bán </a>
                            <?php
                            } else {
                            ?>
                              <a style="font-size: 0.75rem" type="button" class="btn btn-danger btn-icon-text" style="width: 120px" href="?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có muốn tiếp tục kinh doanh sản phẩm này không?')">
                                <i style="font-size: 0.75rem" class="mdi mdi-cart-outline btn-icon-prepend"></i> Bán </a>
                            <?php
                            }
                            ?>
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
                          <?php for ($num = 1; $num <= $totalpage; $num++) { ?>
                            <?php
                            if ($num != $current_page) {
                            ?>
                              <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                                <li class="page-item"><a class="btn btn-outline-secondary" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a></li>
                              <?php } ?>
                            <?php
                            } else {
                            ?>
                              <strong class="page-item"><a class="btn btn-outline-secondary"><?= $num ?></a></strong>
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
      <script src="./js/search.js?v=<?php echo time() ?>"></script>
  <?php
  }
}
include 'footer.php';
  ?>