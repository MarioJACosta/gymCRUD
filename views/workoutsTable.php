<table class="table table-hover"  id="workoutsTable">
    <thead>
    <th colspan="2">Name</th>
    <th colspan="2">Actions</th>
</thead>
<tbody>                
    <tr>
        <td colspan="2" data-toggle="modal" data-target="#addWorkoutModal">
            <a ><i class="fa fa-plus" aria-hidden="true"></i> Add workout</a>
        </td>
    </tr>
    <?php
    foreach ($workouts as $workout) {

        echo '<tr>
            <td><a href = workout/' . $workout['id'] . '><i class="fa fa-address-book-o" aria-hidden="true"></i></a></td>
            <td>' . $workout['Name'] . '</td>
            <td>
                <a href="editWorkout/' . $workout['id'] . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></a></i>
            </td>            
            <td>
                <a href="deleteWorkout/' . $workout['id'] . '"><i class="fa fa-times" aria-hidden="true"></i></a></i>
            </td>
        </tr>';
    }
    ?>
</tbody>
</table>

<div class="modal fade" id="addWorkoutModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                include_once '/addWorkout.php';
                ?>
            </div>
        </div>
    </div>
</div>