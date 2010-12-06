# ColorspaceConverter
A PHP-class for converting colorspaces.

## Examples
	<?php
	$rgb = ColorspaceConverter::hex2rgb('#FF0000');
	$hsv = ColorspaceConverter::rgb2hsv($rgb);
	$hex = ColorspaceConverter::hsv2hex($hsv);
	?>

## Methods
ColorspaceConverter currently supports RGB, HSV ans HEX

* rgb2hsv
* rgb2hex
* hsv2rgb
* hsv2hex
* hex2rgb
* hex2hsv
