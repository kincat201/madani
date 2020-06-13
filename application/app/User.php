<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Util\Constant;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'role',
        'phone',
    ];

    const FORM_DETAIL = [
        'username' => 'Username',
        'email' => 'Email',
        'name' => 'Nama',
        'phone' => 'Telepon',
        'role' => 'Role',
    ];

    const exportData = [
        'username'=>'Username',
        'email'=>'Email',
        'name'=>'Name',
        'phone'=>'Phone',
        'role'=>'Role',
        'created_at'=>'Created',
        'updated_at'=>'Updated',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('users.deleted', 0);
    }

    public function scopeActive($query)
    {
        return $query->where('users.status', Constant::COMMON_STATUS_ACTIVE);
    }

    public function notification()
    {
        return $this->hasMany(Notification::class,'userId');
    }

    public function unreadNotifications()
    {
        return $this->notification()->where('status',Constant::NOTIFICATION_STATUS_UNREAD);
    }

    public function latestNotifications()
    {
        return $this->notification()->where('status',Constant::NOTIFICATION_STATUS_UNREAD)->limit(10)->orderBy('created_at','desc');
    }
}
