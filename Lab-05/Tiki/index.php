<?php
// ===== CONNECT DATABASE =====
$conn = mysqli_connect("localhost", "root", "", "shop_web_25");

if (!$conn) {
    die("Kết nối database thất bại");
}
?>

<?php include "header.php"; ?>

<div class="container">
<?php
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
?>
    <div class="product">
        <img src="<?= $row['image_url'] ?>" alt="<?= $row['name'] ?>">

        <h3><?= $row['name'] ?></h3>

        <p class="price">
            <?= number_format($row['price']) ?>₫
        </p>

        <p><?= $row['description'] ?></p>
    </div>
<?php } ?>
</div>

<?php
mysqli_close($conn);
include "footer.php";
?>
