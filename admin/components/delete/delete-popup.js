
/*
============================================================================
    PAGINATION
============================================================================
*/
function get_pagename() {
    // Get the current path from the URL
    let path = window.location.pathname;
    
    // Split the path into segments
    let segments = path.split('/');
    
    // Get the last segment, which is the page name
    let pageName = segments.pop() || segments.pop(); // Handle trailing slash
    
    // Return the page name
    return pageName;
}
function page_param() {
    let url = window.location.href;

    // Create a URL object
    let urlObj = new URL(url);
    
    // Get the search parameters from the URL
    let params = new URLSearchParams(urlObj.search);
    
    // Get the value of the 'page' parameter
    let page = params.get('page');
    
    // Return the page number or an empty string if 'page' is not present
    return page ? '?page=' + page : '';
}
function uid_param() {
    let url = window.location.href;

    // Create a URL object
    let urlObj = new URL(url);
    
    // Get the search parameters from the URL
    let params = new URLSearchParams(urlObj.search);
    
    // Get the value of the 'page' parameter
    let uid = params.get('uid');
    
    // Return the page number or an empty string if 'page' is not present
    return page ? '?uid=' + uid : '';
}


function get_popup_content(id) {
    // // console.log(id);

    fetch('./confirm-delete-popup.php?type=users&id='+id)
    .then(response => response.text())
    .then(response => {
        // // console.log(response);
        // setTimeout(function() {
            // Insert Content
            $('#deletePopup').html(response);
            // Show Pop Up
            popup('deletePopup');
        // }, 500);
    })
    .catch( err => console.log(err));
}
function confirm_delete() {
    var formData = new FormData();

    const del_id = $('#del_id').val();

    formData.append('del', 'true');
    formData.append('del_id', del_id);

    var url = '../controllers/user-handler.php';

    var pagename = get_pagename();
    
    

    if(pagename == 'users') {
        var pp = page_param();
        var redirect_url = './' + pagename + pp;
    } else if (pagename == 'user-details') {
        // var up = uid_param();
        var redirect_url = './users?page=1';
    }

    

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(response => {
        // console.log(response);
        if(response == '1') {
            // setTimeout(function() {
                $('#message-response-1').html("<div class='success'>The Item was Deleted!</div>");
                setTimeout(function() {
                    // Show Pop Up
                    popup('deletePopup');
                    // Reload Page
                    window.location.href = redirect_url;
                }, 1000);
            // }, 500);
        } else {
            $('#message-response-1').html("<div class='error'>There was an error</div>");
        }
    })
    .catch( err => console.log(err));
}