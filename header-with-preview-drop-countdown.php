
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




<!-- Countdown -->
<style>
    .countdown-container {
        display: flex;
        align-items: center;
        background-color: #2d3748;
        color: white;
        border-radius: 30px;
        padding: 10px 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .countdown-container {
        margin-top: 20px;
        margin-right: 0px;
        margin-bottom: 20px;
    }
    .title {
        font-weight: bold;
        margin-right: 20px;
        font-size: 18px;
        white-space: nowrap;
    }
    
    .text {
        color: #a0aec0;
        font-size: 14px;
        margin-right: 20px;
    }
    
    .timer {
        display: flex;
        align-items: center;
        background-color: #4a5568;
        border-radius: 20px;
        padding: 8px 15px;
    }
    
    .time {
        color: rgba(254, 250, 106, 1);
        font-weight: bold;
        font-size: 16px;
    }
    
    .colon, .sec {
        color: #a0aec0;
        font-size: 16px;
    }

    @media screen and (min-width: 1200px) {
        .countdown-container {
            margin-top: 50px;
            margin-right: 135px;
            margin-bottom: 0px;
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

    
    
    <!-- Countdown -->
    <div class="countdown-container">
        <div class="title">Theme: Winter Drop</div>
        <div class="text">Drop Release</div>
        <div class="timer">
            <span id="hours" class="time">32</span>
            <span class="colon">&nbsp;hour&nbsp;:&nbsp;</span>
            <span id="minutes" class="time">54</span>
            <span class="colon">&nbsp;min&nbsp;:&nbsp;</span>
            <span id="seconds" class="time">32</span>
            <span class="sec">&nbsp;sec</span>
        </div>
    </div>
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


<!-- Countdown -->
<script>
    // Set the initial countdown time (32 hours, 54 minutes, 32 seconds)
    let totalSeconds = 32 * 60 * 60 + 54 * 60 + 32;
    
    // Get the display elements
    const hoursElement = document.getElementById('hours');
    const minutesElement = document.getElementById('minutes');
    const secondsElement = document.getElementById('seconds');
    
    // Function to update the countdown timer
    function updateCountdown() {
        // Calculate hours, minutes, seconds
        const hours = Math.floor(totalSeconds / 3600);
        const minutes = Math.floor((totalSeconds % 3600) / 60);
        const seconds = totalSeconds % 60;
        
        // Update the display
        hoursElement.textContent = hours.toString();
        minutesElement.textContent = minutes < 10 ? '0' + minutes : minutes.toString();
        secondsElement.textContent = seconds < 10 ? '0' + seconds : seconds.toString();
        
        // If countdown is not yet at zero, decrement and set the next update
        if (totalSeconds > 0) {
            totalSeconds--;
            setTimeout(updateCountdown, 1000);
        }
    }
    
    // Start the countdown
    updateCountdown();
</script>