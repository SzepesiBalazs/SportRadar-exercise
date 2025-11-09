<?php

class Router
{
    private array $routes = [];

    public function get(string $path, callable|string $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, callable|string $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    public function put(string $path, callable|string $handler): void
    {
        $this->addRoute('PUT', $path, $handler);
    }

    public function delete(string $path, callable|string $handler): void
    {
        $this->addRoute('DELETE', $path, $handler);
    }

    private function addRoute(string $method, string $path, callable|string $handler): void
    {
        $this->routes[] = [
            'method' => $method,
            'path'   => $path,
            'handler' => $handler
        ];
    }

    public function run(): void
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $uri) {
                $handler = $route['handler'];

                if (is_string($handler) && file_exists($handler)) {
                    require $handler;
                }
                elseif (is_callable($handler)) {
                    call_user_func($handler);
                } else {
                    http_response_code(500);
                    echo json_encode(['error' => 'Invalid route handler']);
                }
                return;
            }
        }

        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Endpoint not found']);
    }
}
