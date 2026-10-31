<?php

namespace Tests\Feature;

use Tests\TestCase;

class ShowroomTest extends TestCase
{
    public function test_make_filter_only_displays_matching_sample_vehicle(): void
    {
        $this->get('/?make=Porsche')->assertOk()->assertSee('911 Carrera S')->assertDontSee('S 580');
    }
}
