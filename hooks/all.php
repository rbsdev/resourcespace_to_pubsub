<?php
require __DIR__ . '/../vendor/autoload.php';

# Imports the Google Cloud client library
use Google\Cloud\PubSub\PubSubClient;

/**
 * Hook Called on all pages when every file was sucessfully uploaded
 */
function HookResourcespace_to_pubsubAllUploadfilesuccess($resource_id) {
    debug_function_call('HookResourcespace_to_pubsubAllUploadfilesuccess', func_get_args());
    global $resourcespace_to_pubsub_project_id, $resourcespace_to_pubsub_service_account, $resourcespace_to_pubsub_topic_name;

    $service_account = json_decode($resourcespace_to_pubsub_service_account, true);

    if (!$resourcespace_to_pubsub_project_id || !$resourcespace_to_pubsub_service_account || !$resourcespace_to_pubsub_topic_name) {
        debug('resourcespace_to_pubsub - plugin not properly configured, missing some configuration');
        error_log(__FILE__ . ' ' . __LINE__ . ' plugin not properly configured, missing some configuration');
        return;
    }

    if (!$service_account) {
        debug('resourcespace_to_pubsub - plugin not properly configured, pubsub_service_account is invalid json');
        error_log(__FILE__ . ' ' . __LINE__ . ' plugin not properly configured, pubsub_service_account is invalid json');
        return;
    }

    try {
        debug("resourcespace_to_pubsub - UploadFileSuccess hook: start '$resource_id'");

        # Instantiates a client
        $pubsub = new PubSubClient([
            'projectId' => $resourcespace_to_pubsub_project_id,
            'keyFile' => $service_account
        ]);

        // Get an instance of a previously created topic.
        $topic = $pubsub->topic($resourcespace_to_pubsub_topic_name);

        // Publish a message to the topic.
        $result = $topic->publish([
            'data' => json_encode(array('resource_id' => $resource_id))
        ]);

        debug("resourcespace_to_pubsub - UploadFileSuccess hook: end '$resource_id', " . json_encode($result));
    } catch (Exception $e) {
        debug('resourcespace_to_pubsub - error on publish message to pubsub for resource (' . $resource_id . ') ' . $e->getMessage());
        error_log(__FILE__ . ' ' . __LINE__ . ' ' . $e->getMessage());
    }
}
