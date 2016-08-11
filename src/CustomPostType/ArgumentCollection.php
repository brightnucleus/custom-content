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

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ArgumentCollection.
 *
 * Collection of arguments to pass into CPT registration.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\CustomContent\CustomPostType
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class ArgumentCollection extends ArrayCollection {

	/**
	 * Prepare the labels to be passed into the CPT registration.
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
	 * Prepare the labels to be passed into the CPT registration.
	 *
	 * @since 0.1.0
	 *
	 * @return self
	 */
	public function prepareLinks() {
		$this[ Argument::LINKS ] = $this->doReplacements( $this[ Argument::LINKS ] );

		return $this;
	}

	/**
	 * Prepare the messages to be passed into the CPT registration.
	 *
	 * @since 0.1.0
	 *
	 * @return self
	 */
	public function prepareMessages() {
		$this[ Argument::MESSAGES ] = $this->doReplacements( $this[ Argument::MESSAGES ] );

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
			0 => $this[ Argument::NAMES ][ Name::SINGULAR_NAME_UC ],
			1 => $this[ Argument::NAMES ][ Name::SINGULAR_NAME_LC ],
			2 => $this[ Argument::NAMES ][ Name::PLURAL_NAME_UC ],
			3 => $this[ Argument::NAMES ][ Name::PLURAL_NAME_LC ],
		];

		foreach ( $array as $key => $string ) {

			// Add fifth argument for strings that need additional data.
			switch ( $key ) {
				case Message::REVISION_RESTORED:

					if ( ! isset( $_GET['revision'] ) ) {
						$array[ $key ] = false;
						continue 2;
					}

					$args[4] = wp_post_revision_title(
						(int) filter_input(
							INPUT_GET,
							'revision',
							FILTER_SANITIZE_NUMBER_INT
						),
						false
					);

					break;

				case Message::ELEMENT_SCHEDULED:
					$post = get_post();

					$args[4] = date_i18n( __( 'M j, Y @ G:i',
						'bn-custom-content' ),
						strtotime( $post->post_date ) );

					break;

				default:
					if ( isset( $args[4] ) ) {
						unset( $args[4] );
					}
			}

			$array[ $key ] = sprintf( $string, ...$args );
		}

		return $array;
	}
}
