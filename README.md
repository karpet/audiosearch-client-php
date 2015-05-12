Audiosear.ch PHP Client
=========================================

PHP client SDK for https://www.audiosear.ch/

See docs at https://www.audiosear.ch/developer/

OAuth credentials are available from https://www.audiosear.ch/oauth/applications

Example:

```php
require_once 'path/to/Audiosearch/Client.php';

# create a client
$client = new Audiosearch_Client(
  'key'     => 'oauth_id',
  'secret'  => 'oauth_secret',
  'host'    => 'https://www.audiosear.ch/',
  'debug'   => false,
)

# fetch a show with id 1234
$show = $client->get('/shows/1234');
# or more idiomatically
$show = $client->get_show(1234);

# fetch an episode
$episode = $client->get('/episodes/5678');
# or idiomatically
$episode = $client->get_episode(5678);

# search
$res = $client->search(array('q' => 'test'));
foreach($res->results as $episode) {
  printf("[%s] %s (%s)\n", $episode->id, $episode->title, $episode->show_title);
}

```

## Development

This package uses composer. To install dependencies you'll need the composer tool
from https://getcomposer.org/. Then:

```bash
make install
```

To run the tests, create a **.env** file in the checkout
with the following environment variables set to meaningful values:

```
AS_ID=somestring
AS_SECRET=sekritstring
AS_HOST=http://audiosear.ch.dev
```

Then run the tests:

```bash
make test
```

