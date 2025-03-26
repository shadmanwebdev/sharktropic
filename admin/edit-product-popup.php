<?php
    if(!isset($_SESSION)) {
        ob_start();
        session_start(); 
    }
    if(isset($_SESSION['uploads'])) {
        unset($_SESSION['uploads']);
    }
    $type = $_GET['type'];
    $id = $_GET['id'];
        
    include '../functions.php';
    include '../Classes/Db.php';
    include '../Classes/Product.php';
?>






<!-- Upload Section -->
<style>
    .upload-area {
        width: 100%;
        height: 200px;
    }
</style>





<?php
    
    $p = new MyApp\Classes\Product();
    $p->edit_product_form($id);
    
?>



<script defer>
    $(document).ready(function(){
        $(".scrollable-div-y").mCustomScrollbar({
            axis: "y", // Enable vertical scrolling
            theme: "minimal"
        });
    });
</script>





