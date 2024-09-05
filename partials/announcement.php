<div class='announcement'>
    <form id='announcementForm' action='./controllers/announcement-handler' method='POST'>
        <input type='submit' name='close' id='close' value='x'>
        <input type='hidden' name='pagename' id='pagename' value='<?= $page; ?>'>
        <input type='hidden' name='query' id='query' value='<?= $query; ?>'>
    </form>
    <div class='announcement-text'>
        <a style='font-size: 14px; color: #fff; text-decoration: none;' href="">Click HERE to check out my OnlyFans!</a>  
    </div>
</div>