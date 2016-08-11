<?php
/**
 * Bright Nucleus Custom Content.
 *
 * Config-driven WordPress Custom Post Types And Custom Taxonomies.
 *
 * @package   BrightNucleus\CustomContent
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      https://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\CustomContent\CustomPostType;

/**
 * Class MenuPosition.
 *
 * Constants to use for defining menu position.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\CustomContent\CustomPostType
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class MenuPosition {

	const BELOW_POSTS            = 5;
	const BELOW_MEDIA            = 10;
	const BELOW_LINKS            = 15;
	const BELOW_PAGES            = 20;
	const BELOW_COMMENTS         = 25;
	const BELOW_FIRST_SEPARATOR  = 60;
	const BELOW_PLUGINS          = 65;
	const BELOW_USERS            = 70;
	const BELOW_TOOLS            = 75;
	const BELOW_SETTINGS         = 80;
	const BELOW_SECOND_SEPARATOR = 100;
}
