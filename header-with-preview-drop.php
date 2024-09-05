
<style>
    .page-wrapper {
        padding: 20px 20px 50px 20px;
        min-height: 100vh;
        width: 100%;
        background: rgba(29, 37, 52, .8);
    }
    .logo-outer {
        max-width: 1440px;
        margin: 0px auto 50px auto;
        display: flex;
        
        flex-flow: column nowrap;
        justify-content: space-between;
        align-items: center;
        /* width: 100%;
        padding: 0px 100px 0px 100px; */
    }
    .logo-outer .logo {
        max-width: 210px;
    }
    .dt-now {
        font-size: 14px;
        font-weight: 500;
        line-height: 1.35;
        margin-top: 10px;
        margin-left: 25px;
        color: rgba(255, 255, 255, 1);
    }
    .section-num {
        font-size: 20px;
        font-weight: 300;
        color: #fff;
        margin-top: 72px;
        margin-right: 125px;
        /* margin-bottom: 120px; */
    }
    @media screen and (min-width: 1280px) {
        .logo-outer {
            flex-flow: row nowrap;
        }
        .dt-now {
            font-size: 16px;
        }
        .section-num {
            font-size: 25px;
            margin-top: 90px;
            margin-right: 160px;
        }
        .logo-outer .logo {
            max-width: 300px;
        }    
        .dt-now {
            font-size: 18px;
        }
    }

</style>


<!-- Preview Drop -->
<style>
    #preview-drop {
        min-width: 160px;
        font-size: 15px;
        border-radius: 1000px;
        padding: 12px 20px;
        max-height: 50px;
        display: flex;
        flex-flow: row nowrap;
        text-align: center;
        justify-content: center;
        align-items: center;
        font-weight: 600;
        border: none;
        /* font-weight: bold; */    
        margin: 20px auto 0 auto;

        color: #111111;
        background-color: #FEFA6A;
        border: 1px solid #FEFA6A;

        
        /* margin-top: 81px; */
        align-self: flex-start;
    }
    #preview-drop:hover {
        color: #111111;
        background-color: #FEFA6A;
        border: 1px solid #FEFA6A;
    }
    @media screen and (min-width: 1280px) {
        .logo-outer {
            flex-flow: row nowrap;
        }
        .dt-now {
            font-size: 18px;
        }
        #preview-drop {
            margin: 81px 135px 0 auto;
        }
    }

</style>

<div class='logo-outer'>
    <div class="logo float-left">
        <a href="./">
            <!-- Logo -->
            <img src="assets/logo.png?v=1" alt="" class="img-fluid">
        </a>
        <div class='dt-now'>03/17/2024 1:33am DMV</div>
    </div>

    
    <button id='preview-drop'>Preview Drop</button>
</div>