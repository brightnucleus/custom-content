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
 * Class InvalidContentTypeException.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class InvalidContentTypeException extends InvalidArgumentException implements CustomContentException {

	/**
	 * Instantiate a InvalidContentTypeException object.
	 *
	 * @since 0.1.2
	 *
	 * @param string $contentType The custom content type that was requested.
	 */
	public function __construct( $contentType ) {
		$message = sprintf(
			'Invalid content type found in Config: %s',
			$contentType
		);
		parent::__construct( $message );
	}
}
