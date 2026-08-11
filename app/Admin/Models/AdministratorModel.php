<?php namespace terre\Admin\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class AdministratorModel extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;
    protected $table    = 'administrator';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
	//
    /**
     * Hash the password on assignment — but only if it is not already hashed.
     *
     * The guard matters from Laravel 11 onward, which rehashes a user's
     * password during a successful login whenever the stored work factor is
     * below the configured one, and assigns the freshly computed hash straight
     * onto the model. Without the isHashed() check this mutator hashed that
     * hash, so the very first login after the upgrade replaced the password
     * with a hash of a hash and locked the account out permanently.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::isHashed($value)
            ? $value
            : \Hash::make($value);
    }
}
