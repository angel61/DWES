<link rel="stylesheet" href="css/youtube.css">
<?php
if (!filter_has_var(INPUT_POST, 'enviar')) {
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

    require_once "API - Youtube/src/Google_Client.php";
    require_once "API - Youtube/src/contrib/Google_YouTubeService.php";

    $palabras = $_REQUEST['palabras'];
    $max = $_REQUEST['max'];

    $key = 'AIzaSyCiQ6EncBFahWgpw96QKLPmMKZmwiMopXA';
    $cliente = new Google_Client();
    $cliente->setDeveloperKey($key);
    $youtube = new Google_YoutubeService($cliente);

    try {
        $busqueda = $youtube->search->listSearch('id,snippet', array('q' => $palabras, 'maxResults' => $max));
        $videos = '';
        foreach ($busqueda['items'] as $result) {
            $titulo = $result['snippet']['title'];
            $miniatura = $result['snippet']['thumbnails']['medium']['url'];
            switch ($result['id']['kind']) {
                case 'youtube#video':
                    $id = $result['id']['videoId'];
                    $enlace = "<a href=http://www.youtube.com/watch?v=" .
                        $id . " target=_blank><div class=\"enlace\"><img src=\"{$miniatura}\">  <span>{$titulo}</span></div </a>";
                    $videos .=  "<div>{$enlace}</div>";
                    break;
            }
        }
        echo "<div class='contenedor'>$videos</div>";
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
