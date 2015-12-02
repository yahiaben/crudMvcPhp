<?php 
include("view/header.php");
echo ("<table class='table table-striped'>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Societe</th>
                        <th>Adresse</th>
                        <th>Num</th>
                        <th>Email</th>
                        <th>Site Web</th>
                        <th>Statut</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                ");
            // On affiche chaque entrée une à une
            foreach($donnees as $donnee)
            {
                echo ("<tr><td>" .$donnee['nom'] ."</td><td>".$donnee['prenom']."</td><td>" .$donnee['societe'] ."</td><td>" .$donnee['adresse'] ."</td><td>" .$donnee['num'] ."</td><td>" .$donnee['email'] ."</td><td>" .$donnee['site'] ."</td><td>" .$donnee['statut'] ."</td><td><a href=index.php?req=modifierContact&id=" .$donnee['id'] .">Modifier</a></td><td><a href=index.php?req=supprimerContact&id=" .$donnee['id'] .">Supprimer</a></td></tr>");
            }
            echo("</tbody></table>");
include("view/footer.php");