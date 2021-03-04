<div class="container">
    <form method='POST' action='index.php' name='frmProductos'>
        <div class="row listado">
            <?php $this->printProductos(); 
            $this->printPaginacion();
            ?>
        </div>
    </form>
</div>