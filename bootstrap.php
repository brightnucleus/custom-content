<?php

require_once __DIR__ . '/vendor/autoload.php';

if ( ! function_exists( '__' ) ) {
	function __( $string, $textdomain ) {
		return $string;
	}
}

if ( ! function_exists( '_x' ) ) {
	function _x( $string, $context, $textdomain ) {
		return $string;
	}
}
