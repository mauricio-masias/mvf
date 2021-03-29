<?php

namespace Tests\Feature;

use Tests\TestCase;

class CommandTest extends TestCase
{
    private $username = 'mauricio-masias';
    

    public function preferedDevLanguageCommandTest()
    {

        $this->artisan('search', ['username' => $this->username])
             ->expectsOutput(' [ PHP ]')
             ->assertExitCode(0);
    }

}
