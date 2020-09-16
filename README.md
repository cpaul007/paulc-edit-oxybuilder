#  Oxygen Builder Customizer Plugin
A helper plugin to customize the Oxygen Builder site.  Oxygen Builder's setup does not work with WordPress Themes. It bypasses them and uses its own theme so to speak Therefore you can't use the `functions.php` file and add the custom PHP code. 

Inside the builder there are **CODE BLOCK** elements in which you can write PHP code, but sometimes it will not be a suitable option (when you are adding the bunch of code, are customizing the plugin's templates etc).

### Assets 
- This folder will contain the CSS and JS files which will be used on the website. If you are only using PHP or HTML template overrides you do not need to deal with this directory.

### elements 

- You will put the custom elements folders inside this folder

### Includes

- There is a **helpers.php file**. You should write your all custom codes inside that file. 

### WooCommerce 
 
Here an example code to load WooCommerce template overrides:

```php
<?php

/*************************************************
Add your custom PHP code inside this PHP file
*************************************************/

add_action( 'after_setup_theme', 'pauloxyb_after_setup_oxyb' );
function pauloxyb_after_setup_oxyb() {

	//* Allow to override WC /templates path
	add_filter( 'wc_get_template', 		'pauloxyb_wc_template', 10, 5 );
	add_filter( 'wc_get_template_part', 'pauloxyb_wc_template_part', 10, 3 );
	
}


function pauloxyb_wc_template( $located, $template_name, $args, $template_path, $default_path ) {
	$newtpl = str_replace( 'woocommerce/templates', basename( POXYB_DIR ) . '/woocommerce', $located );
	
	if ( file_exists( $newtpl ) )
		return $newtpl;

	return $located;
}

function pauloxyb_wc_template_part( $template, $slug, $name ) {
	$newtpl = str_replace( 'woocommerce/templates',basename( POXYB_DIR ) . '/woocommerce', $template );
	
	if ( file_exists( $newtpl ) )
		return $newtpl;

	return $template;
}
```

# Installation

You can install it as a standard plugin not part of the WordPress repository. Click on the Download ZIP button at the right to download the plugin. The other option is to own PHP composer setup with your own package or a setup that can use vcs to install it with composer.

When you choose to download this plugin from Github and have down so:

* Go to Plugins > Add New in your WordPress admin. Click on Upload Plugin and browse for the zip file.
* Activate the plugin.

# FAQs

### How shall I edit the files?

You can use the FTP/SFTP or CPanel -> File Manager tools. You can also use the **WP File Manager plugin**. With is you can directly add/edit/delete the files and folders from your Dashboard. Keep in mind that you should delete this plugin after completing your work.

### Video Tutorial

If you are more of a visual person check the video tutorial below:

[Watch the video](https://www.youtube.com/embed/ulGKSYnQ9jU)

# Changelog
## 1.0.0
Initial Release
