<?php

namespace Llama\Modules\tests;

use Llama\Modules\Facades\Module;

class ModuleFacadeTest extends BaseTestCase
{
    /** @test */
    public function it_resolves_the_module_facade()
    {
        $modules = Module::all();

        $this->assertTrue(is_array($modules));
    }
}
