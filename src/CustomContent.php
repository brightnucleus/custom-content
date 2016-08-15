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

use BrightNucleus\Config\ConfigFactory;
use BrightNucleus\Config\ConfigInterface;
use BrightNucleus\Config\ConfigTrait;
use BrightNucleus\Config\Exception\FailedToProcessConfigException;
use BrightNucleus\Contract\Registerable;
use BrightNucleus\CustomContent\Exception\InvalidContentTypeException;
use BrightNucleus\CustomContent\Exception\ReservedTermException;
use BrightNucleus\Localization\LocalizationTrait;

/**
 * Class CustomContent.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class CustomContent implements Registerable {

	use ConfigTrait;
	use LocalizationTrait;

	/**
	 * Instantiate a CustomPostType object.
	 *
	 * @since 0.1.0
	 *
	 * @param ConfigInterface $config The configuration settings to use.
	 *
	 * @throws FailedToProcessConfigException If the configuration could not be
	 *                                        processed.
	 */
	public function __construct( ConfigInterface $config ) {
		$this->loadLocalization(
			'bn-custom-content',
			__DIR__ . '/../languages'
		);

		$defaults = ConfigFactory::createSubConfig(
			__DIR__ . '/../config/defaults.php',
			__NAMESPACE__
		);

		if ( $config->hasKey( __NAMESPACE__ ) ) {
			$config = $config->getSubConfig( __NAMESPACE__ );
		}

		$config = ConfigFactory::create(
			array_replace_recursive(
				$defaults->getArrayCopy(),
				$config->getArrayCopy()
			)
		);

		$this->processConfig( $config );
	}

	/**
	 * Register the Registerable asset.
	 *
	 * @since 0.1.0
	 *
	 * @param mixed $args Optional. Arguments to pass to register function.
	 * @throws ReservedTermException If a slug is a reserved term.
	 */
	public function register( $args = [ ] ) {
		foreach ( $this->getConfigKeys() as $contentType ) {
			$this->registerContentType(
				$contentType,
				$this->config->getSubConfig( $contentType )
			);
		}
	}

	/**
	 * Register a single content type.
	 *
	 * Possible content types:
	 * - 'CustomPostType'
	 * - 'CustomTaxonomy'
	 *
	 * @since 0.1.0
	 *
	 * @param string          $contentType Content type to register.
	 * @param ConfigInterface $config      Config to use for this content type.
	 * @throws ReservedTermException If a slug is a reserved term.
	 */
	protected function registerContentType( $contentType, ConfigInterface $config ) {

		$class = __NAMESPACE__ . '\\' . $contentType;

		if ( ! class_exists( $class ) ) {
			throw new InvalidContentTypeException( $contentType );
		}

		( new $class( $config ) )->register();
	}
}
