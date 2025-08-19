<?php
/**
 * Bright Nucleus Custom Content Component.
 *
 * @package   BrightNucleus\CustomContent
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      http://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\CustomContent\Tests;

use Brain\Monkey;
use Brain\Monkey\Functions;
use Yoast\PHPUnitPolyfills\TestCases\TestCase as PolyfilledTestCase;

class TestCase extends PolyfilledTestCase
{
	protected function set_up() {
		parent::set_up();
		Monkey\setUp();
		
		Functions\stubs([
            'is_textdomain_loaded' => function($domain) {
                return false;
            },
            'get_locale' => function() {
                return 'en_US';
            },
            'apply_filters' => function($filter, $value) {
                return $value;
            },
            'load_textdomain' => function($domain, $mofile) {
                return true;
            },
			'__' => function($text, $domain = 'default') {
				return $text;
			},
			'_e' => function($text, $domain = 'default') {
				echo $text;
			},
			'_x' => function($text, $context, $domain = 'default') {
				return $text;
			},
			'_ex' => function($text, $context, $domain = 'default') {
				echo $text;
			},
			'_n' => function($single, $plural, $number, $domain = 'default') {
				return $number === 1 ? $single : $plural;
			},
			'_nx' => function($single, $plural, $number, $context, $domain = 'default') {
				return $number === 1 ? $single : $plural;
			},
			'esc_html__' => function($text, $domain = 'default') {
				return htmlspecialchars($text);
			},
			'esc_html_e' => function($text, $domain = 'default') {
				echo htmlspecialchars($text);
			},
			'esc_html_x' => function($text, $context, $domain = 'default') {
				return htmlspecialchars($text);
			},
			'esc_attr__' => function($text, $domain = 'default') {
				return esc_attr($text);
			},
			'esc_attr_e' => function($text, $domain = 'default') {
				echo esc_attr($text);
			},
			'esc_attr_x' => function($text, $context, $domain = 'default') {
				return esc_attr($text);
			},
			'esc_attr' => function($text) {
				return htmlspecialchars($text, ENT_QUOTES);
			}
		]);
	}

	protected function tear_down() {
		Monkey\tearDown();
		parent::tear_down();
	}
}
