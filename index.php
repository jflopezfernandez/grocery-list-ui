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
    } break; // POST Request Switch

    case 'GET': {
        /**
         * Parse the GET request's parameters, if any.
         */
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

        switch ($action) {
            case 'create-list': {
                /**
                 * @todo Display the list creation page.
                 */
                require_once('Views/Home.php');
            } break;

            case 'view-items': {
                /**
                 * Display the master items list.
                 */
                require_once('Views/Items.php');
            } break;

            default: {
                /**
                 * Display the main page.
                 */
                require_once('Views/Home.php');
            } break;
        } // Action Switch
    } break; // GET Request Switch

    default: {
        // TODO:
        // PUT PATCH DELETE HEAD TRACE
    } break;
}
