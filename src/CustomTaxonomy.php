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

namespace BrightNucleus\CustomContent;

use BrightNucleus\CustomContent\CustomTaxonomy\Argument;
use BrightNucleus\CustomContent\CustomTaxonomy\ArgumentCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Class CustomTaxonomy.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class CustomTaxonomy extends AbstractContentType {

	/*
	 * Reserved terms that cannot be used as custom taxonomy slug.
	 */
	const RESERVED_TERMS = [
		'post',
		'page',
		'attachment',
		'revision',
		'nav_menu_item',
		'action',
		'author',
		'order',
		'theme',
	];

	/**
	 * Prepare the arguments and return a Collection of arguments.
	 *
	 * @since 0.1.0
	 *
	 * @param string $cpt  Slug of the custom content.
	 * @param array  $args Array of arguments to prepare.
	 * @return Collection Collection of arguments.
	 */
	protected function prepareArguments( $cpt, array $args ) {
		$defaults = $this->getConfigKey( static::DEFAULTS );

		return ( new ArgumentCollection(
			array_replace_recursive( $defaults, $this->getConfigKey( $cpt ),
				$args )
		) )->prepareLabels();
	}

	/**
	 * Do the actual registration with WordPress.
	 *
	 * @since 0.1.0
	 *
	 * @param string     $cpt            Slug of the custom content.
	 * @param Collection $argsCollection Collection of arguments.
	 */
	protected function doRegistration( $cpt, Collection $argsCollection ) {
		/** @var ArgumentCollection $argsCollection */
		register_taxonomy(
			$cpt,
			$argsCollection->get( Argument::POST_TYPES ),
			$argsCollection->toArray()
		);
	}
}
