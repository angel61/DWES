<div class="container">
    <form method='POST' action='index.php' name='frmProductos'>
        <div class="row">
            <input type="hidden" name="hdnProducto" id="hdnProducto">
            <?php $this->printProductos(); ?>
        </div>
    </form>
</div>