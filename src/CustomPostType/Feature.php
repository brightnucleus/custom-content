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
 * Class Feature.
 *
 * Constants to use for declaring supported features.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\CustomContent\CustomPostType
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class Feature {

	const AUTHOR          = 'author';
	const COMMENTS        = 'comments';
	const CUSTOM_FIELDS   = 'custom-fields';
	const EDITOR          = 'editor';
	const EXCERPT         = 'excerpt';
	const PAGE_ATTRIBUTES = 'page-attributes';
	const POST_FORMATS    = 'post-formats';
	const REVISIONS       = 'revisions';
	const THUMBNAIL       = 'thumbnail';
	const TITLE           = 'title';
	const TRACKBACKS      = 'trackbacks';
}
