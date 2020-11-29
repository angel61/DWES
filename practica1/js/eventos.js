/*
* Este js es utilizado para lanzar submit cuando se realize el evento de cambiar la opcion marcada del select
*/
var onSelectChange = () => {
    document.getElementById("frmSeleccion").submit();
}
function onLoad_body() {
    document.getElementById("seleccion").onchange = onSelectChange;//addEventListener("change", onSelectChange);
}