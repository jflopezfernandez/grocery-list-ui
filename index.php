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
        /**
         * Get the action associated with the request.
         */
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

        switch ($action) {
            case 'create-list': {
                /**
                 * @todo This process of creating a new shopping list needs to
                 * be a function, not simply an SQL query. Not only do we not
                 * really need to pass in any parameters to the query since the
                 * default value for the timestamp was defined when the table
                 * was created, but a function would also allow us to get the
                 * id of the newly created list right away as part of a single
                 * operation, rather than having to query LAST_INSERT_ID() or
                 * something, which might not be thread safe*.
                 * 
                 * *I'm not sure if this claim is accurate, I'm just genuinely
                 * wondering.
                 */
                $statement = $db->prepare('INSERT INTO GroceryLists(list_date) VALUES(NOW())');
                $result = $statement->execute();
                $statement->closeCursor();

                echo "<p>Result:&nbsp;" . var_dump($result) . "</p>";

                require_once('Views/Home.php');
            } break;

            default: {
                // TODO
            }
        }

        /**
         * Redirect to the homepage once the request has been processed.
         */
        // header("Location: http://freebib.org/\n");
        // exit();
    } break; // POST Request Switch

    case 'GET': {
        /**
         * Parse the GET request's parameters, if any.
         */
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

        switch ($action) {
            case 'create-item': {
                /**
                 * Display the item creation page.
                 */
                require_once('Views/Create-Item.php');
            }

            case 'create-list': {
                /**
                 * Display the list creation page.
                 */
                require_once('Views/Create-List.php');
            } break;

            case 'view-item': {
                /**
                 * Display the single-item view.
                 */
                require_once('Views/Item.php');
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
