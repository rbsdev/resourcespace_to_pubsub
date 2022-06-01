# ResourceSpace to Pubsub

This [ResourceSpace plugin](https://www.resourcespace.com/knowledge-base/developers/modifications-and-writing-your-own-plugin) will send a message to a specified [Google Pubsub](https://cloud.google.com/pubsub) Topic when a user uploads a file.

# Installation

To install this plugin, extract it in the ResourceSpace plugins directory, and then either add "resourcespace_to_pubsub" to your plugins array in config.php, or use the new plugins manager to activate it.

On list of plugins page, search for PubSub

![On list of plugins, search PubSub](/gfx/activate-plugin.png)

Once activated, configure project id, topic name and service account on settings page.

![Once activated, configure project id, topic name and service account on settings page](/gfx/configure-plugin.png)

Voilà! After every file uploaded successfully, this plugin will send a message to the PubSub topic configured. With message format:

```json
{
    "resource_id": 0 // id of resource uploaded
}
```

> Note: Even if failed send message, the upload will be finish successfully. Errors will be logged in php error log and resourcespace debug log. Just `grep` for `pubsub` on files to find it.
