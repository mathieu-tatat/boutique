<?php $soustitre = "Gestion utilisateur";
require_once('Model/User.php');
require_once('Controller/user_controller.php');
$user = new User();
ob_start(); ?>

<main class="container-fluid" style="width: 80%;">

    <table class="table table-hover w-90 my-1">
        <thead class="my-1">
            <tr class="row-lg">
                <th class="col-1 text-center">id</th>
                <th class="col-4 text-center">client</th>
                <th class="col-3 text-center">email</th>
                <th class="col-4 text-center">droits</th>
            </tr>
        </thead>

        <tbody class="my-1">
            
        <?php
        $queryRows = $user->getAllUserOrderedById();

        foreach ($queryRows as $row) :?>
            <tr class="row-lg">
                <td class="col-1 text-center"><?= $row['id_utilisateur']?></td>
                <td class="col-4 text-center"><?= $row['prenom']?> <?= $row['nom']?></td>
                <td class="col-3 text-center"><?= $row['email']?></td>
                <td class="col-4 text-center">
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

</main>
<?php   $souscontenu = ob_get_clean(); ?>
