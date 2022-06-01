<?php
$_include_path = '../../../../include/';

// Do the include and authorization checking ritual -- don't change this section.
include $_include_path . 'db.php';
include $_include_path .'authenticate.php';
if (!checkperm('a')) {
    http_response_code(401);
    exit($lang['error-permissiondenied']);
}
include_once $_include_path . 'general_functions.php';

// Specify the name of this plugin and the heading to display for the page.
$plugin_name = 'resourcespace_to_pubsub';
#if(!in_array($plugin_name, $plugins)) {
#    plugin_activate_for_setup($plugin_name);
#}

$plugin_page_heading = $lang['resourcespace_to_pubsub_configuration'];

// Build the $page_def array of descriptions of each configuration variable the plugin uses.
$page_def[] = config_add_html($lang['resourcespace_to_pubsub_summary']);
$page_def[] = config_add_text_input('resourcespace_to_pubsub_project_id', $lang['resourcespace_to_pubsub_project_id']);
$page_def[] = config_add_text_input('resourcespace_to_pubsub_topic_name', $lang['resourcespace_to_pubsub_topic_name']);
//$page_def[] = config_add_text_input('resourcespace_to_pubsub_service_account', $lang['resourcespace_to_pubsub_service_account'], true);
$page_def[] = config_add_text_input('resourcespace_to_pubsub_service_account', $lang['resourcespace_to_pubsub_service_account'], false, 420, true);

// Do the page generation ritual -- don't change this section.
$upload_status = config_gen_setup_post($page_def, $plugin_name);
include $_include_path . 'header.php';
if (isset($error)) {
    $error = htmlspecialchars($error);
    echo "<div class=\"PageInformal FormError\">{$error}</div>";
}
config_gen_setup_html($page_def, $plugin_name, $upload_status, $plugin_page_heading);
include $_include_path . 'footer.php';
