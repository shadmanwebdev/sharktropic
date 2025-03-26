<style>
    .logo-outer {
        width: 100%;
        padding: 0px 10px 50px 10px;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: space-between;
    }
    .dt-now {
        font-size: 14px;
        font-weight: 500;
        line-height: 1.35;
        margin-top: 10px;
        margin-left: 8px;
        color: rgba(255, 255, 255, 1);
    }

    .logo-outer .logo {
        max-width: 210px;
    }
    
    @media screen and (min-width: 1280px) {
        .logo-outer {
            padding: 0px 100px 50px 100px;
        }
        
        .logo-outer .logo {
            max-width: 300px;
        }   
        .dt-now {
            font-size: 16px;
        }
    }
</style>


<div class='logo-outer'>

    <div class="logo float-left">
        <a href="./">
            <!-- Logo -->
            <img src="assets/logo-new.svg?v=1" alt="" class="img-fluid">
        </a>
        <div class='dt-now'>03/17/2024 1:33am DMV</div>
    </div>

    <?php
        include './cart.php';
    ?>
        
</div>