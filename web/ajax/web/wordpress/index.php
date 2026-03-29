<?php

// Authentication checks
$authentication_check_this_is_nested_script = false;
$authentication_check_required_param['dataset']['domain'] = true;
include($_SERVER['DOCUMENT_ROOT']."/ajax/include_authentication_check.php");

// Form elements include
include($_SERVER['DOCUMENT_ROOT']."/inc/form-elements.php");

echo vesta_open_form('/ajax/web/wordpress/router.php');

echo vesta_get_hidden_fields();
//echo vesta_get_confirtmation_hidden_fields();

// install button block
echo vesta_get_element('button_gray', '', 'wordpress_install', __('Install WordPress'), null, 'width: 300px;', 'add', '['.__("What's this?").']', 'https://forum.cpvesta.ru/viewtopic.php?t=386');

$is_wordpress_installed=exec(VESTA_CMD."v-check-if-wordpress-is-installed ".escapeshellarg($vesta_logged_user)." ".escapeshellarg($domain), $output, $return_var);
if ($is_wordpress_installed == '1') {
    // lock/unlock buttons block
    $is_wordpress_locked=exec(VESTA_CMD."v-check-if-wordpress-is-locked ".escapeshellarg($vesta_logged_user)." ".escapeshellarg($domain), $output, $return_var);

    if ($is_wordpress_locked == '0') {$disabled = false; $add_style = ''; $link_text = '['.__("What's this?").']'; $link_url = 'https://forum.cpvesta.ru/viewtopic.php?t=725';}
    else {$disabled = true; $add_style = 'background-color: #ccc;'; $link_text = ''; $link_url = '';}
    echo vesta_get_element('button_gray', '', 'wordpress_lock', __('Lock WordPress'), null, 'width: 300px;'.$add_style, 'add', $link_text, $link_url, $disabled);
    
    if ($is_wordpress_locked == '1') {$disabled = false; $add_style = ''; $link_text = '['.__("What's this?").']'; $link_url = 'https://forum.cpvesta.ru/viewtopic.php?t=725';}
    else {$disabled = true; $add_style = 'background-color: #ccc;'; $link_text = ''; $link_url = '';}
    echo vesta_get_element('button_gray', '', 'wordpress_unlock', __('Unlock WordPress'), null, 'width: 300px;'.$add_style, 'add', $link_text, $link_url, $disabled);

    // Add admin user
    echo vesta_get_element('button_gray', '', 'wordpress_add_admin_user', __('Add WordPress Admin User'), null, 'width: 300px;', 'add', '['.__("What's this?").']', 'https://forum.cpvesta.ru/viewtopic.php?t=1130');

    // Clone
    echo vesta_get_element('button_gray', '', 'wordpress_clone_step1', __('Clone WordPress'), null, 'width: 300px;', 'add', '['.__("What's this?").']', 'https://forum.cpvesta.ru/viewtopic.php?t=385');
    echo '<small>('.__('Hint').': '.__('You can use this button to clone the WordPress to staging subdomain and later clone it back to the original domain').')</small>';
}

echo vesta_close_form();

exit;