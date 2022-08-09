<?php
    include 'config.php';



    // add products to cart
if(isset($_POST['addCart'])){
    $p_id = $_POST['addCart'];
    
    if(isset($_COOKIE['user_cart'])){
        $user_cart = json_decode($_COOKIE['user_cart']);
    }else{
        $user_cart = [];
    }
    if(!in_array($p_id,$user_cart)){
        array_push($user_cart,$p_id);
    }
    
    $cart_count = count($user_cart);
    $u_cart = json_encode($user_cart);

    if(setcookie('user_cart',$u_cart,time() + (1000),'/','','',TRUE)){
        setcookie('cart_count',$cart_count,time() + (1000),'/','','',TRUE);
        echo 'cookie set successfully';
    }else{
        echo 'false';
    }
}

// remove products from cart
if(isset($_POST['removeCartItem'])){
    $p_id = $_POST['removeCartItem'];
    
    if($_COOKIE['cart_count'] == '1'){
        setcookie('cart_count','',time() - (180),'/','','',TRUE);
        setcookie('user_cart','',time() - (180),'/','','',TRUE);
    }else{
        if(isset($_COOKIE['user_cart'])){
            $user_cart = json_decode($_COOKIE['user_cart']);
            if(is_object($user_cart)){
                $user_cart = get_object_vars($user_cart);
            }
            if (($key = array_search($p_id, $user_cart)) !== false) {
                unset($user_cart[$key]);
            }
        }
        $cart_count = count($user_cart);
        $u_cart = json_encode($user_cart);

        if(setcookie('user_cart',$u_cart,time() + (180),'/','','',TRUE)){
            setcookie('cart_count',$cart_count,time() + (180),'/','','',TRUE);
            echo 'cookie set successfully';
        }else{
            echo 'false';
        }
    }
}


// add products in wishlist
if(isset($_POST['addWishlist'])){
    $p_id = $_POST['addWishlist'];
    if(isset($_COOKIE['user_wishlist'])){
        $user_wishlist = json_decode($_COOKIE['user_wishlist']);
    }else{
        $user_wishlist = [];
    }
    if(!in_array($p_id,$user_wishlist)){
        array_push($user_wishlist,$p_id);
    }

    $wishlist_count = count($user_wishlist);
    $u_wishlist = json_encode($user_wishlist);

    if(setcookie('user_wishlist',$u_wishlist,time() + (180),'/','','',TRUE)){
        setcookie('wishlist_count',$wishlist_count,time() + (180),'/','','',TRUE);
        echo 'cookie set successfully';
    }else{
        echo 'false';
    }
}

// remove products from wishlist
if(isset($_POST['removeWishlistItem'])){
    $p_id = $_POST['removeWishlistItem'];
    if($_COOKIE['wishlist_count'] == '1'){
        setcookie('wishlist_count','',time() - (180),'/','','',TRUE);
        setcookie('user_wishlist','',time() - (180),'/','','',TRUE);
    }else{
        if(isset($_COOKIE['user_wishlist'])){
            $user_wishlist = json_decode($_COOKIE['user_wishlist']);
            if(is_object($user_wishlist)){
                $user_wishlist = get_object_vars($user_wishlist);
            }
            if (($key = array_search($p_id, $user_wishlist)) !== false) {
                unset($user_wishlist[$key]);
            }
        }
        $wishlist_count = count($user_wishlist);
        $u_wishlist = json_encode($user_wishlist);

        if(setcookie('user_wishlist',$u_wishlist,time() + (180),'/','','',TRUE)){
            setcookie('wishlist_count',$wishlist_count,time() + (180),'/','','',TRUE);
            echo 'cookie set successfully';
        }else{
            echo 'false';
        }
    }
}

// add products from wishlist to cart

if(isset($_POST['proceedCart'])){
    $p_id = $_POST['proceedCart'];
    if(isset($_COOKIE['user_wishlist'])){
        $user_wishlist = json_decode($_COOKIE['user_wishlist']);
        if(is_object($user_wishlist)){
            $user_wishlist = get_object_vars($user_wishlist);
        }
        if(isset($_COOKIE['user_cart'])){
            $user_cart = json_decode($_COOKIE['user_cart']);
            if(is_object($user_cart)){
                $user_cart = get_object_vars($user_cart);
            }
            array_merge($user_cart,$user_wishlist);
            $user_cart = array_unique($user_cart);

        }else{
            $user_cart= $user_wishlist;
        }

        $u_cart = json_encode($user_cart);
        $cart_count = count($user_cart);

        if(setcookie('user_cart',$u_cart,time() + (180),'/','','',TRUE)){
            setcookie('cart_count',$cart_count,time() + (180),'/','','',TRUE);
            echo 'cookie set successfully';
        }else{
            echo 'false';
        }
    }

}