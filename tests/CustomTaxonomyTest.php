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

use BrightNucleus\CustomContent\CustomTaxonomy\Argument;
use BrightNucleus\CustomContent\CustomTaxonomy\Name;
use BrightNucleus\CustomContent\Exception\ReservedTermException;
use BrightNucleus\Config\ConfigFactory;
use BrightNucleus\CustomContent\CustomTaxonomy;
use Brain\Monkey\Functions;
use Mockery;

/**
 * Class CustomTaxonomyTest.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class CustomTaxonomyTest extends TestCase {

	/**
	 * Test whether the class can be instantiated.
	 *
	 * @since 0.1.0
	 * @covers \BrightNucleus\CustomContent\CustomTaxonomy::__construct
	 */
	public function testClassInstantiation() {
		$config = ConfigFactory::create( [ ] );
		$object = new CustomTaxonomy( $config );
		$this->assertInstanceOf(
			'BrightNucleus\CustomContent\CustomTaxonomy',
			$object
		);
	}

	/**
	 * Test whether a post type can be registered.
	 *
	 * @since 0.1.0
	 * @covers \BrightNucleus\CustomContent\CustomTaxonomy::register
	 */
	public function testRegistration() {
		$config = ConfigFactory::create( [
			'test' => [
				Argument::NAMES      => [
					Name::SINGULAR_NAME_UC => 'Test',
					Name::SINGULAR_NAME_LC => 'test',
					Name::PLURAL_NAME_UC   => 'Tests',
					Name::PLURAL_NAME_LC   => 'tests',
				],
				Argument::POST_TYPES => [ 'post', 'page' ],
			],
		] );
		$object = new CustomTaxonomy( $config );
		$this->assertInstanceOf(
			'BrightNucleus\CustomContent\CustomTaxonomy',
			$object
		);

		Functions\expect( 'register_taxonomy' )
		         ->once()
		         ->with(
			         'test',
			         [ 'post', 'page' ],
			         Mockery::type( 'array' )
		         );
		$object->register();
	}

	/**
	 * Test whether a post type can be registered.
	 *
	 * @since 0.1.0
	 * @covers \BrightNucleus\CustomContent\CustomTaxonomy::register
	 * @covers \BrightNucleus\CustomContent\AbstractContentType::checkReservedTerms
	 */
	public function testReservedTermThrowsException() {
		$config = ConfigFactory::create( [
			'post' => [
				Argument::NAMES => [
					Name::SINGULAR_NAME_UC => 'Post',
					Name::SINGULAR_NAME_LC => 'post',
					Name::PLURAL_NAME_UC   => 'Posts',
					Name::PLURAL_NAME_LC   => 'posts',
				],
			],
		] );
		$object = new CustomTaxonomy( $config );
		$this->assertInstanceOf(
			'BrightNucleus\CustomContent\CustomTaxonomy',
			$object
		);

		$this->expectException( ReservedTermException::class );
		$object->register();
	}
}
