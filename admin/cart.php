<?php 
    include 'header.php';
    if (isset($_COOKIE["user"])) {
        $user = $_COOKIE["user"];
        foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
            $permission = $row['phanquyen'];
        }
        if ($permission==1) {
          switch ($_GET["action"]) {
            case "update":
              if (isset($_GET["id"])) {
                if(rowCount("SELECT * FROM donhang WHERE id={$_GET['id']} && status=1 ")>0){
                  selectall("UPDATE donhang SET status=2 WHERE id={$_GET["id"]} && status=1");
                  header('location:cart.php?action');
                  die();
                }
                else if(rowCount("SELECT * FROM donhang WHERE id={$_GET['id']} && status=2 ")>0){
                  selectall("UPDATE donhang SET status=3 WHERE id={$_GET["id"]} && status=2");
                  header('location:cart.php?action');
                  die();
                }
                else if(rowCount("SELECT * FROM donhang WHERE id={$_GET['id']} && status=4 ")>0){
                  selectall("DELETE FROM donhang WHERE id={$_GET['id']}");
                  header('location:cart.php?action');
                  die();
                }
              }
            break;
            case "delete":
              if (isset($_GET["id"])) {
                if(rowCount("SELECT * FROM donhang WHERE id={$_GET['id']} && status=1 ")>0){
                  selectall("UPDATE donhang SET status=4 WHERE id={$_GET["id"]} && status=1");
                  header('location:cart.php?action');
                }
                else if(rowCount("SELECT * FROM donhang WHERE id={$_GET['id']} && status=2 ")>0){
                  selectall("UPDATE donhang SET status=4 WHERE id={$_GET["id"]} && status=2");
                  header('location:cart.php?action');
                  die();
                }
              }
            break;
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
                                                <th class="addfont" style="width: 10px">STT</th>
                                                <th class="addfont">Khách Hàng</th>
                                                <th class="addfont">Tài khoản (Email)</th>
                                                <th class="addfont">ID Đơn Hàng</th>
                                                <th class="addfont">Tổng Tiền</th>
                                                <th class="addfont">Thời Gian Đặt Hàng</th>
                                                <th class="addfont">Trạng Thái</th>
                                                <th class="addfont">Chức Năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 
                                        $stt=1;
                                        $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:8;
                                        $current_page = !empty($_GET['page'])?$_GET['page']:1;
                                        $offset = ($current_page - 1) * $item_per_page;
                                        $numrow = rowCount("SELECT * FROM donhang");
                                        $totalpage = ceil($numrow / $item_per_page);
                                        foreach (selectAll("SELECT * FROM donhang WHERE status= 1 OR status= 2 OR status= 3 OR status= 4 ORDER BY status ASC LIMIT $item_per_page OFFSET $offset") as $row) {
                                        ?>
                                            <tr class="addfont">
                                                <td style="padding: 0.4rem ;font-size: 0.75rem"><?= $stt++ ?></td>
                                                <td style="padding: 0.4rem ;font-size: 0.75rem">
                                                  <?php
                                                    foreach (selectAll("SELECT * FROM taikhoan WHERE id={$row['id_taikhoan']}" ) as $rows) {
                                                  ?>
                                                <span><?= $rows['hoten'] ?></span>
                                                </td>
                                                <td style="font-size: 0.85rem">
                                                  <span><?= $rows['taikhoan'] ?></span>
                                                </td>
                                                <?php } ?>
                                                <td style="padding: 0.4rem ;font-size: 0.75rem">
                                                  <?= ($row['id']) ?>
                                                </td>
                                                <td style="padding: 0.4rem ;font-size: 0.75rem"><?= number_format($row['tongtien']) ?>đ</td>
                                                <td>
                                                  <p class="addfont" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 200px; padding-top: 12px;"><?= ($row['thoigian']) ?></p>
                                                </td>
                                                <td style="padding: 0.4rem ;font-size: 0.75rem">
                                                  <?php 
                                                    $status = $row['status'];
                                                    if ($status==1) {
                                                      ?>
                                                      <span class="badge badge-info">Chờ Xác Nhận</span>
                                                  <?php 
                                                    }else if($status==2){
                                                      ?>
                                                      <span class="badge badge-warning">Đang Giao</span>
                                                  <?php 
                                                    }else if($status==3){
                                                      ?>
                                                      <span class="badge badge-success">Đã Giao</span>
                                                  <?php 
                                                    }else{
                                                      ?>
                                                      <span class="badge badge-danger">Đã Hủy</span>
                                                  <?php
                                                    }
                                                  ?>
                                                </td>
                                                <td style="padding: 0.4rem ;font-size: 0.75rem">
                                                <a style="font-size: 0.75rem" type="button" class="btn btn-primary btn-icon-text" href="cartdetail.php?id=<?= $row['id'] ?>">
                                                <i style="font-size: 0.75rem" class="mdi mdi-file-check btn-icon-prepend"></i> Chi Tiết</a>
                                                  <?php 
                                                    if($status==1){
                                                      ?>
                                                      <a style="font-size: 0.75rem" type="button" class="btn btn-success btn-icon-text" style="width: 130px" href="?action=update&id=<?= $row['id'] ?>" onclick="return confirm('Bạn có muốn xác nhận đơn hàng này không?')">
                                                      <i style="font-size: 0.75rem" class="mdi mdi-trending-up btn-icon-prepend"></i> Xác Nhận </a>

                                                      <a style="font-size: 0.75rem" type="button" class="btn btn-danger btn-icon-text" href="?action=delele&id=<?= $row['id'] ?>"onclick="return confirm('Bạn có muốn hủy đơn hàng này không?')">
                                                      <i style="font-size: 0.75rem" class="mdi mdi mdi-delete btn-icon-prepend"></i> Hủy</a>
                                                  <?php
                                                    }else if($status==2){
                                                      ?>
                                                      <a style="font-size: 0.75rem" type="button" class="btn btn-success btn-icon-text" style="width: 130px" href="?action=update&id=<?= $row['id'] ?>" onclick="return confirm('Bạn có muốn hoàn thành đơn hàng này không?')">
                                                      <i style="font-size: 0.75rem" class="mdi mdi-trending-up btn-icon-prepend"></i> Hoàn Thành</a>

                                                      <a style="font-size: 0.75rem" type="button" class="btn btn-danger btn-icon-text" href="?action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Bạn có muốn hủy đơn hàng này không?')">
                                                      <i style="font-size: 0.75rem" class="mdi mdi mdi-delete btn-icon-prepend"></i> Hủy</a>
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

