
<div id ="footer" >
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php
                    $db = new Database();
                    $db->select('options','site_name,footer_text,site_desc,contact_phone,contact_email,contact_address',null,null,null,null);
                    $footer = $db->getResult();  ?>
                <h3><?php echo $footer[0]['site_name']; ?></h3>
                <p><?php echo $footer[0]['site_desc']; ?></p>
            </div>
            <div class="col-md-3">
                <h3>Categories</h3>
                <ul class="menu-list">
                    <?php
                    $db = new Database();
                    $db->select('sub_categories','*',null,'cat_products > 0 AND show_in_footer ="1"',null,null);
                    $result = $db->getResult();
                    if(count($result) > 0){
                        foreach($result as $res){ ?>
                            <li><a href="category.php?cat=<?php echo $res['sub_cat_id']; ?>"><?php echo $res['sub_cat_title']; ?></a></li>
                        <?php    }
                    } ?>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Useful Links</h3>
                <ul class="menu-list">
                    <li><a href="<?php echo $hostname; ?>">Home</a></li>
                    <li><a href="all_products.php">All Products</a></li>
                    <li><a href="latest_products.php">Latest Products</a></li>
                    <li><a href="popular_products.php">Popular Products</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Contact Us</h3>
                <ul class="menu-list">
                    <?php if(!empty($footer[0]['contact_address'])){ ?>
                        <li><i class="fa fa-home" ></i><span>: <?php echo $footer[0]['contact_address']; ?></span></li>
                    <?php } ?>
                    <?php if(!empty($footer[0]['contact_phone'])){ ?>
                        <li><i class="fa fa-phone" ></i><span>: <?php echo $footer[0]['contact_phone']; ?></span></li>
                    <?php } ?>
                    <?php if(!empty($footer[0]['contact_email'])){ ?>
                        <li><i class="fa fa-envelope" ></i><span>: <?php echo $footer[0]['contact_email']; ?></span></li>
                    <?php } ?>
                </ul>
            </div>
                        <div class="col-md-12">
                <span><?php echo $footer[0]['footer_text'] ?> | Created by 
                    <a href="https://www.instagram.com/" target="_blank">Aneel, Shamaiza, Khizar</a></span>
                <hr>
                <h2><strong><center>Follow us on our Social Networks:</center></strong></h2>

      <span class="footer-social-overlap footer-social-icons-wrapper">
      <a href="https://www.pinterest.com/" class="generic-anchor" target="_blank" title="Pinterest" itemprop="significantLink"><i class="fa fa-pinterest"></i></a>
      <a href="https://www.facebook.com/" class="generic-anchor" target="_blank" title="Facebook" itemprop="significantLink"><i class="fa fa-facebook"></i></a>
      <a href="https://twitter.com/" class="generic-anchor" target="_blank" title="Twitter" itemprop="significantLink"><i class="fa fa-twitter"></i></a>
      <a href="http://instagram.com/" class="generic-anchor" target="_blank" title="Instagram" itemprop="significantLink"><i class="fa fa-instagram"></i></a>
      <a href="https://www.youtube.com/" class="generic-anchor" target="_blank" title="Youtube" itemprop="significantLink"><i class="fa fa-youtube"></i></a>
      <a href="https://plus.google.com/" class="generic-anchor" target="_blank" title="Google Plus" itemprop="significantLink"><i class="fa fa-google-plus"></i></a>
      </span>



            </div>
        </div>
    </div>
</div>
<script src="js\jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="js\bootstrap.min.js"></script>
<script src="js\actions.js"></script>
<!--okzoom Plugin-->
<script src="js/okzoom.min.js" type="text/javascript"></script>
<!--owl carousel plugin-->
<script type="text/javascript" src="js/owl.carousel.js"></script>

<script>
    $(document).ready(function(){

        $('#product-img').okzoom({
            width: 200,
            height: 200,
            scaleWidth: 800
        });

        $('.banner-carousel').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            navText : ["",""],
            responsive: {
                0: {
                    items: 1,
                    nav: true

                },
                600: {
                    items: 1,
                    nav: true
                },
                1000: {
                    items: 1,
                    nav: true,
                    loop: false,
                    margin: 10
                }
            }
        });

        $('.popular-carousel').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            navText : ["",""],
            responsive: {
                0: {
                    items: 1,
                    nav: true

                },
                600: {
                    items: 2,
                    nav: true
                },
                800: {
                    items: 4,
                    nav: true
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: false,
                    margin: 10
                }
            }
        });

        $('.latest-carousel').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            navText : ["",""],
            responsive: {
                0: {
                    items: 1,
                    nav: true

                },
                600: {
                    items: 2,
                    nav: true
                },
                800: {
                    items: 3,
                    nav: true
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: false,
                    margin: 5
                }
            }
        });
    });

</script>
<style>
    #footer{
    color: #808080;
    display: block;
    margin: auto;
    background-color: #37474F;
    padding: 30px 0 0;
    background-image: url(https://png.pngitem.com/pimgs/s/561-5615692_footer-graphic-muslim-mirror-footer-graphics-hd-png.png);
}
</style>
</body>
</html>