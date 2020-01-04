<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 2/9/2019
 * Time: 12:16 AM.
 */

namespace Notoro\framework\services;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        /** registering app's routes */
        $this->linkRoutes(routes_folder() . '/web.php');

        /** registering app middlewares array from config folder */
        $this->pipeMiddlewares(config_folder() . '/middlewares.php');

    }
}
