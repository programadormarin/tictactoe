<?php

namespace Hmarinjr\TicTacToe;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    private const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    public function getCacheDir(): string
    {
        return $this->getProjectDir() . '/var/cache/' . $this->environment;
    }

    public function getLogDir(): string
    {
        return $this->getProjectDir() . '/var/log';
    }

    public function registerBundles(): iterable
    {
        $contents = require $this->getProjectDir() . '/config/bundles.php';
        foreach ($contents as $class => $envs) {
            if (isset($envs['all']) || isset($envs[$this->environment])) {
                yield new $class();
            }
        }
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->parameters()->set('container.autowiring.strict_mode', true);
        $container->parameters()->set('container.dumper.inline_class_loader', true);
        
        $confDir = $this->getProjectDir() . '/config';
        
        $container->import($confDir . '/packages/*.{php,xml,yaml,yml}');
        $container->import($confDir . '/packages/'.$this->environment.'/*.{php,xml,yaml,yml}');
        
        $container->import($confDir . '/services.{php,xml,yaml,yml}');
        $container->import($confDir . '/services_'.$this->environment.'.{php,xml,yaml,yml}');
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $confDir = $this->getProjectDir() . '/config';
        
        $routes->import($confDir . '/routes/*.{php,xml,yaml,yml}');
        $routes->import($confDir . '/routes/'.$this->environment.'/*.{php,xml,yaml,yml}');
        $routes->import($confDir . '/routes.{php,xml,yaml,yml}');
    }
}
