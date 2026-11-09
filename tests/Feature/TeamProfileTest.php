<?php

namespace Tests\Feature;

use Tests\TestCase;

class TeamProfileTest extends TestCase
{
    /**
     * Test halaman profil tim pengembang dapat diakses dan memuat 6 profil.
     */
    public function test_halaman_tim_pengembang_dapat_diakses(): void
    {
        $response = $this->get(route('tim.profil'));

        $response->assertStatus(200);
        $response->assertSee('WARLD');
        $response->assertSee('Wanda');
        $response->assertSee('Arif');
        $response->assertSee('Rama');
        $response->assertSee('Lelek');
        $response->assertSee('Dimas');
        $response->assertSee('Dika');
        $response->assertSee('warld-logo.png');
    }

    /**
     * Test footer memuat tautan menuju profil tim pengembang.
     */
    public function test_footer_memuat_logo_dan_link_tim_pengembang(): void
    {
        $view = $this->view('layouts.partials.public-footer');

        $view->assertSee(route('tim.profil'));
        $view->assertSee('simerahkoja.png');
        $view->assertSee('warld-logo.png');
        $view->assertSee('footer-warld-logo');
    }
}
