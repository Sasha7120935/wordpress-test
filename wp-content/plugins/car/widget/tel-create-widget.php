<?php
/**
 * Adding a new widget Tel_Widget.
 */
class Tel_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'tel_widget',
            esc_html__('Tel'),
            array('description' => esc_html__('add tel'))
        );

    }

    /**
     * Displaying a Widget in the Front End
     *
     * @param array $args widget arguments.
     * @param array $instance saved data from settings
     */
    function widget( $args, $instance )
    {
        $title = apply_filters('widget_title', $instance['tel']);
        echo $args['before_widget'];
        if (!empty($title))
        echo '<a href="tel:' . $title . '">' . $args['before_title'] . $title . $args['after_title'] . '</a>';
    }

    /**
     * Widget admin part
     *
     * @param array $instance saved data from settings
     */
    function form( $instance )
    {
        $tel = @ $instance['tel'] ?: '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('tel') ?>">
                <?php _e('Tel:', 'wl-test-theme'); ?>
            </label>
            <input class="tiny-text" style="width: 147px"
                   id="<?php echo $this->get_field_id('tel') ?>"
                   name="<?php echo $this->get_field_name('tel') ?>"
                   type="tel"
                   value="<?php echo absint($tel) ?>"
            />
        </p>
        <?php
    }

    /**
     * Saving widget settings. Here the data needs to be cleaned up and returned to save it to the database.
     *
     * @param array $new_instance new settings
     * @param array $old_instance previous settings
     *
     * @return array data to be saved
     * @see WP_Widget::update()
     *
     */
    function update( $new_instance, $old_instance )
    {
        $instance = array();
        $instance['tel'] = (!empty($new_instance['tel'])) ? sanitize_text_field($new_instance['tel']) : '';
        return $instance;
    }

}

function register_tel_widget()
{
    register_widget('Tel_Widget');
}

add_action('widgets_init', 'register_tel_widget');