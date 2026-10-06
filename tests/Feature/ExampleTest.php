<?php
use RefreshDatabase;

test('the application returns a successful response', function () {
    $response = $this->post(route('login'),[
        'email' => 'centre.moga@gmail.com',
        'password' => 'Mog@Admin$123#',
    ]);

    $response->assertOk();
});
