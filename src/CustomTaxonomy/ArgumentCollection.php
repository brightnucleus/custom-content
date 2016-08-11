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

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ArgumentCollection.
 *
 * Collection of arguments to pass into custom taxonomy registration.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\CustomContent\CustomTaxonomy
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class ArgumentCollection extends ArrayCollection {

	/**
	 * Prepare the labels to be passed into the custom taxonomy registration.
	 *
	 * @since 0.1.0
	 *
	 * @return self
	 */
	public function prepareLabels() {
		$this[ Argument::LABELS ] = $this->doReplacements( $this[ Argument::LABELS ] );

		return $this;
	}

	/**
	 * Do the `sprintf()` replacements.
	 *
	 * @since 0.1.0
	 *
	 * @param array $array Array of strings to transform.
	 * @return array Array of transformed strings.
	 */
	protected function doReplacements( array $array ) {
		$args = [
			$this[ Argument::NAMES ][ Name::SINGULAR_NAME_UC ],
			$this[ Argument::NAMES ][ Name::SINGULAR_NAME_LC ],
			$this[ Argument::NAMES ][ Name::PLURAL_NAME_UC ],
			$this[ Argument::NAMES ][ Name::PLURAL_NAME_LC ],
		];

		foreach ( $array as $key => $string ) {
			$array[ $key ] = sprintf( $string, ...$args );
		}

		return $array;
	}
}
