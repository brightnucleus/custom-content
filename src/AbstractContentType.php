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
use BrightNucleus\CustomContent\Exception\ReservedTermException;
use BrightNucleus\Localization\LocalizationTrait;
use Doctrine\Common\Collections\Collection;

/**
 * Abstract class AbstractContentType.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class AbstractContentType implements Registerable {

	use ConfigTrait;
	use LocalizationTrait;

	/*
	 * Key that stores default values.
	 */
	const DEFAULTS = '_bn_custom_content_defaults_';

	/*
	 * Reserved terms that cannot be used as custom post type slug.
	 */
	const RESERVED_TERMS = [ ];

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
			get_class( $this )
		);

		$possiblePrefixes = [
			__CLASS__,
			__NAMESPACE__,
			$this->getClassWithoutNamespace( __CLASS__ ),
		];

		foreach ( $possiblePrefixes as $prefix ) {
			if ( $config->hasKey( $prefix ) ) {
				$config = $config->getSubConfig( $prefix );
			}
		}

		$mergedConfig = ConfigFactory::create(
			array_replace_recursive(
				$defaults->getArrayCopy(),
				$config->getArrayCopy()
			)
		);

		$this->processConfig( $mergedConfig );
	}

	/**
	 * Extract the non-qualified class name from a fully qualified class name.
	 *
	 * @since 0.1.0
	 *
	 * @param string $class Fully qualified class name.
	 * @return string Non-qualified class name.
	 */
	protected function getClassWithoutNamespace( $class ) {
		$path = explode( '\\', __CLASS__ );
		return array_pop( $path );
	}

	/**
	 * Register the Registerable asset.
	 *
	 * @since 0.1.0
	 *
	 * @param mixed $args Optional. Arguments to pass to register function.
	 * @throws ReservedTermException If the slug is a reserved term.
	 */
	public function register( $args = [ ] ) {
		foreach ( $this->getConfigKeys() as $slug ) {

			if ( $this->isReservedTerm( $slug ) ) {
				throw new ReservedTermException( $slug );
			}

			if ( static::DEFAULTS === $slug ) {
				continue;
			}

			$argsCollection = $this->prepareArguments( $slug, $args );
			$this->doRegistration( $slug, $argsCollection );
		}
	}

	/**
	 * Check whether a slug is a reserved term.
	 *
	 * @since 0.1.0
	 *
	 * @param string $slug Slug to check.
	 * @return bool Whether the term is reserved.
	 */
	protected function isReservedTerm( $slug ) {
		return in_array( $slug, static::RESERVED_TERMS, true );
	}

	/**
	 * Prepare the arguments and return a Collection of arguments.
	 *
	 * @since 0.1.0
	 *
	 * @param string $cpt  Slug of the custom content.
	 * @param array  $args Array of arguments to prepare.
	 * @return Collection Collection of arguments.
	 */
	abstract protected function prepareArguments( $cpt, array $args );

	/**
	 * Do the actual registration with WordPress.
	 *
	 * @since 0.1.0
	 *
	 * @param string     $cpt            Slug of the custom content.
	 * @param Collection $argsCollection Collection of arguments.
	 */
	abstract protected function doRegistration( $cpt, Collection $argsCollection );
}
