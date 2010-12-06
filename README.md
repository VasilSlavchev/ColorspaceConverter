# ColorspaceConverter
A PHP-class for converting colorspaces.

## Examples
	<?php
	$rgb = ColorspaceConverter::hex2rgb('#FF0000'); // array(3) { ["r"]=> int(255) ["g"]=> int(0) ["b"]=> int(0) }
	$hsv = ColorspaceConverter::rgb2hsv($rgb); // array(3) { ["h"]=> int(0) ["s"]=> int(1) ["v"]=> int(1) }
	$hex = ColorspaceConverter::hsv2hex($hsv); // string(7) "#ff0000"
	?>

## Methods
ColorspaceConverter currently supports RGB, HSV and HEX

* rgb2hsv
* rgb2hex
* hsv2rgb
* hsv2hex
* hex2rgb
* hex2hsv
