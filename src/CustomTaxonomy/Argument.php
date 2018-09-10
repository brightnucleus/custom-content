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

namespace BrightNucleus\CustomContent\CustomTaxonomy;

/**
 * Class Argument.
 *
 * Constants to use for setting the arguments to pass to register function.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\CustomContent\CustomTaxonomy
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class Argument {

	/*
	 * WordPress custom taxonomy registration arguments.
	 * See https://codex.wordpress.org/Function_Reference/register_taxonomy
	 */

	const LABEL                 = 'label';
	const LABELS                = 'labels';
	const IS_PUBLIC             = 'public'; // Inconsistent naming to avoid PHP error.
	const PUBLICLY_QUERYABLE    = 'publicly_queryable';
	const SHOW_UI               = 'show_ui';
	const SHOW_IN_MENU          = 'show_in_menu';
	const SHOW_IN_NAV_MENUS     = 'show_in_nav_menus';
	const SHOW_TAGCLOUD         = 'show_tagcloud';
	const SHOW_IN_QUICK_EDIT    = 'show_in_quick_edit';
	const META_BOX_CB           = 'meta_box_cb';
	const SHOW_ADMIN_COLUMN     = 'show_admin_column';
	const DESCRIPTION           = 'description';
	const HIERARCHICAL          = 'hierarchical';
	const UPDATE_COUNT_CALLBACK = 'update_count_callback';
	const QUERY_VAR             = 'query_var';
	const REWRITE               = 'rewrite';
	const CAPABILITIES          = 'capabilities';
	const SORT                  = 'sort';
	const _BUILTIN              = '_builtin';

	/*
	 * Bright Nucleus Custom Taxonomy component additional arguments.
	 */

	// Array of single and plural names in upper- and lower-case versions.
	// Keys: 'uc_plural_name'
	//       'uc_singular_name'
	//       'lc_plural_name'
	//       'lc_singular_name'
	const NAMES = '_names_';

	// Array of post types with which to register the taxonomy.
	const POST_TYPES = '_post_types_';
}
