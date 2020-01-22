<?php 
  include('header.php');

  if(isset($_GET["idevent"])) {
      $idevent = intval($_GET["idevent"]);
      ?>

      <div class="postsContent">

          <div class="Posts">

              <?php displayPosts($idevent);
              if(isset($_SESSION["token"])) {
                  ?>
                  <form id="post-form" class="col-sm-7 col-md-9" enctype="multipart/form-data" method="POST"
                        action="PHP_server/treat_posts.php">
                      <hr/>
                      <span><b>Postez une photo par rapport à l'évènement</b></span>
                      <input type="hidden" name="token"
                             value=<?php echo isset($_SESSION["token"]) ? $_SESSION["token"] : ""; ?> />
                      <input type="hidden" name="id_User"
                             value=<?php echo isset($_SESSION["id"]) ? $_SESSION["id"] : ""; ?> />
                      <input type="hidden" name="id_Event"
                             value=<?php echo $idevent ?>/>
                      <input type="file" id="image_p" class="form-control image-file" name="image"/>
                      <textarea placeholder="description..." name="description" class="form-control"
                                rows="3"></textarea>

                      <input type="submit" class="btn btn-info " disabled value="poster">
                  </form>
                  <?php
                   }
                  ?>


         <!-- Modal commentaires -->
          <div class="modal fade" id="commentModal" data-backdrop="static" tabindex="-1" role="dialog"
               aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Commentaires</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="comments">
                          <?php /*displayComments();*/?>
                          </div>

                          <?php if(isset($_SESSION["token"])) {
                                ?>
                          <form id="comment-form" method="post" action="PHP_server/treat_comments.php">
                              <hr/>
                              <div class="input-group">
                                  <input type="hidden" name="token"
                                         value=<?php echo isset($_SESSION["token"]) ? $_SESSION["token"] : ""; ?> />
                                  <input type="hidden" name="id_user"
                                         value=<?php echo isset($_SESSION["id"]) ? $_SESSION["id"] : ""; ?> />
                                  <input type="hidden" name="id_eventsposts"
                                         value="" />
                                  <textarea placeholder="Ajouter un commentaire..." name="publication"
                                            id="publication-input"></textarea>
                                  <input type="submit" value="Publier" id="submit_comment" disabled/>
                              </div>
                          </form>
                        <?php
                          } ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <?php
      }
      include('footer.php'); ?>