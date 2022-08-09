<?php
include 'config.php';

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="images/favicon-icon/24x24.png">
    
</head>
<body>

</body>
</html>
<?php
if($_GET['search'] == ''){
    header("Location: " . $hostname);
}else {
    $db = new Database();
    $db->select('options','site_title',null,null,null,null);
    $result = $db->getResult();
    if(!empty($result)){ 
        $title = $result[0]['site_title']; 
    }else{ 
        $title = "Ravian Clothing";
    }
    include 'header.php';  ?>
    <div class="product-section content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head">Search Results</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 left-sidebar">
                    <?php
                    $db = new Database();
                    $search = $db->escapeString($_GET['search']);
                    $db->sql('SELECT sub_categories.sub_cat_id,sub_categories.sub_cat_title FROM products
                            LEFT JOIN sub_categories ON products.product_cat = sub_categories.cat_parent
                            WHERE products.product_title LIKE "%' . $search . '%"');
                    $result = $db->getResult();  ?>
                    <h3>Related Categories</h3>
                    <ul>
                        <?php if(count($result[0]) > 0){
                            foreach($result[0] as $row){ ?>
                            <li>
                                <a href="category.php?cat=<?php echo $row['sub_cat_id']; ?>"><?php echo $row['sub_cat_title']; ?></a>
                            </li>
                        <?php }
                        } ?>
                    </ul>
                </div>
                <div class="col-md-10">
                    <?php
                    $limit = 8;
                    $db->select('products','*',null,"product_title LIKE '%{$search}%'",null,$limit);
                    $result3 = $db->getResult();
                    if (count($result3) > 0) {
                        foreach($result3 as $row3) {
                            ?>
                            <div class="col-md-3 col-sm-6">
                                <div class="product-grid">
                                    <div class="product-image">
                                        <a class="image" href="single_product.php?pid=<?php echo $row3['product_id']; ?>">
                                            <img class="pic-1"
                                                 src="product-images/<?php echo $row3['featured_image']; ?>">
                                        </a>
                                        <div class="product-button-group">
                                            <a href="single_product.php?pid=<?php echo $row3['product_id']; ?>"><i
                                                    class="fa fa-eye"></i></a>
                                            <a href="" class="add-to-cart"
                                               data-id="<?php echo $row3['product_id']; ?>"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a href="" class="add-to-wishlist"
                                               data-id="<?php echo $row3['product_id']; ?>"><i
                                                    class="fa fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title">
                                            <a href="single_product.php?pid=<?php echo $row3['product_id']; ?>"><?php echo substr($row3['product_title'],0,30).'...'; ?></a>
                                        </h3>
                                        <div class="price"><?php echo $cur_format; ?> <?php echo $row3['product_price']; ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="empty-result">!!! Result Not Found !!!</div>
                    <?php } ?>
                    <div class="pagination-outer">
                        <?php
                        echo $db->pagination('products',null,"product_title LIKE '%{$search}%'",$limit);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php';

} ?>