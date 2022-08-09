<head><link rel="shortcut icon" href="images/favicon-icon/24x24.png"></head>

<?php include 'config.php';  //config file
$p_id = $_GET['pid'];
$db = new Database();
$db->sql("UPDATE products SET product_views=product_views+1 WHERE product_id=".$p_id);
$res = $db->getResult();
$db->select('products','*',null,"product_id= '{$p_id}'",null,null);
$single_product = $db->getResult();
if(count($single_product) > 0){ 
    $title = $single_product[0]['product_title'];   //set dynamic header
    // include header
    include 'header.php'; ?>
    <head><link rel="shortcut icon" href="images/favicon-icon/24x24.png"></head>

<div class="single-product-container">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-5 col-md-7">
                <?php
                $db = new Database();
                $db->select('sub_categories','*',null,"sub_cat_id='{$single_product[0]['product_sub_cat']}'",null,null);
                $category = $db->getResult();
                ?>
                <ol class="breadcrumb">
                    <li><a href="<?php echo $hostname; ?>">Home</a></li>
                    <li><a href="category.php?cat=<?php echo $category[0]['sub_cat_id']; ?>"><?php echo $category[0]['sub_cat_title']; ?></a></li>
                    <li class="active"><?php echo substr($title,0,30).'.....'; ?></li>
                </ol>
            </div> 
        </div>
        <div class="row">
        <?php foreach($single_product as $row){ ?>
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <div class="product-image">
                        <img id="product-img" src="product-images/<?php echo $row['featured_image'] ?>" alt=""/>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="product-content">
                        <h3 class="title"><?php echo $row['product_title']; ?></h3>
                        <span class="price"><?php echo $cur_format; ?>  <?php echo $row['product_price']; ?></span>
                        <p class="description"><?php echo html_entity_decode($row['product_desc']); ?></p>
                        <a class="add-to-cart" data-id="<?php echo $row['product_id']; ?>" href="">Add to cart</a>
                        <a class="add-to-wishlist" data-id="<?php echo $row['product_id']; ?>" href="">Add to Wislist</a>
                    </div>
                </div>
                <div class="col-md-2"></div>
    <?php   } ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; 
}else{
    echo 'Page Not Found';

}
?>