<table class="table table-hover"  id="plansTable">
    <thead>
    <th colspan="2">Name</th>
    <th colspan="2">Actions</th>
</thead>
<tbody>                        
    <tr colspan="2">
        <td data-toggle="modal" data-target="#addPlanModal" colspan="2">
            <a ><i class="fa fa-plus" aria-hidden="true"></i> Add plan</a>
        </td>
    </tr>
    <?php
    foreach ($plans as $plan) {

        echo '<tr>
            <td><a href = plan/' . $plan['id'] . '><i class="fa fa-address-book-o" aria-hidden="true"></i></a></td>
            <td>' . $plan['Name'] . '</td>
            <td>
                <a href="editPlan/' . $plan['id'] . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></a></i>
            </td>
            <td>
                <a href="deletePlan/' . $plan['id'] . '"><i class="fa fa-times" aria-hidden="true"></i></a></i>
            </td>
        </tr>';
    }
    ?>
</tbody>
</table>

<div class="modal fade" id="addPlanModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                include_once '/addPlan.php';
                ?>
            </div>
        </div>
    </div>
</div>