<?php

test('enums to be enums')
    ->expect('App\Enums')
    ->toBeEnums();

test('contracts to be interfaces')
    ->expect('App\Contracts')
    ->toBeInterfaces();

test('concerns to be traits')
    ->expect(['App\Concerns', 'App\Models\Traits', 'App\Models\Concerns'])
    ->toBeTraits();

test('not to use forbidden functions')
    ->expect(['dd', 'dump', 'var_dump', 'print_r', 'exit', 'die', 'phpinfo', 'shell_exec', 'system', 'passthru', 'exec', 'popen', 'proc_open', 'eval'])
    ->not->toBeUsed();

test('controllers naming')
    ->expect('App\Http\Controllers')
    ->toHaveSuffix('Controller');

test('env variables to be used only from config')
    ->expect('env')
    ->not->toBeUsedIn('App');
