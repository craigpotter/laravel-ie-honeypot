<?php

namespace CraigPotter\LaravelIEHoneypot\Tests;

use CraigPotter\LaravelIEHoneypot\CaptureIE;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Testing\TestResponse;

class CaptureIETest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        $this->app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\Session\Middleware\StartSession');
    
        TestResponse::macro('assertPassedIEProtection', function () {
            $this
                ->assertSuccessful()
                ->assertSee('ok');

            return $this;
        });

        TestResponse::macro('assertDidNotPassIEProtection', function () {
            $content = $this
                ->assertSuccessful()
                ->baseResponse->content();

            TestCase::assertEquals('', $content, 'The request unexpectedly passed IE protection.');

            return $this;
        });

        TestResponse::macro('assertIEProtectionRedirected', function () {
            $this->assertRedirect(config('ie-honeypot.redirect_url'));
        
            return $this;
        });

        Route::any('test', function () {
            return 'ok';
        })->middleware(CaptureIE::class);

        Route::any('another-test', function () {
            return 'ok';
        })->middleware(CaptureIE::class);

        Route::any(config('ie-honeypot.redirect_url'), function () {
            return 'ok';
        })->middleware(CaptureIE::class);
    }

    /** @test */
    public function requests_will_always_succeed_when_the_package_is_not_enabled()
    {
        config()->set('ie-honeypot.enabled', false);

        $response = $this->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Trident/7.0; rv:11.0) like Gecko',
        ])->get('test');

        $response->assertPassedIEProtection();
    }
    
    /** @test */
    public function requests_that_are_not_ie_succeed()
    {
        $this
            ->get('test')
            ->assertPassedIEProtection();
    }

    /** @test */
    public function requests_to_ie_trap_always_act_as_expected()
    {

        // Test normal non IE
        $this->get(config('ie-honeypot.redirect_url'))
            ->assertPassedIEProtection();

        // Test IE gets redirected
        $response = $this->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Trident/7.0; rv:11.0) like Gecko',
        ])->get(config('ie-honeypot.redirect_url'));

        $response->assertIEProtectionRedirected();
    }

    /** @test */
    public function requests_from_ie_get_initially_redirected()
    {
        $response = $this->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Trident/7.0; rv:11.0) like Gecko',
        ])->get('test');

        $response->assertIEProtectionRedirected();
    }

    /** @test */
    public function ie_users_can_bypass_redirection_at_own_risk()
    {
        $response = $this->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Trident/7.0; rv:11.0) like Gecko',
        ])->get('test');

        $response->assertIEProtectionRedirected();

        $bypass = $this->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Trident/7.0; rv:11.0) like Gecko',
        ])->get('test?ie-bypass=true');

        $bypass->assertPassedIEProtection();
    }

    /** @test */
    public function ie_users_cant_bypass_without_url_param()
    {
        $response = $this->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Trident/7.0; rv:11.0) like Gecko',
        ])->get('test');

        $response->assertIEProtectionRedirected();

        $bypassFail = $this->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Trident/7.0; rv:11.0) like Gecko',
        ])->get('another-test');

        $bypassFail->assertIEProtectionRedirected();
    }

    /** @test */
    public function ie_users_can_access_other_pages_after_successful_bypass()
    {
        $response = $this->withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Trident/7.0; rv:11.0) like Gecko',
            ])->get('test');
    
        $response->assertIEProtectionRedirected();
    
        $bypass = $this->withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Trident/7.0; rv:11.0) like Gecko',
            ])->get('test?ie-bypass=true');
    
        $bypass->assertPassedIEProtection();

        $anotherBypass = $this->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Trident/7.0; rv:11.0) like Gecko',
        ])->get('another-test');

        $anotherBypass->assertPassedIEProtection();
    }

    /** @test */
    public function ie_bypass_blade_directive_returns_correct_string()
    {
        $response = $this->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Trident/7.0; rv:11.0) like Gecko',
        ])->get('test');

        $response->assertIEProtectionRedirected();

        $bladeSnippet = '@ieBypass';
        $expectedCode = "<?php echo session('ie-bypass-trapped', ''); ?>?ie-bypass=true";

        $this->assertEquals($expectedCode, Blade::compileString($bladeSnippet));
    }
}
