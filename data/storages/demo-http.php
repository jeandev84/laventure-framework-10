<?php
ob_start();
# https://www.php.net/manual/en/function.ob-get-contents.php
use Laventure\Component\Http\Message\Request\ServerRequest;
use Laventure\Component\Http\Message\Request\Uri;
use Laventure\Component\Http\Message\Response\Body\ResponseBody;
use Laventure\Component\Http\Message\Response\Response;
use Laventure\Component\Http\Message\Response\Status\ResponseStatus;
use Laventure\Component\Http\Message\Stream\Stream;

require 'vendor/autoload.php';

# dump("Content 1");
# dump("Content 2");


/*
$request = ServerRequest::fromGlobals();
dump($request);
*/

$request = ServerRequest::fromGlobals();


dump($request);

/*
$response = new Response();

$response->withHeaders([
    'Framework' => 'laventure'
]);

#$response->setContent('<h1>Hello world</h1>');
#$response->setContent('<h3>Salut les amis</h3>');

# $response->withStatus(204, 'Created now');

# $response->send();

echo $response;
*/

require __DIR__.'/views/form.php';
?>

