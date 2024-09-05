
function countWords(text) {
    // Remove any extra white spaces from the beginning and end of the text
    text = text.trim();

    // Check if the text is empty
    if (text === "") {
        return 0;
    }

    // Split the text into an array of words using a regular expression
    // This regex splits by spaces, tabs, and newlines
    const words = text.split(/\s+/);

    // Return the count of words
    return words.length;
}
function limitWords(text, maxLength, returnLength) {
    // Get the word count of the input text
    const wordCount = countWords(text);

    // Split the text into an array of words
    const words = text.split(/\s+/);

    // If the word count exceeds the given maximum length
    if (wordCount > maxLength) {
        // Slice the array to return only the specified number of words
        const limitedWords = words.slice(0, returnLength);

        // Convert the array of words back into a string
        return limitedWords.join(' ');
    } else {
        // If the word count does not exceed the maximum length, return the original text
        return text;
    }
}

// Function to convert date format
function convertDateFormat(dateStr) {
    const date = new Date(dateStr);
    
    const options = { day: 'numeric', month: 'long', year: 'numeric' };
    const formattedDate = new Intl.DateTimeFormat('en-GB', options).format(date);
    // console.log(formattedDate);
    return formattedDate;
}
function create_news(event) {
    event.preventDefault();
    var formData = new FormData();

    const title = $('#title-field').val();
    const description = $('#description-field').val();

    let page = get_page();

    if(page == 'news') {
        page = page;
    } else if (page == 'index') {
        page = '';
    }
    let return_url = '../admin/' + page;

    console.log(title, description);

    if (title && description) {
        
        load_start();
        
        $('#title-error').html('');
        $('#description-error').html('');

        formData.append('create_news', 'true');
        formData.append('title', title);
        formData.append('description', description);
    
        fetch('../controllers/news-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(response => {
            setTimeout(function() {
                load_end();
                closePopup();

                // Response
                console.log(response);

                // Page
                var page = get_page();

                if($.trim(response.status) == '1') {
                    $('#message-response-1').html("<div class='success'>News created!</div>");

                    setTimeout(function() {

                        // Parse the JSON response
                        const newsArray = response.news_array;
                        
                        // Extract the required data
                        const createdAt = convertDateFormat(newsArray.created_at);
                        const imgSm = newsArray.images.length > 0 ? newsArray.images[0].image_filename_sm : 'placeholder.png';
                        const description = limitWords(newsArray.description, 5, 20);

                        let html = `<div class='c-row' id='news-id-${newsArray.id}'>
                            <div class='item'>
                                <div class='thumbnail'>
                                    <img src='./uploads/${imgSm}' alt='News Image'>
                                </div>
                                <div class='text'>
                                    <div class='title'>${newsArray.title}</div>
                                    <div class='subtitle'>${description}</div>
                                </div>
                            </div>`;

                        // News page
                        if (page == 'news') {
                            html += `<div class='item'>${createdAt}</div>
                            <div class='item' onclick='get_popup_content_news("${newsArray.id}")'>
                                <img src='./assets/edit.svg' alt=''>
                            </div>`;
                        }

                        html += `</div>`;

                        // Append HTML
                        const lastRow = document.querySelector('.c-row:last-of-type');
                        lastRow.insertAdjacentHTML('afterend', html);

                        // Scroll to new element
                        const newElement = document.getElementById(`news-id-${newsArray.id}`);
                        newElement.scrollIntoView({ behavior: 'smooth' });

                        // window.location.href = return_url;
                    }, 500);
                } else {
                    $('#message-response-1').html("<div class='error'>An error occurred while submitting this form!</div>");
                }
            }, 500);
        })
        .catch(err => console.log(err));
    } else {
        // Title
        if (title) {
            $('#title-error').html('');
            $('#name-wrapper').removeClass('invalid');
        } else {
            $('#title-error').html('<div>Field cannot be blank</div>');
            $('#name-wrapper').addClass('invalid');
        }
        // Description
        if (description) {
            $('#description-error').html('');
            $('#description-wrapper').removeClass('invalid');
        } else {
            $('#description-error').html('<div>Field cannot be blank</div>');
            $('#description-wrapper').addClass('invalid');
        }
    }
}
function update_news(event) {
    event.preventDefault();
    var formData = new FormData();

    const news_id = $('#news_id').val();
    const title = $('#title-field').val();
    const description = $('#description-field').val();

    let page = get_page();

    if(page == 'news') {
        page = page;
    } else if (page == 'index') {
        page = '';
    }
    let return_url = '../admin/' + page;

    console.log(news_id, title, description);

    if (title && description) {
        
        load_start();
        
        $('#title-error').html('');
        $('#description-error').html('');

        formData.append('update_news', 'true');
        formData.append('news_id', news_id);
        formData.append('title', title);
        formData.append('description', description);
    
        fetch('../controllers/news-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(response => {
            setTimeout(function() {
                load_end();
                if($.trim(response) == '1') {
                    $('#message-response-1').html("<div class='success'>News updated!</div>");
                    setTimeout(function() {
                        window.location.href = return_url;
                    }, 500);
                } else {
                    $('#message-response-1').html("<div class='error'>An error occurred while submitting this form!</div>");
                }
            }, 500);
        })
        .catch(err => console.log(err));
    } else {
        // Title
        if (title) {
            $('#title-error').html('');
            $('#name-wrapper').removeClass('invalid');
        } else {
            $('#title-error').html('<div>Field cannot be blank</div>');
            $('#name-wrapper').addClass('invalid');
        }
        // Description
        if (description) {
            $('#description-error').html('');
            $('#description-wrapper').removeClass('invalid');
        } else {
            $('#description-error').html('<div>Field cannot be blank</div>');
            $('#description-wrapper').addClass('invalid');
        }
    }
}

function get_popup_content_news(id) {
    // console.log(id);

    fetch('./confirm-delete-popup-news.php?type=product&id='+id)
    .then(response => response.text())
    .then(response => {
        // console.log(response);
        // setTimeout(function() {
            // Insert Content
            $('#deletePopup').html(response);
            // Show Pop Up
            popup('deletePopup');
        // }, 500);
    })
    .catch( err => console.log(err));
}
function confirm_delete_news(id) {
    var formData = new FormData();

    formData.append('del', 'true');
    formData.append('del_id', id);

    const url = '../controllers/news-handler.php';


    let page = get_page();

    if(page == 'news') {
        page = page;
    } else if (page == 'index') {
        page = '';
    }
    let return_url = '../admin/' + page;

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
                    // Reload Page
                    window.location.href = return_url;
                }, 500);
            // }, 500);
        } else {
            $('#message-response-1').html("<div class='error'>There was an error</div>");
        }
    })
    .catch( err => console.log(err));
}

function get_popup_content_edit_news(id) {
    // console.log(id);
    closePopup();

    fetch('./edit-news-popup?type=news&id='+id)
    .then(response => response.text())
    .then(response => {
        // console.log(response);
        // setTimeout(function() {
            // Insert Content
            $('#deletePopup').html(response);
            // Show Pop Up
            popup('deletePopup');
        // }, 500);
    })
    .catch( err => console.log(err));
}

function get_popup_content_add_news() {
    closePopup();

    fetch('./add-news-popup?type=news')
    .then(response => response.text())
    .then(response => {
        // console.log(response);
        // setTimeout(function() {
            // Insert Content
            $('#deletePopup').html(response);
            // Show Pop Up
            popup('deletePopup');
        // }, 500);
    })
    .catch( err => console.log(err));
}