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

namespace BrightNucleus\CustomContent\CustomPostType;

/**
 * Class Message.
 *
 * Constants to use for translating edit form messages.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\CustomContent\CustomPostType
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class Message {

	const UNUSED                    = 0;
	const ELEMENT_UPDATED_WITH_LINK = 1;
	const CUSTOM_FIELD_UPDATED      = 2;
	const CUSTOM_FIELD_DELETED      = 3;
	const ELEMENT_UPDATED           = 4;
	const REVISION_RESTORED         = 5;
	const ELEMENT_PUBLISHED         = 6;
	const ELEMENT_SAVED             = 7;
	const ELEMENT_SUBMITTED         = 8;
	const ELEMENT_SCHEDULED         = 9;
	const ELEMENT_DRAFT_UPDATED     = 10;
	const VIEW_LINK                 = 'view_link';
	const PREVIEW_LINK              = 'preview_link';
}
