<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocaleTest extends TestCase
{
    use RefreshDatabase;

    private function makeUser(array $extra = []): User
    {
        return User::create(array_merge([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => 'password',
        ], $extra));
    }

    public function test_guests_are_redirected_to_filament_login(): void
    {
        $this->get('/dashboard')->assertRedirect('/admin/login');
    }

    public function test_unknown_language_is_rejected(): void
    {
        $this->get('/locale/xx')->assertNotFound();
    }

    public function test_guest_switch_is_stored_in_a_cookie(): void
    {
        $this->get('/locale/en')->assertRedirect()->assertCookie('locale', 'en');
    }

    public function test_logged_in_switch_is_stored_on_the_user(): void
    {
        $user = $this->makeUser();

        $this->actingAs($user)->get('/locale/en');

        $this->assertSame('en', $user->fresh()->locale);
    }

    public function test_dashboard_uses_the_users_saved_language(): void
    {
        $this->withoutVite();

        $this->actingAs($this->makeUser(['locale' => 'en']))
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Welcome back');

        $this->actingAs($this->makeUser(['email' => 'nl@example.com', 'locale' => 'nl']))
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Welkom terug');
    }

    public function test_cookie_language_is_used_for_guests_on_the_login_page(): void
    {
        $this->withoutVite();

        $this->withCookie('locale', 'en')
            ->get('/admin/login')
            ->assertOk();

        $this->assertSame('en', app()->getLocale());
    }

    public function test_users_screen_loads_for_a_logged_in_user(): void
    {
        $this->withoutVite();

        $this->actingAs($this->makeUser())
            ->get('/admin/users')
            ->assertOk();
    }
}
