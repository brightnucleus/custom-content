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

	/*
	 * Key that stores default values.
	 */
	const DEFAULTS = '_cpt_defaults_';

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
		foreach ( $this->getConfigKeys() as $cpt ) {

			if ( $this->isReservedTerm( $cpt ) ) {
				throw new ReservedTermException(
					'Cannot register content type for reserved term: ' . $cpt
				);
			}

			if ( static::DEFAULTS === $cpt ) {
				continue;
			}

			$argsCollection = $this->prepareArguments( $cpt, $args );
			$this->doRegistration( $cpt, $argsCollection );
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
	abstract protected function isReservedTerm( $slug );

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
