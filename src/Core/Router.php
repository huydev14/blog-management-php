<?php

namespace Core;

class Router
{
    protected $routers = [];

    // Register routes
    public function get($url, $action)
    {
        $this->routers['GET'][$url] = $action;
    }

    public function post($url, $action)
    {
        $this->routers['POST'][$url] = $action;
    }

    public function getRoute()
    {
        return $this->routers;
    }

    // Dispatch
    public function dispatch($method, $url)
    {
        $url = $url ?: '/'; // If url is empty, return '/'
        $method = strtoupper((string)$method); // normalize method
        $statusCode = 0;
        $message = '';

        if (!isset($this->routers[$method][$url])) {
            $statusCode = 404;
            $message = '404 ERROR';
        } else {
            [$statusCode, $message] = $this->resolveAction($url, $this->routers[$method][$url]);
        }

        if ($statusCode > 0) {
            $this->respondError($statusCode, $message);
        }
    }

    private function resolveAction(string $url, string $action): array
    {
        $statusCode = 0;
        $message = '';

        if (strpos($action, '@') === false) {
            $statusCode = 500;
            $message = 'Invalid route action';
        } else {
            [$controller, $func] = explode('@', $action, 2);
            $fqcn = $this->resolveControllerClass($url, $controller);

            if (!class_exists($fqcn)) {
                $statusCode = 500;
                $message = 'Controller class not found: ' . $fqcn;
            } else {
                $instance = new $fqcn();
                if (!method_exists($instance, $func)) {
                    $statusCode = 404;
                    $message = 'Action not found';
                } else {
                    $this->invokeController($instance, $func);
                }
            }
        }

        return [$statusCode, $message];
    }

    private function resolveControllerClass(string $url, string $controller): string
    {
        $publicRoutes = ['/', '/post', '/post/comment', '/archive', '/about', '/category', '/search'];
        $namespace = in_array($url, $publicRoutes)
            ? 'App\\Controllers\\Client\\'
            : 'App\\Controllers\\Admin\\';

        return $namespace . $controller;
    }

    private function invokeController(object $instance, string $func): void
    {
        if ($instance instanceof Controller) {
            $instance->executeAction($func);
            return;
        }

        $instance->$func();
    }

    private function respondError(int $statusCode, string $message): void
    {
        http_response_code($statusCode);
        echo $message;
    }
}
