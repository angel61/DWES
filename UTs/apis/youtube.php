
    <link rel="stylesheet" href="youtube.css">
<?php
if (!filter_has_var(INPUT_POST, 'enviar')) {
    // Formulario para recoger palabras clave y nº de resultados a mostrar
    echo "
<form action='youtube.php' method='post'>
<h3>Palabras clave: </h3>
<input type='search' id='palabras' name='palabras'>
<h3>Maximo: </h3>
<input type='number' id='max' name='max' min='1' max='10' value='5'>
<br/><br/>
<input type='submit' name='enviar' value='Enviar'/>
</form>";
} else {
    // Incluimos los archivos de biblioteca necesarios
    require_once "API - Youtube/src/Google_Client.php";
    require_once "API - Youtube/src/contrib/Google_YouTubeService.php";
    // Recogemos las palabras clave y el maximo de resultados a mostrar
    $palabras = $_REQUEST['palabras'];
    $max = $_REQUEST['max'];
    // Para realizar la consulta creamos un objeto Google_Client con
    // nuestra clave de la API Google, y a continuación creamos un objeto
    // Google_YoutubeService asociado al cliente
    $key = 'AIzaSyCiQ6EncBFahWgpw96QKLPmMKZmwiMopXA';
    $cliente = new Google_Client();
    $cliente->setDeveloperKey($key);
    $youtube = new Google_YoutubeService($cliente);
    //Lanzamos la búsqueda
    try {
        $busqueda = $youtube->search->listSearch('id,snippet', array('q' => $palabras, 'maxResults' => $max));
        // Podemos ver la estructura de los resultados obtenidos
        // echo "<pre>";
        // print_r($busqueda);
        // echo "</pre>";
        // Almacenamos los resultados en tres string,
        // uno para cada tipo de elemento
        $videos = '';
        $canales = '';
        $listas = '';
        // Para cada resultado de búsqueda ($searchResponse['items'])
        // obtenemos su título y su id, y creamos un enlace
        // La forma de obtener el id depende del tipo de elemento
        // ( youtube#video, youtube#channel, youtube#playlist )
        foreach ($busqueda['items'] as $result) {
            $titulo = $result['snippet']['title'];
            $miniatura = $result['snippet']['thumbnails']['medium']['url'];
            switch ($result['id']['kind']) {
                case 'youtube#video':
                    $id = $result['id']['videoId'];
                    $enlace = "<a href=http://www.youtube.com/watch?v=" .
                        $id . " target=_blank><div class=\"enlace\"><img src=\"{$miniatura}\">  <span>{$titulo}</span></div </a>";
                    $videos .= sprintf('<li>%s</li>', $enlace);
                    break;
                case 'youtube#channel':
                    $id = $result['id']['channelId'];
                    $enlace = "<a href=http://www.youtube.com/channel/" .
                        $id . " target=_blank>" . $titulo . "</a>";
                    $canales .= sprintf('<li>%s (%s)</li>', $enlace, $id);
                    break;
                case 'youtube#playlist':
                    $id = $result['id']['playlistId'];
                    $enlace = "<a href=http://www.youtube.com/playlist?list=" .
                        $id . " target=_blank>" . $titulo . "</a>";
                    $listas .= sprintf('<li>%s (%s)</li>', $enlace, $id);
                    break;
            }
        } // Mostramos los resultados
        echo "
    <h3>Videos</h3> <ul>$videos</ul>";
        // Controlamos los posibles errores
    } catch (Google_ServiceException $e) {
        $error = sprintf('<p>A service error occurred:
    <code>%s</code></p>', htmlspecialchars($e->getMessage()));
        echo $error;
    } catch (Google_Exception $e) {
        $error = sprintf('<p>An client error occurred:
    <code>%s</code></p>', htmlspecialchars($e->getMessage()));
        echo $error;
    }
}
