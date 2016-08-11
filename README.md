# Bright Nucleus Custom Content

[![Latest Stable Version](https://img.shields.io/packagist/v/brightnucleus/custom-content.svg)](https://packagist.org/packages/brightnucleus/custom-content)
[![Total Downloads](https://img.shields.io/packagist/dt/brightnucleus/custom-content.svg)](https://packagist.org/packages/brightnucleus/custom-content)
[![Latest Unstable Version](https://img.shields.io/packagist/vpre/brightnucleus/custom-content.svg)](https://packagist.org/packages/brightnucleus/custom-content)
[![License](https://img.shields.io/packagist/l/brightnucleus/custom-content.svg)](https://packagist.org/packages/brightnucleus/custom-content)

Config-driven WordPress Custom Content Definitions (Custom Post Types, Custom Taxonomies).

## Table Of Contents

* [Installation](#installation)
* [Basic Usage](#basic-usage)
	* [Registering A New Custom Post Type](#registering-a-new-custom-post-type)
	* [Registering A New Custom Taxonomy](#registering-a-new-custom-taxonomy)
	* [Registering Several Custom Content Elements At Once](#registering-several-custom-content-elements-at-once)
	* [About Rewrite Rules](#about-rewrite-rules)
* [Contributing](#contributing)
* [License](#license)

## Installation

The best way to use this package is through Composer:

```BASH
composer require brightnucleus/custom-content
```

## Basic Usage

### Registering A New Custom Post Type

To register a new custom post type, you need to define it within a Config file. Default values can be found within `config/defaults.php` configuration. You then instantiate the `CustomPostType` class by injecting your Config into its constructor, and call its `register()` method.

__Example:__

```PHP
<?php namespace CPT\Example;

use BrightNucleus\Config\ConfigFactory;
use BrightNucleus\CustomContent\CustomPostType;

// You can of course load your Config from a file. We create one directly here
// to make the example clearer.
$config = ConfigFactory::create( [

 	// This configuration key represents the slug of the CPT.
	'example' => [

		// For most localization needs, it should be sufficient to only provide
		// these four name variants. The Custom Content component will figure
		// out the rest.
		Argument::NAMES => [
			Name::SINGULAR_NAME_UC => _x('Example', 'post type uc singular name', 'cpt-example'),
			Name::SINGULAR_NAME_LC => _x('example', 'post type lc singular name', 'cpt-example'),
			Name::PLURAL_NAME_UC   => _x('Examples', 'post type uc plural name', 'cpt-example'),
			Name::PLURAL_NAME_LC   => _x('examples', 'post type lc plural name', 'cpt-example'),
		],

		// Here, we register the taxonomy we'll later create with our new custom
		// post type.
		Argument::TAXONOMIES => [ 'taxexample' ],

		// We also add some supported features to the custom post type.
		Argument::SUPPORTS => [
			Feature::TITLE,
			Feature::AUTHOR,
			Feature::REVISIONS,
			Feature::COMMENTS,
			Feature::THUMBNAIL,
		],
	],
] );

// Create a new `CustomPostType` instance configured by our new Config file.
$example_cpt = new CustomPostType( $config );

// Register this new custom post type with WordPress.
// Note that CPTs should always be registered within the `init` hook.
add_action( 'init', [ $example_cpt, 'register' ] );
```

### Registering A New Custom Taxonomy

To register a new custom taxonomy, you need to define it within a Config file. Default values can be found within `config/defaults.php` configuration. You then instantiate the `CustomTaxonomy` class by injecting your Config into its constructor, and call its `register()` method.

__Example:__

```PHP
<?php namespace Tax\Example;

use BrightNucleus\Config\ConfigFactory;
use BrightNucleus\CustomContent\CustomTaxonomy;

// You can of course load your Config from a file. We create one directly here
// to make the example clearer.
$config = ConfigFactory::create( [

 	// This configuration key represents the slug of the CPT.
 	'taxexample' => [

		// For most localization needs, it should be sufficient to only provide
		// these four name variants. The Custom Content component will figure
		// out the rest.
		Argument::NAMES => [
			Name::SINGULAR_NAME_UC => _x('TaxExample', 'taxonomy uc singular name', 'tax-example'),
			Name::SINGULAR_NAME_LC => _x('taxexample', 'taxonomy lc singular name', 'tax-example'),
			Name::PLURAL_NAME_UC   => _x('TaxExamples', 'taxonomy uc plural name', 'tax-example'),
			Name::PLURAL_NAME_LC   => _x('taxexamples', 'taxonomy lc plural name', 'tax-example'),
		],

		// Here, we register the taxonomy with our previously created custom
		// post type.
		Argument::POST_TYPES => [ 'example' ],
	],
] );

// Create a new `CustomTaxonomy` instance configured by our new Config file.
$example_tax = new CustomTaxonomy( $config );

// Register this new custom taxonomy with WordPress.
// Note that Taxonomies should always be registered within the `init` hook.
add_action( 'init', [ $example_tax, 'register' ] );
```

### Registering Several Custom Content Elements At Once

To register several custom content elements at once, you can instantiate a `CustomContent` object and pass it a Config with all of your custom post types and taxonomies included.

The format of the Config is similar to the singular Configs above, with the distinction that it starts with a key for each type of custom content after the prefix. The different slugs are then children of the corresponding content type.

Known content types are:

* `CustomPostType`
* `CustomTaxonomy`

__Example:__

```PHP
<?php namespace CustomContent\Example;

use BrightNucleus\Config\ConfigFactory;
use BrightNucleus\CustomContent\CustomContent;
use BrightNucleus\CustomContent\CustomPostType\Argument as CPTArgument;
use BrightNucleus\CustomContent\CustomTaxonomy\Argument as TaxArgument;

// You can of course load your Config from a file. We create one directly here
// to make the example clearer.
$config = ConfigFactory::create( [

	// In this example, we want to register two custom post types (`book` &
	// `magazine`) as well as two custom taxonomies related to these
	// (`publisher`, `shelf`).

	'CustomPostType' => [
		'book'       => [
			// Arguments to define a book.
			// [...]
			CPTArgument::TAXONOMIES => [ 'publisher', 'shelf' ],
		],
		'magazine'   => [
			// Arguments to define a magazine.
			// [...]
			CPTArgument::TAXONOMIES => [ 'publisher', 'shelf' ],
		],
	],

	'CustomTaxonomy' => [
		'publisher'  => [
			// Arguments to define a publisher.
			// [...]
			TaxArgument::POST_TYPES => [ 'book', 'magazine' ],
		],
		'shelf'      => [
			// Arguments to define a publisher.
			// [...]
			TaxArgument::POST_TYPES => [ 'book', 'magazine' ],
		],
	],
] );

// Create a new `CustomContent` instance configured by our new Config file.
$custom_content = new CustomContent( $config );

// Register this new custom content with WordPress.
add_action( 'init', [ $custom_content, 'register' ] );
```

### About Rewrite Rules

If your custom content includes pretty permalinks, you will need to flush the rewrite rules.

__NOTE: You need to take care that you only flush the rewrite rules once, not on every page request.__

The best way to achieve this is to hook into plugin activation, register your custom content, and then call `flush_rewrite_rules()` from within that hook.

__Example:__

```PHP
<?php namespace CustomContent\Example;

use BrightNucleus\Config\ConfigFactory;
use BrightNucleus\CustomContent\CustomContent;

function register_custom_content() {
    static $custom_content;

    if ( null === $custom_content ) {
		$config = ConfigFactory::create( __DIR__ . '/config/custom_content.php' );
		$custom_content = new CustomContent( $config );
	}

    $custom_content->register();
}
add_action( 'init', __NAMESPACE__ . '\\register_custom_content' );

function flush_rewrite_rules() {
	cc_example_register_custom_content();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, __NAMESPACE__ . '\\flush_rewrite_rules' );
```

## Contributing

All feedback / bug reports / pull requests are welcome.

## License

Copyright (c) 2016 Alain Schlesser, Bright Nucleus

This code is licensed under the [MIT License](LICENSE).
