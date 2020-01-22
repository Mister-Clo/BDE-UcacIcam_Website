<?php include('header.php'); ?>

    <section id="EvenementListe">
        <div id="banniere">
            <h2>Liste des événements A venir</h2>
        </div>

        <?php displayFutureEvents();

        if(isset($_SESSION["token"])) {
            if($_SESSION["status"] == 1) {
                ?>
                <form id="event-form" class="col-sm-6 col-md-7" enctype="multipart/form-data" method="POST"
                      action="PHP_server/treat_posts.php">
                    <hr/>
                    <span><b>Ajouter un nouvel évènement</b></span>
                    <input type="hidden" name="token"
                           value=<?php echo isset($_SESSION["token"]) ? $_SESSION["token"] : ""; ?> /><br/>
                    <input type="hidden" name="id_User"
                           value=<?php echo isset($_SESSION["id"]) ? $_SESSION["id"] : ""; ?> /><br/>
                    Date de l'évènement: <input type="date" name="date" class="form-control"/><br/>
                    Nom de l'évènement: <input type="text" class="form-control" placeholder="nom" name="nom"/><br/>
                    <input type="file" id="image_p" class="form-control image-file" name="image"/><br/>
                    <textarea placeholder="description..." name="description" class="form-control"
                              rows="3"></textarea>

                    <input type="submit" class="btn btn-info " disabled value="poster">
                </form>
                <?php
            }
        }
        ?>

    </section>

<?php include('footer.php'); ?>