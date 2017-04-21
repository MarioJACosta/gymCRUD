<?php

include_once dirname(__CLASS__) . 'controllers/Database.php';

/**
 * Description of Plan
 *
 * @author Mario Costa <mario@computech-it.co.uk>
 */
class Plan extends Database {

    /**
     * Return all the plans
     * @return array
     */
    public function getPlans() {

        $database = new Database();

        $query = 'SELECT * FROM plan';

        return $database->prepareQuery($query);
    }

    /**
     * Return the plan details by Id
     * @param int $id
     * @return array
     */
    public function getPlan($id) {

        $database = new Database();

        $query = 'SELECT * FROM plan WHERE id=:id';

        return $database->prepareQuery($query, 'id', $id, TRUE);
    }

    /**
     * Add new plan
     * @param string $Name
     * @param array $workoutsId
     */
    public function addPlan($Name, $workoutsId) {
        $database = new Database();

        $query = 'INSERT INTO plan (Name) VALUES (:Name)';

        $database->prepareQuery($query, 'Name', [$Name,], TRUE, false);

        $planId = $database->lastInsertId();

        foreach ($workoutsId as $id) {
            $this->addPlanWorkout($planId, $id);
        }
    }

    /**
     * Delete plan and the relationships with the workouts
     * @param string $planId
     */
    public function deletePlan($planId) {
        $database = new Database();

        $queryDeletePlan = 'DELETE FROM plan WHERE id=:id';

        $database->prepareQuery($queryDeletePlan, 'id', $planId, TRUE, FALSE);

        $queryDeletePlanWorkout = 'DELETE FROM plan_workout WHERE Plan_Id=:Plan_Id';

        $database->prepareQuery($queryDeletePlanWorkout, 'Plan_Id', $planId, TRUE, FALSE);

        $queryDeletePlanUser = 'DELETE FROM user_plan WHERE Plan_Id=:Plan_Id';

        $database->prepareQuery($queryDeletePlanUser, 'Plan_Id', $planId, TRUE, FALSE);
    }

    /**
     * Edit plan and workout
     * @param type $planName
     * @param type $planId
     * @param array $workoutsId
     */
    public function editPlan($planName, $planId, $workoutsId) {

        $database = new Database();

        $queryUpdatePlan = 'UPDATE plan SET Name=:Name WHERE id=:id';

        $database->prepareQuery($queryUpdatePlan, 'Name,id', [$planName, $planId], TRUE, false);

        foreach ($workoutsId as $id) {
            $this->addPlanWorkout($planId, $id);
        }
    }

    /**
     * Add new relations 
     * @param string $id
     */
    public function addPlanWorkout($planId, $workoutId) {
        $database = new Database();

        $query = 'INSERT INTO plan_workout (Plan_Id, Workout_Id) VALUES (:Plan_Id, :Workout_Id)';

        $database->prepareQuery($query, 'Plan_Id,Workout_Id', [$planId, $workoutId,], TRUE, FALSE);
    }

    /**
     * Returns the workout ids associated with the plan
     * @param int $planId
     * @return array 
     */
    public function getPlanWorkout($planId) {

        $database = new Database();

        $query = 'SELECT * FROM plan_workout WHERE Plan_Id=:Plan_Id';

        $results = $database->prepareQuery($query, 'Plan_Id', [$planId], TRUE, TRUE);

        $workouts = [];

        foreach ($results as $result) {
            $workouts[] = $result['Workout_Id'];
        }
        return $workouts;
    }

    /**
     * Get the users for a plan
     * @param type $planId
     * @return array
     */
    public function getPlanUser($planId) {
        $database = new Database();

        $query = 'SELECT User_Id FROM user_plan WHERE Plan_Id=:Plan_Id';

        return $database->prepareQuery($query, 'Plan_Id', [$planId], TRUE, TRUE);
    }

}
