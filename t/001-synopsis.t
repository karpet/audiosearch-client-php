#!/usr/bin/env php
<?php
require_once 'Common.php';
require_once 'lib/Audiosearch/Client.php';

plan(30);

ok( $client = new Audiosearch_Client(), "new Client" );

ok( $show = $client->get('/shows/74'), "get /shows/74" );
ok( $show_i = $client->get_show(74), "get_show 74" );
is( $show->title, $show_i->title, "show titles match" );

ok( $episode = $client->get('/episodes/3431'), "get /episodes/3431" );
ok( $episode_i = $client->get_episode(3431), "get_episode 3431" );
is( $episode->title, $episode_i->title, "episode titles match" );

ok( $resp = $client->search(array('q' => 'test')), "search q=test" );
foreach ( $resp->results as $episode ) {
    ok( $episode->title, "hit has title" );
    ok( $episode->show_id, "hit has show_id" );
}

is( $resp->query, 'test', "search results has query" );
is( $resp->page, 1, "search results have page" );
