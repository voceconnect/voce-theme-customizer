Voce Theme Customizer
===================
Contributors: banderon  
Tags: theme, customizer, image, media, library, dropdown, textarea  
Requires at least: 3.5.0  
Tested up to: 3.6  
Stable tag: 1.0  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html

## Description
Adds several Theme Customizer controls.

- An image selector that uses the Media Library, saving either the image source (as WordPress currently does) or the image ID
- A dropdown
- A textarea

## Installation

### As standard plugin:
> See [Installing Plugins](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins).

## Usage

#### Example with an image, saving the image src

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

#### Example with an image, saving the image ID

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

#### Example with a dropdown and a textarea

```php
<?php
add_action( 'customize_register', function( $wp_customize ) {
	$wp_customize->add_section( 'new_section' , array(
		'title'    => 'New Section',
		'priority' => 30,
	) );

	$id1 = 'new_dropdown';
	$opts = array(
		'val1' => 'Value 1',
		'val2' => 'Value 2',
		'val3' => 'Value 3',
		'val4' => 'Value 4',
	);
	$wp_customize->add_setting( $id1 );
	$wp_customize->add_control( new Voce_Customize_Dropdown_Control( $wp_customize, $id1, array(
		'label'         => 'My New Dropdown',
		'settings'      => $id1,
		'section'       => 'new_section',
		'options'       => $opts,
	) ) );

	$id2 = 'new_textarea';
	$wp_customize->add_setting( $id2 );
	$wp_customize->add_control( new Voce_Customize_Textarea_Control( $wp_customize, $id2, array(
		'label'         => 'My New Textarea',
		'settings'      => $id2,
		'section'       => 'new_section',
	) ) );
} );
?>
```

#### Options

Image Control: ```output_format``` - specifies whether to save the ```src``` (default) or the ```id``` of the image

Dropdown Control: ```options``` - an array with which to populate the dropdown

**1.0**  
*Initial version.*
