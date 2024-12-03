<?php
require_once __DIR__ . "/autoload/autoload.php";

$category =  $db->fetchAll("category");

?>


<?php
require_once __DIR__ . "/layouts/header.php";
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Xin chào bạn đến với admin</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"></li>
            </ol>


        </div>
    </main>
    <?php
    require_once __DIR__ . "/layouts/footer.php"
    ?>