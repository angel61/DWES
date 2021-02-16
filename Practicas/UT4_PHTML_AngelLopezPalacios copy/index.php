<?php
require_once("phtml.php");

$pweb=new PaginaWeb('Buenos dias');
$titulo=new Titulo(1,"Titulo");
$parrafo=new Parrafo("dhjfhdghgf ahjekhjgshfgj hkhjgshfs jdkj hjghsgjdj lfkjkj sghgjh kjfl kjkh jghj hjljkjgj shkjldkh ghagjhkd");
$texto=new Texto("ags hdjsfg dfhsgjhdsha ghsgjkjsha ghgsjdk jhfg dfahj kdjsghgdfahsk jahgf hgjhkdjsgafgah ddkhjshafhgsj hdkhjghfg");
$link=new Hipervinculo("google.com","Google");

$tabla=new Tabla();

$encabezado=new Fila();
$encabezado->addEncabezado("1");
$encabezado->addEncabezado("2");
$encabezado->addEncabezado("3");
$fila1=new Fila(['a','b','c']);
$fila2=new Fila(['d','e','f']);
$tabla->addFila($encabezado);
$tabla->addFila($fila1);
$tabla->addFila($fila2);

$lista=new Lista(['a','b','c'],true);

$form1=new Formulario('frm1','POST','index.php');

$inp1=new Input('txtNombre','text');
$lbl1=new Etiqueta($inp1->nombre,"Nombre: ");
$filaForm1=new Fila([$lbl1,$inp1]);

$inp2=new Desplegable('slcLista',['a','b','c']);
$lbl2=new Etiqueta($inp2->nombre,"Lista: ");
$filaForm2=new Fila([$lbl2,$inp2]);

$submit=new input('submit','submit','Enviar');
$filaForm3=new Fila([$submit]);

$tablaForm=new Tabla([$filaForm1,$filaForm2,$filaForm3],0);

$form1->addElemento($tablaForm);



$pweb->addElemento($titulo);
$pweb->addElemento($parrafo);
$pweb->addElemento($texto);
$pweb->addElemento($link);
$pweb->addElemento($tabla);
$pweb->addElemento($lista);
$pweb->addElemento($form1);


echo $pweb;

if(isset($_REQUEST['txtNombre']))
echo $_REQUEST['txtNombre'];