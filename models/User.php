<?php

include_once dirname(__CLASS__) . 'controllers/Database.php';

/**
 * Description of User
 *
 * @author Mario Costa <mario@computech-it.co.uk>
 */
class User {

    /**
     * Get all users
     * @return array
     */
    public function getUsers() {

        $database = new Database();

        $query = 'SELECT * FROM user';

        return $database->prepareQuery($query);
    }

    /**
     * Get user by id
     * @param string $id
     * @return array
     */
    public function getUser($id) {

        $database = new Database();

        $query = 'SELECT * FROM user WHERE id=:id';

        return $database->prepareQuery($query, 'id', $id, TRUE);
    }

    /**
     * Delete user by ID
     * @param string $id
     */
    public function deleteUser($id) {
        $database = new Database();

        $queryUser = 'DELETE FROM user WHERE id=:id';

        $database->prepareQuery($queryUser, 'id', $id, TRUE, FALSE);

        $queryUserPlan = 'DELETE FROM user_plan WHERE User_Id=:id';

        $database->prepareQuery($queryUserPlan, 'id', $id, TRUE, FALSE);
    }

    /**
     * Add user
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $planId
     */
    public function addUser($firstName, $lastName, $email, $planId) {
        $database = new Database();

        $queryUser = 'INSERT INTO user (First_Name, Last_Name, Email) VALUES (:First_Name, :Last_Name, :Email)';

        $database->prepareQuery($queryUser, 'First_Name,Last_Name,Email', [$firstName, $lastName, $email], TRUE, FALSE);

        $userId = $database->lastInsertId();

        $queryUserPlan = 'INSERT INTO user_plan (User_Id, Plan_Id) VALUES (:User_Id, :Plan_Id)';

        $database->prepareQuery($queryUserPlan, 'User_Id,Plan_Id', [$userId, $planId,], TRUE, FALSE);
    }

    /**
     * Edit user
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $userId
     * @param string $planId
     */
    public function editUser($firstName, $lastName, $email, $userId, $planId) {
        $database = new Database();

        $queryUpdateUser = 'UPDATE user SET First_Name=:First_Name, Last_Name=:Last_Name, Email=:Email WHERE id=:id';

        $database->prepareQuery($queryUpdateUser, 'First_Name,Last_Name,Email,id', [$firstName, $lastName, $email, $userId], TRUE, FALSE);

        $queryUpdateUserPlan = 'UPDATE user_plan SET Plan_Id=:Plan_Id WHERE User_Id=:User_Id';

        $database->prepareQuery($queryUpdateUser, 'Plan_Id,User_Id', [$queryUpdateUserPlan, $lastName, $email, $planId], TRUE, FALSE);
    }

    /**
     * Get the plan associated to the user
     * @param string $userId
     * @return array
     */
    public function getUserPlan($userId) {

        $database = new Database();

        $query = 'SELECT * FROM user_plan WHERE User_Id=:User_Id';

        $result =  $database->prepareQuery($query, 'User_Id', [$userId], TRUE, TRUE);
        
        return $result;
    }

}
