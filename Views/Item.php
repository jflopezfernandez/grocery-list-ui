<?php

/**
 * Import the page header.
 * 
 * @todo This needs to be refactored. I don't like that every page has to 
 * individually and manually import the header and footer. The index page should
 * be the one managing that.
 */
require_once('Views/Components/Header.php');

/**
 * Ensure we were actually given an item id. If we weren't, treat this as an
 * item creation rather than an item view/edit.
 */
$item_id = filter_input(INPUT_GET, 'item-id', FILTER_SANITIZE_STRING);

$create_new = ($item_id) ? false : true;

?>
<main>
    <p>Item ID: <?= $item_id ?></p>
    <p>Creating new item? <?= $create_new ?></p>
</main>
<?php require_once('Views/Components/Footer.php'); ?>