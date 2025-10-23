<?php

namespace WPPS\Admin;

class Page {

    /**
     * 1️⃣ Initialize hooks for admin panel.
     * This method is called from WPPS_Loader::init()
     */
    public static function init() {
        // Add "Post Seeder" menu item
        add_action( 'admin_menu', [ __CLASS__, 'add_admin_page' ] );

        // Enqueue styles and scripts only in admin panel
        add_action( 'admin_enqueue_scripts', [ __CLASS__, 'enqueue_assets' ] );
    }

    /**
     * 2️⃣ Register page in admin menu
     */
    public static function add_admin_page() {
        add_menu_page(
            __( 'WP Post Seeder', 'wp-post-seeder' ), // Page title
            __( 'Post Seeder', 'wp-post-seeder' ),    // Menu name
            'manage_options',                         // Who can see
            'wpps',                                   // page slug
            [ __CLASS__, 'render_admin_page' ],       // callback for content output
            'dashicons-database-import',              // Menu icon
            80                                        // Position
        );
    }

    /**
     * 3️⃣ Enqueue CSS and JS for plugin page
     */
    public static function enqueue_assets( $hook ) {
        // To prevent scripts from loading on all admin pages
        if ( $hook !== 'toplevel_page_wpps' ) {
            return;
        }

        wp_enqueue_style(
            'wpps-admin',
            WPPS_URL . 'assets/dist/admin.css',
            [],
            filemtime( WPPS_PATH . 'assets/dist/admin.css' )
        );

        wp_enqueue_script(
            'wpps-admin',
            WPPS_URL . 'assets/dist/admin.js',
            [],
            filemtime( WPPS_PATH . 'assets/dist/admin.js' ),
            true
        );
    }

    /**
     * 4️⃣ Content of "Post Seeder" page
     */
    public static function render_admin_page() {
        ?>
        <div class="wrap wpps-admin">
            <h1><?php esc_html_e( 'WP Post Seeder', 'wp-post-seeder' ); ?></h1>
            <p><?php esc_html_e( 'Generate sample posts for development and testing.', 'wp-post-seeder' ); ?></p>

            <form id="wpps-form" method="post">
                <table class="form-table">
                    <tr>
                        <th><label for="post_type"><?php esc_html_e( 'Post Type', 'wp-post-seeder' ); ?></label></th>
                        <td>
                            <select name="post_type" id="post_type">
                                <?php
                                $post_types = get_post_types( [ 'public' => true ], 'objects' );
                                foreach ( $post_types as $type ) {
                                    printf(
                                        '<option value="%s">%s</option>',
                                        esc_attr( $type->name ),
                                        esc_html( $type->labels->singular_name )
                                    );
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="count"><?php esc_html_e( 'Number of posts', 'wp-post-seeder' ); ?></label></th>
                        <td><input type="number" name="count" id="count" value="5" min="1" max="100"></td>
                    </tr>
                </table>

                <?php submit_button( __( 'Generate Posts', 'wp-post-seeder' ) ); ?>
            </form>
        </div>
        <?php
    }
}
