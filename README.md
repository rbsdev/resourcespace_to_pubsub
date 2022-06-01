# ResourceSpace to Pubsub

This [ResourceSpace plugin](https://www.resourcespace.com/knowledge-base/developers/modifications-and-writing-your-own-plugin) will send a message to a specified [Google Pubsub](https://cloud.google.com/pubsub) Topic when a user uploads a file.

## Message Format

```json
{
    "resource_id": "id of resource"
}
```

# Installation

To install this plugin, extract it in the ResourceSpace plugins directory, and then either add "resourcespace_to_pubsub" to your plugins array in config.php, or use the new plugins manager to activate it.

After activate plugin, configure project id, topic name and service account on settings page.
