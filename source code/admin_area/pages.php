
<?php
include('../includes/connect.php');
?>
<?php
$start = 0;

$rows_per_page = 4;

$records = $conn->query("SELECT * FROM products");
$nr_of_rows = $records->num_rows;

$pages = ceil($nr_of_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}

$result = $conn->query("SELECT * FROM products LIMIT $start, $rows_per_page");
?>