

<style>
    .logo-outer {
        max-width: 95%;
        margin: 0px auto 50px auto;

        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        align-items: center;
    }
    /* .logo-container {
        width: calc(50% + 200px);
        margin: 0;
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        align-items: center;
    } */
    .logo-outer .logo {
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        align-items: center;
        max-width: 250px;
        margin-left: -20px;
    }
    .dt-now {
        font-size: 16px;
        font-weight: 500;
        line-height: 1.35;
        margin-top: 15px;
        margin-left: 8px;
        color: rgba(255, 255, 255, 1);
    }

    @media screen and (min-width: 576px) {
        .logo-outer {
            flex-flow: row nowrap;
            justify-content: space-between;
            align-items: center;
        }
        .logo-outer .logo {
            align-items: flex-start;
        }
    }
    @media screen and (min-width: 1280px) {
        .logo-outer {
            max-width: 1440px;
            margin: 0px auto 50px auto;
        }
        .logo-outer .logo {
            max-width: 300px;
            margin-left: 0px;
        }
        .dt-now {
            font-size: 18px;
            font-weight: 500;
            line-height: 1.35;
            color: rgba(255, 255, 255, 1);
        }
    }
</style>


<div class="logo float-left">
    <a href="./">
        <!-- Logo -->
        <img src="assets/logo-new.svg?v=1" alt="" class="img-fluid">
    </a>

    <div class='dt-now' id='currentDateTime'></div>
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

