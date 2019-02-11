<?php

namespace Notoro\framework\renderer;

class Renderer
{
    public $viewsPath = "";

    public function __construct(string $viewsPath)
    {
        $this->viewsPath = $viewsPath;
    }

    public function render(string $view, array $params = [])
    {
        ob_start();
        $params['renderer'] = \getContainer()->get('Renderer');
        extract($params);
        $view = str_replace('.', DIRECTORY_SEPARATOR, $view);
        $path = $this->viewsPath.'/'.$view.'.view.php';
        require($path);
        return ob_get_clean();
    }
}
