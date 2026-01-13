<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Exercise 10</title>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .product {
            width: 30%;
            text-align: center;
            font-family: Arial;
        }
        .product img {
            width: 200px;
        }
        .price {
            font-weight: bold;
        }
        .old-price {
            text-decoration: line-through;
            color: gray;
            font-size: 14px;
        }
        .discount {
            color: red;
            font-weight: bold;
        }

    </style>
</head>
<body>

<?php
$products = [
    [
        "name" => "Máy Ảnh Canon SX730 HS (Hàng Nhập Khẩu)",
        "image" => "https://timhangcongnghe.com/uploads/erp/products/product_image/image_url/21879/canon-power-shot-sx730-hs-01.jpg",
        "price" => "7.690.000 đ",
        "old_price" => "9.370.000 đ",
        "discount" => "-18%"
    ],
    [
        "name" => "Máy Ảnh Canon SX720 HS (Hàng Nhập Khẩu)",
        "image" => "https://rukminim2.flixcart.com/image/480/480/j2hw58w0/point-shoot-camera/h/x/h/powershot-sx720-hs-sx720-hs-canon-original-imaetu5az548cxur.jpeg?q=90",
        "price" => "6.290.000 đ",
        "old_price" => "7.870.000 đ",
        "discount" => "-20%"
    ],
    [
        "name" => "Máy Ảnh Canon SX620 HS (Hàng Nhập Khẩu)",
        "image" => "https://images-na.ssl-images-amazon.com/images/I/61-dKWxEUlL.jpg",
        "price" => "4.890.000 đ",
        "old_price" => "6.240.000 đ",
        "discount" => "-22%"
    ],
    [
        "name" => "Máy Ảnh Canon SX730 HS (Hàng Chính Hãng)",
        "image" => "https://timhangcongnghe.com/uploads/erp/products/product_image/image_url/21879/canon-power-shot-sx730-hs-01.jpg",
        "price" => "9.170.000 đ",
        "old_price" => "10.620.000 đ",
        "discount" => "-14%"
    ],
    [
        "name" => "Máy Ảnh Canon Powershot G3X (Lê Bảo Minh)",
        "image" => "https://s3.cloud.cmctelecom.vn/tinhte1/2015/06/3064056_canon-g3-x-5.jpg",
        "price" => "16.990.000 đ",
        "old_price" => "22.500.000 đ",
        "discount" => "-24%"
    ],
    [
        "name" => "Máy Ảnh Canon G9X Mark II (Hàng Nhập Khẩu)",
        "image" => "https://cdn.nguyenkimmall.com/images/companies/1/may-anh-canon-powershot-g9x.jpg",
        "price" => "9.490.000 đ",
        "old_price" => "11.990.000 đ",
        "discount" => "-21%"
    ]
];
?>

<div class="container">
    <?php foreach ($products as $product) { ?>
        <div class="product">
            <img src="<?= $product['image']; ?>" alt="">
            <p><?= $product['name']; ?></p>
            <span class="price"><?= $product['price']; ?></span>
            <span class="old-price"><?= $product['old_price']; ?></span>
            <span class="discount"><?= $product['discount']; ?></span>
        </div>
    <?php } ?>
</div>

</body>
</html>
