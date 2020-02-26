<?php

use Opis\Database\Database;
use Opis\Database\Connection;

class Init {

    /*
	 * Class Properties Declaration
	 */

    public $environment;
    public $capsule;
    public $controller_path;
    public $req_controller;
    public $req_model;
    public $view_render;
    public $req_param;
    public $req_method;
    public $load;
    const CONFIG = [
        'ram_per_study_in_gb' => .5/1000,
        'price_ram_per_gb_hour' => 0.00553,
        'storage_price_per_gb' => 0.10,
        'storage_per_story_gb' => 10/1000
    ];

    /**
     *Split server path request into Array
     *@return capsule;
     */
    public function path_split($path) {
        $this->capsule = explode('/', ltrim($path));
        return $this->capsule;
    }

    /**
     *Checks is url results to a trailing Slash
     *@return bool;
     */
    public static function is_slash($path) {
        /**
         *Is path = '/'
         *@return true;
         */
        if ($path == '/') {

            return true;
        }
        /**
         *Is path != '/'
         *@return false;
         */
        else {
            return false;
        }
    }

    public static function view($template_name, $data = array()) {
        $loader = new Twig_Loader_Filesystem('views');
        $twig = new Twig_Environment($loader);

        $template = $twig->loadTemplate($template_name . '.html');
        echo $template->render($data);
    }
}
