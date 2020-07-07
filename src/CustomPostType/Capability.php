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
 * Class Capability.
 *
 * Constants to use for setting the custom post type's capabilities.
 *
 * @since   0.1.8
 *
 * @package BrightNucleus\CustomContent\CustomPostType
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class Capability {

    const EDIT_POST              = 'edit_post';
    const READ_POST              = 'read_post';
    const DELETE_POST            = 'delete_post';
    const EDIT_POSTS             = 'edit_posts';
    const EDIT_OTHERS_POSTS      = 'edit_others_posts';
    const DELETE_POSTS           = 'delete_posts';
    const PUBLISH_POSTS          = 'publish_posts';
    const READ_PRIVATE_POSTS     = 'read_private_posts';
    const READ                   = 'read';
    const DELETE_PRIVATE_POSTS   = 'delete_private_posts';
    const DELETE_PUBLISHED_POSTS = 'delete_published_posts';
    const DELETE_OTHERS_POSTS    = 'delete_others_posts';
    const EDIT_PRIVATE_POSTS     = 'edit_private_posts';
    const EDIT_PUBLISHED_POSTS   = 'edit_published_posts';
}
