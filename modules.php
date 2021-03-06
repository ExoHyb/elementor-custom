<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Modules class
 */
class Modules {

    /**
     * @var Module_Base[]
     */
    private  static $instance = null, $modules = [];

    public function __construct() {
        // Folder name as modules

        $this->modules = [
            'push-products',
            'push-categories'
        ];
    }

    public static function get_instance() {
        if ( ! self::$instance )
            self::$instance = new self;
        return self::$instance;
    }

    public function init(){
        add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_widget_categories' ) );
        add_action( 'elementor/init', array( $this, 'widgets_registered' ) );
        add_action( 'elementor/widget/posts/skins_init',  array( $this,'skin_registered'), 1 );
    }

    public function add_elementor_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'custom',
            [
                'title' => __( 'Elementor Custom', 'plugin-name' ),
                'icon' => 'fa fa-plug',
            ],
            1 // Position
        );
    }

    public function skin_registered($widget) {
        // We check if the Elementor plugin has been installed / activated.
        if(defined('ELEMENTOR_PATH') && class_exists('ElementorPro\Modules\Posts\Skins\Skin_Cards')){
            foreach ( $this->skins as $skin_name ) {
                include_once( __NAMESPACE__ . 'modules/' . $skin_name . '/skins/skin-posts.php' );
                $widget->add_skin( new Custom_Posts_Skin( $widget ) );
            }
        }
    }

    public function widgets_registered() {
        // We check if the Elementor plugin has been installed / activated.
        if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){
            if (isset($this->modules)) {
                foreach ( $this->modules as $module_name ) {
                    $widget = __NAMESPACE__ . 'modules/' . $module_name . '/widgets/widget-'.$module_name.'.php';
                    require_once ECW_PLUGIN_PLUGIN_PATH . $widget;
                }
            }
        }
    }
}
Modules::get_instance()->init();

