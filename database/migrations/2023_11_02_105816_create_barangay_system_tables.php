<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->down();

        $this->createBarangays();
        $this->createBarangayUsers();
        $this->createBarangayZones();
        $this->createBarangayStreets();
        $this->createBarangayHouseholdWithHistory();
        $this->createResidentsWithHistory();
        $this->createDocumentTemplates();
        $this->createDocumentRequests();
        $this->createBarangayPersonnel();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->dropBarangayPersonnel();
        $this->dropDocumentRequests();
        $this->dropDocumentTemplates();
        $this->dropResidentsWithHistory();
        $this->dropBarangayHouseholdsWithHistory();
        $this->dropBarangayZones();
        $this->dropBarangayStreets();
        $this->dropBarangayUsers();
        $this->dropBarangays();
    }

    function createBarangays()
    {
        Schema::create('barangays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    function dropBarangays()
    {
        Schema::dropIfExists('barangays');
    }

    function createBarangayUsers()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('barangay_id')->nullable()->constrained();
        });
    }

    function dropBarangayUsers()
    {
        if (Schema::hasColumn('users', 'barangay_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('barangay_id');
            });
        }
    }

    function createBarangayZones()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barangay_id')->constrained();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    function dropBarangayZones()
    {
        Schema::dropIfExists('zones');
    }

    function createBarangayHouseholdWithHistory()
    {
        $historizedAttributes = function (Blueprint $table) {
            $table->foreignId('barangay_id')->constrained();
            $table->string('number');
            // decision time
            $table->date('date_accomplished')->nullable();
            // transaction time
            $table->timestamps();
            // valid time
            $table->softDeletes();
        };

        Schema::create('households', function (Blueprint $table) use ($historizedAttributes) {
            $table->id();
            $historizedAttributes($table);
        });

        Schema::create('household_history', function (Blueprint $table) use ($historizedAttributes) {
            $table->id();
            $table->foreignId('household_id')->constrained();
            $historizedAttributes($table);
        });
    }

    function dropBarangayHouseholdsWithHistory()
    {
        Schema::dropIfExists('household_history');
        Schema::dropIfExists('households');
    }

    function createBarangayStreets()
    {
        Schema::create('streets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barangay_id')->constrained();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    function dropBarangayStreets()
    {
        Schema::dropIfExists('streets');
    }

    function createResidentsWithHistory()
    {
        $this->createBirthPlaces();
        $this->createGenders();
        $this->createCivilStatuses();
        $this->createCitizenships();
        $this->createOccupations();

        $historizedAttributes = function (Blueprint $table) {
            $table->foreignId('barangay_id')->constrained();
            $table->foreignId('household_id')->nullable()->constrained();
            // name
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('extension_name')->nullable();
            // address
            $table->string('house_number')->nullable();
            $table->foreignId('street_id')->nullable()->constrained();
            $table->foreignId('zone_id')->nullable()->constrained();
            // birth
            $table->foreignId('birth_place_id')->nullable()->constrained();
            $table->date('birth_date')->nullable();
            $table->foreignId('gender_id')->nullable()->constrained();
            // civil status
            $table->foreignId('civil_status_id')->nullable()->constrained();
            // citizenship
            $table->foreignId('citizenship_id')->nullable()->constrained();
            // occupation
            $table->foreignId('occupation_id')->nullable()->constrained();
            // decision time
            $table->date('date_accomplished');
            // transaction time
            $table->timestamps();
            // valid time
            $table->softDeletes();
        };

        Schema::create('residents', function (Blueprint $table) use ($historizedAttributes) {
            $table->id();
            $historizedAttributes($table);
        });
        Schema::create('resident_history', function (Blueprint $table) use ($historizedAttributes) {
            $table->id();
            $table->foreignId('resident_id')->constrained();
            $historizedAttributes($table);
        });
    }

    function dropResidentsWithHistory()
    {
        Schema::dropIfExists('resident_history');
        Schema::dropIfExists('residents');

        $this->dropBirthPlaces();
        $this->dropGenders();
        $this->dropCivilStatuses();
        $this->dropCitizenships();
        $this->dropOccupations();
    }

    function createDocumentTemplates()
    {
        Schema::create('document_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barangay_id')->nullable()->constrained();
            $table->string('file_path');
            $table->jsonb('form_schema');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    function dropDocumentTemplates()
    {
        Schema::dropIfExists('document_templates');
    }

    function createDocumentRequests()
    {
        Schema::create('document_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barangay_id')->constrained();
            $table->foreignId('document_template_id')->constrained();
            $table->foreignId('resident_id')->nullable()->constrained();
            $table->foreignId('resident_history_id')->nullable()->constrained();
            $table->jsonb('form_data');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    function dropDocumentRequests()
    {
        Schema::dropIfExists('document_requests');
    }

    function createBarangayPersonnel()
    {
        $this->createPositions();

        Schema::create('personnel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barangay_id')->constrained();
            // name
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('extension_name')->nullable();
            // position
            $table->foreignId('position_id')->nullable()->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    function dropBarangayPersonnel()
    {
        Schema::dropIfExists('personnel');

        $this->dropPositions();
    }

    function createPositions()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    function dropPositions()
    {
        Schema::dropIfExists('positions');
    }

    function createBirthPlaces()
    {
        Schema::create('birth_places', function (Blueprint $table) {
            $table->id();
            // province and city_or_municipality is nullable
            // in case of missing information
            $table->string('province')->nullable();
            $table->string('city_or_municipality')->nullable();
            // label must still exist
            $table->string('label');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    function dropBirthPlaces()
    {
        Schema::dropIfExists('birth_places');
    }

    function createGenders()
    {
        Schema::create('genders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    function dropGenders()
    {
        Schema::dropIfExists('genders');
    }

    function createCivilStatuses()
    {

        Schema::create('civil_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    function dropCivilStatuses()
    {
        Schema::dropIfExists('civil_statuses');
    }

    function createCitizenships()
    {
        Schema::create('citizenships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    function dropCitizenships()
    {
        Schema::dropIfExists('citizenships');
    }

    function createOccupations()
    {
        Schema::create('occupations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    function dropOccupations()
    {
        Schema::dropIfExists('occupations');
    }
};
