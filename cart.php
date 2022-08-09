<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="images/favicon-icon/24x24.png">
    
</head>
<body>

</body>
</html>
<?php include 'header.php'; ?>

<div class="product-cart-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12 clearfix">
                <h2 class="section-head">My Cart</h2>
                <?php
                    if(isset($_COOKIE['user_cart'])){
                        $pid = json_decode($_COOKIE['user_cart']);
                        if(is_object($pid)){
                            $pid = get_object_vars($pid);
                        }
                        $pids = implode(',',$pid);
                        $db = new Database();
                        $db->select('products','*',null,'product_id IN ('.$pids.')',null,null);
                        $result = $db->getResult();
                        if(count($result) > 0){ ?>
                                <table class="table table-bordered">
                                    <thead>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th width="120px">Product Price</th>
                                    <th width="100px">Qty.</th>
                                    <th width="100px">Sub Total</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                <?php foreach($result as $row){ ?>
                                    <tr class="item-row">
                                        <td><img src="product-images/<?php echo $row['featured_image']; ?>" alt="" width="70px" /></td>
                                        <td><?php echo $row['product_title']; ?></td>
                                        <td><?php echo $cur_format; ?> <span class="product-price"><?php echo $row['product_price']; ?></span></td>
                                        <td>
                                            <input class="form-control item-qty" type="number" value="1" min="1" max="5" onKeyDown="return false" />
                                            <input type="hidden" class="item-id" value="<?php echo $row['product_id']; ?>"/>
                                            <input type="hidden" class="item-price" value="<?php echo $row['product_price']; ?>"/>
                                        </td>
                                        <td><?php echo $cur_format; ?> <span class="sub-total"><?php echo $row['product_price']; ?></span></td>
                                        <td>
                                            <a class="btn btn-sm btn-primary remove-cart-item" href="" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-remove"></i></a>
                                        </td>
                                    </tr>
                        <?php    } ?>
                                    <tr>
                                        <td colspan="5" align="right"><b>TOTAL AMOUNT (<?php echo $cur_format; ?>)</b></td>
                                        <td class="total-amount"></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <a class="btn btn-sm btn-primary" href="http://localhost/Online-shopping/"> Continue Shopping</a>
                                <?php if(isset($_SESSION['user_role'])){ ?>

                            <form action="payment.php" class="checkout-form pull-right" method="POST">
                                    <?php
                                        $product_id = '';
                                        foreach($result as $row){
                                            $product_id .= $row['product_id'].',';
                                        }
                                    ?>
                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <input type="hidden" name="product_total" class="total-price" value="">
                                <input type="hidden" name="product_qty" class="total-qty" value="1">
                        <input type="submit" class="btn btn-md btn-success" value="Proceed to Checkout">
                                </form>

                                <?php }else{ ?>
                                    <a class="btn btn-sm btn-success pull-right" href="#" data-toggle="modal" data-target="#userLogin_form" >Proceed to Checkout</a>
                                <?php } ?>
                <?php   }
                    }else{ ?>
                        <div class="empty-result">
                            Your cart is currently empty.
                        </div>
                    <?php }
                ?>


            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>