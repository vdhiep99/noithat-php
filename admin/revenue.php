<?php 
  $tongtienhientai = 0;
  $tongtiendutinh = 0;
  $tongtiengiam = 0;
  if (isset($_COOKIE["user"])) {
      $user = $_COOKIE["user"];
      foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
          $permission = $row['phanquyen'];
      }
      if ($permission==1) {
        foreach (selectAll("SELECT * FROM donhang WHERE status =4") as $item) {
          $tongtiengiam += $item['tongtien'];
        }
        foreach (selectAll("SELECT * FROM donhang WHERE status =3") as $item) {
          $tongtienhientai += $item['tongtien'];
        }
        foreach (selectAll("SELECT * FROM donhang WHERE status =3 or status =2 or status =1") as $item2) {
            $tongtiendutinh += $item2['tongtien'];
        }
        
?>
<!-- partial -->
<div class="main-panel">
          <div class="content-wrapper">
            <div class="row">

              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5 class="addfont">Tổng Doanh Thu Thực Tế</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"><?= number_format($tongtienhientai)?>đ</h2>
                          <!-- <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p> -->
                        </div>
                        <!-- <h6 class="text-muted font-weight-normal">11.38% Since last month</h6> -->
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-monitor text-success ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5 class="addfont">Tổng Doanh Thu Dự Tính</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"><?= number_format($tongtiendutinh)?>đ</h2>
                          <!-- <p class="text-success ml-2 mb-0 font-weight-medium">+8.3%</p> -->
                        </div>
                        <!-- <h6 class="text-muted font-weight-normal"> 9.61% Since last month</h6> -->
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                      <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5 class="addfont">Tổng Các Khoản Giảm Trừ Doanh Thu</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"><?= number_format($tongtiengiam)?>đ</h2>
                          <!-- <p class="text-danger ml-2 mb-0 font-weight-medium">-2.1% </p> -->
                        </div>
                        <!-- <h6 class="text-muted font-weight-normal"> 9.61% Since last month</h6> -->
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title addfont">Thống Kê</h4>
                    <div class="table-responsive">
                    <table class="table">
                      <thead>
                          <tr>
                              <th class="addfont" style="width: 100px">STT</th>
                              <th class="addfont" style="width: 500px" >Họ Tên</th>
                              <th class="addfont" style="width: 400px" >Tài Khoản (Email)</th>
                              <th class="addfont" style="width: 300px">Loại Tài Khoản</th>
                              <th class="addfont" style="width: 300px">Số Đơn Đã Mua</th>
                              <th class="addfont" style="width: 300px">Tổng Tiền</th>
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
                      foreach (selectAll("SELECT * FROM donhang WHERE status=3 ORDER BY tongtien DESC LIMIT $item_per_page OFFSET $offset ") as $row) {
                        $idtaikhoan1 = $row["id_taikhoan"];
                      foreach (selectAll("SELECT * FROM taikhoan WHERE id = '$idtaikhoan1'") as $rows) {
                        $numrow = rowCount("SELECT * FROM donhang WHERE status=3 && id_taikhoan = $idtaikhoan1");
                      ?>
                          <tr class="addfont">
                              <td>
                                <?= $stt++ ?></td>
                              <td>
                                <img src="<?= empty($rows['anh'])?'../img/account/user.png':'../img/account/'.$rows['anh'].'' ?>" alt="image">
                                <span><?= $rows['hoten'] ?></span>
                              </td>
                              <td>
                                <?= $rows['taikhoan'] ?>
                              </td>
                              <td>
                                <?= $rows['phanquyen'] == 1 ? 'Admin' : 'Khách hàng'?>
                              </td>
                              <td>
                                <?= $numrow ?>
                              </td>
                              <td>
                                <?php 
                              foreach (selectAll("SELECT * FROM donhang WHERE status=3 && id_taikhoan = $idtaikhoan1") as $item) {
                              ?>
                                <?= number_format($item['tongtien'])?>đ
                              <?php
                                  }
                              ?>
                              </td>
                          </tr>
                      <?php
                          }
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