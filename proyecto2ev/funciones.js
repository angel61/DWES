const vistaProducto=(id)=>{
    let form=document.getElementById("frmProductos");
    let hiden=document.getElementById("hdnProducto");
    hiden.value=id;
    document.frmProductos.submit();
}
