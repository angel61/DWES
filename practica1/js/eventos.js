
var onSelectChange = () => {
    document.getElementById("frmSeleccion").submit();
}
function onLoad_body() {
    document.getElementById("seleccion").addEventListener("change", onSelectChange);
}