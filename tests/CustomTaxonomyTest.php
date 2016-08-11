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

use BrightNucleus\CustomContent\CustomTaxonomy\Argument;
use BrightNucleus\CustomContent\CustomTaxonomy\Name;
use BrightNucleus\CustomContent\Exception\ReservedTermException;
use PHPUnit_Framework_TestCase;
use BrightNucleus\Config\ConfigFactory;
use Brain\Monkey;
use Brain\Monkey\Functions;
use Mockery;

/**
 * Class CustomTaxonomyTest.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class CustomTaxonomyTest extends PHPUnit_Framework_TestCase {

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

		Functions::expect( 'register_taxonomy' )
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

		$this->setExpectedException( ReservedTermException::class );
		$object->register();
	}
}
