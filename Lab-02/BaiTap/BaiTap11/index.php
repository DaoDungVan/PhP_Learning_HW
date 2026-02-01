<?php include "header.php"; ?>

<?php
$cameras = [
    ["https://timhangcongnghe.com/uploads/erp/products/product_image/image_url/21879/canon-power-shot-sx730-hs-01.jpg",
    "Canon SX730 HS Nhập Khẩu", "7.690.000 đ", "9.370.000 đ","-18%"],
    ["https://rukminim2.flixcart.com/image/480/480/j2hw58w0/point-shoot-camera/h/x/h/powershot-sx720-hs-sx720-hs-canon-original-imaetu5az548cxur.jpeg?q=90",
    "Canon SX720 HS", "6.290.000 đ", "7.870.000 đ","-20%"],
    ["https://images-na.ssl-images-amazon.com/images/I/61-dKWxEUlL.jpg",
    "Canon SX620 HS", "4.890.000 đ", "6.240.000 đ","-22%"],
    ["https://timhangcongnghe.com/uploads/erp/products/product_image/image_url/21879/canon-power-shot-sx730-hs-01.jpg",
    "Canon SX730 HS Chính Hãng", "9.170.000 đ", "10.620.000 đ","-14%"],
    ["https://s3.cloud.cmctelecom.vn/tinhte1/2015/06/3064056_canon-g3-x-5.jpg",
    "Canon Powershot G3X", "16.990.000 đ", "22.500.000 đ","-24%"],
    ["https://cdn.nguyenkimmall.com/images/companies/1/may-anh-canon-powershot-g9x.jpg",
    "Canon G9X Mark II", "9.490.000 đ", "11.990.000 đ","-21%"]
];
?>

<div class="container">
    <?php for ($i = 0; $i < count($cameras); $i++) { ?>
        <div class="product">
            <img src=<?= $cameras[$i][0]; ?> alt="">
            <p><?= $cameras[$i][1]; ?></p>
            <span class="price"><?= $cameras[$i][2]; ?></span>
            <span class="old-price"><?= $cameras[$i][3]; ?></span>
            <span class="discount"><?= $cameras[$i][4]; ?></span>
        </div>
    <?php } ?>
</div>

<?php include "footer.php"; ?>
