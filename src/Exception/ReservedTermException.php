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

namespace BrightNucleus\CustomContent\Exception;

use BrightNucleus\Exception\InvalidArgumentException;

/**
 * Class ReservedTermException.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class ReservedTermException extends InvalidArgumentException implements CustomContentException {

	/**
	 * Instantiate a ReservedTermException object.
	 *
	 * @since 0.1.0
	 *
	 * @param string $slug The slug of the custom content to be registered.
	 */
	public function __construct( $slug ) {
		$message = sprintf(
			'Cannot register content type for reserved term: %s',
			$slug
		);
		parent::__construct( $message );
	}
}
