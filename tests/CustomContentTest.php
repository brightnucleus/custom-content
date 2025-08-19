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

namespace BrightNucleus\CustomContent\Tests;

use BrightNucleus\CustomContent\CustomPostType\Argument as CPTArgument;
use BrightNucleus\CustomContent\CustomPostType\Name as CPTName;
use BrightNucleus\CustomContent\CustomTaxonomy\Argument as TaxArgument;
use BrightNucleus\CustomContent\CustomTaxonomy\Name as TaxName;
use BrightNucleus\CustomContent\CustomContent;
use BrightNucleus\Config\ConfigFactory;
use Brain\Monkey\Functions;
use Mockery;

/**
 * Class CustomContentTest.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class CustomContentTest extends TestCase {

	/**
	 * Test whether the class can be instantiated.
	 *
	 * @since 0.1.0
	 * @covers \BrightNucleus\CustomContent\CustomContent::__construct
	 */
	public function testClassInstantiation() {
		$config = ConfigFactory::create( [ ] );
		$object = new CustomContent( $config );
		$this->assertInstanceOf(
			'BrightNucleus\CustomContent\CustomContent',
			$object
		);
	}

	/**
	 * Test whether a post type can be registered.
	 *
	 * @since 0.1.0
	 * @covers \BrightNucleus\CustomContent\CustomContent::register
	 */
	public function testRegistration() {
		$config = ConfigFactory::create( [
			'CustomPostType' => [
				'cpt' => [
					CPTArgument::NAMES      => [
						CPTName::SINGULAR_NAME_UC => 'CPT',
						CPTName::SINGULAR_NAME_LC => 'cpt',
						CPTName::PLURAL_NAME_UC   => 'CPTs',
						CPTName::PLURAL_NAME_LC   => 'cpts',
					],
					CPTArgument::TAXONOMIES => [ 'post', 'page' ],
				],
			],
			'CustomTaxonomy' => [
				'tax' => [
					TaxArgument::NAMES      => [
						TaxName::SINGULAR_NAME_UC => 'Tax',
						TaxName::SINGULAR_NAME_LC => 'tax',
						TaxName::PLURAL_NAME_UC   => 'Taxos',
						TaxName::PLURAL_NAME_LC   => 'taxos',
					],
					TaxArgument::POST_TYPES => [ 'cpt' ],
				],
			],
		] );
		$object = new CustomContent( $config );
		$this->assertInstanceOf(
			'BrightNucleus\CustomContent\CustomContent',
			$object
		);

		Functions\expect( 'register_post_type' )
		         ->once()
		         ->with(
			         'cpt',
			         Mockery::type( 'array' )
		         );
		Functions\expect( 'register_taxonomy' )
		         ->once()
		         ->with(
			         'tax',
			         [ 'cpt' ],
			         Mockery::type( 'array' )
		         );
		$object->register();
	}
}
