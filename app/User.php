<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    /**
     * プライマリキー割り当て
     */
    protected $primaryKey = 'userid';

    /**
     * The attributes that should be hidden for arrays.
     * 配列に対して非表示にする必要がある属性。
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * ネイティブタイプにキャストする必要のある属性。
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 権限属性に独自属性の定義。
     */
    public function getAuthItemAttribute() {
        switch ($this->auth) {
            case 4:
                return 'オーナー';
                break;
            case 7:
                return '従業員';
                break;
            case 10:
                return '税理士';
                break;
        }
    }

}
