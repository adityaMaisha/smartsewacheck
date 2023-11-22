<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\DatabaseMigrations;

return new class extends Migration
{
    use DatabaseMigrations;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            /* = = [ Personal Detail ] = = */
            $table->string('employee_code')->unique();
            $table->string('profile_photo');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('password');
            $table->string('office_email')->unique();
            $table->string('office_phone_number')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->timestamp('date_of_joining')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('department_id')->nullable()->comment('department_id and role_id both are same');
            $table->string('blood_group')->nullable();
            $table->string('country_id')->nullable();
            $table->string('state_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('address');
            $table->string('pincode');
            $table->string('emergency_contact_number');
            $table->enum('employee_status', ['active', 'inactive'])->default('inactive');

            /* = = [ Certifications ] = = */
            $table->string('pan_card_number');
            $table->string('pan_card_attachment');
            $table->string('address_proof_id_number');
            $table->string('address_proof_id_attachment');
            $table->string('other_documents_attachment');

            /* = = [ Bank Details ] = = */
            $table->string('bank_name');
            $table->string('account_holder_name');
            $table->enum('account_type', ['saving', 'current']);
            $table->string('account_number');
            $table->string('ifsc_code');
            $table->string('bank_branch');
            $table->string('bank_city');

            /* = = [ Other ] = = */
            $table->string('reference_id')->nullable()->comment('other employee id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
