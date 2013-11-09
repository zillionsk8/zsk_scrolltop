<? // Settings page Class
class zskSettingsPage{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;
    /**
     * Start up
     */
    public function __construct(){
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }
    /**
     * Add options page
     */
    public function add_plugin_page(){
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'zsk Scroll To Top', 
            'manage_options', 
            'zsk_scrolltop_admin', 
            array( $this, 'create_admin_page' )
        );
    }
    /**
     * Options page callback
     */
    public function create_admin_page(){
        // Set class property
        $this->options = get_option( 'zsk_scrolltop' );
                
                wp_enqueue_media();
                wp_register_script('zsk-scrolltop-admin-js', ZSK_TOP_PLUGIN_PATH.'includes/zsk-scrolltop-admin.js', array('jquery'));
                wp_enqueue_script('zsk-scrolltop-admin-js');
                
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>zsk Scroll to Top Settings</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'zsk_option_group' );   
                do_settings_sections( 'zsk_scrolltop_settings' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php        
    }
    /**
     * Register and add settings
     */
    public function page_init() {        
        register_setting(
            'zsk_option_group', // Option group
            'zsk_scrolltop', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'NS Counter Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'zsk_scrolltop_settings' // Page
        );  

        add_settings_field(
            'zsk_scrolltop_image', // ID
            'Image to use for scroll to top', // Title 
            array( $this, 'zsk_scrolltop_image_callback' ), // Callback
            'zsk_scrolltop_settings', // Page
            'setting_section_id' // Section           
        );                  
    }
    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input ) {
        $new_input = array();

        if( isset( $input['zsk_scrolltop_image'] ) )
            $new_input['zsk_scrolltop_image'] = sanitize_text_field( $input['zsk_scrolltop_image'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info(){
        print 'Enter your settings below:';
    }
    /** 
     * Get the settings option array and print one of its values
     */
    public function zsk_scrolltop_image_callback(){
        printf(
                '<input type="text" id="zsk_scrolltop_image" name="zsk_scrolltop[zsk_scrolltop_image]" value="%s" />',
            isset( $this->options['zsk_scrolltop_image'] ) ? esc_attr( $this->options['zsk_scrolltop_image']) : '' 
        );
                echo '<input id="zsk_upload_image_button" class="button" type="button" value="Upload Image" /><br>Enter an URL or upload an image';
    }
}

?>
