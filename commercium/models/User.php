<?php

/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 14:39
 */

namespace commercium\models;

use commercium\repositories\Groups;
use framework\components\Model;

class User extends Model {

    public static $primaryKeyAttribute = "user_id";

    public $user_id, $firstname, $lastname, $password, $email;

    //general attributes
    /**
     * All the user groups the user belongs to
     * @var Group[]
     */
    private $groups;

    /**
     * checks if this users belongs to a particular group
     * @param $slug
     * @return bool
     */
    public function isMemberOfGroup($slug) {
        foreach ($this->getGroups() as $group) {
            if ($group->slug == $slug) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return Group[]
     */
    public function getGroups() {
        if (empty($this->groups)) {
            //fill groups array
            $this->groups = Groups::findAllByUserId($this->getPrimaryKey());
        }
        return $this->groups;
    }
}