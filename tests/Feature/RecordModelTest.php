<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecordModelTest extends TestCase
{
    use RefreshDatabase;

    protected $recordModel;

    protected function setUp(): void
    {
        parent::setUp();

        $key = TestKey::create();
        $this->recordModel = new TestRecord();
        $this->recordModel->record_key()->associate($key);
        $this->recordModel->save();
    }

    public function test_record_key_is_a_belongsto_relationship()
    {
        $relationship = $this->recordModel->record_key();
        $this->assertInstanceOf(BelongsTo::class, $relationship);
    }

    public function test_record_key_is_related_to_key_model()
    {
        $related_model = $this->recordModel->record_key()->getRelated();
        $this->assertInstanceOf(TestKey::class, $related_model);
    }
}
