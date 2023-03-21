# Mailgun Webhooks for Laravel

#### Tracking
This package allows you to quick and easily integrate your Laravel application with Mailgun Webhooks thus allowing you to track the outgoing email status for each individual user.

- Log when an email was delivered to a specific user
- Log when an email failed to send to a specific user
- etc...

This may be useful information you want to display to your end users or to a certain subset of users (Managers, Moderators, Admins, etc...). 

### Email Content Storage
This package will also store the content of the emails sent if you need to reference them at any point in the future. There are many use-cases for why this information is valuable.

- Verify a customers complaint with information in the email they received a few weeks ago
- Validate that a customer isn't altering / falsifying an email to benefit their case
- etc...

#### Alerts
This package allows gives you the ability to set it up so that you receive alerts for specific things. You have the ability to turn on and off the type of notifications you want to receive.
- Get notified when an email fails to deliver to a user
- Get notified when a user files a spam complaint
- etc...

## Installation Instructions

Lets begin the installation. First you'll need to install the package with composer.

`composer require biegalski-llc/laravel-mailgun-webhooks`

Next, you will want to publish the configuration and view files.

`php artisan vendor:publish --tag=mailgun_webhook_config`

`php artisan vendor:publish --tag=mailgun_webhook_view`

## DotEnv Configuration Options

Below you will find various options to configure this plugin to your needs.

### Options
Turn on and off certain features of this package
```
MAILGUN_WEBHOOKS_OPTIONS_DISABLE_CONTENT=false
MAILGUN_WEBHOOKS_OPTIONS_DISABLE_FLAG=false
MAILGUN_WEBHOOKS_OPTIONS_DISABLE_TAG=false
MAILGUN_WEBHOOKS_OPTIONS_DISABLE_VARIABLE=false
```

### Notifications
Turn on and off various notifications and set who these notifications send to.
```
MAILGUN_WEBHOOKS_ALERTS_TO=
MAILGUN_WEBHOOKS_ALERTS_FROM_EMAIL=
MAILGUN_WEBHOOKS_ALERTS_FROM_NAME=

MAILGUN_WEBHOOKS_TRIGGER_DELIVERED=false
MAILGUN_WEBHOOKS_TRIGGER_OPENED=false
MAILGUN_WEBHOOKS_TRIGGER_PERM_FAILURE=true
MAILGUN_WEBHOOKS_TRIGGER_SPAM=true
MAILGUN_WEBHOOKS_TRIGGER_TEMP_FAILURE=true
MAILGUN_WEBHOOKS_TRIGGER_UNSUBSCRIBE=true
```

### Content Logging
Storing all content can quickly build up disk space used. Turn on and off various pieces of content to store. Only store what you need! `body_html` by default is true, the rest by default are false.
```
MAILGUN_WEBHOOKS_CONTENT_LOG_STRIP_HTML=false
MAILGUN_WEBHOOKS_CONTENT_LOG_STRIP_TEXT=false
MAILGUN_WEBHOOKS_CONTENT_LOG_BODY_HTML=true
MAILGUN_WEBHOOKS_CONTENT_LOG_BODY_PLAIN=false
```

### Custom Database Connection
Storing all of these mailgun notifications in another database? Specify which database connection to use.
```
MAILGUN_WEBHOOKS_CUSTOM_DATABASE=null
```

### User Model
By default - we reference the App\Users model to form the relationship. If you use a custom model or have made changes to the User model - you may need to add and edit these variables to your dotenv as well:
```
MAILGUN_WEBHOOKS_USER_TABLE_NAME=users
MAILGUN_WEBHOOKS_USER_TABLE_EMAIL=email
MAILGUN_WEBHOOKS_USER_TABLE_KEY=id
MAILGUN_WEBHOOKS_USER_TABLE_FPQN=App\Users
```

### Signing Key
Mailgun allows you to set an HTTP webhook signing key, which can be different from the API key value set in the MAILGUN_SECRET environment variable used to connect to the Mailgun API for sending. This is especailly useful if you use Domain level sending API keys or have rotated the HTTP Webhook signing key. Defaults to the MAILGUN_SECRET value.
```
MAILGUN_WEBHOOKS_SIGNING_KEY=
```

After you've completed the configuration - lets re-cache it:

`php artisan config:cache`

Now, you'll need to run the database migrations:

`php artisan migrate`

And, finally, you'll need to add a middleware to the route middleware group. In `app\Http\Kernel.php` add the following line to the `routeMiddleware` group:

`'mailgun_webhooks' => \Biegalski\LaravelMailgunWebhooks\Middleware\ValidateMailgunWebhook::class,`

You're all set! Now you just need to add the API endpoints to the webhooks in your Mailgun account.

## Add Webhooks In Mailgun

1. Login
2. Navigate to `Sending` -> `Webhooks`
3. Click `Add Webhook` button
4. Select the appropriate `Event Type` and input its corresponding API endpoint. Endpoints listed below:

| Event Type | Endpoint URL |
| ----------- | ----------- |
| Clicks | https://domain.com/api/mg-webhooks/clicked |
| Delivered Messages | https://domain.com/api/mg-webhooks/delivered |
| Opened Messages | https://domain.com/api/mg-webhooks/opened |
| Permanent Failure | https://domain.com/api/mg-webhooks/perm-failure |
| Spam Complaints | https://domain.com/api/mg-webhooks/spam |
| Temporary Failure | https://domain.com/api/mg-webhooks/temp-failure |
| Unsubscribes | https://domain.com/api/mg-webhooks/unsubscribe |

*Replace "https://domain.com" with your applications URL.

## Usage

It starts collecting data and sending notifications after configuration is setup. You can dive deeper and extract or display this data. Usage steps for that coming soon!


## Affiliations

I have no affiliation with Laravel or Mailgun. Both are just frequently used in projects I am involved in and this package fills a need across various projects.

## Translations

There is currently 9 translations:

- German
- English
- Spanish
- French
- Italian
- Dutch
- Portuguese
- Russian
- Polish

More languages coming soon!

If you're unsure how localization works in Laravel, please reference the documentation at [https://laravel.com/docs/master/localization](https://laravel.com/docs/master/localization)

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits
- [Biegalski LLC](https://biegal.ski/)
- [paulredmond](https://gist.github.com/paulredmond/14523d3bd8062f9ce48cdd1340b3f171) - Laravel Middleware to Validate a signed Mailgun Webhook.
- [naszybko](https://github.com/naszybko) - Introducing events pull request and added Laravel 8 support
- [mafftor](https://github.com/mafftor) - Ukrainian translation
- [abordage](https://github.com/abordage) - Case-sensitivity fix
- [alistairreynolds](https://github.com/alistairreynolds) - Foreign key constraint fix
- [PunchRockgroin](https://github.com/PunchRockgroin) - Add Mailgun HTTP webhook signing key configuration
- [affektde](https://github.com/affektde) - Added PHP8 support
- [mharkrollen2](https://github.com/mharkrollen2) - fix table name for custom table

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
