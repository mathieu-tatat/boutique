<?php $soustitre = "Gestion utilisateur";
require_once('Model/User.php');
require_once('Controller/user_controller.php');
$user = new User();
ob_start(); ?>

<table class="table table-hover w-90 my-1">
    <thead class="my-1">
        <tr>
            <th>id</th>
            <th>prenom</th>
            <th>nom</th>
            <th>email</th>
            <th>address</th>
            <th>code postal</th>
            <th>droits</th>
        </tr>
    </thead>

    <tbody class="my-1">
        
    <?php
    $queryRows = $user->getAllUserOrderedById();

    foreach ($queryRows as $row) :?>
        <tr>
            <td><?= $row['id_utilisateur']?></td>
            <td><?= $row['prenom']?></td>
            <td><?= $row['nom']?></td>
            <td><?= $row['email']?></td>
            <td><?= $row['address']?></td>
            <td><?= $row['code_postal']?></td>
            <td>
                <form method="POST" >
                    <select name="id_droit" class="rounded-pill">
                    <?php if ($row['id_droit'] == 1337) : ?>
                        <option value="1337" selected>Admin</option>
                        <option value="1">Utilisateur</option>
                    <?php else : ?>
                        <option value="1337">Admin</option>
                        <option value="1" selected>Utilisateur</option>
                    <?php endif; ?>
                    </select>
                    <form method="POST">
                        <input type="hidden" name="id_utilisateur" value="<?= $row['id_utilisateur'] ?>">
                        <input type="submit" name="chg_right" value="modifier" 
                        class="btn btn-dark rounded-pill px-1">
                    </form>
                </form>        
            </td>
        </tr>
    <?php   endforeach; ?>
    </tbody>
</table>

<?php   $souscontenu = ob_get_clean(); ?>