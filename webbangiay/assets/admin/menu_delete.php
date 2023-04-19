<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
?>
  <!-- Begin:Menu_delete -->
  <section class="home-section">
    <div class="main-content">
      <h1>Xóa danh mục</h1>
      <div id="delete-box">
        <?php
        $error = false;
        if (isset($_GET['id']) && !empty($_GET['id'])) {
          include '../config/connect.php';
          $menu = mysqli_query($con, "SELECT * FROM `menu` ORDER BY `menu`.`position` ASC");
          $menuList = mysqli_fetch_all($menu, MYSQLI_ASSOC);
          deleteChildrenMenu($_GET['id'], $menuList, $con);
          $result = mysqli_query($con, "DELETE FROM `menu` WHERE `id` = " . $_GET['id']);
          if (!$result) {
            $error = "Không thể xóa danh mục.";
          }
          mysqli_close($con);
          if ($error !== false) {
        ?>
            <div id="error-notify" class="delete-content">
              <h2>Thông báo</h2>
              <h3><?= $error ?></h3>
              <h3><a href="./menu_listing.php">Danh sách danh mục</a></h3>
            </div>
          <?php } else { ?>
            <div id="success-notify" class="delete-content">
              <h2>Xóa danh mục thành công</h2>
              <h3><a href="./menu_listing.php">Danh sách danh mục</a></h3>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </section>
  <!-- End:Menu_delete -->
<?php
}
include 'footer.php';
?>