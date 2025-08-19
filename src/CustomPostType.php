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

use BrightNucleus\CustomContent\CustomPostType\Argument;
use BrightNucleus\CustomContent\CustomPostType\ArgumentCollection;
use BrightNucleus\CustomContent\CustomPostType\Link;
use BrightNucleus\CustomContent\CustomPostType\Message;
use BrightNucleus\Exception\BadMethodCallException;
use Doctrine\Common\Collections\Collection;

/**
 * Class CustomPostType.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class CustomPostType extends AbstractContentType {

	/**
	 * Storage for message filter callbacks.
	 *
	 * @var array
	 */
	protected $messageFilters = [];

	/*
	 * Reserved terms that cannot be used as custom post type slug.
	 */
	const RESERVED_TERMS = [
		'post',
		'page',
		'attachment',
		'revision',
		'nav_menu_item',
		'action',
		'author',
		'order',
		'theme',
	];

	/**
	 * Prepare the arguments and return a Collection of arguments.
	 *
	 * @since 0.1.0
	 *
	 * @param string $cpt  Slug of the custom content.
	 * @param array  $args Array of arguments to prepare.
	 * @return Collection Collection of arguments.
	 */
	protected function prepareArguments( $cpt, array $args ) {
		$defaults = $this->getConfigKey( static::DEFAULTS );

		return ( new ArgumentCollection(
			array_replace_recursive( $defaults, $this->getConfigKey( $cpt ),
				$args )
		) )->prepareLabels()
		   ->prepareLinks();
	}

	/**
	 * Do the actual registration with WordPress.
	 *
	 * @since 0.1.0
	 *
	 * @param string     $cpt            Slug of the custom content.
	 * @param Collection $argsCollection Collection of arguments.
	 */
	protected function doRegistration( $cpt, Collection $argsCollection ) {
		/** @var ArgumentCollection $argsCollection */
		register_post_type( $cpt, $argsCollection->toArray() );
		$this->registerMessages( $cpt, $argsCollection );
	}

	/**
	 * Register the edit form messages.
	 *
	 * @since 0.1.0
	 *
	 * @param string             $cpt  Identifier of the custom post type.
	 * @param ArgumentCollection $args Collection of arguments.
	 */
	protected function registerMessages( $cpt, ArgumentCollection $args ) {
		$method_name = "messages_for_{$cpt}";

		$this->messageFilters[$method_name] = function ( $messages ) use ( $cpt, $args ) {

			$args->prepareMessages();

			$messages[ $cpt ] = $args->get( Argument::MESSAGES );

			if ( $this->isQueryable( $cpt ) ) {

				$permalink = $this->getPermalink();

				foreach ( $this->getMessagesWithViewLink() as $key ) {
					$messages[ $cpt ][ $key ] .= $this->getViewLink( $permalink,
						$args );
				}

				foreach ( $this->getMessagesWithPreviewLink() as $key ) {
					$messages[ $cpt ][ $key ] .= $this->getPreviewLink( $permalink,
						$args );
				}
			}

			return $messages;
		};

		add_filter( 'post_updated_messages', [ $this, $method_name ] );
	}

	/**
	 * Get the permalink for the current post.
	 *
	 * @since 0.1.0
	 *
	 * @return string|false Permalink string or false if not found.
	 */
	protected function getPermalink() {
		$post = get_post();

		if ( null === $post ) {
			return false;
		}

		return get_permalink( $post->ID );
	}

	/**
	 * Check whether the current custom post type is queryable.
	 *
	 * @since 0.1.0
	 *
	 * @param string $cpt Slug of the custom post type.
	 * @return bool Whether the custom post type is queryable.
	 */
	protected function isQueryable( $cpt ) {
		return get_post_type_object( $cpt )->publicly_queryable;
	}

	/**
	 * Get the "View <element>" link.
	 *
	 * @since 0.1.0
	 *
	 * @param string             $permalink Permalink to the current post.
	 * @param ArgumentCollection $args      Collection of arguments.
	 * @return string HTML link to view the post.
	 */
	protected function getViewLink( $permalink, $args ) {
		if ( ! $permalink ) {
			return '';
		}

		return sprintf(
			' <a href="%s">%s</a>',
			esc_url( $permalink ),
			$args[ Argument::LINKS ][ Link::VIEW_LINK ]
		);
	}

	/**
	 * Get the "Preview <element>" link.
	 *
	 * @since 0.1.0
	 *
	 * @param string             $permalink Permalink to the current post.
	 * @param ArgumentCollection $args      Collection of arguments.
	 * @return string HTML link to preview the post.
	 */
	protected function getPreviewLink( $permalink, $args ) {
		if ( ! $permalink ) {
			return '';
		}

		$preview_permalink = add_query_arg( 'preview', 'true', $permalink );

		return sprintf(
			' <a target="_blank" href="%s">%s</a>',
			esc_url( $preview_permalink ),
			$args[ Argument::LINKS ][ Link::PREVIEW_LINK ]
		);
	}

	/**
	 * Get the list of message keys to which a "View <element>" link should be
	 * appended.
	 *
	 * @since 0.1.0
	 *
	 * @return array Array of keys to which to append the link.
	 */
	protected function getMessagesWithViewLink() {
		return [
			Message::ELEMENT_UPDATED_WITH_LINK,
			Message::ELEMENT_PUBLISHED,
			Message::ELEMENT_SCHEDULED,
		];
	}

	/**
	 * Get the list of message keys to which a "Preview <element>" link should
	 * be appended.
	 *
	 * @since 0.1.0
	 *
	 * @return array Array of keys to which to append the link.
	 */
	protected function getMessagesWithPreviewLink() {
		return [
			Message::ELEMENT_SUBMITTED,
			Message::ELEMENT_DRAFT_UPDATED,
		];
	}

	/**
	 * Magic method to allow dynamic callbacks
	 *
	 * @since 0.1.0
	 *
	 * @param  string $method         Method that has been called.
	 * @param  array  $args           Arguments that have been passed to the
	 *                                method.
	 * @return mixed                  Return value of the method being called.
	 * @throws BadMethodCallException An undefined callback was invoked.
	 */
	public function __call( $method, $args ) {
		if ( isset( $this->messageFilters[$method] ) && is_callable( $this->messageFilters[$method] ) ) {
			return call_user_func_array( $this->messageFilters[$method], $args );
		}
		if ( is_callable( array( $this, $method ) ) ) {
			return call_user_func_array( $this->$method, $args );
		}
		throw new BadMethodCallException( 'An undefined callback was invoked: ' . (string) $method );
	}
}
