<style>
    .confirm-email-reminder {
        color: #fff;
        background-color: #1481aa;
        /* background-color: #000; */
        padding: 40px 20px;
        width: 100%;
        text-align: center;
        font-weight: 500;
        font-size: 25px;
    }
</style>

<div class='confirm-email-reminder'>
    <div class=''>
        Please check your email for the account verification link
        <br>
        <a style='font-size: 14px; color: #fff;' href="<?= $_SESSION['url']; ?>"><?= $_SESSION['url']; ?></a>
    </div>
</div>
