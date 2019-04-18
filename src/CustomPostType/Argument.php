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
 * Class Argument.
 *
 * Constants to use for setting the arguments to pass to register function.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\CustomContent\CustomPostType
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class Argument {

	/*
	 * WordPress CPT registration arguments.
	 * See https://codex.wordpress.org/Function_Reference/register_post_type
	 */

	const LABEL                 = 'label';
	const LABELS                = 'labels';
	const DESCRIPTION           = 'description';
	const IS_PUBLIC             = 'public'; // Inconsistent naming to avoid PHP error.
	const EXCLUDE_FROM_SEARCH   = 'exclude_from_search';
	const PUBLICLY_QUERYABLE    = 'publicly_queryable';
	const SHOW_UI               = 'show_ui';
	const SHOW_IN_NAV_MENUS     = 'show_in_nav_menus';
	const SHOW_IN_MENU          = 'show_in_menu';
	const SHOW_IN_ADMIN_BAR     = 'show_in_admin_bar';
	const MENU_POSITION         = 'menu_position';
	const MENU_ICON             = 'menu_icon';
	const CAPABILITY_TYPE       = 'capability_type';
	const CAPABILITIES          = 'capabilities';
	const MAP_META_CAP          = 'map_meta_cap';
	const HIERARCHICAL          = 'hierarchical';
	const SUPPORTS              = 'supports';
	const REGISTER_META_BOX_CB  = 'register_meta_box_cb';
	const TAXONOMIES            = 'taxonomies';
	const HAS_ARCHIVE           = 'has_archive';
	const PERMALINK_EPMASK      = 'permalink_epmask';
	const REWRITE               = 'rewrite';
	const QUERY_VAR             = 'query_var';
	const CAN_EXPORT            = 'can_export';
	const SHOW_IN_REST          = 'show_in_rest';
	const REST_BASE             = 'rest_base';
	const REST_CONTROLLER_CLASS = 'rest_controller_class';
	const _BUILTIN              = '_builtin';
	const _EDIT_LINK            = '_edit_link';

	/*
	 * Additional block editor registration arguments.
	 * See https://wordpress.org/gutenberg/handbook/designers-developers/developers/block-api/block-templates/#custom-post-types
	 */
	const TEMPLATE      = 'template';
	const TEMPLATE_LOCK = 'template_lock';
	
	/*
	 * Bright Nucleus Custom Post Type component additional arguments.
	 */

	// Array of single and plural names in upper- and lower-case versions.
	// Keys: 'uc_plural_name'
	//       'uc_singular_name'
	//       'lc_plural_name'
	//       'lc_singular_name'
	const NAMES = '_names_';

	// Edit form messages.
	// See the "Customizing the messages." example at
	// https://codex.wordpress.org/Function_Reference/register_post_type#Example
	const MESSAGES = '_messages_';

	// Links that are appended to some messages.
	const LINKS = '_links_';
}
