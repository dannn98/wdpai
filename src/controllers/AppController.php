<?php

class AppController {

    private $request;
    protected $segments;

    public function __construct($segments)
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
        $this->segments = $segments;
        $this->repositories();
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
            return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = []) {
        $templatePath = 'public/views/'.$template.'.php';
        $output = 'File not found';

        if(file_exists($templatePath)) {
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }

    protected function redirect($direct) {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/{$direct}");
    }

    protected function repositories(){

    }
}