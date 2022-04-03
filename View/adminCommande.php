<?php $soustitre = "Gestion commande"; 
require_once('Model/Commande.php');
$commande = new Commande();
ob_start(); ?>
<main class="container-fluid" style="width: 80%;">

    <table class="table table-hover w-90 my-1">
        <thead class="my-1">
            <tr>
                <th>Id</th>
                <th>Date commande</th>
                <th>Payé en</th>                        
                <th>Payé par</th>
                <th>E-mail</th>
                <th>Prix total</th>
            </tr>
        </thead>
        <tbody class="my-1">
        <?php  
            $queryOrderRows = $commande->getAllCmds();
            foreach( $queryOrderRows as $row) :?>
                                
                <tr>
                    <td><?= $row['id_commande']?></td>
                    <td><?= $row['date_commande']?></td>
                    <td><?= $row['nom_paiement']?></td>                            
                    <td><?= $row['nom']?> <?= $row['prenom']?></td>
                    <td><?= $row['email']?></td>
                    <td><?= $row['total_price']?></td>
                </tr>                    
        <?php   endforeach; ?>
        </tbody>
    </table>
    
</main>
<?php   $souscontenu = ob_get_clean(); ?>
