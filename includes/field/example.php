<?php
namespace Khromov\Atom\Field;

class Example {
    static function init() {
        add_action( 'add_meta_boxes_atom', array(__CLASS__, 'metabox'), 10, 2 );
    }

    static function metabox( $post_type, $post = null ) {
            add_meta_box(
                'my-meta-box',
                __( 'My Meta Box' ),
                array(__CLASS__, 'metabox_render'),
                'atom',
                'normal',
                'default'
            );
    }

    static function metabox_render($post) {
        global $wp_customize;

        $examples = array();

        require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';
        require_once ABSPATH . WPINC . '/class-wp-customize-setting.php';
        // @todo require_once __DIR__ . '/class-wp-customize-client-validated-setting.php';
        if ( empty( $wp_customize ) ) {
            $wp_customize = new \WP_Customize_Manager(); // WPCS: override ok.
            $wp_customize->register_controls();
        }

        // New sky color control.
        $id = 'sky_color';
        $setting = $wp_customize->add_setting( new \WP_Customize_Setting( $wp_customize, $id, array(
            'type' => 'js', // Prevent setting from being handled on the server.
            'transport' => 'none', // Prevent setting change from being synced anywhere.
            'default' => '#278df4',
        ) ) );
        // @todo Allow a control's setting param to be WP_Customize_Setting instances in addition to just setting IDs.
        $control = $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, $id, array(
            'label' => __( 'Sky Color', 'standalone-customizer-controls' ),
            'setting' => array( $setting->id ),
        ) ) );
        $examples['color-control'] = array(
            'heading' => __( 'Color Control', 'standalone-customizer-controls' ),
            'setting' => $setting,
            'control' => $control,
        );

        //add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
        add_action( 'admin_footer', array( $wp_customize, 'render_control_templates' ) );
        add_action( 'admin_footer', array( $wp_customize, 'render_section_templates' ) );

        if ( ! wp_script_is( 'customize-dynamic-control', 'registered' ) ) {
            ?>
            <div class="error">
                <p><?php esc_html_e( 'Please install and activate the Customize Posts plugin to make use of the Dynamic control bundled with it.', 'standalone-customizer-controls' ) ?></p>
            </div>
            <?php
        }

        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'Standalone Customizer Controls Demo', 'standalone-customizer-controls' ) ?></h1>

            <p>
                <?php esc_html_e( 'This is a demonstration of how to use Customizer settings and controls outside the context of the Customizer app. The goal of this demo is to show how Customizer controls can be used in Shortcode UI (Shortcake) forms and also provide an example for how Customizer controls can be embedded on the frontend.', 'standalone-customizer-controls' ); ?>
            </p>

            <?php foreach ( $examples as $example_id => $example ) : ?>
                <?php
                /**
                 * Control.
                 *
                 * @var \WP_Customize_Control $control
                 */
                $control = $example['control'];

                /**
                 * Setting.
                 *
                 * @var \WP_Customize_Setting $setting
                 */
                $setting = $example['setting'];

                $example_data = array_merge(
                    $example,
                    array(
                        'setting' => array(
                            'id' => $setting->id,
                            'params' => $setting->json(),
                        ),
                        'control' => array(
                            'id' => $control->id,
                            'params' => $control->json(),
                        ),
                    )
                );

                ?>
                <section id="<?php echo esc_attr( $example_id ) ?>" class="standalone-control-example" data-config="<?php echo esc_attr( wp_json_encode( $example_data ) ) ?>">
                    <h2><?php echo esc_html( $example_data['heading'] ) ?></h2>
                    <fieldset class="control"><ul></ul></fieldset>

                    <label class="setting" for="<?php echo esc_attr( $example_id . 'setting' ) ?>"><?php esc_html_e( 'Setting value (JSON):', 'standalone-customizer-controls' ) ?></label>
                    <textarea id="<?php echo esc_attr( $example_id . 'setting' ) ?>" class="setting widefat"></textarea>
                </section>
            <?php endforeach; ?>

            <script>
                jQuery( function( $ ) {
                    StandaloneCustomizerControls.init( wp.customize, $( ".standalone-control-example" ) );
                } );
            </script>
        </div>
        <?php
    }
}