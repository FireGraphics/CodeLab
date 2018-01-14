<div class="col s9" id="articles" style="box-sizing: border-box;">
    <div class="wrapper" style="float: left;width: 100%;box-sizing: border-box;margin-bottom: 20px;">
        <?php foreach($db->query("SELECT * FROM posts ORDER BY date_published DESC LIMIT 0, 1", "Post") as $post):  ?>
        <?php $user = $db->getUser($post->idUser, "User")  ?>
        <?php $category = $db->getCategory($post->idCategorie, "Category") ?>
        <?php $dayPost = $db->getDate("SELECT DAY(date_published) as dayPublish FROM posts WHERE id = ?", [$post->id]); ?>
        <?php $hourPost = $db->getDate("SELECT HOUR(date_published) as hourPublish FROM posts WHERE id = ?", [$post->id]); ?>
        <div class="last z-depth-1" style="background: #fff;height: 510px;padding-bottom: 20px;">
           <div class="overlay" style="width: 100%;height: 65%;overflow:hidden;display: flex;align-items: center;justify-content: center;box-sizing: border-box;">
                <a href=""><img src="<?= $post->minia  ?>" alt=""></a>
           </div>
           <div class="info" style="width: 100%;height: 17.5%;padding: 20px 20px 0 20px;box-sizing: border-box;">
               <h4 style="margin: 0;padding: 0;font-size: 1.8rem;color: #333;font-weight: 500;" class="postTitle"><a href="#"><?= $post->getTitle() ?></a></h4>
               <p style="color: #333;"><?= $post->getExtrait()  ?></p>
               <div class="postInfo">
                  <div class="articleInfo">
                    <div class="datetime" onclick="Materialize.toast('Posté le <?= $post->date_published  ?>', 4000)" style="cursor: pointer;">
                    <?php $hasLiked = $db->countRow("SELECT * FROM likes WHERE ip = ?", array($_SERVER['REMOTE_ADDR']), false)  ?>
                        <p style="margin: 0;padding: 0;"><span class="material-icons" style="margin: 0;padding: 0 0 5px 0;float: left;font-size: 20px;margin-right: 5px;">access_time</span><?= $post->getDatePost($dayPost['dayPublish'], $hourPost['hourPublish'])  ?></a>
                    </div>
                  </div>
                  <div class="articleInfo">
                    <div class="datetime">
                        <p style="margin: 0;padding: 0;"><span class="material-icons" style="margin: 0;padding: 0 0 5px 0;float: left;font-size: 20px;margin-right: 5px;">account_circle</span><?= $user->username  ?></a>
                    </div>
                  </div>
                  <div class="articleInfo">
                    <div class="datetime">
                        <p style="margin: 0;padding: 0;"><span class="material-icons" style="margin: 0;padding: 0 0 5px 0;float: left;font-size: 20px;margin-right: 5px;">assignment</span><?= $category->name  ?></a>
                    </div>
                  </div>
                  <div class="articleInfo right" style="background: transparent;">
                    <div class="datetime">
                        <p style="margin: 0;padding: 0;cursor: pointer;color: #<?php if($hasLiked == 1) { echo "fdd835;";  }  ?>" id="like" idPost="<?= $post->id  ?>" likeCount="<?= $db->getNumberOfLikes([$post->id])  ?>"><span class="material-icons" style="margin: 0;padding: 0 0 5px 0;float: left;font-size: 20px;margin-right: 5px;">star</span><?= $db->getNumberOfLikes([$post->id])  ?></p>
                    </div>
                  </div>
                  <div class="articleInfo right">
                    <div class="datetime">
                        <p style="margin: 0;padding: 0;"><span class="material-icons" style="margin: 0;padding: 0 0 5px 0;float: left;font-size: 20px;margin-right: 5px;">attach_money</span><?= $post->budget; ?>$</a>
                    </div>
                  </div>
               </div>
           </div>
        </div>
        <?php endforeach; ?>
        <div class="articlesList">
            <div class="articlePanel" style="margin-top: 60px;">
                <?php require_once("template/postList.php")  ?>
            </div>
        </div>
    </div>
</div>
<div class="col s3">
    <div class="mainPanel">
        fsdfsfsd
    </div>
</div>