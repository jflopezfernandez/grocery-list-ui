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

$statement = $db->prepare('SELECT * FROM Items WHERE id=:id');
$statement->bindParam(':id', $item_id, \PDO::PARAM_INT);
$statement->execute();
$item = $statement->fetch();
$statement->closeCursor();

?>
<main>
    <a href="/?action=view-items">Item List</a>
    <?php if ($item) { ?>
    <h1>Item Overview</h1>
    <h2><?= $item['name'] ?></h2>
    <h3><?= $item['price'] ?></h3>
    <table>
        <thead>
        <tr>
            <th>Date</th>
            <th>Price</th>
        </thead>
        <tbody>
        <?php

        $statement = $db->prepare('SELECT * FROM ItemPriceLog WHERE item_id=:item_id');
        $statement->bindParam(':item_id', $item_id, \PDO::PARAM_INT);
        $statement->execute();
        $price_changes = $statement->fetchAll();
        $statement->closeCursor();

        foreach ($price_changes as $price_change) {
            echo "<tr>";
            echo "    <td>$price_change[change_timestamp]</td>";
            echo "    <td>$price_change[price]</td>";
            echo "</tr>";
        }

        ?>
        </tbody>
    </table>
    <?php } else { ?>
    <h2 style="text-align: center;"><span style="color: red;">Nonexistent Item ID Requested</span></h2>
    <?php } ?>
</main>
<?php require_once('Views/Components/Footer.php'); ?>