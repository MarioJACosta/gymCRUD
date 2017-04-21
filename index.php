<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// CONTROLLERS ===============================================
require_once dirname(__FILE__) . '/models/User.php';
require_once dirname(__FILE__) . '/models/Plan.php';
require_once dirname(__FILE__) . '/models/Workout.php';
require_once dirname(__FILE__) . '/models/Exercise.php';

// DATABASE ==================================================
require_once dirname((__FILE__)) . '/controllers/Database.php';

// DATABASE CONFIGURATIONS ===================================
require_once dirname((__FILE__)) . '/config.php';

// SLIM ======================================================
require_once dirname(__FILE__) . '/vendor/autoload.php';

// INITIALIZE SLIM FRAMEWORK
$app = new \Slim\App();

// VIEWS =====================================================
$container = $app->getContainer();
$container['views'] = function($container) {
    return new \Slim\Views\PhpRenderer('views/');
};

// HOMEPAGE VIEW
$app->get('/', function (Request $request, Response $response) {

    $user = new User();
    $users = $user->getUsers();

    $plan = new Plan();
    $plans = $plan->getPlans();

    $workout = new Workout();
    $workouts = $workout->getWorkouts();

    $exercise = new Exercise();
    $exercises = $exercise->getExercises();

    return $this->views->render($response, 'app.php', [
                'users' => $users,
                'plans' => $plans,
                'workouts' => $workouts,
                'exercises' => $exercises
    ]);
})->setName('homepage');

// USER RELATED ROUTES ======================================
// SHOW ALL USERS
$app->get('/users', function(Request $request, Response $response) {
    $user = new User();
    $users = $user->getUsers();

    $plan = new Plan();
    $plans = $plan->getPlans();

    $workout = new Workout();
    $workouts = $workout->getWorkouts();

    $exercise = new Exercise();
    $exercises = $exercise->getExercises();

    return $this->views->render($response, 'tables.php', [
                'table' => 'users',
                'users' => $users,
                'plans' => $plans,
                'workouts' => $workouts,
                'exercises' => $exercises
    ]);
})->setName('users');

$app->get('/user/{id}', function (Request $request, Response $response) {

    $userId = $request->getAttribute('id');

    // get user details
    $user = new User();

    $userDetails = $user->getUser([$userId]);
    $userDetail = $userDetails[0];

    // get user plans
    $userPlan = $user->getUserPlan($userId);

    // get plan details for the user plans
    $plan = new Plan();

    foreach ($userPlan as $value) {
        $planDetails = $plan->getPlan([$value['Plan_Id']]);
        $userDetail['Plan'][] = $planDetails[0];

        $planWorkouts = $plan->getPlanWorkout($planDetails[0]['id']);

        if (isset($planWorkouts[0])) {
            $userDetails['Workout'][] = $planWorkouts[0];
        } else {
            $userDetails['Workout'][] = null;
        }

        unset($planDetails);
        unset($planWorkouts);
    }

    if (!is_null($userDetails['Workout'])) {
        // get workouts associated to the plan
        $workout = new Workout();

        foreach ($userDetails['Workout'] as $key => $value) {
            $workoutDetails = $workout->getWorkout($value);
            $workoutDetail[] = $workoutDetails[0];

            $workoutExercises[] = $workout->getWorkoutExercise([$workoutDetail[0]['id']]);

            unset($workoutDetails);
        }

        $userDetail['Workout'] = $workoutDetail;

        // get the exercises for the workouts
        $exercise = new Exercise();

        foreach ($workoutExercises as $key => $exercises) {
            foreach ($exercises as $value) {
                $exercisesDetails = $exercise->getExercise($value);
                $exerciseDetails[] = $exercisesDetails[0];
            }
            $userDetail['Workout'][$key]['Exercises'] = $exerciseDetails;
            unset($exerciseDetails);
        }
    }

    return $this->views->render($response, 'userDetail.php', [
                'userDetails' => $userDetail
    ]);
});

// DELETE USER
$app->get('/deleteUser/{id}', function (Request $request, Response $response) {

    $id = $request->getAttribute('id');

    // get user details
    $user = new User();
    $user->deleteUser([$id]);

    return $response->withRedirect($this->router->pathFor('homepage'));
});

// ADD USER
$app->post('/addUser', function (Request $request, Response $response) {
    $user = new User();

    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $email = $_REQUEST['email'];
    $plan = $_REQUEST['planSelect'];

    $user->addUser($firstName, $lastName, $email, $plan);

    return $response->withRedirect($this->router->pathFor('homepage'));
})->setName('addUser');

// EDIT USER
$app->post('/user/{id}', function (Request $request, Response $response) {

    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $email = $_REQUEST['email'];
    $userId = $request->getAttribute('id');
    $planId = $_REQUEST['plan'];

    $user = new User();
    $user->editUser($firstName, $lastName, $email, $userId, $planId);

    $plan = new Plan();
    $plans = $plan->getPlan($planId);

    $message = 'Your plan changed to the ' . $plans[0]['Name'];

    sendEmail($email, $message, $message);

    return $response->withRedirect($this->router->pathFor('users'));
})->setName('editUser');
$app->get('/editUser/{id}', function (Request $request, Response $response) {

    $id = $request->getAttribute('id');

    $user = new User();
    $result = $user->getUser([$id]);

    $plan = new Plan();
    $plans = $plan->getPlans();

    return $this->views->render($response, 'editUser.php', [
                'user' => $result[0],
                'plans' => $plans
    ]);
});

// PLAN RELATED TOUTES ============================================
// GET PLANS
$app->get('/plans', function(Request $request, Response $response) {
    $plan = new Plan();
    $plans = $plan->getPlans();

    $workout = new Workout();
    $workouts = $workout->getWorkouts();

    $exercise = new Exercise();
    $exercises = $exercise->getExercises();

    return $this->views->render($response, 'tables.php', [
                'table' => 'plans',
                'plans' => $plans,
                'workouts' => $workouts,
                'exercises' => $exercises
    ]);
})->setName('plans');

// ADD NEW PLAN
$app->post('/addPlan', function (Request $request, Response $response) {

    $plan = new Plan();

    $name = $_REQUEST['name'];
    $workoutsId = $_REQUEST['workouts'];

    $results = $plan->addPlan($name, $workoutsId);

    return $response->withRedirect($this->router->pathFor('plans'));
})->setName('addPlan');

// GET PLAN BY ID
$app->get('/plan/{id}', function(Request $request, Response $response) {

    $planId = $request->getAttribute('id');

    $plan = new Plan();

    $results = $plan->getPlan([$planId]);

    $planDetails = $results[0];

    unset($results);

    $planWorkouts = $plan->getPlanWorkout($planId);

    // get workouts associated to the plan
    $workout = new Workout();

    foreach ($planWorkouts as $key => $value) {
        $workoutDetails = $workout->getWorkout($value);
        $workoutDetail[] = $workoutDetails[0];

        $workoutExercises[] = $workout->getWorkoutExercise([$workoutDetail[0]['id']]);

        unset($workoutDetails);
    }

    $planDetails['Workouts'] = $workoutDetail;

    // get the exercises for the workouts
    $exercise = new Exercise();

    foreach ($workoutExercises as $key => $exercises) {
        foreach ($exercises as $value) {
            $exercisesDetails = $exercise->getExercise($value);
            $exerciseDetails[] = $exercisesDetails[0];
        }
        $planDetails['Workouts'][$key]['Exercises'] = $exerciseDetails;
        unset($exerciseDetails);
    }

    return $this->views->render($response, 'planDetails.php', [
                'planDetails' => $planDetails
    ]);
});

// EDIT PLAN
$app->get('/editPlan/{id}', function (Request $request, Response $response) {

    $id = $request->getAttribute('id');

    $plan = new Plan();
    $result = $plan->getPlan([$id]);

    $workout = new Workout();
    $workouts = $workout->getWorkouts();

    return $this->views->render($response, 'editPlan.php', [
                'plan' => $result[0],
                'workouts' => $workouts
    ]);
});
$app->post('/plan/{id}', function (Request $request, Response $response) {

    $planName = $_REQUEST['planName'];
    $workoutsId = $_REQUEST['workouts'];

    $planId = $request->getAttribute('id');

    $plan = new Plan();
    $plan->editPlan($planName, $planId, $workoutsId);

    // get the users for the plan
    $usersId = $plan->getPlanUser($planId);

    $subject = 'The plan ' . $planName . ' changed';

    $user = new User();

    foreach ($usersId as $userId) {
        $users = $user->getUser([$userId['User_Id']]);
        $message = 'Dear ' . $users[0]['First_Name'] . ' ' . $users[0]['Last_Name'] . ', the plan ' . $planName . ' has chnaged.';
        sendEmail($users[0]['Email'], $subject, $message);
    }

    return $response->withRedirect($this->router->pathFor('plans'));
});

// DELETE PLAN
$app->get('/deletePlan/{id}', function (Request $request, Response $response) {

    $id = $request->getAttribute('id');

    // get user details
    $plan = new Plan();
    $plan->deletePlan([$id]);

    return $response->withRedirect($this->router->pathFor('plans'));
});

// WORKOUT RELATED TOUTES ============================================
// GET WORKOUTS
$app->get('/workouts', function(Request $request, Response $response) {

    $workout = new Workout();
    $workouts = $workout->getWorkouts();

    $exercise = new Exercise();
    $exercises = $exercise->getExercises();

    return $this->views->render($response, 'tables.php', [
                'table' => 'workouts',
                'workouts' => $workouts,
                'exercises' => $exercises
    ]);
})->setName('workouts');

// GET WORKOUT BY ID
$app->get('/workout/{id}', function(Request $request, Response $response) {

    $workoutId = $request->getAttribute('id');

    // get workouts associated to the plan
    $workout = new Workout();
    $workoutDetail = $workout->getWorkout($workoutId);
    $workoutDetails = $workoutDetail[0];

    $workoutExercises = $workout->getWorkoutExercise([$workoutId]);

    // get the exercises for the workouts
    $exercise = new Exercise();

    foreach ($workoutExercises as $exercises) {

        $exercisesDetails = $exercise->getExercise($exercises);

        $workoutDetails['Exercises'][] = $exercisesDetails[0];

        unset($exercisesDetails);
    }

    return $this->views->render($response, 'workoutDetails.php', [
                'workoutDetails' => $workoutDetails
    ]);
});

// ADD NEW WORKOUT
$app->post('/addWorkout', function (Request $request, Response $response) {
    $workout = new Workout();

    $name = $_REQUEST['name'];
    $exercises = $_REQUEST['exercises'];

    $workout->addWorkout($name, $exercises);

    return $response->withRedirect($this->router->pathFor('workouts'));
})->setName('addWorkout');

// EDIT WORKOUT
$app->get('/editWorkout/{id}', function(Request $request, Response $response) {

    $id = $request->getAttribute('id');

    $workout = new Workout();
    $result = $workout->getWorkout($id);

    $exercise = new Exercise();
    $exercises = $exercise->getExercises();

    return $this->views->render($response, 'editWorkout.php', [
                'workout' => $result[0],
                'exercises' => $exercises
    ]);
});
$app->post('/workout/{id}', function (Request $request, Response $response) {

    $workoutName = $_REQUEST['workoutName'];
    $exercisesId = $_REQUEST['exercises'];

    $workoutId = $request->getAttribute('id');

    $workout = new Workout();
    $workout->editWorkout($workoutName, $workoutId, $exercisesId);

    return $response->withRedirect($this->router->pathFor('workouts'));
});

//DELETE WORKOUT
$app->get('/deleteWorkout/{id}', function(Request $request, Response $response) {

    $id = $request->getAttribute('id');

    $workout = new Workout();
    $workout->deleteWorkout([$id]);

    return $response->withRedirect($this->router->pathFor('workouts'));
});

// EXERCISE RELATED TOUTES ============================================
// GET EXERCISES
$app->get('/exercises', function(Request $request, Response $response) {
    $exercise = new Exercise();

    $exercises = $exercise->getExercises();

    return $this->views->render($response, 'tables.php', [
                'exercises' => $exercises,
                'table' => 'exercises'
    ]);
})->setName('exercises');

// ADD NEW EXERCISE
$app->post('/addExercise', function (Request $request, Response $response) {
    $exercise = new Exercise();

    $name = $_REQUEST['name'];

    $results = $exercise->addExercise($name);

    return $response->withRedirect($this->router->pathFor('exercises'));
})->setName('addExercise');

// EDIT EXERCISE
$app->get('/editExercise/{id}', function(Request $request, Response $response) {

    $id = $request->getAttribute('id');

    $exercise = new Exercise();
    $result = $exercise->getExercise([$id]);

    return $this->views->render($response, 'editExercise.php', [
                'exercise' => $result[0]
    ]);
});
$app->post('/exercise/{id}', function (Request $request, Response $response) {

    $exerciseName = $_REQUEST['exerciseName'];

    $exerciseId = $request->getAttribute('id');

    $exercise = new Exercise();
    $exercise->editExercise($exerciseName, $exerciseId);

    return $response->withRedirect($this->router->pathFor('exercises'));
});

//DELETE EXERCISE
$app->get('/deleteExercise/{id}', function(Request $request, Response $response) {
    $id = $request->getAttribute('id');

    $exercise = new Exercise();
    $exercise->deleteExercise([$id]);

    return $response->withRedirect($this->router->pathFor('exercises'));
});


// RUN SLIM FRAMEWORK
$app->run();

// SEND EMAIL
function sendEmail($emailUser, $subject, $message) {

    try {
        mail($emailUser, $subject, $message);
    } catch (Exception $e) {
        var_dump($e);

        exit;
    }
}
?>


