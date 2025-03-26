
<style>
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
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
    }
    .dt-now {
        font-size: 14px;
        font-weight: 500;
        line-height: 1.35;
        margin-top: 10px;
        margin-left: 8px;
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
        .logo-outer .logo {
            align-items: flex-start;
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
            margin: 60px 135px 0 auto;
        }
    }

</style>

<div class='logo-outer'>
    <div class="logo float-left">
        <a href="./">
            <!-- Logo -->
            <img src="assets/logo-new.svg?v=1" alt="" class="img-fluid">
        </a>
        <div class='dt-now' id="currentDateTime"></div>
    </div>

    
    <a href='./drop' id='preview-drop'>Preview Drop</a>
</div>






<!-- Live Datetime -->
<script defer>
    function updateDateTime() {
        const now = new Date();
        
        // Format date as mm/dd/yyyy
        const month = (now.getMonth() + 1).toString().padStart(2, '0');
        const day = now.getDate().toString().padStart(2, '0');
        const year = now.getFullYear();
        const dateString = `${month}/${day}/${year}`;
        
        // Format time separately
        const timeString = now.toLocaleString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true,
            timeZone: 'America/New_York'
        });
        
        // Extract just the time portion without using split
        const timeOnly = timeString.match(/\d{1,2}:\d{2}:\d{2} [AP]M/)[0];
        
        document.getElementById("currentDateTime").textContent = `${dateString} ${timeOnly}`;
    }

    // Update the date and time immediately, then every second
    updateDateTime();
    setInterval(updateDateTime, 1000);
</script>