<?php

namespace WPPS\Core;

use WPPS\Admin\Page;
use WPPS\Admin\Ajax;
use WPPS\Generator\PostGenerator;

class Loader {
    public static function init() {
        Page::init();
        Ajax::init();
        PostGenerator::init();
    }
}
