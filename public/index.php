<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use \Source\Ahorcado;
use \Source\TemplateEngine as TE;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
session_start();

// To help the built-in PHP dev server, check if the request was actually for
// something which should probably be served as a static file
if (PHP_SAPI == 'cli-server') {
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) return false;
}
if(!isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
}

$te = new TE("../templates/fullpage.template");
$te->addVariable("score",$_SESSION['score']);

$app->get('/', function (Request $request, Response $response, array $args) use ($te) {
    $newForm = new TE("../templates/newForm.template");
    $newForm->addVariable("score", $_SESSION['score']);
    $te->addVariable("content", $newForm->render());
    $response->getBody()->write($te->render());
    return $response;
});
$app->post('/empezarJuego', function (Request $request, Response $response, array $args) {
    if(isset($_POST['palabra']) && isset($_POST['vidas']) && $_POST['vidas'] > 0 ){
        $_SESSION['palabra'] = strtolower($_POST['palabra'])    ;
        $_SESSION['vidas'] = $_POST['vidas'];
    }
    return $response->withStatus(302)->withHeader("Location", "jugar");
});
$app->get('/jugar', function (Request $request, Response $response, array $args) use ($te) {
    $ahorcado = new Ahorcado($_SESSION['palabra'],$_SESSION['vidas']);
    foreach($_SESSION['letrasJugadas'] as $v){
        $ahorcado->jugar($v);
    }
    if($ahorcado->gano()){
        $_SESSION['score'] +=1;
        $res = new TE("../templates/res.template");
        $res->addVariable("res", "Ganaste");
        $te->addVariable("score", $_SESSION['score']);
        $te->addVariable("content", $res->render());
    }elseif($ahorcado->perdio()){
        $_SESSION['score'] -=1;
        $res = new TE("../templates/res.template");
        $res->addVariable("res", "Perdiste");
        $te->addVariable("score", $_SESSION['score']);
        $te->addVariable("content", $res->render());
    }else{ // si no gane y no perdi entonces juego
        $game = new TE("../templates/game.template");
        $game->addVariable("palabra", $ahorcado->mostrar());
        echo "";
        $vidasTotales = "";
        for($i=0;$i<$ahorcado->intentosRestantes();$i++){
            $vida = new TE("../templates/corazon.template");
            $vidasTotales .= $vida->render();
        }
        $game->addVariable("vidas",$vidasTotales);
        $game->addVariable("letrasJugadas",implode(",", $_SESSION['letrasJugadas']));
        $botonLetras = "";
        foreach (range('a', 'z') as $char) {
            $upperChar = strtoupper($char);
            if (in_array($char, $_SESSION['letrasJugadas'])){
                $letra = new TE("../templates/letraJugada.template");
                $letra->addVariable("letraMayus", $upperChar);
            }else{
                $letra = new TE("../templates/letra.template");
                $letra->addVariable("letra", $char);
                $letra->addVariable("letraMayus", $upperChar);
            }
            $botonLetras .= $letra->render();
        }
        $game->addVariable("letrasJugadas", $botonLetras);
        $te->addVariable("content", $game->render());
    }
    $response->getBody()->write($te->render());
    return $response;
});
$app->get('/jugar/{letra}', function (Request $request, Response $response, array $args) {
    $_SESSION['letrasJugadas'][] = $args['letra'];
    return $response->withStatus(302)->withHeader("Location", "/jugar");
});
$app->post('/reiniciar', function (Request $request, Response $response, array $args) {
    unset($_SESSION['letrasJugadas']);
    unset($_SESSION['palabra']);
    unset($_SESSION['vidas']);
    return $response->withStatus(302)->withHeader("Location", "/");
});


$app->run();
