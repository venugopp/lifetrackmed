<?php

/** Autoloading The required Classes **/

class IndexController {

    private $model;
    function __construct($tile) {
        /** Loading the corresponding Model class **/
        $this->model = new $tile;
    }

    /**
     * Landing page.
     */
    public function index() {
        /** Initializing a index.html view Found in (Views/index.html) **/
        Init::view('index', [
            'pageTitle' => 'Cost Estimator'
        ]);
    }

    /**
     * Ajax callback.
     */
    public function calculate() {
        $number_of_stories = $_POST['numberofstudy'] ?? 0;
        $studygrowth = $_POST['studygrowth'] ?? 0;
        $forecast = $_POST['forecast'] ?? 0;
        $result = $this->model->calculate(Init::CONFIG, $number_of_stories, $studygrowth, $forecast);
        Init::view('main/data', array(
            'results' => $result,
        ));
    }
}
