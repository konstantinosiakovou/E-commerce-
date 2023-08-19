<?php

namespace App;
use App\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\CustomVerifyEmailNotification; 
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'token', 'phone', 'name', 'surname', 'city', 'address', 'zip', 'vatnumber','cardname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
        return $this->hasMany('App\Order');
        
    }
    /**
     * Returns true if user is verified
     * @return bool
     * 
     */


    public function verified()
    {
        return $this->token === null;
    }
    
    /**
     * Send the user a verification user
     * @return void
     * 
     * 
     * 
     * */


    public function sendVerificationEmail()
    {
        $this->notify(new VerifyEmail($this));
    }

    /**
     * Send the password reset notification.
     * @note: This override Authenticatable methodology
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
    
}
