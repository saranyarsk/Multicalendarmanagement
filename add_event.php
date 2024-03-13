<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Add Event.php
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
// Include WordPress environment
require_once ABSPATH . 'wp-load.php';

// Include the Google API PHP Client Library
require_once get_template_directory() . '/googleCalendar/vendor/autoload.php';

// Function to add event to Google Calendar
function addEventToGoogleCalendarEventadd($credentialsFile, $summary, $startDateTime, $endDateTime, $attendeeEmail) {
    try {
        $client = new Google_Client();
        $client->setAuthConfig($credentialsFile); // Set credentials from JSON file

        $service = new Google_Service_Calendar($client);

        $event = new Google_Service_Calendar_Event(array(
            'summary' => $summary,
            'start' => array(
                'dateTime' => $startDateTime,
                'timeZone' => 'America/New_York',
            ),
            'end' => array(
                'dateTime' => $endDateTime,
                'timeZone' => 'America/New_York',
            ),
            'attendees' => array(
                array('email' => $attendeeEmail),
            ),
        ));

        $calendarId = 'primary'; // You can use 'primary' for the primary calendar of the authenticated user

        $event = $service->events->insert($calendarId, $event);

        // Log success to a file
        $errorLogPath = get_template_directory() . '/google_calendar_error.log';
        error_log('Success creating Google Calendar event: ' . $event->htmlLink, 3, $errorLogPath);

        return true; // Event creation successful
    } catch (Exception $e) {
        // Log error to a file
        $errorLogPath = get_template_directory() . '/google_calendar_error.log';
        error_log('Error creating Google Calendar event: ' . $e->getMessage(), 3, $errorLogPath);

        return false; // Event creation failed
    }
}

// Retrieve form data
$title = $_POST['title'];
$date = $_POST['date'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$description = $_POST['description'];

// Path to the Google API credentials JSON file
$credentialsFile =  get_template_directory() . '/googleCalendar/client_secret_69719740503-js06c3upvf71su59nnkve8e970doouh9.apps.googleusercontent.com.json';


// Get subscribers' email addresses 
$subscribers = get_users(array(
    'role' => 'subscriber',
    'fields' => array('user_email'),
));

// Create the event and log success/failure
foreach ($subscribers as $subscriber) {
    addEventToGoogleCalendarEventadd($credentialsFile, $title, $date . 'T' . $startTime . ':00', $date . 'T' . $endTime . ':00', $subscriber->user_email);
}

echo 'Event added to Google Calendar.';
?>
