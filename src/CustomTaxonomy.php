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
use BrightNucleus\CustomContent\CustomTaxonomy\ArgumentCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Class CustomTaxonomy.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class CustomTaxonomy extends AbstractContentType {

	/*
	 * Key that stores default values.
	 */
	const DEFAULTS = '_tax_defaults_';

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
		) )->prepareLabels();
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
		register_taxonomy(
			$cpt,
			$argsCollection->get( Argument::POST_TYPES ),
			$argsCollection->toArray()
		);
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
		return in_array( $slug, [
			'attachment',
			'attachment_id',
			'author',
			'author_name',
			'calendar',
			'cat',
			'category',
			'category__and',
			'category__in',
			'category__not_in',
			'category_name',
			'comments_per_page',
			'comments_popup',
			'customize_messenger_channel',
			'customized',
			'cpage',
			'day',
			'debug',
			'error',
			'exact',
			'feed',
			'fields',
			'hour',
			'link_category',
			'm',
			'minute',
			'monthnum',
			'more',
			'name',
			'nav_menu',
			'nonce',
			'nopaging',
			'offset',
			'order',
			'orderby',
			'p',
			'page',
			'page_id',
			'paged',
			'pagename',
			'pb',
			'perm',
			'post',
			'post__in',
			'post__not_in',
			'post_format',
			'post_mime_type',
			'post_status',
			'post_tag',
			'post_type',
			'posts',
			'posts_per_archive_page',
			'posts_per_page',
			'preview',
			'robots',
			's',
			'search',
			'second',
			'sentence',
			'showposts',
			'static',
			'subpost',
			'subpost_id',
			'tag',
			'tag__and',
			'tag__in',
			'tag__not_in',
			'tag_id',
			'tag_slug__and',
			'tag_slug__in',
			'taxonomy',
			'tb',
			'term',
			'theme',
			'type',
			'w',
			'withcomments',
			'withoutcomments',
			'year',
		], true );
	}
}
