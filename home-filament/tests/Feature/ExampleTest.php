<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_application_redirects_guests_to_filament_login(): void
    {
        $this->get('/dashboard')
            ->assertRedirect('/admin/login');
    }
}
