<?php
/*
=================================================================
    cURL
    CRUD (create, read, update, delete) 
    GET PRODUCT
    CREATE PRODUCT
    UPDATE PRODUCT
    
    DISPLAY

    COLORS
    SIZES
    CATEGORIES
    SUBCATEGORIES
    STOCK
    
    FORM
    CART
    PAYMENT
=================================================================  
*/


namespace MyApp\Classes;

class Product extends Db {
    public $con;
    public function __construct() {
        $this->con = $this->con();
    }
    public function startSession() {
        ob_start();
        session_start();
    }
    public function endSession() {
        session_unset();
        session_destroy();
    }
    function product_count() {
        $sql = "SELECT COUNT(*) AS product_count FROM products";

        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $product_count = $row['product_count'];

        return $product_count;
    }
    public function image_exists($product_id, $image_filename_sm) {
        $stmt = $this->con->prepare("SELECT * FROM product_images WHERE product_id=? AND image_filename_sm=? LIMIT 1");
        $stmt->bind_param('is', $product_id, $image_filename_sm);
        $stmt->execute();        
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if(isset($data)) {
            if(count($data) > 0) {
                $status = '1';
            } else {
                $status = '0';
            }
        } else {
            $status = '0';
        }
        return $status;
    }
    /*
    =================================================================
        CRUD (create, read, update, delete)
    =================================================================  
    */
    public function create_product() {
        $category_id = 1;
        $title =  $_POST['title'];
        $description =  $_POST['description'];
        $sale_price = $_POST['price'];
        $regular_price = floatval($_POST['price']) + 20;
        $created_at = datetime_now();
        $size = $_POST['size'];

        
        $stmt = $this->con->prepare('INSERT INTO products (category_id, title, description, regular_price, sale_price, size, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('issssss', $category_id, $title, $description, $regular_price, $sale_price, $size, $created_at);
        
        if($stmt->execute()) {   
            $status = '1';

            $product_id = $stmt->insert_id;

            $uploads = json_decode($_SESSION['uploads'], true);

            foreach($uploads as $img_filename) {
                $image_filename_sm = $img_filename;
                $image_filename_md = $img_filename;
                $image_filename_lg = $img_filename;

                $stmtImg = $this->con->prepare("INSERT INTO product_images (product_id, image_filename_sm, image_filename_md, image_filename_lg, created_at) VALUES (?, ?, ?, ?, ?)");
                $stmtImg->bind_param("issss", $product_id, $image_filename_sm, $image_filename_md, $image_filename_lg, $created_at);
                $stmtImg->execute();
                $stmtImg->close();
            }




            // Create Stock
            $quantity = $_POST['stock'];
            
            $stmtStock = $this->con->prepare('INSERT INTO product_stocks (product_id, quantity, created_at) VALUES (?, ?, ?)');
            $stmtStock->bind_param('iis', $product_id, $quantity, $created_at);
            if($stmtStock->execute()) {   
                $status = '1';
            } else {
                $status = '0';
            }
            $stmtStock->close();
            
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();

        // Created News array
        if($product_id) {
            $product_array = $this->get_product($product_id);
        } else {
            $product_array = array();
        }
        
        // Json Response
        $create_response = json_encode(array (
            'status' => $status,
            'product_array' => $product_array
        ), true);

        echo $create_response;

    }
    public function update_product($id) {
        /*  
            Update Product
            1. Update the product item
            2. Insert new images
            3. Update stock
        */
        $title =  $_POST['title'];
        $description =  $_POST['description'];
        $sale_price = $_POST['price'];
        $regular_price = floatval($_POST['price']) + 20;
        $size = $_POST['size'];
        $updated_at = datetime_now();
        $quantity = $_POST['stock'];

        // Update Product
        $stmt = $this->con->prepare("UPDATE products SET  title=?, description=?, sale_price=?, regular_price=?, size=?, updated_at=? WHERE id=?");
        $stmt->bind_param('ssssssi', $title, $description, $sale_price, $regular_price, $size, $updated_at, $id);
        if($stmt->execute()) {   
            $status = '1';

            if(isset($_SESSION['uploads'])) {
                $uploads = json_decode($_SESSION['uploads'], true);
                
                if(count($uploads) > 0) {
                    foreach($uploads as $img_filename) {
                        $image_filename_sm = $img_filename;
                        $image_filename_md = $img_filename;
                        $image_filename_lg = $img_filename;
        
                        $stmtImg = $this->con->prepare("INSERT INTO product_images (product_id, image_filename_sm, image_filename_md, image_filename_lg, created_at) VALUES (?, ?, ?, ?, ?)");
                        $stmtImg->bind_param("issss", $id, $image_filename_sm, $image_filename_md, $image_filename_lg, $created_at);
                        $stmtImg->execute();
                        $stmtImg->close();
                    }
                }
            }
            


            // Create Stock
            $quantity = $_POST['stock'];
            
            $stmtStock = $this->con->prepare('UPDATE product_stocks SET quantity=?, updated_at=? WHERE product_id=?');
            $stmtStock->bind_param('isi', $quantity, $updated_at, $id);
            if($stmtStock->execute()) {   
                $status = '1';
            } else {
                $status = '0';
            }
            $stmtStock->close();



        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();

            
        // Check if the product_id exists in product_stocks
        $stmtCheck = $this->con->prepare('SELECT COUNT(*) FROM product_stocks WHERE product_id=?');
        $stmtCheck->bind_param('i', $id);
        $stmtCheck->execute();
        $stmtCheck->bind_result($count);
        $stmtCheck->fetch();
        $stmtCheck->close();

        if ($count > 0) {
            // Update Stock
            $stmtStock = $this->con->prepare('UPDATE product_stocks SET quantity=?, updated_at=? WHERE product_id=?');
            $stmtStock->bind_param('isi', $quantity, $updated_at, $id);
            if ($stmtStock->execute()) {
                $status = '1';
            } else {
                $status = '0';
            }
            $stmtStock->close();
        } else {
            // Create stock
            $stmtStock = $this->con->prepare('INSERT INTO product_stocks (product_id, quantity, created_at) VALUES (?, ?, ?)');
            $stmtStock->bind_param('iis', $id, $quantity, $created_at);
            if ($stmtStock->execute()) {
                $status = '1';
            } else {
                $status = '0';
            }
            $stmtStock->close();
        }
        echo $status;
    }
    public function delete_product($id) {
        // Delete `product`
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        if($stmt->execute()) {
            $stmt->close();
            $status = '1';
        } else {
            $status = '0';
        }

        // Delete `product_images` row
        if($status == '1') {
            $sql = "DELETE FROM product_images WHERE product_id = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("i", $id);
            if($stmt->execute()) {
                $stmt->close();
                $status = '1';
            } else {
                $status = '0';
            }
        }


        // Delete `product_stocks` row
        if($status == '1') {
            $sql = "DELETE FROM product_stocks WHERE product_id = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("i", $id);
            if($stmt->execute()) {
                $stmt->close();
                $status = '1';
            } else {
                $status = '0';
            }
        }

        
        // Delete `products_sold` row
        if($status == '1') {
            $sql = "DELETE FROM products_sold WHERE product_id = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("i", $id);
            if($stmt->execute()) {
                $stmt->close();
                $status = '1';
            } else {
                $status = '0';
            }
        }

        echo $status;
    }
    public function get_products() {
        $sql = "SELECT 
            p.id AS product_id,
            p.title,
            p.description,
            p.regular_price,
            p.sale_price,
            p.size,
            p.created_at AS product_created_at,
            c.id AS category_id,
            c.name AS category_name,
            i.id AS image_id,
            i.image_filename_sm,
            i.image_filename_md,
            i.image_filename_lg,
            s.quantity AS stock_quantity,
            ps.quantity AS quantity_sold
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        LEFT JOIN product_images i ON p.id = i.product_id
        LEFT JOIN product_stocks s ON p.id = s.product_id
        LEFT JOIN products_sold ps ON p.id = ps.product_id";
        
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Initialize an array to store product data and associated details
        $data = array();
        while ($row = $result->fetch_assoc()) {
            // Product Id
            $product_id = $row['product_id'];
    
            // Initialize the product array if not already created
            if (!isset($data[$product_id])) {
                $data[$product_id] = array(
                    'id' => $product_id,
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'regular_price' => $row['regular_price'],
                    'sale_price' => $row['sale_price'],
                    'size' => $row['size'],
                    'created_at' => $row['product_created_at'],
                    'category' => array(
                        'id' => $row['category_id'],
                        'name' => $row['category_name']
                    ),
                    'images' => array(),
                    'stocks' => array(),
                    'sold' => array()
                );
            }
    
            // Store images associated with the product
            if($row['image_id']) {
                $data[$product_id]['images'][] = array(
                    'id' => $row['image_id'],
                    'image_filename_sm' => $row['image_filename_sm'],
                    'image_filename_md' => $row['image_filename_md'],
                    'image_filename_lg' => $row['image_filename_lg']
                );
            }
    
            // Store stock information associated with the product
            $data[$product_id]['stocks'][] = array(
                'quantity' => $row['stock_quantity']
            );
    
            // Store sold quantities associated with the product
            $data[$product_id]['sold'][] = array(
                'quantity' => $row['quantity_sold']
            );
        }
        $stmt->close();
    
        return $data;
    }
    
    
    public function get_product($product_id) {
        $sql = "SELECT 
            p.id AS product_id,
            p.title,
            p.description,
            p.regular_price,
            p.sale_price,
            p.size,
            p.created_at AS product_created_at,
            c.id AS category_id,
            c.name AS category_name,
            i.id AS image_id,
            i.image_filename_sm,
            i.image_filename_md,
            i.image_filename_lg,
            s.quantity AS stock_quantity,
            ps.quantity AS quantity_sold
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        LEFT JOIN product_images i ON p.id = i.product_id
        LEFT JOIN product_stocks s ON p.id = s.product_id
        LEFT JOIN products_sold ps ON p.id = ps.product_id
        WHERE p.id = ?";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Initialize an array to store product data and associated details
        $data = array();
        while ($row = $result->fetch_assoc()) {
            // Product Id
            $product_id = $row['product_id'];
    
            // Initialize the product array if not already created
            if (!isset($data[$product_id])) {
                $data[$product_id] = array(
                    'id' => $product_id,
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'regular_price' => $row['regular_price'],
                    'sale_price' => $row['sale_price'],
                    'size' => $row['size'],
                    'created_at' => $row['product_created_at'],
                    'category' => array(
                        'id' => $row['category_id'],
                        'name' => $row['category_name']
                    ),
                    'images' => array(),
                    'stocks' => array(),
                    'sold' => array()
                );
            }
    
            // Store images associated with the product
            if($row['image_id']) {
                $data[$product_id]['images'][] = array(
                    'id' => $row['image_id'],
                    'image_filename_sm' => $row['image_filename_sm'],
                    'image_filename_md' => $row['image_filename_md'],
                    'image_filename_lg' => $row['image_filename_lg']
                );
            }
            
            // Store stock information associated with the product
            $data[$product_id]['stocks'][] = array(
                'quantity' => $row['stock_quantity']
            );

            // Store sold quantities associated with the product
            $data[$product_id]['sold'][] = array(
                'quantity' => $row['quantity_sold']
            );
        }
        $stmt->close();
    
        return $data[$product_id];
    }


    public function delete_product_image($product_id, $image_filename) {
        // var_dump($product_id, $image_filename);
        $stmt = $this->con->prepare("DELETE FROM product_images WHERE product_id=? AND image_filename_sm=?");
        $stmt->bind_param('is', $product_id, $image_filename);
        $stmt->execute();
        $stmt->close();
    }



    public function create_category() {
        $name = $_POST['name'];
        $created_at = datetime_now();
        
        $stmt = $this->con->prepare("INSERT INTO categories (name, created_at) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $created_at);
        
        if($stmt->execute()) {   
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
        echo $status;
    }
    public function update_category($id) {
        $name = $_POST['name'];
        $updated_at = datetime_now();
        
        $stmt = $this->con->prepare("UPDATE categories SET name=?, updated_at=? WHERE id=?");
        $stmt->bind_param('ssi', $name, $updated_at, $id);
        if($stmt->execute()) {   
            $status = '1';
        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
        echo $status;
    }
    public function products() {
        $products = $this->get_products();

        $pdtsStr = "";
        foreach ($products as $product) {
            $id = $product['id'];
            $images = $product['images'];
    
            $sale_price = "$".$product['sale_price'];
            $regular_price = "$".$product['regular_price'];
            $description = paragraphs($product['description']);
    
            // foreach ($images as $image) {
            //     $img_small = $image['image_filename_sm'];
            //     $img_medium = $image['image_filename_md'];
            //     $img_large = $image['image_filename_lg'];
            // }

            $image_count = count($images);
            if($image_count > 0) {
                $i = $image_count - 1;
                $img_medium = $images[$i]['image_filename_md'];

                $image_dir = "./admin/uploads/$img_medium";
            } else  {
                $image_dir = "./assets/placeholder.png";
            }

            
            $pdtsStr .= "<a class='product' href='./product?pid=$id'>
                <div class='product-inner-div'>
                    <div class='image'>
                        <img src='$image_dir' alt=''>
                    </div>
                    <div class='product-meta'>
                        <img src='assets/logo-small.svg' alt=''>
                        <h4>Shirt #{$id} Long</h4>
                        <p>$sale_price</p>
                    </div>
                </div>
            </a>";
        }

        echo $pdtsStr;
    }
    public function collection() {
        $products = $this->get_products();
 
        $num_of_rows = count($products);
        $results_per_page = 24;

        $num_of_sections = ceil($num_of_rows / $results_per_page);

        $pdtsStr = "";

        $cur_pdt_num = 1;
        foreach ($products as $product) {
            $id = $product['id'];
            $images = $product['images'];
    
            $sale_price = "$".$product['sale_price'];
            $regular_price = "$".$product['regular_price'];
            $description = paragraphs($product['description']);
    


            $img_small = $images[0]['image_filename_sm'];
            $img_medium = $images[0]['image_filename_md'];


            if($cur_pdt_num == 1) {
                $pdtsStr .= "<div class='collection-section' data-num='1/$num_of_sections'>
                <script defer>
                    $('.section-num').text(\"1/$num_of_sections\");
                </script>";
            } else if(is_int(($cur_pdt_num - 1) / $results_per_page) || ($cur_pdt_num - 1) == $num_of_rows) {
                $sections_passed = floor($cur_pdt_num / $results_per_page);

                $cur_section_num = $sections_passed + 1;

                $pdtsStr .= "<div class='collection-section' data-num='$cur_section_num/$num_of_sections'>";
            
            }




            $pdtsStr .= "<a class='product' href='./product?pid=$id'>
                <div class='c-item'>
                    <div class='thumbnail'>
                        <img src='./admin/uploads/$img_small' alt='Thumbnail'>
                        <p>{$product['title']}</p>
                    </div>
                    <div class='title'>
                        <p>{$product['title']}</p>
                    </div>
                </div>
            </a>";

            if(is_int($cur_pdt_num / $results_per_page) || $cur_pdt_num == $num_of_rows) {
                $pdtsStr .= "</div>";
            } 

            $cur_pdt_num++;
        }

        echo $pdtsStr;
    }
    public function product($product_id) {
        $product = $this->get_product($product_id);
        $images = $product['images'];

        $sale_price = "$".$product['sale_price'];
        $regular_price = "$".$product['regular_price'];
        $description = paragraphs($product['description']);


        // Images
        $imgStr = "";
        if(count($images) > 0) {
            foreach ($images as $image) {
                $img_small = $image['image_filename_sm'];
                $img_large = $image['image_filename_md'];
                $img_medium = $image['image_filename_lg'];
                
                $imgStr .= "<div class='item-slick3' data-thumb='./admin/uploads/$img_small'>
                    <div class='pic-wrap pos-relative'>
                        <img src='./admin/uploads/$img_medium' alt='IMG-PRODUCT'>
                        <a class='expand-arrow' href='./admin/uploads/$img_large'>
                            <i class='fa fa-expand'></i>
                        </a>
                    </div>
                </div>";
            }
        }
        
        // Sizes
        $product_sizes = json_decode($product['size'], true);
        $sizesStr = "";
        if(count($product_sizes) > 0) {
            foreach($product_sizes as $size) {
                $sizesStr .= "<span style='text-transform: uppercase;' class='size-option $size' data-key='$size' data-value='$size' onclick='select_size(\"$size\")'>$size</span>";
            }
        }

        $merchStr = "<div class='row' style='color: #fff;'>
            <div class='product-images col-md-6 col-lg-6'>
                <div class='p-l-25 p-r-30 p-lr-0-lg'>
                    <div class='wrap-slick3 flex-sb flex-w'>
                        <div class='wrap-slick3-dots'></div>
                        <div class='wrap-slick3-arrows flex-sb-m flex-w'></div>

                        <div class='slick3 gallery-lb'>
                            $imgStr
                        </div>
                    </div>
                </div>
            </div>
            <form action='' class='product-form col-md-6 col-lg-6' method='post' id=\"order-{$product['id']}\">

                <div class='p-r-50 p-t-5 p-lr-0-lg'>
                    <p class='pdt-sold'>
                        In Stock {$product['stocks'][0]['quantity']} products & Sold {$product['sold'][0]['quantity']} Products
                    </p>
                    <h2 class='pdt-name'>
                        {$product['title']}
                    </h2>
                    <p class='pdt-serial'>
                        Serial Number #{$product['id']}
                    </p>


                    <div class='pdt-text'>
                        $description
                        <p>USD(incl. of all taxes)</p>
                    </div>


                    <span class='pdt-price'>
                        <span class='sale-price'>
                            $sale_price
                        </span>
                        <span class='regular-price'>
                            $regular_price
                        </span>
                    </span>

                    <div class='sizes size-wrapper'>
                        <div class='sizes-label'>Size</div>
                        <div class='size-options'>
                            $sizesStr
                        </div>
                        <div id='size-error' class='error-text'></div>
                    </div>

                    
                    <input type='hidden' name='add_to_cart' id='add_to_cart' value='true'>
                    <input type='hidden' name='id' id='id' value=\"{$product['id']}\">
                    <input type='hidden' name='size' id='size' value=\"M\">
                    


                    
                    <div class='btns-group-bottom'>
                        <div class='wrap-num-product'>
                            <div class='btn-num-product-down'>
                                <svg width='16' height='16' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                <g clip-path='url(#clip0_8006_1357)'>
                                <path d='M5 12H19' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                                </g>
                                <defs>
                                <clipPath id='clip0_8006_1357'>
                                <rect width='24' height='24' fill='white'/>
                                </clipPath>
                                </defs>
                                </svg>
                            </div>

                            <input class='mtext-104 cl3 txt-center num-product' type='number' id='pdt-qty' name='qty' value='1'>

                            <div class='btn-num-product-up'>
                                <svg width='16' height='16' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                <g clip-path='url(#clip0_8006_1360)'>
                                <path d='M12 5V19' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                                <path d='M5 12H19' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                                </g>
                                <defs>
                                <clipPath id='clip0_8006_1360'>
                                <rect width='24' height='24' fill='white'/>
                                </clipPath>
                                </defs>
                                </svg>
                            </div>
                        </div>

                        <div class='btns'>
                            <span class='add-to-cart-btn btn-default btn-1' onclick='add_to_cart(event, \"{$product['id']}\")'>
                                Add to cart
                            </span>
                            <span class='buy-now-btn btn-default btn-1' onclick='buy_now(event, \"{$product['id']}\")'>
                                Buy Now
                            </span>
                        </div>
                    </div>

                    
                </div>
            </form>
        </div>";


        // Review tab goes here

        echo $merchStr;
    }


    function products_table_header($isIndex=false) {
        if($isIndex == false) {
            return "<div class='content'>
            <div class='header'>
                <div class='item'>Name</div>
                <div class='item'>Price</div>
                <div class='item'>Size</div>
                <div class='item'>Edit</div>
            </div>
            <div class='body'>
                <div class='rows'>";
        } else {
            return "<div class='content'>
                <div class='header'>
                    <div class='item'>Name</div>
                    <div class='item'>Price</div>
                    <div class='item'>Order</div>
                    <div class='item'>Total</div>
                    <div class='item'>Edit</div>
                </div>
                <div class='body'>
                    <div class='rows'>";
        }
    }
    function products_table_footer() {
        return "</div>
            </div>
        </div>";
    }
    function products_row_html($product_array, $isIndex = false) {
        $img_sm = $product_array['images'][0]['image_filename_sm'];

        $sizes = json_decode($product_array['size'], true);

        $sizesStr = "";
        $num_of_sizes = count($sizes);
        $s = 1;
        foreach($sizes as $size) {
            $sizesStr .= $size;
            if($num_of_sizes > $s) {
                $sizesStr .= ', ';
            }
            $s += 1;
        }

        if($isIndex == false) {
            return "<div class='c-row' id='product-id-{$product_array['id']}'>
                <div class='item'>
                    <div class='thumbnail'>
                        <img src='./uploads/{$img_sm}' alt=''>
                    </div>
                    <span>{$product_array['title']}</span>
                </div>
                <div class='item'>$".$product_array['sale_price']."</div>
                <div class='item' style='text-transform: uppercase;'>$sizesStr</div>
                
                <div class='item' onclick='get_popup_content_product(\"{$product_array['id']}\")'>
                    <img src='./assets/edit.svg' alt=''>
                </div>
            </div>";
        } else {
            return "<div class='c-row' id='product-id-{$product_array['id']}'>
                <div class='item'>
                    <div class='thumbnail'>
                        <img src='./uploads/{$img_sm}' alt=''>
                    </div>
                    <span>{$product_array['title']}</span>
                </div>
                <div class='item'>$".$product_array['sale_price']."</div>
                <div class='item'>50</div>
                <div class='item'>$6.492.44</div>
                <div class='item' onclick='get_popup_content_product(\"{$product_array['id']}\")'>
                    <img src='./assets/edit.svg' alt=''>
                </div>
            </div>";

        }
    }

    public function products_admin($isIndex = false) {
        // Get page name
        $pagename = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME);
    
        // Get array of arrays
        $products_array = $this->get_products();

        // var_dump($products_array);
    
        $num_of_rows = count($products_array);
    
        $results_per_page = 80;
    
        // Number of total pages available
        $num_of_pages = ceil($num_of_rows / $results_per_page);
    
        // Determine which page product is currently on
        $page = isset($_GET['page']) ? ($_GET['page'] == 0 ? 1 : intval($_GET['page'])) : 1;
    
        $starting_limit_number = ($page - 1) * $results_per_page;
    
        $contentStr = "";
        $contentStr .= $this->products_table_header();
        foreach(array_slice($products_array, $starting_limit_number, $results_per_page) as $key => $value) {
            $product_array = $value;
            $contentStr .= $this->products_row_html($product_array);
        }
        $contentStr .= $this->products_table_footer();
    
        // // Previous & next page
        // $prev = ($page == 1) ? $page : ($page - 1);
        // $next = ($page == $num_of_pages) ? $page : ($page + 1);
    
        // $paging = "<div class='pagination'>
        //     <div>
        //         <a class='page-num arrow' href='./$pagename?page=" . ($page > 1 ? ($page - 1) : 1) . "'>
        //             <i class='fas fa-arrow-left'></i>
        //         </a>
        //     </div>
        //     <div class='pagination-links'>";
    
        // // Show links only if there is more than one page
        // if ($num_of_pages > 1) {
        //     // Show the current page and links for next 2 pages
        //     for ($p = $page; $p <= min($num_of_pages, $page + 2); $p++) {
        //         if ($p != $page) {
        //             $paging .= "<a class='page-num' href='./$pagename?page=" . $p . "'>" . $p . "</a> ";
        //         } else {
        //             $paging .= "<a class='page-num current-page' href='./$pagename?page=" . $p . "'>" . $p . "</a> ";
        //         }
        //     }
        //     // Skip links for 2 pages
        //     if ($page + 5 < $num_of_pages) {
        //         $paging .= "<span>...</span> ";
        //     }
        //     // Show the link for the 6th page if available
        //     if ($page + 4 < $num_of_pages) {
        //         $paging .= "<a class='page-num' href='./$pagename?page=" . ($page + 4) . "'>" . ($page + 4) . "</a> ";
        //     } else if ($page + 3 < $num_of_pages) {
        //         $paging .= "<a class='page-num' href='./$pagename?page=" . ($page + 3) . "'>" . ($page + 3) . "</a> ";
        //     }
        // } else {
        //     // If there's only one page, show the link for the current page and previous/next page links
        //     $paging .= "<a class='page-num current-page' href='./$pagename?page=" . $page . "'>" . $page . "</a> ";
        // }
    
        // $paging .= "</div>
        //     <div>
        //         <a class='page-num arrow arrow-right' href='./$pagename?page=" . ($page < $num_of_pages ? ($page + 1) : $num_of_pages) . "'>
        //             <i class='fas fa-arrow-right'></i>
        //         </a>
        //     </div>
        // </div>";
    
        // $contentStr .= $paging;


        echo $contentStr;
    }
    public function edit_product_form($id) {
        $product = $this->get_product($id);
        
        $product_sizes = json_decode($product['size'], true);

        $sizes = ['s', 'm', 'l', 'xl', 'xxl'];

        $sizesStr = "";
        foreach($sizes as $size) {
            if(in_array($size, $product_sizes)) {
                $sizesStr .= "<span style='text-transform: uppercase;' class='size-option selected $size' data-key='$size' data-value='$size' onclick='select_size(\"$size\")'>$size</span>";
            } else {
                $sizesStr .= "<span style='text-transform: uppercase;' class='size-option $size' data-key='$size' data-value='$size' onclick='select_size(\"$size\")'>$size</span>";
            }

        }

        $imagesStr = "";

        $uploads = array();

        if(count($product['images']) > 0) {
            // var_dump($product['images']);
            foreach($product['images'] as $image) {
                $image_filename_sm = $image['image_filename_sm'];
                $image_dir = "uploads/{$image_filename_sm}";
    
                $imagesStr .= "<div class='img-container'>
                    <img src='$image_dir'>
                    <span onclick='delete_old_image(this, $id, \"$image_dir\")' class='remove-icon'>&times;</span>
                </div>";
    
                
                array_push($uploads, basename($image_filename_sm));
            }
        }

        
        if(isset($_SESSION['old_uploads'])) {
            unset($_SESSION['old_uploads']);
        }
        $_SESSION['old_uploads'] = json_encode($uploads, true);

        $contentStr = "<div id='bookingPopupInner' class='edit-product-popup'>   
            <input type='hidden' name='type' id='type' value='product'>
            <input type='hidden' name='product_id' id='product_id' value='$id'>
            <div id='cross' onclick='closePopup()'>
                <img src='assets/cross.svg' alt=''>
            </div>
            <div>
                <div id='popup-heading'>
                    Drop Products
                </div>
                <form action='' class='popup-form scrollable-div-y' id='popup-form'>
                    
                    <div class='row' id='row-1'>
                        <div class='coluumn' id='column-1'>


                            <div class='upload-area' id='uploadfile'>
                                <div class='upload-area-inner'>
                                    <div class='upload-icon'>
                                        <img src='assets/upload.svg' alt=''>
                                    </div>
                                    <div class='select-text'>
                                        Drag and Drop file here or 
                                        <span id='fileElem'>Choose File</span>
                                    </div>
                                </div>
                            </div>

                            <div class='uploaded-images' id='uploadedImages'>
                                $imagesStr
                            </div>

                            <input type='file' id='fileInput' style='display: none;'>



                            <div class='sizes size-wrapper'>
                                <div class='sizes-label'>Size</div>
                                <div class='size-options'>
                                    $sizesStr
                                </div>
                                <div id='size-error' class='error-text'></div>
                            </div>

                        </div>
                        <div class='coluumn' id='column-2'>
                            <div class='input-wrapper' id='name-wrapper'>
                                <label for='title'>Title<span class='required'>*</span></label>
                                <input value='{$product['title']}' name='name' id='title-field' type='name' class='input-field' placeholder='Type here'>
                                <div id='title-error' class='error-text'></div>
                            </div>
                            <div class='input-wrapper' id='description-wrapper'>
                                <label for='description'>Description</label>
                                <textarea name='description' rows='5' id='description-field' type='name' class='textarea-field' placeholder='Type here'>{$product['description']}</textarea>
                                <div id='description-error' class='error-text'></div>
                            </div>
                            <div class='input-row'>
                                <div class='input-wrapper' id='price-wrapper'>
                                    <label for='price'>Price</label>
                                    <input value='{$product['sale_price']}' name='price' id='price-field' type='text' class='input-field' placeholder='Type here'>
                                    <div id='price-error' class='error-text'></div>
                                </div>
                                <div class='input-wrapper' id='stock-wrapper'>
                                    <label for='stock'>In Stock</label>
                                    <input value='{$product['stocks'][0]['quantity']}' name='stock' id='stock-field' type='number' class='input-field' placeholder='Type here'>
                                    <div id='stock-error' class='error-text'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='row' id='row-2'>
                
                        <span class='btns'>
                            <span class='btn admin-btn-2' onclick='closePopup()'>
                                Cancel
                            </span>
                            <span class='btn admin-btn-1' onclick='update_product(event)'>
                                Save
                            </span>
                        </span>
                
                    </div>
                    <div class='row' id='row-3'>
                        <!-- Response -->
                        <div class='message-response' id='message-response-1'></div>
                    </div>
                </form>

            </div>
        </div>";

        echo $contentStr;
    }

    /*
    =================================================================
        SEARCH
    =================================================================  
    */
    public function get_searched_products($search) {
        $sql = "SELECT 
            p.id AS product_id,
            p.title,
            p.description,
            p.regular_price,
            p.sale_price,
            p.size,
            p.created_at AS product_created_at,
            c.id AS category_id,
            c.name AS category_name,
            i.id AS image_id,
            i.image_filename_sm,
            i.image_filename_md,
            i.image_filename_lg,
            s.quantity AS stock_quantity,
            ps.quantity AS quantity_sold
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        LEFT JOIN product_images i ON p.id = i.product_id
        LEFT JOIN product_stocks s ON p.id = s.product_id
        LEFT JOIN products_sold ps ON p.id = ps.product_id";
        
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Initialize an array to store product data and associated details
        $data = array();
        while ($row = $result->fetch_assoc()) {
            // Product Id
            $product_id = $row['product_id'];
    
            // Initialize the product array if not already created
            if (!isset($data[$product_id])) {
                $data[$product_id] = array(
                    'id' => $product_id,
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'regular_price' => $row['regular_price'],
                    'sale_price' => $row['sale_price'],
                    'size' => $row['size'],
                    'created_at' => $row['product_created_at'],
                    'category' => array(
                        'id' => $row['category_id'],
                        'name' => $row['category_name']
                    ),
                    'images' => array(),
                    'stocks' => array(),
                    'sold' => array()
                );
            }
    
            // Store images associated with the product
            if($row['image_id']) {
                $data[$product_id]['images'][] = array(
                    'id' => $row['image_id'],
                    'image_filename_sm' => $row['image_filename_sm'],
                    'image_filename_md' => $row['image_filename_md'],
                    'image_filename_lg' => $row['image_filename_lg']
                );
            }
    
            // Store stock information associated with the product
            $data[$product_id]['stocks'][] = array(
                'quantity' => $row['stock_quantity']
            );
    
            // Store sold quantities associated with the product
            $data[$product_id]['sold'][] = array(
                'quantity' => $row['quantity_sold']
            );
        }
        $stmt->close();

        // var_dump($data);

        // Filter the results
        $filtered_data = array_filter($data, function($item) use ($search) {
            $search = strtolower($search);
            $title = strtolower($item['title']);

            $match = strpos($title, $search);

            if ($match === false) {
                return false;
            }
            return true; // Include item in the filtered results
        });
        // var_dump($filtered_data);
        return $filtered_data;
    }
    public function searched_products($search) {        
        // Get array of arrays
        $products_array = $this->get_searched_products($search);
        // var_dump($products_array);
        
        // Get page name
        $pagename = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME);
    
        $num_of_rows = count($products_array);
    
        $results_per_page = 20;
    
        // Number of total pages available
        $num_of_pages = ceil($num_of_rows / $results_per_page);
    
        // Determine which page product is currently on
        $page = isset($_GET['page']) ? ($_GET['page'] == 0 ? 1 : intval($_GET['page'])) : 1;
    
        $starting_limit_number = ($page - 1) * $results_per_page;
    
        $contentStr = "";
        foreach(array_slice($products_array, $starting_limit_number, $results_per_page) as $key => $value) {
            $product_array = $value;
            $contentStr .= $this->products_row_html($product_array);
        }

        echo $contentStr;
    }
}