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
 * Class Capability.
 *
 * Constants to use for setting the custom taxonomy's capabilities.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\CustomContent\CustomTaxonomy
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class Capability {

	const MANAGE_TERMS = 'manage_terms';
	const EDIT_TERMS   = 'edit_terms';
	const DELETE_TERMS = 'delete_terms';
	const ASSIGN_TERMS = 'assign_terms';
}
