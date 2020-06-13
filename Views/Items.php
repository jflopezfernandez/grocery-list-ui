<?php

/**
 * Import the page header.
 * 
 * @todo This needs to be refactored. I don't like that every page has to 
 * individually and manually import the header and footer. The index page should
 * be the one managing that.
 */
require_once('Views/Components/Header.php');

?>
<main>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($db->query('SELECT * FROM Items') as $item) {
                echo "<tr>";
                echo "    <td>$item[id]</td>";
                echo "    <td>$item[name]</td>";
                echo "    <td>$item[price]</td>";
                echo "</tr>";
            }

            ?>
        </tbody>
    </table>
</main>
<?php require_once('Views/Components/Footer.php'); ?>
