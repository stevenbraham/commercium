<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 01-04-17
 * Time: 18:02
 */

namespace commercium\repositories;

use commercium\models\Group;
use framework\components\base\Core;
use framework\components\Repository;

/**
 * Repository for group class
 * @package commercium\repositories
 */
class Groups extends Repository {
    public static function getModel() {
        return Group::class;
    }

    /**
     * @param string $slug
     * @return Group
     */
    public static function findBySlug($slug) {
        return static::findByAttribute('slug', $slug);
    }

    /**
     * Fetches all the groups were a particular user belongs in
     * @param $userId
     * @return Group[]
     */
    public static function findAllByUserId($userId) {
        $query = 'select g.* from ' . static::getTable() . ' g join users_groups ug on ug.group_id = g.id where ug.user_id = :user_id';
        $statement = Core::getInstance()->database->prepare($query);
        $statement->execute(['user_id' => $userId]);
        return $statement->fetchAll(\PDO::FETCH_CLASS, Group::class); //convert result to group array
    }

    public static function getTable() {
        return "groups";
    }

    public static function attachGroupToUser($userId, $groupId) {
        //create new many to many relationship
        $query = "INSERT INTO `users_groups` (`user_id`, `group_id`) VALUES (:user_id, :group_id);";
        $statement = Core::getInstance()->database->prepare($query);
        $statement->execute([
            'user_id' => $userId,
            'group_id' => $groupId
        ]);
    }

    public static function detachAllFromUser($userId) {
        $statement = Core::getInstance()->database->prepare("delete from users_groups where user_id = :user");
        $statement->execute(['user' => $userId]);
    }

}