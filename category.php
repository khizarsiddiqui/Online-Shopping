<head><link rel="shortcut icon" href="images/favicon-icon/24x24.png"></head>
<?php
include 'config.php';

$db = new Database();
$cat = $db->escapeString($_GET['cat']);

$db->select('sub_categories','sub_cat_title',null,"sub_cat_id = '{$cat}'",null,null);
$result = $db->getResult();
if(!empty($result)){ 
    $title = $result[0]['sub_cat_title'].' : Buy '.$result[0]['sub_cat_title'].' at Best Price'; 

}else{ 
    $title = "Result Not Found";
}
$page_head = $result[0]['sub_cat_title'];

?>
<?php include 'header.php'; ?>

    <div class="product-section content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head"><?php echo $page_head; ?></h2>
                </div>
            </div>
            <?php if(!empty($result)){ ?>
            <div class="row">
                <div class="col-md-3 left-sidebar">
                    <h3>Related Brands</h3>
                    <?php
                    $db->select('sub_categories','cat_parent',null,"sub_cat_id = '{$cat}'",null,null);
                    $cat_name = $db->getResult();

                    $db->select('brands','*',null,"brand_cat = '{$cat_name[0]["cat_parent"]}'",null,null);
                    $result2 = $db->getResult();
                    if(count($result2) > 0){ ?>
                        <ul>
                            <?php foreach($result2 as $row2){ ?>
                                <li><a href="brands.php?brand=<?php echo $row2['brand_id']; ?>"><?php echo $row2['brand_title']; ?></a></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
                <div class="col-md-9">
                    <?php
                    $limit = 8;
                    $db->select('products','*',null,"product_sub_cat = '{$cat}' AND product_status = 1 AND qty > 0",null,null);
                    $result3 = $db->getResult();
                    if(count($result3) > 0){
                        foreach($result3 as $row3){ ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="product-grid">
                                    <div class="product-image">
                                        <a class="image" href="single_product.php?pid=<?php echo $row3['product_id']; ?>">
                                            <img class="pic-1" src="product-images/<?php echo $row3['featured_image']; ?>">
                                        </a>
                                        <div class="product-button-group">
                                            <a href="single_product.php?pid=<?php echo $row3['product_id']; ?>" ><i class="fa fa-eye"></i></a>
                                            <a href="" class="add-to-cart" data-id="<?php echo $row3['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a>
                                            <a href="" class="add-to-wishlist" data-id="<?php echo $row3['product_id']; ?>"><i class="fa fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title">
                                            <a href="single_product.php?pid=<?php echo $row3['product_id']; ?>"><?php echo substr($row3['product_title'],0,30),'...'; ?></a>
                                        </h3>
                                        <div class="price"><?php echo $cur_format; ?> <?php echo $row3['product_price']; ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php    }
                    }else{ ?>
                        <div class="empty-result">Result Empty</div>
                <?php } ?>
                <div class="col-md-12 pagination-outer">
                        <?php
                            echo $db->pagination('products',null,"product_sub_cat = '{$cat}' AND product_status = 1 AND qty > 0",$limit);
                        ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

<?php include 'footer.php'; ?>