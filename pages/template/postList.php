<?php foreach($db->query("SELECT * FROM posts ORDER BY date_published DESC ", "Post") as $post):  ?>
        <?php $user = $db->getUser($post->idUser, "User")  ?>
        <?php $category = $db->getCategory($post->idCategorie, "Category") ?>
        <?php $dayPost = $db->getDate("SELECT DAY(date_published) as dayPublish FROM posts WHERE id = ?", [$post->id]); ?>
        <?php $hourPost = $db->getDate("SELECT HOUR(date_published) as hourPublish FROM posts WHERE id = ?", [$post->id]); ?>

    <div class="card horizontal">
      <div class="card-image" style="width: 30%;overflow: hidden;height: 204.27px">
        <img style="width:100%;height: 100%;" src="<?= $post->minia  ?>">
      </div>
      <div class="card-stacked">
        <div class="card-content">
          <h4><a href="#"><?= $post->getTitle(26);  ?></a></h4>
          <p><?= $post->getExtrait();  ?></p>
        </div>
        <div class="card-action">
        <div class="articleInfo">
                    <div class="datetime" onclick="Materialize.toast('Posté le <?= $post->date_published  ?>', 4000)" style="cursor: pointer;">
                    <?php $hasLiked = $db->countRow("SELECT * FROM likes WHERE ip = ?", array($_SERVER['REMOTE_ADDR']), false)  ?>
                        <p style="margin: 0;padding: 0;"><span class="material-icons" style="margin: 0;padding: 0 0 5px 0;float: left;font-size: 20px;margin-right: 5px;">access_time</span><?= $post->getDatePost($dayPost['dayPublish'], $hourPost['hourPublish'])  ?></a>
                    </div>
                  </div>
                  <div class="articleInfo">
                    <div class="datetime">
                        <p style="margin: 0;padding: 0;"><span class="material-icons" style="margin: 0;padding: 0 0 5px 0;float: left;font-size: 20px;margin-right: 5px;">account_circle</span><?= $user->username ?></a>
                    </div>
                  </div>
                  <div class="articleInfo">
                    <div class="datetime">
                        <p style="margin: 0;padding: 0;"><span class="material-icons" style="margin: 0;padding: 0 0 5px 0;float: left;font-size: 20px;margin-right: 5px;">assignment</span><?= $category->name  ?></a>
                    </div>
                  </div>
        </div>
      </div>
    </div>
    
 <?php endforeach; ?>