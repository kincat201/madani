<?php
namespace App\Helpers;

use App\Company;
use App\Notification;
use App\User;
use App\Util\Constant;

class SelectHelper {
    /**
     * @param int $user_id User-id
     *
     * @return string
     */

    public static function getUserByUsername($request){
        if(empty($request->username)) {
            return false;
        }

        return User::where('username',$request->username)->first();
    }

    public static function getUserList() {
        $users = User::where('role','!=', Constant::USER_ROLE_ADMIN)->get();
        $data = [];

        foreach ($users as $user){
            $data[$user->id] = $user->name;
        }

        return $data;
    }

    public static function getCommonStatus() {
        return Constant::COMMON_STATUS_LIST;
    }

    public static function getCompany() {
        $companies = Company::get();
        $data = [];

        foreach ($companies as $company){
            $data[$company->id] = $company->name;
        }
        return $data;
    }

    public static function getNotification(){
        $notification = Notification::where('userId',0)
                        ->where('status',Constant::NOTIFICATION_STATUS_UNREAD)
                        ->orderBy('created_at','desc')
                        ->get();
        $data['list'] = $notification;
        $data['count'] = count($notification);

        return $data;

    }

    public static function getSelectList($type){
        if($type == 'getUserList'){
            return self::getUserList();
        }else if($type == 'getCommonStatus'){
            return self::getCommonStatus();
        }else if($type == 'getCompany'){
            return self::getCompany();
        }else if($type == 'getNotification'){
            return self::getNotification();
        }
    }
}
