# Mailjet Subscribe for Craft CMS 3.x

Simple Craft plugin for subscribing to a Mailjet list.

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Settings

In the plugin settings you have to set
- Public API key
- Private API key
- List ID you want to use (currently you have to use the same list in all forms)

## Usage

The plugin consists of a controller function that needs an email address, which it then passes on to the mailjet service to handle subscribing.
Post your subscription form to `mailjet-subscribe/list/subscribe` like the example below: 

```html
<form class="form" method="POST">
    {{ csrfInput() }}
    <input type="hidden" name="action" value="mailjet-subscribe/list/subscribe">
    <input type="email" id="email" name="email" required value="{% if (mailjetSubscribe is defined) and (not mailjetSubscribe.success) %}{{ mailjetSubscribe.values.email }}{% endif %}">
    <input type="submit" value="Subscribe">
</form>
```
