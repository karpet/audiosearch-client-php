#!/usr/bin/env php
<?php
require_once 'Common.php';

require_once 'lib/Audiosearch/Client.php';

plan(1);

ok( $client = new Audiosearch_Client(), "new Client" );
