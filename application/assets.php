<?php

use \Laravel\Asset;

// Default-Styles
Asset::add('bootstrap.css', 'css/bootstrap.min.css');
Asset::add('my-before-bootstrap-responsive.css', 'css/my-before-bootstrap-responsive.css', 'bootstrap.css');
Asset::add('font-awesome.css', 'css/font-awesome.min.css', 'my-before-bootstrap-responsive.css');
Asset::add('bootstrap-responsive.css', 'css/bootstrap-responsive.min.css', 'font-awesome.css');
Asset::add('my.css', 'css/my.css', 'bootstrap-responsive.css');

// Default-Scripts
Asset::add('jquery.js', 'js/jquery.min.js');
Asset::add('bootstrap.js', 'js/bootstrap.min.js', 'jquery.js');

// jquery.highlight-Script (benötigt jquery)
Asset::container('jquery.highlight')->add('jquery.highlight.js', 'js/jquery.highlight.closure.js');