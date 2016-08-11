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

use BrightNucleus\CustomContent\CustomPostType\Argument as CPTArgument;
use BrightNucleus\CustomContent\CustomPostType\Name as CPTName;
use BrightNucleus\CustomContent\CustomTaxonomy\Argument as TaxArgument;
use BrightNucleus\CustomContent\CustomTaxonomy\Name as TaxName;
use PHPUnit_Framework_TestCase;
use BrightNucleus\Config\ConfigFactory;
use Brain\Monkey;
use Brain\Monkey\Functions;
use Mockery;

/**
 * Class CustomContentTest.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class CustomContentTest extends PHPUnit_Framework_TestCase {

	protected function setUp() {
		parent::setUp();
		Monkey::setUpWP();
	}

	protected function tearDown() {
		Monkey::tearDownWP();
		parent::tearDown();
	}

	/**
	 * Test whether the class can be instantiated.
	 *
	 * @since 0.1.0
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

		Functions::expect( 'register_post_type' )
		         ->once()
		         ->with(
			         'cpt',
			         Mockery::type( 'array' )
		         );
		Functions::expect( 'register_taxonomy' )
		         ->once()
		         ->with(
			         'tax',
			         [ 'cpt' ],
			         Mockery::type( 'array' )
		         );
		$object->register();
	}
}
