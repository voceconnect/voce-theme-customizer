Voce Theme Customizer
===================
Contributors: banderon  
Tags: theme, customizer, image, media, library  
Requires at least: 3.5.0  
Tested up to: 3.6  
Stable tag: 1.0  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html

## Description
Allow selecting images in the Theme Customizer using the Media Library, saving either the image source (as WordPress currently does) or the image ID

## Installation

### As standard plugin:
> See [Installing Plugins](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins).

## Usage

#### Example saving the image src

```php
<?php
add_action( 'customize_register', function( $wp_customize ) {
	$wp_customize->add_section( 'new_section' , array(
		'title'    => 'New Section',
		'priority' => 30,
	) );

	$id = 'new_image';

	$wp_customize->add_setting( $id );
	$wp_customize->add_control( new Voce_Customize_Image_Control( $wp_customize, $id, array(
		'label'    => 'My New Image',
		'settings' => $id,
		'section'  => 'new_section',
	) ) );
} );
?>
```

#### Example saving the image ID

```php
<?php
add_action( 'customize_register', function( $wp_customize ) {
	$wp_customize->add_section( 'new_section' , array(
		'title'    => 'New Section',
		'priority' => 30,
	) );

	$id = 'new_image';

	$wp_customize->add_setting( $id );
	$wp_customize->add_control( new Voce_Customize_Image_Control( $wp_customize, $id, array(
		'label'         => 'My New Image',
		'settings'      => $id,
		'section'       => 'new_section',
		'output_format' => 'id',
	) ) );
} );
?>
```

#### Options

```output_format``` - specifies whether to save the ```src``` (default) or the ```id``` of the image


**1.0**  
*Initial version.*