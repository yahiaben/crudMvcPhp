<?php include("header.php");?>
<div class="container">
    <div class="col-md-5">
        <div class="form-area">  
            <!-- Brand and toggle get grouped for better mobile display -->
            <form role="form" method="POST" action="">
                <br style="clear:both">
                <h3 style="margin-bottom: 25px; text-align: center;">Contact Form</h3>
                <div class="form-group">
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" value=<?php echo $nom?> required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom" value=<?php echo $prenom?> >
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="societe" name="societe" placeholder="Societe" value=<?php echo $societe?> >
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" value=<?php echo $adresse?> >
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="num" name="num" placeholder="Numéro de téléphone" value=<?php echo $num?> >
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value=<?php echo $email?> >
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="site" name="site" placeholder="Site Web" value=<?php echo $site?> >
                </div>
                <div class="form-group">
                    <input type="radio" name="particulierOuPro" value="particulier" id="particulier" <?php if($statut =='particulier') echo "checked"?>/> <label for="particulier">Particulier</label><br />
                    <input type="radio" name="particulierOuPro" value="professionel" id="professionel" <?php if($statut =='professionel') echo "checked"?>/> <label for="professionel">Professionel</label><br />
                </div>
                <input type="hidden" name="form-submitted" value="1" />
                <input type="submit" value="Submit" />
            </form>
        </div>
    </div>
</div>
<?php include("footer.php");?>