<?php 
    include 'header.php';
    if (isset($_COOKIE["user"])) {
        $user = $_COOKIE["user"];
        foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
            $permission = $row['phanquyen'];
        }
        if ($permission==1) {
            if (isset($_GET["id"])) {
                // selectAll("UPDATE  FROM taikhoan WHERE id={$_GET['id']}");
                // header('location:account.php');
                if(rowCount("SELECT * FROM taikhoan WHERE id={$_GET['id']} && status=1 ")>0){
                  selectall("UPDATE taikhoan SET status=0 WHERE id={$_GET["id"]} && status=1");
                  header('location:account.php');
                  die();
                }
                else {
                  selectall("UPDATE taikhoan SET status=1 WHERE id={$_GET["id"]} && status=0");
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
                                <h4 class="card-title addfont">Tài Khoản </h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="addfont" style="width: 100px">STT</th>
                                                <th class="addfont" style="width: 500px" >Họ Tên</th>
                                                <th class="addfont" style="width: 400px" >Tài Khoản (Email)</th>
                                                <th class="addfont" style="width: 300px">Loại Tài Khoản</th>
                                                <th class="addfont" style="width: 300px">Trạng thái</th>
                                                <th class="addfont"><a type="button" class="btn btn-success btn-fw" style="width: 204px" href="addaccount.php">Thêm Tài Khoản</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 
                                        $stt=1;
                                        $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:8;
                                        $current_page = !empty($_GET['page'])?$_GET['page']:1;
                                        $offset = ($current_page - 1) * $item_per_page;
                                        $numrow = rowCount("SELECT * FROM taikhoan");
                                        $totalpage = ceil($numrow / $item_per_page);
                                        foreach (selectAll("SELECT * FROM taikhoan ORDER BY status ASC LIMIT $item_per_page OFFSET $offset") as $row) {
                                        ?>
                                            <tr>
                                                <td>
                                                  <?= $stt++ ?></td>
                                                <td>
                                                  <img src="<?= empty($row['anh'])?'../img/account/user.png':'../img/account/'.$row['anh'].'' ?>" alt="image">
                                                  <span class="addfont"><?= $row['hoten'] ?></span>
                                                </td>
                                                <td class="addfont">
                                                  <?= $row['taikhoan'] ?>
                                                </td>
                                                <td class="addfont">
                                                  <?= $row['phanquyen'] == 1 ? 'Admin' : 'Khách hàng'?>
                                                </td>
                                                <td class="addfont">
                                                  <?= $row['status'] == 0 ? 'Đang hoạt động' : 'Khóa'?>
                                                </td>
                                                <td>
                                                  <a type="button" class="btn btn-primary btn-icon-text addfont" href="editaccount.php?id=<?= $row['id'] ?>">
                                                  <i class="mdi mdi-file-check btn-icon-prepend"></i> Sửa </a>
                                                  <?php 
                                                    $status = $row['status'];
                                                    if ($status==0) {
                                                      ?>
                                                      <a type="button" class="btn btn-danger btn-icon-text addfont" style="width: 120px" href="?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có muốn khóa tài khoản này không?')">
                                                      <i class="mdi mdi-account-off btn-icon-prepend"></i> Khóa </a>
                                                  <?php 
                                                    }else{
                                                      ?>
                                                      <a type="button" class="btn btn-secondary btn-icon-text addfont" style="width: 120px" href="?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có muốn mở tài khoản này không?')">
                                                      <i class="mdi mdi-account-outline btn-icon-prepend"></i> Mở Khóa</a>
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

