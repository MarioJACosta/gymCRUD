<table class="table table-hover"  id="exercisesTable">
    <thead>
    <th>Name</th>
    <th colspan="2">Actions</th>
</thead>
<tbody>     
    <tr>
        <td data-toggle="modal" data-target="#addExerciseModal">
            <a ><i class="fa fa-plus" aria-hidden="true"></i> Add exercise</a>
        </td>
    </tr>
    <?php
    foreach ($exercises as $exercise) {

        echo '<tr>
            <td>' . $exercise['Name'] . '</td>
            <td>
                <a href="editExercise/' . $exercise['id'] . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></a></i>
            </td>
            <td>
                <a href="deleteExercise/' . $exercise['id'] . '"><i class="fa fa-times" aria-hidden="true"></i></a></i>
            </td>
        </tr>';
    }
    ?>
</tbody>
</table>

<div class="modal fade" id="addExerciseModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                include_once '/addExercise.php';
                ?>
            </div>
        </div>
    </div>
</div>

