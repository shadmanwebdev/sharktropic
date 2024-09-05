<!-- Bottom Menu -->
<style>
    .bottom-menu {
        margin-top: 50px;
        margin-bottom: 30px;
        max-width: 1400px;
        min-width: 90%;
        margin-left: auto;
        margin-right: auto;
    }
    .bottom-menu .inner-div {
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        border-top: 1px solid rgba(255, 255, 255, .2);
    }
    .bottom-menu ul {
        margin: 0;
        padding: 0;
        display: flex;
        flex-flow: row wrap;
    }
    .bottom-menu ul.list-1 {
        justify-content: flex-start;
    }
    .bottom-menu ul.list-2 {
        justify-content: center;
        display: flex;
        
    }
    .bottom-menu ul.list-2 > li {
        white-space: nowrap;
        margin-left: 10px;
        margin-right: 10px;
    }
    .bottom-menu ul.list-1 > li {
        margin-left: 10px;
        margin-right: 10px;
    }
    .bottom-menu ul > li > a {
        display: block;
        color: #FFFFFF;
        font-size: 15px;
        font-weight: 300;
        padding: 20px 2px 0 2px;
        transition: 0.3s;
        text-transform: uppercase;
    }

    .bottom-menu ul > li.active > a {
        font-weight: 700;
        color: #FEFA6A;
    }

    .li-mobile {
        display: block;
    }
    .li-desktop {
        display: none;
    }
    @media screen and (min-width: 768px) {
        .bottom-menu ul.list-2 > li {
            margin-left: 15px;
            margin-right: 15px;
        }
        .bottom-menu ul.list-1 > li {
            margin-left: 15px;
            margin-right: 15px;
        }
    }
</style>


<div class='bottom-menu'>
    <div class='inner-div'>
        <ul class='list-1'>
            <?php
                // Get the current page name without the extension
                $current_page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

                // Define your menu items (without .php extension)
                $menu_items = [
                    'Home' => '',
                    'Shop' => 'shop',
                    'About' => 'about',
                    'Collections' => 'collections',
                    'News' => 'news',
                    'Mailing list' => 'mailing-list',
                    'My Collection' => 'my-collection',
                ];

                
                // Check if the current page matches any menu item
                foreach ($menu_items as $label => $href) {
                    if ($current_page === $href) {
                        echo '<li class="bm-item li-desktop active"><a href="./">' . $label . '</a></li>';
                    } else {
                        echo '<li class="bm-item li-desktop"><a href="./">' . $label . '</a></li>';
                    }
                    break;
                }
            ?>
        </ul>
        <ul class='list-2'>
            <?php
                
                $n = 0;
                // Check if the current page matches any menu item
                foreach ($menu_items as $label => $href) {
                    if($n > 0 && $n < 6) {
                        if ($current_page === $href) {
                            echo '<li class="bm-item active"><a href="' . $href . '">' . $label . '</a></li>';
                        } else {
                            echo '<li class="bm-item"><a href="' . $href . '">' . $label . '</a></li>';
                        }
                    } else if ($n == 6) {
                        if(isset($_SESSION['user'])) {
                            if ($current_page === $href) {
                                echo '<li class="bm-item li-mobile active"><a href="./">' . $label . '</a></li>';
                            } else {
                                echo '<li class="bm-item li-mobile"><a href="./">' . $label . '</a></li>';
                            }
                        }
                    } else if ($n == 0) {
                        if ($current_page === $href) {
                            echo '<li class="bm-item li-mobile active"><a href="./">' . $label . '</a></li>';
                        } else {
                            echo '<li class="bm-item li-mobile"><a href="./">' . $label . '</a></li>';
                        }
                    }
                    $n += 1;
                }
            ?>
            <!-- <li class="bm-item active"><a href="./shop">Shop</a></li>
            <li class="bm-item"><a href="./about">About</a></li>
            <li class="bm-item"><a href="./collections">Collections</a></li>
            <li class="bm-item"><a href="./news">News</a></li>
            <li class="bm-item"><a href="./mailing-list">Mailing list</a></li> -->
        </ul>
    </div>
</div>