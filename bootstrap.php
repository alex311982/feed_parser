<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__.'/vendor/autoload.php';

// The check is to ensure we don't use .env in production
if (!isset($_SERVER['APP_ENV'])) {
    if (!class_exists(Dotenv::class)) {
        throw new \RuntimeException('APP_ENV environment variable is not defined. You need to define environment variables for configuration or add "symfony/dotenv" as a Composer dependency to load variables from a .env file.');
    }
    (new Dotenv())->load(__DIR__.'/.env');
}

$env = $_SERVER['APP_ENV'] ?? 'dev';

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/config'));
$loader->load('services.yml');

$container->set(
    'app.container',
    $container
);

$container->set(
    'app.parameterBag',
    $container->getParameterBag()
);

$container->setParameter('twitter_access_token', getenv('TWITTER_ACCESS_TOKEN'));
$container->setParameter('twitter_access_token_secret', getenv('TWITTER_ACCESS_TOKEN_SECRET'));
$container->setParameter('twitter_consumer_key', getenv('TWITTER_CONSUMER_KEY'));
$container->setParameter('twitter_consumer_secret', getenv('TWITTER_CONSUMER_SECRET'));

$encoders = [new JsonEncoder()];
$normalizers = [new ObjectNormalizer()];

$serializer = new Serializer($normalizers, $encoders);

$container->set(
    'app.serializer',
    $serializer
);

$container->compile();

$container->get('symfony.event_dispatcher')->addListener('twitter.feed_update', $container->get('feed.twitter_stream_handler_listener'));
