<?php
include 'header.php';

if (isset($_COOKIE["user"])) {
  $user = $_COOKIE["user"];
  foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
    $permission = $row['phanquyen'];
  }
  if ($permission == 1) {
    if (isset($_GET["id"])) {
      foreach (selectAll("SELECT * FROM sanpham WHERE id={$_GET['id']}") as $item) {
        $ten = $item['ten'];
        $id_danhmuc = $item['id_danhmuc'];
        $chatlieu = $item['chatlieu'];
        $nhasanxuat = $item['nhasanxuat'];
        $tgbaohanh = $item['tgbaohanh'];
        $gia = $item['gia'];
        $chitiet = $item['chitiet'];
        $mota = $item['mota'];
        $soluong = $item['soluong'];
      }
    }
    if (isset($_POST['sua'])) {
      $ten = $_POST["ten"];
      $soluong = $_POST["soluong"];
      $id_danhmuc = $_POST["danhmuc"];
      $chatlieu = $_POST["chatlieu"];
      $nhasanxuat = $_POST["nhasanxuat"];
      $tgbaohanh = $_POST["tgbaohanh"];
      $gia = $_POST["gia"];
      $anh1 = $_FILES['anh1']['name'];
      $tmp1 = $_FILES['anh1']['tmp_name'];
      $type1 = $_FILES['anh1']['type'];
      $anh2 = $_FILES['anh2']['name'];
      $tmp2 = $_FILES['anh2']['tmp_name'];
      $type2 = $_FILES['anh2']['type'];
      $anh3 = $_FILES['anh3']['name'];
      $tmp3 = $_FILES['anh3']['tmp_name'];
      $type3 = $_FILES['anh3']['type'];
      $chitiet = $_POST["chitiet"];
      $mota = $_POST["mota"];
      $dir = '../img/product/';
      move_uploaded_file($tmp1, $dir . $anh1);
      move_uploaded_file($tmp2, $dir . $anh2);
      move_uploaded_file($tmp3, $dir . $anh3);
      if (empty($_FILES['anh1']['name'] || $_FILES['anh2']['name'] || $_FILES['anh3']['name'])) {
        selectAll("UPDATE sanpham SET ten='$ten',id_danhmuc='$id_danhmuc',chatlieu='$chatlieu',nhasanxuat='$nhasanxuat',tgbaohanh='$tgbaohanh',soluong='$soluong',gia='$gia',chitiet='$chitiet',mota='$mota' WHERE id={$_GET['id']}");
        header('location:product.php');
        die();
      } else {
        selectAll("UPDATE sanpham SET ten='$ten',id_danhmuc='$id_danhmuc',chatlieu='$chatlieu',nhasanxuat='$nhasanxuat',tgbaohanh='$tgbaohanh',soluong='$soluong',gia='$gia',anh1='$anh1',anh2='$anh2',anh3='$anh3',chitiet='$chitiet',mota='$mota' WHERE id={$_GET['id']}");
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
              <div class="card-body addfont">
                <h4 class="card-title addfont">Sửa Sản Phẩm</h4>
                <form class="forms-sample" action="" method="post" enctype="multipart/form-data">

                  <div class="form-group addfont">
                    <label for="exampleInputName1">Tên Sản Phẩm</label>
                    <input type="text" value="<?= $ten ?>" name="ten" required class="form-control text-light" placeholder="Nhập tên sản phẩm">
                  </div>
                  <div class="form-group addfont">
                    <label for="exampleInputName1">Số Lượng Sản Phẩm</label>
                    <input type="number" value="<?= $soluong ?>" name="soluong" required class="form-control text-light" placeholder="Nhập số lượng sản phẩm">
                  </div>

                  <div class="form-group addfont">
                    <label for="exampleInputName1">Giá</label>
                    <input type="number" value="<?= $gia ?>" name="gia" required class="form-control text-light" placeholder="Nhập giá bán">
                  </div>

                  <div class="form-group addfont">
                    <label for="exampleInputEmail3">Danh mục</label>
                    <select required name="danhmuc" id="input" class="form-control text-light">
                      <?php
                      foreach (selectAll("SELECT * FROM danhmuc ") as $item) {
                      ?>
                        <option value="<?= $item['id_dm'] ?>"><?= $item['danhmuc'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group addfont">
                    <label for="exampleInputName1">Chất liệu</label>
                    <input type="text" value="<?= $chatlieu ?>" name="chatlieu" required class="form-control text-light" placeholder="Nhập chất liệu">
                  </div>

                  <div class="form-group addfont">
                    <label for="exampleInputName1">Nhà sản xuất</label>
                    <input type="text" value="<?= $nhasanxuat ?>" name="nhasanxuat" required class="form-control text-light" placeholder="Nhập nhà sản xuất">
                  </div>

                  <div class="form-group addfont">
                    <label for="exampleInputName1">tgbaohanh</label>
                    <input type="text" value="<?= $tgbaohanh ?>" name="tgbaohanh" required class="form-control text-light" placeholder="Nhập tên thời gian bảo hành">
                  </div>
                  <div class="form-group addfont">
                    <label>Ảnh Sản Phẩm</label>
                    <input type="file" name="anh1" class="form-control">
                    <input type="file" name="anh2" class="form-control">
                    <input type="file" name="anh3" class="form-control">
                  </div>

                  <div class="form-group addfont">
                    <label for="exampleTextarea1">Mô Tả Ngắn</label>
                    <textarea type="text" name="mota" required class="form-control text-light" rows="3" style="line-height: 2" placeholder="Nhập mô tả ngắn gọn"><?= $mota ?></textarea>
                  </div>

                  <div class="form-group addfont">
                    <label for="exampleTextarea1">Chi Tiết</label>
                    <textarea type="text" name="chitiet" required class="form-control text-light" style="line-height: 2" rows="6" placeholder="Nhập chi tiết"><?= $chitiet ?></textarea>
                  </div>

                  <button type="submit" name="sua" class="btn btn-primary mr-2">Sửa sản phẩm</button>
                  <a class="btn btn-dark" href="product.php">Hủy</a>
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