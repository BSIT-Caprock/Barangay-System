<?php

namespace Tests\Feature;

use App\Models\Abstract\KeyModel;
use App\Models\Abstract\RecordModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertTrue;

class KeyModelTest extends TestCase
{
    use RefreshDatabase;

    protected $keyModel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->keyModel = TestKey::create();
    }
    
    public function test_records_is_a_hasmany_relationship()
    {
        $relationship = $this->keyModel->records();
        $this->assertInstanceOf(HasMany::class, $relationship);
    }

    public function test_records_is_related_to_record_model()
    {
        $related_model = $this->keyModel->records()->getRelated();
        $this->assertInstanceOf(TestRecord::class, $related_model);
    }

    public function test_records_can_contain_many_record_models()
    {   
        $this->keyModel->records()->saveMany([
            new TestRecord(), 
            new TestRecord(),
        ]);

        $this->keyModel->refresh();

        $records = $this->keyModel->records;

        $this->assertEquals(2, $records->count());
    }

    public function test_latestRecord()
    {
        $record1 = new TestRecord();
        $record2 = new TestRecord();

        $this->keyModel->records()->saveMany([
            $record1, 
            $record2,
        ]);

        $this->keyModel->refresh();

        $latestRecord = $this->keyModel->latest_record;

        $this->assertEquals($record2->id, $latestRecord->id);
    }

    public function test_scopeUnused()
    {
        $this->assertTrue(TestKey::unused()->get()->contains($this->keyModel));
    }

    public function test_createRecord()
    {
        $key = TestKey::createRecord();
        $this->assertEquals(1, $key->records->count());
    }
}

class TestKey extends KeyModel
{
    protected $table = 'test_keys';

    protected static $recordModel = TestRecord::class;
}

class TestRecord extends RecordModel
{
    protected $table = 'test_records';

    protected $fillable = ['key_id'];

    protected static $keyModel = TestKey::class;
}