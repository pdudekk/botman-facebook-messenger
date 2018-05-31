## BotMan studio facebook messenger bot

Facebook messenger bot created with [Botman Studio](https://botman.io/)

## Prerequisites

- [Facebook for developers](https://developers.facebook.com) account and created messenger app.
- Test Facebook site.
- Cloud platform as service like [Heroku](https://dashboard.heroku.com).

## Installation

###### Clone the repository to new folder.

`git clone git@github.com:pdudekk/botman-facebook-messenger.git botman-facebook-messenger`

###### Navigate to botman-facebook-messenger folder.

`cd botman-facebook-messenger`

###### Rename .env.example file

`rename .env.example .env`

###### Fill this information in .env file from [Facebook for developers](https://developers.facebook.com) website in app dashboard.

```
FACEBOOK_TOKEN=
FACEBOOK_APP_SECRET=
FACEBOOK_VERIFICATION=
```

FACEBOOK_TOKEN can be found in Messenger settings under Token generation.

FACEBOOK_APP_SECRET can be found in basic settings under App Secret.

FACEBOOK_VERIFICATION is token created by app owner.

###### After that still on  [Facebook for developers](https://developers.facebook.com) website in app dashboard under Webhooks :

Callback URL is application url + /botman.

Verify Token = FACEBOOK_VERIFICATION.

On Subscription Fields You can check _messages_ and _messaging_postbacks_.

###### After that Messenger app can be turned on.


## License

BotMan is free software distributed under the terms of the MIT license.
