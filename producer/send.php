<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$name = $_POST['name'];
$message = $_POST['message'];

$connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

$msg = new AMQPMessage("{\"name\": \"$name\", \"message\": \"$message\"}");
$channel->basic_publish($msg, '', 'hello');


echo " [x] Sent $message from $name\n";