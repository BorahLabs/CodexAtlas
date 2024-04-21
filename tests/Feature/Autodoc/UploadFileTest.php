<?php

use App\Livewire\Autodoc\UploadFile;
use App\Models\AutodocLead;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;

test('file can be uploaded', function () {
    $lead = AutodocLead::factory()->create();
    Livewire::test(UploadFile::class, [
        'lead' => $lead,
    ])
        ->set('data.file', UploadedFile::fake()->createWithContent('code.zip', file_get_contents(storage_path('mocks/qdrant.zip'))))
        ->call('uploadFile');

    $lead->refresh();
    expect($lead->zip_path)->not->toBeEmpty();
    expect($lead->framework)->not->toBeEmpty();
    expect($lead->first_file)->not->toBeEmpty();
});
