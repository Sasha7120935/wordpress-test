<?php
/**
 * Plugin Name: Car
 * Plugin URI: https://wordpress.com/
 * Description: An Car toolkit that helps you sell anything. Beautifully.
 * Version: 6.3.1
 * Author: Automattic
 * Author URI: https://wordpress.com/
 * Text Domain:
 * Domain Path: /languages/
 * Requires at least: 5.7
 * Requires PHP: 7.0
 *
 * @package Car
 */
$event = esc_attr(get_post_meta(get_the_ID(), 'hcf_fuel', true));
?>
<div class="hcf_box">
    <style scoped>
        .hcf_box {
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }

        .hcf_field {
            display: contents;
        }
    </style>
    <p class="meta-options hcf_field">
        <label for="hcf_color"><?php _e( 'Color', 'wl_test_theme') ?></label>
        <input id="hcf_color"
               type="color"
               name="hcf_color"
               value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'hcf_color', true)); ?>" required>
    </p>
    <p class="meta-options hcf_field">
        <label for="hcf_power"><?php _e( 'Power', 'wl_test_theme') ?></label>
        <input id="hcf_power"
               type="number"
               name="hcf_power"
               value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'hcf_power', true)); ?>" required>
    </p>
    <p class="meta-options hcf_field">
        <label for="hcf_price"><?php _e( 'Price', 'wl_test_theme') ?></label>
        <input id="hcf_price"
               type="number"
               name="hcf_price"
               value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'hcf_price', true)); ?>" required>
    </p>
    <p class="meta-options hcf_field">
        <label for="hcf_fuel"><?php _e( 'Fuel','wl_test_theme'); ?></label>
        <select id="hcf_fuel"
                name="hcf_fuel">
            <option value="select"><?php _e( 'Select', 'wl_test_theme' ); ?></option>
            <option value="petrol" <?php echo ($event === 'petrol') ? ' selected' : ''; ?>><?php _e( 'Petrol', 'wl_test_theme' ); ?></option>
            <option value="gas" <?php echo ($event === 'gas') ? ' selected' : ''; ?>><?php _e( 'Gas', 'wl_test_theme' ); ?> </option>
            <option value="diesel" <?php echo ($event === 'diesel') ? ' selected' : ''; ?>><?php _e( 'Diesel', 'wl_test_theme' ); ?></option>
        </select required>
    </p>
</div>