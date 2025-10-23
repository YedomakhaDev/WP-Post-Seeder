<?php

namespace WPPS\Generator;

use Faker\Factory;

class ContentProvider {
    private $faker;

    public function __construct() {
        $this->faker = Factory::create();
    }

    public function getTitle() { }
    public function getContent() { }
    public function getExcerpt() { }
}
?>