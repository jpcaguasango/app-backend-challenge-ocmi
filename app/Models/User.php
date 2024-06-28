<?php

namespace App\Models;

use App\Scopes\OnlyClientScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new OnlyClientScope);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'clientId',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    /**
     * The attributes that should be related by default.
     *
     * @var array
     */
    protected $with = ['client'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public static function getPermissions($user)
    {
        $permissions = [];
        $roles = $user->roles;

        foreach ($roles as $role) {
            // Add ability of the role
            array_push($permissions, $role->slug);

            // Is full access?
            if ($role->fullAccess)
                return array('*');

            // Add abilities from role
            foreach ($role->permissions as $permission) {
                array_push($permissions, $permission->slug);
            }
        }

        return $permissions;
    }

    public static function isAdmin($user)
    {
        $roles = $user->roles;

        foreach ($roles as $role) {
            // Is full access?
            if ($role->fullAccess)
                return true;
        }

        return false;
    }

    public static function removeTokens($user)
    {
        $user->tokens()->delete();
    }


    /**
     * Get the client for the user.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'clientId');
    }

    /**
     * The users that belong to the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'userId', 'roleId')->withTimesTamps();
    }
}
