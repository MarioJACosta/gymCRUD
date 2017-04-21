<?php

include_once dirname(__CLASS__) . 'controllers/Database.php';

/**
 * Description of Exercise
 *
 * @author Mario Costa <mario@computech-it.co.uk>
 */
class Exercise extends Database {

    /**
     * Get all exercises
     * @return array
     */
    public function getExercises() {

        $database = new Database();

        $query = 'SELECT * FROM exercise';

        return $database->prepareQuery($query);
    }

    /**
     * Get exercise by Id
     * @param string $id
     * @return array
     */
    public function getExercise($id) {

        $database = new Database();

        $query = 'SELECT * FROM exercise WHERE id=:id';

        $results = $database->prepareQuery($query, 'id', $id, TRUE);

        $exercise = [];
        foreach ($results as $result) {
            $exercise[] = $result;
        }

        return $exercise;
    }

    /**
     * Add new exercise
     * @param string $name
     * @return array
     */
    public function addExercise($name) {
        $database = new Database();

        $query = 'INSERT INTO exercise (Name) VALUES (:Name)';

        return $database->prepareQuery($query, 'Name', [$name,], TRUE, false);
    }

    /**
     * Update Exercise
     * @param string $name
     * @param string $id
     * @return array
     */
    public function editExercise($name, $id) {
        $database = new Database();

        $query = 'UPDATE exercise SET Name=:Name WHERE id=:id';

        return $database->prepareQuery($query, 'Name,id', [$name, $id], TRUE, FALSE);
    }

    /**
     * Delete exercise by Id
     * @param string $exerciseId
     */
    public function deleteExercise($exerciseId) {
        $database = new Database();

        $queryDeleteExercise = 'DELETE FROM exercise WHERE id=:id';

        $database->prepareQuery($queryDeleteExercise, 'id', $exerciseId, TRUE, FALSE);

        $queryDeleteExerciseWorkout = 'DELETE FROM exercise_workout WHERE Exercise_Id=:Exercise_Id';

        $database->prepareQuery($queryDeleteExerciseWorkout, 'Exercise_Id', $exerciseId, TRUE, FALSE);
    }

}
