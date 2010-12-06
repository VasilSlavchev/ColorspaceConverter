<?php

class ColorspaceConverter
{

	/**
	 * Converts RGB to HSV
	 *
	 * @access  public
	 * @param   integer  red
	 * @param   integer  green
	 * @param   integer  blue
	 * @return  array
	 */
	public static function rgb2hsv($r, $g = NULL, $b = NULL)
	{
		$hsl = array();
		$rgb = array();
		$delta_rgb = array();
		
		if (! is_array($r)) {
			$rgb['r'] = (int) $r;
			$rgb['g'] = (int) $g;
			$rgb['b'] = (int) $b;
		} else {
			$rgb = $r;
		}
		
		$rgb['r'] = $rgb['r'] / 255;
		$rgb['g'] = $rgb['g'] / 255;
		$rgb['b'] = $rgb['b'] / 255;
		
		$min = min($rgb);
		$max = max($rgb);
		$delta = $max - $min;
		
		$v = $delta;
		
		if ($delta == 0) {
			$h = 0;
			$s = 0;
		} else {
			$s = $delta / $max;
		}
		
		if ($max == 0) {
			$max = 1;
		}
		
		$delta_rgb['r'] = ((($max - $rgb['r']) / 6) + ($delta / 2)) / $max;
		$delta_rgb['g'] = ((($max - $rgb['g']) / 6) + ($delta / 2)) / $max;
		$delta_rgb['b'] = ((($max - $rgb['b']) / 6) + ($delta / 2)) / $max;
		
		switch ($max) {
			case $rgb['r']:
				$h = $rgb['b'] - $rgb['g'];
				break;
			case $rgb['g']:
				$h = (1 / 3) + $delta_rgb['r'] - $delta_rgb['b'];
				break;
			case $rgb['b']:
				$h = (1 / 3) + $delta_rgb['g'] - $delta_rgb['r'];
				break;
		}
		
		if ($h < 0) {
			$h++;
		}
		
		if ($h > 1) {
			$h--;
		}
		
		$hsl['h'] = $h;
		$hsl['s'] = $s;
		$hsl['v'] = $v;
		
		return $hsl;
	}
	
	/**
	 * Converts HSV to RGB
	 *
	 * @access  public
	 * @param   float    hue
	 * @param   float    saturation
	 * @param   float    value
	 * @return  array
	 */
	public static function hsv2rgb($h, $s = NULL, $v = NULL)
	{
		$rgb = array();
		
		if (! is_array($h)) {
			$hsv['h'] = (int) $h;
			$hsv['s'] = (int) $s;
			$hsv['v'] = (int) $v;
		} else {
			$hsv = $h;
		}
		
		if ($hsv['s'] == 0) {
			$r = $g = $b = $hsv['v'] * 255;
		}
		else
		{
			$hsv['h'] = $hsv['h'] * 6;
			$var_i = floor($hsv['h']);
			$var_1 = $hsv['v'] * (1 - $hsv['s']);
			$var_2 = $hsv['v'] * (1 - $hsv['s'] * ($hsv['h'] - $var_i));
			$var_3 = $hsv['v'] * (1 - $hsv['s'] * (1 - ($hsv['h'] - $var_i)));
			
			switch ($var_i) {
				case 0:
					$r = $hsv['v'];
					$g = $var_3;
					$b = $var_1;
					break;
				case 1:
					$r = $var_2;
					$g = $hsv['v'];
					$b = $var_1;
					break;
				case 2:
					$r = $var_1;
					$g = $hsv['v'];
					$b = $var_3;
					break;
				case 3:
					$r = $var_1;
					$g = $var_2;
					$b = $hsv['v'];
					break;
				case 4:
					$r = $var_3;
					$g = $var_1;
					$b = $hsv['v'];
					break;
				default:
					$r = $hsv['v'];
					$g = $var_1;
					$b = $var_2;
					break;
			}
			
			$r = $r * 255;
			$g = $g * 255;
			$b = $b * 255;
		}
		
		$rgb['r'] = $r;
		$rgb['g'] = $g;
		$rgb['b'] = $b;
		
		return $rgb;
	}
	
	/**
	 * Converts HEX to RGB
	 *
	 * @access  public
	 * @param   string   hex
	 * @return  array
	 */
	public static function hex2rgb($hex) {
		$hex = str_replace('#', '', $hex);
		$color = array();
		
		if (strlen($hex) == 3) {
			$color['r'] = hexdec(substr($hex, 0, 1) . $rgb['r']);
			$color['g'] = hexdec(substr($hex, 1, 1) . $rgb['g']);
			$color['b'] = hexdec(substr($hex, 2, 1) . $rgb['b']);
		} else {
			$color['r'] = hexdec(substr($hex, 0, 2));
			$color['g'] = hexdec(substr($hex, 2, 2));
			$color['b'] = hexdec(substr($hex, 4, 2));
		}
		
		return $color;
	}
	
	/**
	 * Converts RGB to HEX
	 *
	 * @access  public
	 * @param   integer  red
	 * @param   integer  green
	 * @param   integer  blue
	 * @return  array
	 */
	public static function rgb2hex($r, $g = NULL, $b = NULL) {
		$rgb = array();
		
		if (! is_array($r)) {
			$rgb['r'] = $r;
			$rgb['g'] = $g;
			$rgb['b'] = $b;
		} else {
			$rgb = $r;
		}
		
		$hex = '#';
		$hex.= str_pad(dechex($rgb['r']), 2, '0', STR_PAD_LEFT);
		$hex.= str_pad(dechex($rgb['g']), 2, '0', STR_PAD_LEFT);
		$hex.= str_pad(dechex($rgb['b']), 2, '0', STR_PAD_LEFT);
		
		return $hex;
	}

	/**
	 * Converts HEX to HSV
	 *
	 * @access  public
	 * @param   string   hex
	 * @return  array
	 */
	public static function hex2hsv($hex)
	{
		$rgb = Image_Tools::hex2rgb($hex);
		return Image_Tools::rgb2hsv($rgb);
	}
	
	/**
	 * Converts HSV to HEX
	 *
	 * @access  public
	 * @param   float    hue
	 * @param   float    saturation
	 * @param   float    value
	 * @return  array
	 */
	public static function hsv2hex($h, $s = NULL, $v = NULL)
	{
		$rgb = Image_Tools::hsv2rgb($h, $s, $v);
		return Image_Tools::rgb2hex($rgb);
	}
	
}