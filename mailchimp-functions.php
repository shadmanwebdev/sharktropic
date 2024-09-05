<?php
require 'vendor/autoload.php';
$config = include 'config.php';

function send_campaign($email_content, $tier) {
    // var_dump($email_content, $tier);
    
    $mailchimp = new MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => $config['mailchimp']['apiKey'],
        'server' => $config['mailchimp']['server'],
    ]);

    $list_id = $config['mailchimp']['listId'];

    // var_dump($mailchimp);

    // Segment id
    if($tier != null) {
        $segment_name = $tier;
        // echo $segment_name = ($tier == 'free') ? 'Users' : 'Subscribers';
        $saved_segment_id = get_segment_id($segment_name);

        $recipients = [
            'list_id' => $list_id,
            'segment_opts' => [
                'saved_segment_id' => $saved_segment_id
            ]
        ];
    } else {
        $recipients = [
            'list_id' => $list_id
        ];
    }
    // var_dump($segment_id_array);
    
    $response = $mailchimp->campaigns->create([
        'type' => 'regular',
        'recipients' => $recipients,
        'settings' => [
            'subject_line' => 'Uncut College Email Campaign',
            'from_name' => 'Uncut College',
            'reply_to' => 'contact@uncutcollege.com',
        ],
    ]);
    $campaignId = $response->id;
    

    $mailchimp->campaigns->setContent($campaignId, [
        'html' => $email_content,
    ]);

    
    try {
        $mailchimp->campaigns->send($campaignId);
        echo '1';
    } catch (\Exception $e) {
        // var_dump($e);
        echo '2';
        // echo 'Mailchimp API Error: ' . $e->getMessage();
    }
}


function add_to_audience($email, $tags = []) {
    
    $mailchimp = new MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => $config['mailchimp']['apiKey'],
        'server' => $config['mailchimp']['server'],
    ]);

    $list_id = $config['mailchimp']['listId'];


    try {
        $memberInfo = [
            'email_address' => $email,
            'status' => 'subscribed', // or 'pending' for double opt-in
        ];

        if (!empty($tags)) {
            $memberInfo['tags'] = $tags;
        }

        $response = $mailchimp->lists->addListMember($list_id, $memberInfo);

        // var_dump($response);

        // Check the response to ensure the email was added successfully
        if ($response->status == 'subscribed') {
            return '1'; // Success
        } else {
            return '0'; // Failed
        }
    } catch (\Exception $e) {
        return '2'; // Error
    }
}


function update_email_tag($email, $tier) {

    $newTags = [$tier]; // The updated tags

    $mailchimp = new MailchimpMarketing\ApiClient();
    
    $mailchimp->setConfig([
        'apiKey' => $config['mailchimp']['apiKey'],
        'server' => $config['mailchimp']['server'],
    ]);

    $list_id = $config['mailchimp']['listId'];

    try {
        // // Retrieve the current tags for the subscriber
        // $subscriberInfo = $mailchimp->lists->getListMemberTags($listId, md5(strtolower($email)));

        // // Modify the tags as needed
        // $currentTags = $subscriberInfo['tags'];
        // $currentTags = array_merge($currentTags, $newTags); // Add new tags

        // Update the subscriber's tags
        $response = $mailchimp->lists->updateListMemberTags($list_id, md5(strtolower($email)), ['tags' => $newTags]);

        return '1';
        // echo 'Tags updated successfully.';
    } catch (\Exception $e) {
        return '0';
        // echo 'Mailchimp API Error: ' . $e->getMessage();
    }
}


function get_segment_id($segment_name) {

    $mailchimp = new MailchimpMarketing\ApiClient();

    
    $mailchimp->setConfig([
        'apiKey' => $config['mailchimp']['apiKey'],
        'server' => $config['mailchimp']['server'],
    ]);

    $list_id = $config['mailchimp']['listId'];

    try {
        // Retrieve a list of segments for the specified list
        $segmentsObject = $mailchimp->lists->listSegments($list_id);
        // var_dump($segments);
        // Iterate through the segments to find the one you need
        foreach ($segmentsObject->segments as $segment) {
            // var_dump($segment);
            // Check the name of the segment to identify the one you want
            if ($segment->name === $segment_name) {
                $segmentId = $segment->id;
                return $segmentId;
                // echo 'Segment ID: ' . $segmentId;
            }
        }
    } catch (\Exception $e) {
        echo 'Mailchimp API Error: ' . $e->getMessage();
    }

}


function segment_loop() {
    // Assuming $segmentsObject contains the stdClass object you posted
    if (isset($segmentsObject->segments) && is_array($segmentsObject->segments)) {
        foreach ($segmentsObject->segments as $segment) {
            // Access segment properties here
            $segmentId = $segment->id;
            $segmentName = $segment->name;
            $memberCount = $segment->member_count;
            $segmentType = $segment->type;
            $listId = $segment->list_id;
            $created_at = $segment->created_at;

            // Perform actions or output information about each segment
            echo "Segment ID: $segmentId\n";
            echo "Segment Name: $segmentName\n";
            echo "Member Count: $memberCount\n";
            echo "Segment Type: $segmentType\n";
            echo "List Id: $listId\n";
            echo "Created at: $created_at\n";
            
            // Add more logic here as needed for each segment
        }
    } else {
        echo "No segments found in the object.";
    }

}


// $email_content = "<p>This is a test email</p>
// <p>This is the second paragraph</p>";
// $tier = null;
// send_campaign($email_content, $tier);



/*
=========================================================
    Domain Verification:
=========================================================

    To use the email address contact@uncutcollege.com as the "reply_email" 
    in your Mailchimp campaign, you need to add and verify this email address 
    as a sender in your Mailchimp account. Here are the steps to do that:

    Log in to your Mailchimp account.
    
    Go to the Mailchimp Dashboard.
    
    In the upper right corner, click on your profile name and then select "Account."
    
    In the Account settings, click on "Settings" in the left sidebar.
    
    Under the "Verified Domains" section, click on "View Settings."
    
    You will see a section labeled "Send From Email Addresses." Click the "Add A Sending Email Address" button.
    
    Enter the email address you want to use as the "reply_email" (e.g., contact@uncutcollege.com) and follow the instructions to complete the verification process.
    
    Mailchimp may send a confirmation email to the address you provided, and you'll need to click on the verification link in that email to complete the process.
    
    Once you have successfully added and verified contact@uncutcollege.com as a sending email address, you should be able to use it as the "reply_to" address when creating or editing your Mailchimp campaigns. Make sure to select it from the list of verified sending email addresses in your campaign settings.


*/