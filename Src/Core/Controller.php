<?php

class Controller
{

    protected function view(string $view, array $info = []): void
    {

        $view_path = plugin_dir_path(__DIR__) . "Views/{$view}.php";

        if (file_exists($view_path)) {

            extract($info);
            include $view_path;
        } else {

            echo "View not found";
        }
    }

    protected function loadRepository(string $repository)
    {

        $repository_path = plugin_dir_path(__DIR__) . "Repo/{$repository}.php";
        if (file_exists($repository_path)) {

            include_once $repository_path;
            return new $repository();
        }

        return null;
    }
}
