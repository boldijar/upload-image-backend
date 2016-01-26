<?php
require_once 'vendor/autoload.php';
require_once 'FileHelper.php';

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
$app = new Silex\Application();

$app->post('/upload', function (Request $request) use ($app){
	// get file from requests
	$file = $request->files->get('image');
	// if null return error
	if ($file==null) {
		$obj=new stdClass();
		$obj->success=false;
		$obj->error="No image provided";
	 	return json_encode($obj);
	}
	// upload the file and return the json with the data
	return json_encode(FileHelper::writeFile($file));
});
$app->run();

?>
