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
use BrightNucleus\CustomContent\CustomPostType\Label as CPTLabel;
use BrightNucleus\CustomContent\CustomPostType\Link as CPTLink;
use BrightNucleus\CustomContent\CustomPostType\MenuPosition as CPTMenuPosition;
use BrightNucleus\CustomContent\CustomPostType\Message as CPTMessage;
use BrightNucleus\CustomContent\CustomPostType\Name as CPTName;
use BrightNucleus\CustomContent\CustomTaxonomy\Argument as TaxArgument;
use BrightNucleus\CustomContent\CustomTaxonomy\Capability as TaxCapability;
use BrightNucleus\CustomContent\CustomTaxonomy\Label as TaxLabel;
use BrightNucleus\CustomContent\CustomTaxonomy\Name as TaxName;

/*
 * Default upper-case and lower case versions of single and plural name for
 * custom post type.
 */
$cpt_default_names = [
	CPTName::SINGULAR_NAME_UC => _x( 'Element', 'post type upper case singular name', 'bn-custom-content' ),
	CPTName::SINGULAR_NAME_LC => _x( 'element', 'post type lower case singular name', 'bn-custom-content' ),
	CPTName::PLURAL_NAME_UC   => _x( 'Elements', 'post type upper case plural name', 'bn-custom-content' ),
	CPTName::PLURAL_NAME_LC   => _x( 'elements', 'post type lower case plural name', 'bn-custom-content' ),
];

/*
 * Default labels for a custom post type, in a translatable way.
 */
$cpt_default_labels = [
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::NAME                  => __( '%3$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::SINGULAR_NAME         => __( '%1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::ADD_NEW               => _x( 'Add New', 'element', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::ADD_NEW_ITEM          => __( 'Add New %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::EDIT_ITEM             => __( 'Edit %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::NEW_ITEM              => __( 'New %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::VIEW_ITEM             => __( 'View %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::SEARCH_ITEMS          => __( 'Search %3$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::NOT_FOUND             => __( 'No %4$s found.', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::NOT_FOUND_IN_TRASH    => __( 'No %4$s found in Trash.', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::PARENT_ITEM_COLON     => __( 'Parent %1$s:', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::ALL_ITEMS             => __( 'All %3$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::ARCHIVES              => __( '%1$s Archives', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::INSERT_INTO_ITEM      => __( 'Insert into %2$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::UPLOADED_TO_THIS_ITEM => __( 'Uploaded to this %2$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::FEATURED_IMAGE        => __( 'Featured Image', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::SET_FEATURED_IMAGE    => __( 'Set featured image', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::REMOVE_FEATURED_IMAGE => __( 'Remove featured image', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::USE_FEATURED_IMAGE    => __( 'Use as featured image', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::MENU_NAME             => _x( '%3$s', 'admin menu', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::FILTER_ITEMS_LIST     => __( 'Filter %4$s list', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::ITEMS_LIST_NAVIGATION => __( '%3$s list navigation', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::ITEMS_LIST            => __( '%3$s list', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLabel::NAME_ADMIN_BAR        => _x( '%1$s', 'add new on admin bar', 'bn-custom-content' ),
];

/*
 * Default messages for a custom post type, in a translatable way.
 */
$cpt_default_messages = [
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTMessage::UNUSED                    => '', // Unused. Messages start at index 1.
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTMessage::ELEMENT_UPDATED_WITH_LINK => __( '%1$s updated.', 'bn-custom-content' ), // View Element link will be appended.
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTMessage::CUSTOM_FIELD_UPDATED      => __( 'Custom field updated.', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTMessage::CUSTOM_FIELD_DELETED      => __( 'Custom field deleted.', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTMessage::ELEMENT_UPDATED           => __( '%1$s updated.', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural, %5$s date and time of the revision. */
	CPTMessage::REVISION_RESTORED         => __( '%1$s restored to revision from %5$s.', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTMessage::ELEMENT_PUBLISHED         => __( '%1$s published.', 'bn-custom-content' ), // View Element link will be appended.
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTMessage::ELEMENT_SAVED             => __( '%1$s saved.', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTMessage::ELEMENT_SUBMITTED         => __( '%1$s submitted.', 'bn-custom-content' ), // Preview Element link will be appended.
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural, %5$s scheduled date. */
	CPTMessage::ELEMENT_SCHEDULED         => __( '%1$s scheduled for: %5$s.', 'bn-custom-content' ), // Scheduled Page link will be appended.
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTMessage::ELEMENT_DRAFT_UPDATED     => __( '%1$s draft updated.', 'bn-custom-content' ),
	// Preview Element link will be appended.
];

/*
 * Default links.
 */
$cpt_default_links = [
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLink::VIEW_LINK    => __( 'View %2$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	CPTLink::PREVIEW_LINK => __( 'Preview %2$s', 'bn-custom-content' ),
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
	CPTArgument::LABELS        => $cpt_default_labels,
	CPTArgument::IS_PUBLIC     => true,
	CPTArgument::MENU_POSITION => CPTMenuPosition::BELOW_POSTS,
	CPTArgument::SUPPORTS      => $cpt_default_supports,
	// Bright Nucleus Custom Post Type component arguments.
	CPTArgument::NAMES         => $cpt_default_names,
	CPTArgument::MESSAGES      => $cpt_default_messages,
	CPTArgument::LINKS         => $cpt_default_links,
];

/*
 * Default upper-case and lower case versions of single and plural name for
 * custom post type.
 */
$tax_default_names = [
	TaxName::SINGULAR_NAME_UC => _x( 'Taxonomy', 'taxonomy upper case singular name', 'bn-custom-content' ),
	TaxName::SINGULAR_NAME_LC => _x( 'taxonomy', 'taxonomy lower case singular name', 'bn-custom-content' ),
	TaxName::PLURAL_NAME_UC   => _x( 'Taxonomies', 'taxonomy upper case plural name', 'bn-custom-content' ),
	TaxName::PLURAL_NAME_LC   => _x( 'taxonomies', 'taxonomy lower case plural name', 'bn-custom-content' ),
];

/*
 * Default labels for a custom taxonomy, in a translatable way.
 */
$tax_default_labels = [
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::NAME                       => _x( '%3$s', 'taxonomy general name', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::SINGULAR_NAME              => _x( '%1$s', 'taxonomy singular name', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::MENU_NAME                  => _x( '%3$s', 'taxonomy menu name', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::ALL_ITEMS                  => __( 'All %3$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::EDIT_ITEM                  => __( 'Edit %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::VIEW_ITEM                  => __( 'View %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::UPDATE_ITEM                => __( 'Update %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::ADD_NEW_ITEM               => __( 'Add New %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::NEW_ITEM_NAME              => __( 'New %1$s Name', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::PARENT_ITEM                => __( 'Parent %1$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::PARENT_ITEM_COLON          => __( 'Parent %1$s:', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::SEARCH_ITEMS               => __( 'Search %3$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::POPULAR_ITEMS              => __( 'Popular %3$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::SEPARATE_ITEMS_WITH_COMMAS => __( 'Separate %4$s with commas', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::ADD_OR_REMOVE_ITEMS        => __( 'Add or remove %4$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::CHOOSE_FROM_MOST_USED      => __( 'Choose from the most used %4$s', 'bn-custom-content' ),
	/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
	TaxLabel::NOT_FOUND                  => __( 'No %4$s found.', 'bn-custom-content' ),
];

/*
 * Default capabilities of a custom taxonomy.
 */
$tax_default_capabilities = [
	TaxCapability::MANAGE_TERMS => 'manage_categories',
	TaxCapability::EDIT_TERMS   => 'manage_categories',
	TaxCapability::DELETE_TERMS => 'manage_categories',
	TaxCapability::ASSIGN_TERMS => 'edit_posts',
];

/*
 * Default Configuration for Bright Nucleus Custom Taxonomy.
 */
$tax_defaults = [
	// WordPress custom taxonomy registration arguments.
	TaxArgument::LABELS       => $tax_default_labels,
	TaxArgument::CAPABILITIES => $tax_default_capabilities,
	// Bright Nucleus Custom Taxonomy component arguments.
	TaxArgument::NAMES        => $tax_default_names,
	TaxArgument::POST_TYPES   => [ ],
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
