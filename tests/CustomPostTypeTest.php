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

use BrightNucleus\CustomContent\CustomPostType\Argument;
use BrightNucleus\CustomContent\CustomPostType\Message;
use BrightNucleus\CustomContent\CustomPostType\Name;
use BrightNucleus\CustomContent\Exception\ReservedTermException;
use BrightNucleus\Config\ConfigFactory;
use BrightNucleus\CustomContent\CustomPostType;
use Brain\Monkey\Functions;
use Mockery;

/**
 * Class CustomPostTypeTest.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class CustomPostTypeTest extends TestCase {

	/**
	 * Test whether the class can be instantiated.
	 *
	 * @since 0.1.0
	 * @covers \BrightNucleus\CustomContent\CustomPostType::__construct
	 */
	public function testClassInstantiation() {
		$config = ConfigFactory::create( [ ] );
		$object = new CustomPostType( $config );
		$this->assertInstanceOf(
			'BrightNucleus\CustomContent\CustomPostType',
			$object
		);
	}

	/**
	 * Test whether a post type can be registered.
	 *
	 * @since 0.1.0
	 * @covers \BrightNucleus\CustomContent\CustomPostType::register
	 * @covers \BrightNucleus\CustomContent\CustomPostType::registerMessages
	 */
	public function testRegistration() {
		$config = ConfigFactory::create( [
			'test' => [
				Argument::NAMES => [
					Name::SINGULAR_NAME_UC => 'Test',
					Name::SINGULAR_NAME_LC => 'test',
					Name::PLURAL_NAME_UC   => 'Tests',
					Name::PLURAL_NAME_LC   => 'tests',
				],
			],
		] );
		$object = new CustomPostType( $config );

		Functions\expect( 'register_post_type' )
		         ->once()
		         ->with(
			         'test',
			         Mockery::type( 'array' )
		         )
		         ->andReturn( true );
		
		Functions\expect( 'has_filter' )
		         ->once()
		         ->with(
			         'post_updated_messages',
			         [ $object, 'messages_for_test' ]
		         )
		         ->andReturn( true );
		
		$object->register();
		$this->assertTrue(
			has_filter(
				'post_updated_messages',
				[ $object, 'messages_for_test' ]
			)
		);
	}

	/**
	 * Test whether a post type can be registered.
	 *
	 * @since 0.1.0
	 * @covers \BrightNucleus\CustomContent\CustomPostType::register
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
		$object = new CustomPostType( $config );
		$this->assertInstanceOf(
			'BrightNucleus\CustomContent\CustomPostType',
			$object
		);

		$this->expectException( ReservedTermException::class );
		$object->register();
	}

	/**
	 * Test whether the messages filter works correctly.
	 *
	 * @covers \BrightNucleus\CustomContent\CustomPostType::__call
	 * @covers \BrightNucleus\CustomContent\CustomPostType::registerMessages
	 */
	public function testMessagesFilter() {
		$config = ConfigFactory::create( [
			'test' => [
				Argument::NAMES => [
					Name::SINGULAR_NAME_UC => 'Test',
					Name::SINGULAR_NAME_LC => 'test',
					Name::PLURAL_NAME_UC   => 'Tests',
					Name::PLURAL_NAME_LC   => 'tests',
				],
			],
		] );
		$object = new CustomPostType( $config );
		Functions\expect( 'register_post_type' )
		         ->once()
		         ->andReturn( true );
		$object->register();

		$post            = Mockery::mock( 'WP_Post' );
		$post->ID        = 1;
		$post->post_date = 'DATE';

		$post_type_object                     = Mockery::mock( 'stdClass' );
		$post_type_object->publicly_queryable = true;

		$messages = $this->get_dummy_messages_data( 'test' );

		Functions\expect( 'get_post' )
		         ->twice()
		         ->andReturn( $post );
		Functions\expect( 'get_post_type_object' )
		         ->once()
		         ->andReturn( $post_type_object );
		Functions\expect( 'date_i18n' )
		         ->once()
		         ->andReturn( 'DATE' );
		Functions\expect( 'get_permalink' )
		         ->once()
		         ->andReturn( 'https://www.google.com/' );
		Functions\expect( 'esc_url' )
		         ->times( 5 )
		         ->andReturn( 'https://www.google.com/' );
		Functions\expect( 'add_query_arg' )
		         ->twice();
		$messages = $object->messages_for_test( $messages );
		$this->assertTrue( array_key_exists( 'test', $messages ) );
		$this->assertTrue( 11 === count( $messages['test'] ) );
		$this->assertEquals(
			'Test scheduled for: DATE. <a href="https://www.google.com/">View test</a>',
			$messages['test'][ Message::ELEMENT_SCHEDULED ]
		);
	}

	protected function get_dummy_messages_data( $cpt ) {
		return [
			'post' => [
				Message::UNUSED                    => 'Message::UNUSED',
				Message::ELEMENT_UPDATED_WITH_LINK => 'Message::ELEMENT_UPDATED_WITH_LINK',
				Message::CUSTOM_FIELD_UPDATED      => 'Message::CUSTOM_FIELD_UPDATED',
				Message::CUSTOM_FIELD_DELETED      => 'Message::CUSTOM_FIELD_DELETED',
				Message::ELEMENT_UPDATED           => 'Message::ELEMENT_UPDATED',
				Message::REVISION_RESTORED         => 'Message::REVISION_RESTORED',
				Message::ELEMENT_PUBLISHED         => 'Message::ELEMENT_PUBLISHED',
				Message::ELEMENT_SAVED             => 'Message::ELEMENT_SAVED',
				Message::ELEMENT_SUBMITTED         => 'Message::ELEMENT_SUBMITTED',
				Message::ELEMENT_SCHEDULED         => 'Message::ELEMENT_SCHEDULED',
				Message::ELEMENT_DRAFT_UPDATED     => 'Message::ELEMENT_DRAFT_UPDATED',
			],
			'page' => [
				Message::UNUSED                    => 'Message::UNUSED',
				Message::ELEMENT_UPDATED_WITH_LINK => 'Message::ELEMENT_UPDATED_WITH_LINK',
				Message::CUSTOM_FIELD_UPDATED      => 'Message::CUSTOM_FIELD_UPDATED',
				Message::CUSTOM_FIELD_DELETED      => 'Message::CUSTOM_FIELD_DELETED',
				Message::ELEMENT_UPDATED           => 'Message::ELEMENT_UPDATED',
				Message::REVISION_RESTORED         => 'Message::REVISION_RESTORED',
				Message::ELEMENT_PUBLISHED         => 'Message::ELEMENT_PUBLISHED',
				Message::ELEMENT_SAVED             => 'Message::ELEMENT_SAVED',
				Message::ELEMENT_SUBMITTED         => 'Message::ELEMENT_SUBMITTED',
				Message::ELEMENT_SCHEDULED         => 'Message::ELEMENT_SCHEDULED',
				Message::ELEMENT_DRAFT_UPDATED     => 'Message::ELEMENT_DRAFT_UPDATED',
			],
		];
	}
}
