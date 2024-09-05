<style>
    .page-loader-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .page-loader {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin .5s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="page-loader-wrapper">
    <div class="page-loader"></div>
</div>

<script defer>
    document.onreadystatechange = function () {
        if (document.readyState === "complete") {
            // setTimeout(function() {
                // Page has fully loaded; hide the loading animation.
                document.querySelector(".page-loader-wrapper").style.display = "none";
            // }, 1000);
        }
    };
</script>