<?php
/*
 * Plugin Name: Hello World
 * Description: Try create plugin wordpress 
 * Author: siEmpuL
 */

// ** PROTEC FILE
if ( !defined('ABSPATH') ) {
    echo 'Hi there!  I\'m just trial a plugin, not much I can do when called directly. ';
    exit;
}

add_action( 'admin_menu', function(){
    $pageTitle = __('My Helloworld');
    $menuTitle = $pageTitle;
    $capability = 'edit_pages'; // permission just admin
    $menuSlug = 'helloworld';
    $icon = 'dashicons-buddicons-groups';
    $position = 50; // https://developer.wordpress.org/reference/functions/add_menu_page/#default-bottom-of-menu-structure

    $menu = add_menu_page($pageTitle, $menuTitle, $capability, $menuSlug, function () {
        dasboard_helloword();
    }, $icon, $position);

    // allow editor save page settings
    add_filter(
        hook_name: 'option_page_capability_helloworld_settings',
        callback: fn($capability) => 'edit_pages'
    );
});

// helloword dashboard
function dasboard_helloword(){
    ?>
    <style>
        h1 {
            color:red;
        }
    </style>
    <h1>Hallo Plugin Trial</h1>
    <p>nb : call this feature using shorcode [show_helloworld_feature] or do_shortcode('show_helloworld_feature')</p>
    <form action="options.php" method="POST">
        <?php settings_fields('helloworld_settings'); ?>
        <input type="text" name="helloworld_inputan1" value="<?= get_option('helloworld_inputan1') ?>" id="">
        <button class="button button-primary">save</button>
    </form>
    <?php
}

// attach the settings to the admin_init hook
add_action('admin_init', function () {
    // specify settings name to be saved to wp_options table
    $optionGroup = 'helloworld_settings';
    register_setting(
        option_group: $optionGroup,
        option_name: 'helloworld_inputan1'
    );
});

add_shortcode('show_helloworld_feature', function() {
    $inputan1 = get_option('helloworld_inputan1');
    ?>
    <h5><?= $inputan1 ?></h5>
    <?php
});
