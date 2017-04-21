<?php
require_once dirname(__FILE__) . '/header.php';
require_once dirname(__FILE__) . '/navBar.php';
?>
<table class="table table-hover" id="userTbale">
    <thead>
        <tr>
            <th colspan="2">First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th colspan="2">Actions</th>
        </tr>
    </thead>
    <tbody>      
        <tr>
            <td data-toggle="modal" data-target="#addUserModal" colspan="2">
                <a ><i class="fa fa-plus" aria-hidden="true"></i> Add user</a>
            </td>
        </tr>
        <?php
        foreach ($users as $key => $user) {
            echo '
                <tr>
                <td><a href = user/' . $user['id'] . '><i class="fa fa-address-book-o" aria-hidden="true"></i></a></td>
                <td>' . $user['First_Name'] . '</td>
                <td>' . $user['Last_Name'] . '</td>
                <td>' . $user['Email'] . '</td>
                <td>
                    <a href="editUser/' . $user['id'] . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></a></i>
                </td>
                <td>
                    <a href="deleteUser/' . $user['id'] . '"><i class="fa fa-times" aria-hidden="true"></i></a></i>
                </td>
            </tr>';
        }
        ?>
    </tbody>
</table>

<div class="modal fade" id="addUserModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                include_once '/addUser.php';
                ?>
            </div>
        </div>
    </div>
</div>