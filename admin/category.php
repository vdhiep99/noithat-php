<?php 
    include 'header.php';
    if (isset($_COOKIE["user"])) {
        $user = $_COOKIE["user"];
        foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
            $permission = $row['phanquyen'];
        }
        
        if ($permission==1) {
            if (isset($_GET["id"])) {
                if(rowCount("SELECT * FROM sanpham WHERE id_danhmuc={$_GET['id']}")>0){
                    echo '<script>alert("Chỉ được xóa danh mục không có sản phẩm")</script>';
                    // header('location:category.php');
                }
                else {
                    selectAll("DELETE FROM danhmuc WHERE id_dm={$_GET['id']}");
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
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="addfont">STT</th>
                                                <th class="addfont" style="width: 500px" >Tên Sản Phẩm</th>
                                                <th class="addfont">Số lượng sản phẩm</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th><a type="button" class="btn btn-success btn-fw addfont" style="width: 162px" href="addcategory.php">Thêm Danh Mục</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 
                                        $stt=1;
                                        $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:8;
                                        $current_page = !empty($_GET['page'])?$_GET['page']:1;
                                        $offset = ($current_page - 1) * $item_per_page;
                                        $numrow = rowCount("SELECT * FROM danhmuc");
                                        $totalpage = ceil($numrow / $item_per_page);
                                        foreach (selectAll("SELECT * FROM danhmuc LIMIT $item_per_page OFFSET $offset") as $row) {
                                        ?>
                                            <tr>
                                                <td><?= $stt++ ?></td>
                                                <td>
                                                <span><?= $row['danhmuc'] ?></span>
                                                </td>
                                                <td><?= rowCount("SELECT * FROM sanpham WHERE id_danhmuc={$row['id_dm']}") ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                <a type="button" class="btn btn-primary btn-icon-text" href="editcategory.php?id=<?= $row['id_dm'] ?>">
                                                <i class="mdi mdi-file-check btn-icon-prepend"></i> Sửa </a>
                                                <a type="button" class="btn btn-danger btn-icon-text" href="?id=<?= $row['id_dm'] ?>" onclick="return confirm('Bạn có muốn xóa danh mục này không ?')">
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

