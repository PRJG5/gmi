<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

	protected $table = 'users';
	protected $primaryKey = 'id';
	public $incrementing = true;
	protected $keyType = 'bigIncrements';
	public $timestamps = true;

	protected $attributes = [
		'name' => '',
		'email' => '',
		'email_verified_at' => NULL,
		'password' => '',
		'remember_token' => NULL,
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];
	
	protected $guarded = [
		'id',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];
}
