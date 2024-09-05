<?php
/*
=================================================================
    CRUD (create, read, update, delete) 
    
    DISPLAY
=================================================================  
*/


namespace MyApp\Classes;

class News extends Db {
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
    function news_count() {
        $sql = "SELECT COUNT(*) AS news_count FROM news";

        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $news_count = $row['news_count'];

        return $news_count;
    }
    function convertDateFormat($datetime) {
        // Create a DateTime object from the input string
        $date = new \DateTime($datetime);
    
        // Format the date to the desired format
        $formattedDate = $date->format('j F Y');
    
        return $formattedDate;
    }
    /*
    =================================================================
        CRUD (create, read, update, delete)
    =================================================================  
    */
    public function create_news() {
        $category_id = 1;
        $title =  $_POST['title'];
        $description =  $_POST['description'];
        $created_at = datetime_now();
        
        $stmt = $this->con->prepare('INSERT INTO news (title, description, created_at) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $title, $description, $created_at);
        
        if($stmt->execute()) {   
            $status = '1';

            $news_id = $stmt->insert_id;

            
            // Insert Images
            if(isset($_SESSION['uploads'])) {
                $uploads = json_decode($_SESSION['uploads'], true);
                if(count($uploads) > 0) {
                    foreach($uploads as $img_filename) {
                        $image_filename_sm = $img_filename;
                        $image_filename_md = $img_filename;
                        $image_filename_lg = $img_filename;
        
                        $stmtImg = $this->con->prepare("INSERT INTO news_images (news_id, image_filename_sm, image_filename_md, image_filename_lg, created_at) VALUES (?, ?, ?, ?, ?)");
                        $stmtImg->bind_param("issss", $news_id, $image_filename_sm, $image_filename_md, $image_filename_lg, $created_at);
                        $stmtImg->execute();
                        $stmtImg->close();
                    }
                }
            }

        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();


        // Created News array
        if($news_id) {
            $news_array = $this->get_news_item($news_id);
        } else {
            $news_array = array();
        }
        

        $create_response = json_encode(array (
            'status' => $status,
            'news_array' => $news_array
        ), true);

        echo $create_response;
    }
    public function update_news($id) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $updated_at = datetime_now();
        
        $stmt = $this->con->prepare("UPDATE news SET title=?, description=?, updated_at=? WHERE id=?");
        $stmt->bind_param('sssi', $title, $description, $updated_at, $id);
        if($stmt->execute()) {   
            $status = '1';
            
            if(isset($_SESSION['uploads'])) {
                $uploads = json_decode($_SESSION['uploads'], true);
                
                if(count($uploads) > 0) {
                    foreach($uploads as $img_filename) {
                        $image_filename_sm = $img_filename;
                        $image_filename_md = $img_filename;
                        $image_filename_lg = $img_filename;
        
                        $stmtImg = $this->con->prepare("INSERT INTO news_images (news_id, image_filename_sm, image_filename_md, image_filename_lg, created_at) VALUES (?, ?, ?, ?, ?)");
                        $stmtImg->bind_param("issss", $id, $image_filename_sm, $image_filename_md, $image_filename_lg, $created_at);
                        $stmtImg->execute();
                        $stmtImg->close();
                    }
                }
            }
            

        } else {
            $status = '0';
            die('prepare() failed: ' . htmlspecialchars($this->con->error));
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        $stmt->close();
        echo $status;
    }
    public function delete_news($id) {
        // Delete `news` row
        $sql = "DELETE FROM news WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        if($stmt->execute()) {
            $stmt->close();
            $status = '1';
        } else {
            $status = '0';
        }

        // Delete `news_images` row
        if($status == '1') {
            $sql = "DELETE FROM news_images WHERE news_id = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("i", $id);
            if($stmt->execute()) {
                $stmt->close();
                $status = '1';
            }
        }

        echo $status;
    }
    public function get_news() {
        $sql = "SELECT 
            n.id AS news_id,
            n.title,
            n.description,
            n.created_at AS news_created_at,
            i.id AS image_id,
            i.image_filename_sm,
            i.image_filename_md,
            i.image_filename_lg
        FROM news n
        LEFT JOIN news_images i ON n.id = i.news_id";
        
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Initialize an array to store news data and associated details
        $data = array();

        $image_ids = array();

        while ($row = $result->fetch_assoc()) {
            // News Id
            $news_id = $row['news_id'];
    
            // Initialize the news array if not already created

            if (!isset($data[$news_id])) {
                $data[$news_id] = array(
                    'id' => $news_id,
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'created_at' => $row['news_created_at'],
                    'images' => array()
                );
            }
    
            // Store images associated with the news
            if($row['image_id']) {
                if(!in_array($row['image_id'], $image_ids)) {
                    $data[$news_id]['images'][] = array(
                        'id' => $row['image_id'],
                        'image_filename_sm' => $row['image_filename_sm'],
                        'image_filename_md' => $row['image_filename_md'],
                        'image_filename_lg' => $row['image_filename_lg']
                    );
                }
                array_push($image_ids, $row['image_id']);
            }
        }
        $stmt->close();
    
        return $data;
    }
    
    public function get_news_item($news_id) {
        $sql = "SELECT 
            n.id AS news_id,
            n.title,
            n.description,
            n.created_at AS news_created_at,
            i.id AS image_id,
            i.image_filename_sm,
            i.image_filename_md,
            i.image_filename_lg
        FROM news n
        LEFT JOIN news_images i ON n.id = i.news_id
        WHERE n.id = ?";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $news_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Initialize an array to store news data and associated details
        $data = array();
        while ($row = $result->fetch_assoc()) {
            // News Id
            $news_id = $row['news_id'];

            // Initialize the news array if not already created
            if (!isset($data[$news_id])) {
                $data[$news_id] = array(
                    'id' => $news_id,
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'created_at' => $row['news_created_at'],
                    'images' => array()
                );
            }

            // Store images associated with the news
            if($row['image_id']) {
                $data[$news_id]['images'][] = array(
                    'id' => $row['image_id'],
                    'image_filename_sm' => $row['image_filename_sm'],
                    'image_filename_md' => $row['image_filename_md'],
                    'image_filename_lg' => $row['image_filename_lg']
                );
            }
        }
        $stmt->close();

        // var_dump($data[$news_id]);

        return $data[$news_id];
    }


    public function delete_news_image($news_id, $image_filename) {
        // var_dump($news_id, $image_filename);
        $stmt = $this->con->prepare("DELETE FROM news_images WHERE news_id=? AND image_filename_sm=?");
        $stmt->bind_param('is', $news_id, $image_filename);
        $stmt->execute();
        $stmt->close();
    }


    public function news_item($news_id) {
        $news = $this->get_news_item($news_id);
        $images = $news['images'];

        $description = paragraphs($news['description']);

        $imgStr = "";
        foreach ($images as $image) {
            $img_small = $image['image_filename_sm'];
            $img_large = $image['image_filename_md'];
            $img_medium = $image['image_filename_lg'];
            
            $imgStr .= "<div class='image'>
                <img src='admin/uploads/$img_medium?v=2' alt=''>
            </div>";
        }

        $newsStr = "<div class='news-outer'>
            <div class='news-sections owl-carousel'>
                <div class='news-section'>
                    <div class='col-left'>
                        <div class='images-wrapper owl-carousel'>
                            $imgStr
                        </div>
                    </div>
                    <div class='col-right'>
                        <div class='news-section-title'>
                            <h2>{$news['title']}</h2>
                        </div>
                        <div class='text-row'>
                            $description
                        </div>
                    </div>
                </div>
            </div>
        </div>";



        echo $newsStr;
    }

    public function news_slide_count() {
        $newss = $this->get_news();

        $num_of_rows = count($newss);

        $results_per_page = 1;

        $num_of_sections = ceil($num_of_rows / $results_per_page);

        $cur_item_num = 1;

        echo "$cur_item_num/$num_of_sections";
    }

    public function news() {
        $newss = $this->get_news();

        $num_of_rows = count($newss);
        $results_per_page = 1;

        $num_of_sections = ceil($num_of_rows / $results_per_page);

        $pdtsStr = "";

        $cur_item_num = 1;

        $newsStr = "<div class='news-outer'>
        <div class='news-sections owl-carousel'>";

        if(count($newss) > 0) {
            foreach ($newss as $news) {
                
                $description = paragraphs($news['description']);

                // Images
                $images = $news['images'];
    
                $imgStr = "";
                foreach ($images as $image) {
                    $img_small = $image['image_filename_sm'];
                    $img_large = $image['image_filename_md'];
                    $img_medium = $image['image_filename_lg'];
                    
                    $imgStr .= "<div class='image'>
                        <img src='admin/uploads/$img_medium?v=2' alt=''>
                    </div>";
                }
    
    
                $newsStr .= "<div class='news-section' data-num='$cur_item_num/$num_of_rows'>
                    <div class='col-left'>
                        <div class='images-wrapper owl-carousel'>
                            $imgStr
                        </div>
                    </div>
                    <div class='col-right'>
                        <div class='news-section-title'>
                            <h2>{$news['title']}</h2>
                        </div>
                        <div class='text-row'>
                            $description
                        </div>
                    </div>
                </div>";

                $cur_item_num += 1;
    
            }
        }

        $newsStr .= "</div>
        </div>";

        echo $newsStr;
    }



    function newss_table_header($isIndex = false) {
        if($isIndex == false) {
            return "<div class='content'>
            <div class='header'>
                <div class='item'>Name</div>
                <div class='item'>Updated</div>
                <div class='item'>Edit</div>
            </div>
            <div class='body'>
                <div class='rows'>";
        } else {
            return "<div class='content'>";
        }

    }
    function newss_table_footer($isIndex = false) {
        return "</div>
            </div>
        </div>";
    }
    function newss_row_html($news_array, $isIndex = false) {
        $dt = $this->convertDateFormat($news_array['created_at']);

        if(count($news_array['images']) > 0) {
            $img_sm = $news_array['images'][0]['image_filename_sm'];
        } else {
            $img_sm = 'placeholder.png';
        }

        $description = limitWords($news_array['description'], 5, 5);

        if($isIndex == false) {
            return "
            <div class='c-row' id='news-id-{$news_array['id']}'>
                <div class='item'>
                    <div class='thumbnail'>
                        <img src='./uploads/$img_sm' alt='News Image'>
                    </div>
                    <div class='text'>
                        <div class='title'>{$news_array['title']}</div>
                        <div class='subtitle'>{$description}</div>
                    </div>
                </div>
                <div class='item'>$dt</div>
                
                <div class='item' onclick='get_popup_content_news(\"{$news_array['id']}\")'>
                    <img src='./assets/edit.svg' alt=''>
                </div>
            </div>";
        } else {
            return "
            <div class='c-row' id='news-id-{$news_array['id']}'>
                <div class='item'>
                    <div class='thumbnail'>
                        <img src='./uploads/$img_sm' alt='News Image'>
                    </div>
                    <div class='text'>
                        <div class='title'>{$news_array['title']}</div>
                        <div class='subtitle'>{$description}</div>
                    </div>
                </div>
            </div>";
        }
    }
    public function newss_admin($isIndex = false) {
        // Get page name
        $pagename = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME);
    
        // Get array of arrays
        $newss_array = $this->get_news();

        // var_dump($newss_array);
    
        $num_of_rows = count($newss_array);
    
        $results_per_page = 20;
    
        // Number of total pages available
        $num_of_pages = ceil($num_of_rows / $results_per_page);
    
        // Determine which page news is currently on
        $page = isset($_GET['page']) ? ($_GET['page'] == 0 ? 1 : intval($_GET['page'])) : 1;
    
        $starting_limit_number = ($page - 1) * $results_per_page;
    
        $contentStr = "";
        $contentStr .= $this->newss_table_header($isIndex);
        foreach(array_slice($newss_array, $starting_limit_number, $results_per_page) as $key => $value) {
            $news_array = $value;
            $contentStr .= $this->newss_row_html($news_array, $isIndex);
        }
        $contentStr .= $this->newss_table_footer($isIndex);
    
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

    public function edit_news_form($id) {
        $news = $this->get_news_item($id);
    
        $imagesStr = "";

        $uploads = array();

        if(count($news['images']) > 0) {
            // var_dump($news['images']);
            foreach($news['images'] as $image) {
                $image_filename_sm = $image['image_filename_sm'];
                $image_dir = "uploads/{$image_filename_sm}";
    
                $imagesStr .= "<div class='img-container'>
                    <img src='$image_dir'>
                    <span onclick='delete_old_news_image(this, $id, \"$image_dir\")' class='remove-icon'>&times;</span>
                </div>";
    
                
                array_push($uploads, basename($image_filename_sm));
            }
        }

        if(isset($_SESSION['old_uploads'])) {
            unset($_SESSION['old_uploads']);
        }
        $_SESSION['old_uploads'] = json_encode($uploads, true);
        $description = $news['description'];
        $encodedDescription = json_encode($description);
        $contentStr = "
        <div id='bookingPopupInner' class='edit-news-popup'>   
            <input type='hidden' name='type' id='type' value='news'>
            <input type='hidden' name='news_id' id='news_id' value='$id'>
            <div id='cross' onclick='closePopup()'>
                <img src='assets/cross.svg' alt=''>
            </div>
            <div>
                <div id='popup-heading'>
                    Edit News
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
                                        Drag and Drop file here or <span id='fileElem' style='color: #3F8BB7; cursor: pointer;'>Choose File</span>
                                    </div>
                                </div>
                            </div>

                            <div class='uploaded-images' id='uploadedImages'>
                                $imagesStr
                            </div>

                            <input type='file' id='fileInput' style='display: none;'>

                            <div class='input-wrapper' id='name-wrapper'>
                                <label for='title'>Title<span class='required'>*</span></label>
                                <input value='{$news['title']}' name='name' id='title-field' type='name' class='input-field' placeholder='Type here'>
                                <div id='title-error' class='error-text'></div>
                            </div>
                            <div class='input-wrapper' id='description-wrapper'>
                                <label for='description'>Description</label>
                                <textarea name='description' rows='5' id='description-field' type='name' class='textarea-field  scrollable-div-y' placeholder='Type here'>{$news['description']}</textarea>
                                <div id='description-error' class='error-text'></div>
                            </div>
                            <script defer>
                                $(document).ready(function() {
                                    // Assuming old text from the database is retrieved and stored in a variable
                                    var oldText = $encodedDescription;
                                    $('#description-field').val(oldText);

                                    // Initialize mCustomScrollbar on the textarea
                                    $('#description-field').mCustomScrollbar({
                axis: 'y', // Enable horizontal scrolling only
                theme: 'minimal'
            });
                                });
                            </script>
                        </div>
                    </div>
                    <div class='row' id='row-2'>
                
                        <span class='btns'>
                            <span class='btn admin-btn-2' onclick='closePopup()'>
                                Cancel
                            </span>
                            <span class='btn admin-btn-1' onclick='update_news(event)'>
                                Save
                            </span>
                        </span>
                
                    </div>
                    <div class='row' id='row-3'>
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
    public function get_searched_news($search) {
        $sql = "SELECT 
            n.id AS news_id,
            n.title,
            n.description,
            n.created_at AS news_created_at,
            i.id AS image_id,
            i.image_filename_sm,
            i.image_filename_md,
            i.image_filename_lg
        FROM news n
        LEFT JOIN news_images i ON n.id = i.news_id";
        
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        // Initialize an array to store news data and associated details
        $data = array();

        $image_ids = array();

        while ($row = $result->fetch_assoc()) {
            // News Id
            $news_id = $row['news_id'];

            // Initialize the news array if not already created

            if (!isset($data[$news_id])) {
                $data[$news_id] = array(
                    'id' => $news_id,
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'created_at' => $row['news_created_at'],
                    'images' => array()
                );
            }

            // Store images associated with the news
            if($row['image_id']) {
                if(!in_array($row['image_id'], $image_ids)) {
                    $data[$news_id]['images'][] = array(
                        'id' => $row['image_id'],
                        'image_filename_sm' => $row['image_filename_sm'],
                        'image_filename_md' => $row['image_filename_md'],
                        'image_filename_lg' => $row['image_filename_lg']
                    );
                }
                array_push($image_ids, $row['image_id']);
            }
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
    public function searched_news($search) {        
        // Get array of arrays
        $newss_array = $this->get_searched_news($search);
        // var_dump($newss_array);
        
        // Get page name
        $pagename = pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_FILENAME);
    
        $num_of_rows = count($newss_array);
    
        $results_per_page = 20;
    
        // Number of total pages available
        $num_of_pages = ceil($num_of_rows / $results_per_page);
    
        // Determine which page news is currently on
        $page = isset($_GET['page']) ? ($_GET['page'] == 0 ? 1 : intval($_GET['page'])) : 1;
    
        $starting_limit_number = ($page - 1) * $results_per_page;
    
        $contentStr = "";
        foreach(array_slice($newss_array, $starting_limit_number, $results_per_page) as $key => $value) {
            $news_array = $value;
            $contentStr .= $this->newss_row_html($news_array);
        }

        echo $contentStr;
    }
}