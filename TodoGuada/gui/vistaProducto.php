<!--div class="container">
    <div class="row py-4 my-2">
        <?php //$this->printProducto($_REQUEST["producto"]);
        ?>
    </div>
</div-->
<div class="container mt-5">
    <div class="card">
        <form action="index.php" method="post">
            <div class="row">
                <?php $this->printProducto(); ?>
            </div>
        </form>
    </div>


</div>