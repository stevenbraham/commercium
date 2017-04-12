<?php

/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 18:55
 */

namespace commercium\repositories;

use commercium\models\User;
use framework\components\base\Core;
use framework\components\Repository;

/**
 * Repository for users class
 * @package commercium\repositories
 */
class Users extends Repository {

    public static function getModel() {
        return User::class;
    }

    /**
     * Inserts a new user in database and returns the model
     * @return User
     */
    public static function insert($firstname, $lastname, $email, $password) {
        $query = "INSERT INTO `" . static::getTable() . "` (`firstname`, `lastname`, `email`, `password`) VALUES (:firstname, :lastname, :email, :password);";
        $statement = Core::getInstance()->database->prepare($query);
        $statement->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password
        ]);
        return static::findOrFail(Core::getInstance()->database->lastInsertId());
    }

    public static function getTable() {
        return "users";
    }

    /**
     * Update a user in the database
     * @param User $user
     */
    public static function update(User &$user) {
        Core::getInstance()->database->prepare('update ' . static::getTable() . ' set `firstname` = :firstname, `lastname` = :lastname, `email` = :email, `password` = :password  where  ' . static::getPrimaryKeyAttribute() . ' = :id')->execute([
            'id' => $user->getPrimaryKey(),
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'password' => $user->password
        ]);
    }

    public static function getPrimaryKeyAttribute() {
        return "user_id";
    }

    /**
     * Detaches all groups for an user and attach a set of particular groups
     * @param $userId
     * @param array $groups ids of roles
     */
    public static function setGroups($userId, $groups) {
        Groups::detachAllFromUser($userId);
        foreach ($groups as $groupId) {
            Groups::attachGroupToUser($userId, $groupId);
        }
    }
}