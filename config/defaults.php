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

/*
 * Default upper-case and lower case versions of single and plural name for
 * custom post type.
 */
$cpt_default_names = [
	CustomPostType\Name::SINGULAR_NAME_UC => _x( 'Element', 'post type upper case singular name', 'bn-custom-content' ),
	CustomPostType\Name::SINGULAR_NAME_LC => _x( 'element', 'post type lower case singular name', 'bn-custom-content' ),
	CustomPostType\Name::PLURAL_NAME_UC   => _x( 'Elements', 'post type upper case plural name', 'bn-custom-content' ),
	CustomPostType\Name::PLURAL_NAME_LC   => _x( 'elements', 'post type lower case plural name', 'bn-custom-content' ),
];

/*
 * Default labels for a custom post type, in a translatable way.
 */
$cpt_default_labels = [
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::NAME                  => _x( '%3$s', 'cpt general name', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::SINGULAR_NAME         => _x( '%1$s', 'cpt singular name', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::ADD_NEW               => _x( 'Add New', 'element', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::ADD_NEW_ITEM          => __( 'Add New %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::EDIT_ITEM             => __( 'Edit %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::NEW_ITEM              => __( 'New %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::VIEW_ITEM             => __( 'View %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::SEARCH_ITEMS          => __( 'Search %3$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::NOT_FOUND             => __( 'No %4$s found.', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::NOT_FOUND_IN_TRASH    => __( 'No %4$s found in Trash.', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::PARENT_ITEM_COLON     => __( 'Parent %1$s:', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::ALL_ITEMS             => __( 'All %3$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::ARCHIVES              => __( '%1$s Archives', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::INSERT_INTO_ITEM      => __( 'Insert into %2$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::UPLOADED_TO_THIS_ITEM => __( 'Uploaded to this %2$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::FEATURED_IMAGE        => __( 'Featured Image', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::SET_FEATURED_IMAGE    => __( 'Set featured image', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::REMOVE_FEATURED_IMAGE => __( 'Remove featured image', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::USE_FEATURED_IMAGE    => __( 'Use as featured image', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::MENU_NAME             => _x( '%3$s', 'admin menu', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::FILTER_ITEMS_LIST     => __( 'Filter %4$s list', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::ITEMS_LIST_NAVIGATION => __( '%3$s list navigation', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::ITEMS_LIST            => __( '%3$s list', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Label::NAME_ADMIN_BAR        => _x( '%1$s', 'add new on admin bar', 'bn-custom-content' ),
];

/*
 * Default messages for a custom post type, in a translatable way.
 */
$cpt_default_messages = [
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Message::UNUSED                    => '', // Unused. Messages start at index 1.
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Message::ELEMENT_UPDATED_WITH_LINK => __( '%1$s updated.', 'bn-custom-content' ), // View Element link will be appended.
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Message::CUSTOM_FIELD_UPDATED      => __( 'Custom field updated.', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Message::CUSTOM_FIELD_DELETED      => __( 'Custom field deleted.', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Message::ELEMENT_UPDATED           => __( '%1$s updated.', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural, %5$s date and time of the revision. */
	CustomPostType\Message::REVISION_RESTORED         => __( '%1$s restored to revision from %5$s.', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Message::ELEMENT_PUBLISHED         => __( '%1$s published.', 'bn-custom-content' ), // View Element link will be appended.
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Message::ELEMENT_SAVED             => __( '%1$s saved.', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Message::ELEMENT_SUBMITTED         => __( '%1$s submitted.', 'bn-custom-content' ), // Preview Element link will be appended.
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural, %5$s scheduled date. */
	CustomPostType\Message::ELEMENT_SCHEDULED         => __( '%1$s scheduled for: %5$s.', 'bn-custom-content' ), // Scheduled Page link will be appended.
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Message::ELEMENT_DRAFT_UPDATED     => __( '%1$s draft updated.', 'bn-custom-content' ),
	// Preview Element link will be appended.
];

/*
 * Default links.
 */
$cpt_default_links = [
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Link::VIEW_LINK    => __( 'View %2$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomPostType\Link::PREVIEW_LINK => __( 'Preview %2$s', 'bn-custom-content' ),
];

/*
 * The default features that a custom post type supports.
 *
 * See the constants in class `Feature` for a list of possible values.
 */
$cpt_default_supports = [
];

/*
 * Default Configuration for Bright Nucleus Custom Post Type.
 */
$cpt_defaults = [
	// WordPress CPT registration arguments.
	CustomPostType\Argument::LABELS        => $cpt_default_labels,
	CustomPostType\Argument::IS_PUBLIC     => true,
	CustomPostType\Argument::MENU_POSITION => CustomPostType\MenuPosition::BELOW_POSTS,
	CustomPostType\Argument::SUPPORTS      => $cpt_default_supports,
	// Bright Nucleus Custom Post Type component arguments.
	CustomPostType\Argument::NAMES         => $cpt_default_names,
	CustomPostType\Argument::MESSAGES      => $cpt_default_messages,
	CustomPostType\Argument::LINKS         => $cpt_default_links,
];

/*
 * Default upper-case and lower case versions of single and plural name for
 * custom post type.
 */
$tax_default_names = [
	CustomTaxonomy\Name::SINGULAR_NAME_UC => _x( 'Taxonomy', 'taxonomy upper case singular name', 'bn-custom-content' ),
	CustomTaxonomy\Name::SINGULAR_NAME_LC => _x( 'taxonomy', 'taxonomy lower case singular name', 'bn-custom-content' ),
	CustomTaxonomy\Name::PLURAL_NAME_UC   => _x( 'Taxonomies', 'taxonomy upper case plural name', 'bn-custom-content' ),
	CustomTaxonomy\Name::PLURAL_NAME_LC   => _x( 'taxonomies', 'taxonomy lower case plural name', 'bn-custom-content' ),
];

/*
 * Default labels for a custom taxonomy, in a translatable way.
 */
$tax_default_labels = [
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::NAME                       => _x( '%3$s', 'taxonomy general name', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::SINGULAR_NAME              => _x( '%1$s', 'taxonomy singular name', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::MENU_NAME                  => _x( '%3$s', 'taxonomy menu name', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::ALL_ITEMS                  => __( 'All %3$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::EDIT_ITEM                  => __( 'Edit %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::VIEW_ITEM                  => __( 'View %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::UPDATE_ITEM                => __( 'Update %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::ADD_NEW_ITEM               => __( 'Add New %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::NEW_ITEM_NAME              => __( 'New %1$s Name', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::PARENT_ITEM                => __( 'Parent %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::PARENT_ITEM_COLON          => __( 'Parent %1$s:', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::SEARCH_ITEMS               => __( 'Search %3$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::POPULAR_ITEMS              => __( 'Popular %3$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::SEPARATE_ITEMS_WITH_COMMAS => __( 'Separate %4$s with commas', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::ADD_OR_REMOVE_ITEMS        => __( 'Add or remove %4$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::CHOOSE_FROM_MOST_USED      => __( 'Choose from the most used %4$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CustomTaxonomy\Label::NOT_FOUND                  => __( 'No %4$s found.', 'bn-custom-content' ),
];

/*
 * Default capabilities of a custom taxonomy.
 */
$tax_default_capabilities = [
	CustomTaxonomy\Capability::MANAGE_TERMS => 'manage_categories',
	CustomTaxonomy\Capability::EDIT_TERMS   => 'manage_categories',
	CustomTaxonomy\Capability::DELETE_TERMS => 'manage_categories',
	CustomTaxonomy\Capability::ASSIGN_TERMS => 'edit_posts',
];

/*
 * Default Configuration for Bright Nucleus Custom Taxonomy.
 */
$tax_defaults = [
	// WordPress custom taxonomy registration arguments.
	CustomTaxonomy\Argument::LABELS       => $tax_default_labels,
	CustomTaxonomy\Argument::CAPABILITIES => $tax_default_capabilities,
	// Bright Nucleus Custom Taxonomy component arguments.
	CustomTaxonomy\Argument::NAMES        => $tax_default_names,
	CustomTaxonomy\Argument::POST_TYPES   => [ ],
];

/*
 * Return the configuration with a vendor/package prefix.
 */
return [
	'BrightNucleus' => [
		'CustomContent' => [
			'CustomPostType' => [
				CustomPostType::DEFAULTS => $cpt_defaults,
			],
			'CustomTaxonomy' => [
				CustomTaxonomy::DEFAULTS => $tax_defaults,
			],
		],
	],
];
