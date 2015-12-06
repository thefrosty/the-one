<?php
/**
 * The multiple select customize control extends the WP_Customize_Control class.  This class allows
 * developers to create select fields with the `multiple` attribute within the WordPress theme customizer.
 *
 * @author     Jesper Johansen <kontakt@jayj.dk>
 * @copyright  Copyright (c) 2012, Jesper Johansen
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Multiple Select customize control class.
 *
 * @since 1.0.0
 */
class Multiple_Select_Custom_Control extends WP_Customize_Control {

	/* The type of customize control being rendered. */
	public $type = 'multiple-select';

	/* Displays the multiple select on the customize screen. */
	public function render_content() {

		if ( empty( $this->choices ) )
			return; ?>

			<label>
				<?php if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>
				<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo $this->description; ?></span>
				<?php endif; ?>
				<select <?php $this->link(); ?> multiple="multiple" size="10" style="width: 100%;">
					<?php
						foreach ( $this->choices as $value => $label ) {
							$selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
							echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
						}
					?>
				</select>
			</label>
		<?php
	}
}
