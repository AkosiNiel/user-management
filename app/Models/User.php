<?php

<<<<<<< HEAD
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable; 
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * One-to-one relationship with Profile
     */
    public function profile(): \Illuminate\Database\Eloquent\Relations\HasOne
{
    return $this->hasOne(Profile::class);
}
}
=======
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename')->nullable();
            $table->string('address')->nullable();
            $table->string('company')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('position')->nullable();
            $table->enum('status', ['active', 'deactivate'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
>>>>>>> 973fba8 (changes)
