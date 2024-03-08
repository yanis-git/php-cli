#!/usr/bin/env php
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Dotenv\Dotenv;
use App\Application\App;

$baseDir = realpath(__DIR__);
$envFile = sprintf('%s/.env', $baseDir);
$configDir = sprintf('%s/config', $baseDir);

$dotenv = new Dotenv();
if (!file_exists($envFile)) {
    throw new RuntimeException('No .env file found. Please create one by copying .env.example.');
}
$dotenv->load($envFile);

$container = new ContainerBuilder();
$container->setParameter('base_dir', $baseDir);
$loader = new YamlFileLoader($container, new FileLocator($configDir));

$loader->load('services.yaml');
$container->compile(resolveEnvPlaceholders: true);

$app = $container->get(App::class);
$app->run();
