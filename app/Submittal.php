<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submittal extends Model
{
    /**
     * プライマリーキー割り当て
     * @var string
     */
    protected $primaryKey = 'submittalid';

    /**
     * この提出情報を持つユーザーにアクセスする
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * 提出者の名前の取得
     */
    public function getUserNameAttribute() {
        return $this->user->name;
    }

    /**
     * 提出者の色の取得
     */
    public function getUserColorAttribute() {
        return $this->user->color;
    }

    /**
     * 'go_time'カラム値の分割
     */
    public function getSplitGoTimeAttribute() {
        return substr($this->go_time,0,5);
    }

    /**
     * 'out_time'カラム値の分割
     */
    public function getSplitLeaveTimeAttribute() {
        switch($this->leave_time){
            case '29:00:00':
                return 'ラスト';
                break;
            default:
                return substr($this->leave_time,0,5);
        }
    }
}
