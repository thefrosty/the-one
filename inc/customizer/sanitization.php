<?php

/**
 * Sanitize checkboxes.
 *
 * @param mixed $input
 *
 * @return bool
 */
function theone_sanitize_checkbox( $input ) {
	return absint( $input ) === 1 ? 1 : 0;
}

/**
 * Sanitize select and radio fields
 *
 * @link  http://cachingandburning.com/wordpress-theme-customizer-sanitizing-radio-buttons-and-select-lists/
 * @return string
 */
function theone_sanitize_choices( $input, $setting ) {
	global $wp_customize;

	$control = $wp_customize->get_control( $setting->id );

	if ( array_key_exists( $input, $control->choices ) ) {
		return $input;
	} else {
		return $setting->default;
	}
}

/**
 * Sanitize multiple select
 *
 * @return string
 */
function theone_sanitize_multiple_choices( $input, $setting ) {
	global $wp_customize;

	$control = $wp_customize->get_control( $setting->id );
	
	/*
	 * Choices are associative array, key => value.
	 * Let's flip it to value => key here because we need
	 * to compare it with values of a linear array soon.
	*/
	$control->choices = array_flip( $control->choices );
	
	/*
	 * Now, compare the values of saved choices (linear array)
	 * with values of recently flipped available choices (associative array),
	 * while preserving saved choices as an array.
	 */
	$input = array_intersect( $input, $control->choices );

	/*
	 * After comparison, there should be some matching pairs.
	 * If there's any, return it. Else, return default.
	 */
	if ( !empty( $input ) ) {
		return $input;
	} else {
		return $setting->default;
	}
}
