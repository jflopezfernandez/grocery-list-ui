<?php

/**
 * Import the Application configuration file.
 */
require_once('Util/Configuration.php');

/**
 * Import the database initialization and configuration file.
 */
require_once('Util/Database.php');

/**
 * Get the current request type. Crucially, we make sure to pass it through the
 * string filter to make sure we don't have any bullshit. We already use a
 * switch statement to make sure we are explicitly only handling request methods
 * we actually intend to, but you can never be too sure, I think.
 */
$requestMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

switch ($requestMethod) {
    case 'POST': {
        // TODO: Handle the request

        /**
         * Redirect to the homepage once the request has been processed.
         */
        header("Location: http://freebib.org/\n");
        exit();
    } break;

    case 'GET': {
        /**
         * Display the main page.
         */
        require_once('Views/Home.php');
    } break;

    default: {
        // TODO:
        // PUT PATCH DELETE HEAD TRACE
    } break;
}
