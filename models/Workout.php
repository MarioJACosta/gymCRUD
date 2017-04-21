<?php

include_once dirname(__CLASS__) . 'controllers/Database.php';

/**
 * Description of Workout
 *
 * @author Mario Costa <mario@computech-it.co.uk>
 */
class Workout extends Database {

    /**
     * Get all workouts
     * @return array
     */
    public function getWorkouts() {

        $database = new Database();

        $query = 'SELECT * FROM workout';

        return $database->prepareQuery($query);
    }

    /**
     * Get workout by Id
     * @param string $id
     * @return array
     */
    public function getWorkout($id) {

        $database = new Database();

        $query = 'SELECT * FROM workout WHERE id=:id';

        $results = $database->prepareQuery($query, 'id', [$id], TRUE);

        return $results;
    }

    /**
     * Add new workout
     * @param string $name
     * @param string $exercisesId
     */
    public function addWorkout($name, $exercisesId) {
        $database = new Database();

        $query = 'INSERT INTO workout (Name) VALUES (:Name)';

        $database->prepareQuery($query, 'Name', [$name], TRUE, false);

        $workoutId = $database->lastInsertId();

        foreach ($exercisesId as $exerciseId) {
            $this->addWorkoutExercise($workoutId, $exerciseId);
        }
    }

    /**
     * Delete the relationships between the workout and the exercises 
     * @param string $workoutId
     */
    public function deleteWorkout($workoutId) {
        $database = new Database();

        $queryDeleteWorkout = 'DELETE FROM workout WHERE id=:id';

        $database->prepareQuery($queryDeleteWorkout, 'id', $workoutId, TRUE, FALSE);

        $queryDeleteWorkoutExercise = 'DELETE FROM exercise_workout WHERE Workout_Id=:Workout_Id';

        $database->prepareQuery($queryDeleteWorkoutExercise, 'Workout_Id', $workoutId, TRUE, FALSE);

        $queryDeleteWorkoutPlan = 'DELETE FROM plan_workout WHERE Workout_Id=:Workout_Id';

        $database->prepareQuery($queryDeleteWorkoutPlan, 'Workout_Id', $workoutId, TRUE, FALSE);
    }

    /**
     * Update workout
     * @param string $workoutName
     * @param string $workoutId
     * @param array $exercisesId
     */
    public function editWorkout($workoutName, $workoutId, $exercisesId) {

        $database = new Database();

        $queryUpdateWorkout = 'UPDATE workout SET Name=:Name WHERE id=:id';

        $database->prepareQuery($queryUpdateWorkout, 'Name,id', [$workoutName, $workoutId], TRUE, false);

        foreach ($exercisesId as $id) {
            $this->addWorkoutExercise($workoutId, $id);
        }
    }

    /**
     * Add a new exercises for the workout
     * @param string $workoutId
     * @param string $exerciseId
     */
    public function addWorkoutExercise($workoutId, $exerciseId) {
        $database = new Database();

        $queryExercises = 'INSERT INTO exercise_workout (Exercise_Id, Workout_Id) VALUES (:Exercise_Id, :Workout_Id)';

        $database->prepareQuery($queryExercises, 'Exercise_Id,Workout_Id', [$exerciseId, $workoutId], TRUE, false);
    }

    /**
     * Get the exercises associated to the workout
     * @param string $workoutId
     * @return array
     */
    public function getWorkoutExercise($workoutId) {

        $database = new Database();

        $query = 'SELECT * FROM exercise_workout WHERE Workout_Id=:Workout_Id';

        $results = $database->prepareQuery($query, 'Workout_Id', $workoutId, TRUE);

        foreach ($results as $result) {
            $workouts[] = $result['Exercise_Id'];
        }

        return $workouts;
    }

}
