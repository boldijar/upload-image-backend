<?php
require_once 'vendor/autoload.php';
require_once 'FileHelper.php';


use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
$app = new Silex\Application();


$app->get('/hello', function ( Application $app, Request $request) use ($app) {
	return "Sup";
});

$app->get('/version', function ( Application $app, Request $request) use ($app) {
	$obj = new stdClass();
  $obj->name="1.0.0";
  $obj->stable=true;
  return json_encode($obj);
});

$app->post('/upload', function (Request $request) use ($app){
	$file = $request->files->get('image');
	if ($file==null) {
		return "no file";
	}
	FileHelper::writeFile($file);
	return "done";
});

// $app->get('/suggestion', function ( Application $app, Request $request) use ($app) {
// 		$question= $request->query->get('question');
// 		global $answerController;
// 		return createResponse($answerController->getAnswer($question));
// });


function createResponse($object){
		$response = new Response();
		$response->setContent(json_encode($object));
		$response->setStatusCode(200);
	  $response->headers->set("Access-Control-Allow-Origin","*");
    $response->headers->set("Access-Control-Allow-Methods","GET,POST,PUT,DELETE,OPTIONS");
    $response->headers->set("Content-Type","application/json; charset=UTF-8 ");
    return $response;
}


$app->run();

?>
