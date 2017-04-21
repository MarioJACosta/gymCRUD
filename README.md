I've assumed that one user can only have one plan.
One plan can have many workouts.
One workout can have many exercises.
When adding new records there is no validation of the data neither if the record is repeated.
When editing Plans, the new Workouts are just added. The same happens for Workouts with Exercises. 
There isn't any kind of validation for repeated records.

Bugs
When a Workout is deleted it breaks the user details, because the workout is deleted from the plan and there is no error handling.
The email is just a concept. Locally I couldn't test if the email is sent and it would be necessary to add definitions about ports and SMTP. 
I used the basic mail class just to show one way to do it. Later it could be used either PHP Mailer or PHP Simple Mail classes. They are better and offer more chances of customization.

To test the code:
Create database called gym and import the sql file.
In the folder lib/config.php is necessary to change the database information.
Run composer.json to download Slim Framework.
I suggest starting adding Exercises, Workouts, Plans and finally Users. This prevents error messages in the details. 
Anyway as records start being added to the database, those errors will disappear.