<?php
session_start();
require("Products.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <?php if (isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item'])) {
        $Sum=0;
        ?>
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Image</th>
                <th>Quality</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($_SESSION['cart_item'] as $key => $value) : ?>
                <tr>
                    <td><?php echo $value['Id'] ?></td>
                    <td><?php echo $value['Name'] ?></td>
                    <td><?php echo $value['image'] ?></td>
                    <td><?php echo $value['quality'] ?></td>
                    <td><?php echo $value['price'] ?></td>
                    <td><?php
                        $total=$value['quality'] * $value['price'];
                        $Sum+=$total;
                         echo number_format($total,0,",",".")." VND"; ?></td>
                    <td>
                        <form action="process.php" method="post" name="Item<?php   echo $value['Id'] ?>">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="Delete_Id" value="<?php echo $value['Id']?>">
                            <input type="submit" class="btn btn-md btn-outline-secondary" value="Xóa">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div>Tổng Hóa Đơn : <strong><?php echo number_format($Sum,0,",",".")." VND"; ?></strong></div>
    <?php } else { ?>
    <?php } ?>

</div>

<div class="container" style="margin-top: 50px">
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-6">
                <form action="process.php" method="post" name="product<?php echo $product['Id'] ?>">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top"
                             data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                             alt="Thumbnail [100%x225]" style="height: 300px; width: 100%; display: block;"
                             src="images/<?php echo $product['image']; ?>" data-holder-rendered="true">
                        <div class="card-body">
                            <h2 class="card-text"><?php echo $product['Name'] ?></h2>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <input type="number" class="btn btn-md btn-outline-secondary" name="quality" min="1"
                                           value="1">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="product_id" value="<?php echo $product['Id'] ?>">
                                    <button type="submit" class="btn btn-md btn-outline-secondary">Thêm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>

