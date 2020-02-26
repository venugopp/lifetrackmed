<?php
/** Autoloading The required Classes **/


class IndexModel
{
    function __construct() {

    }

    /**
     * Helper method for calculating the result.
     *
     * @param Array $config
     * @param Integer $stories
     * @param Integer $studygrowth
     * @param Integer $forecast
     * @return Array
     */
    public function calculate($config, $stories, $studygrowth, $forecast) {
        $ram_per_study_in_gb = $config['ram_per_study_in_gb'];
        $price_ram_per_gb_hour = $config['price_ram_per_gb_hour'];
        $storage_price_per_gb = $config['storage_price_per_gb'];
        $storage_per_story_gb = $config['storage_per_story_gb'];

        $month_count = 0;
        while ($forecast >= 1) {
            if (empty($number_of_stories)) {
                $number_of_stories = $stories;
            } else {
                $growth_stories = $number_of_stories * $studygrowth / 100;
            }
            $number_of_stories += $growth_stories;
            $ram_required = $number_of_stories * $ram_per_study_in_gb;
            $storage_required = $number_of_stories * $storage_per_story_gb;
            // Cost of RAM for a day.
            $cost_of_ram = $ram_required * $price_ram_per_gb_hour * 24;
            // Cost of Storage for a month.
            $cost_of_storage = $storage_required * $storage_price_per_gb;

            $cost = $cost_of_ram + $cost_of_storage;

            $return[] = [
                'date' => date("M Y", strtotime('+' . $month_count . ' month')),
                'studies' => number_format($number_of_stories),
                'cost' => '$' . number_format($cost, 2),
            ];
            $month_count++;
            $forecast--;
        }

        return $return;
    }
}
