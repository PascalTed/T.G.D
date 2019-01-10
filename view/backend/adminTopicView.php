<?php require_once('view/backend/adminMenuView.php'); ?>
<?php require_once('view/frontend/toLoginView.php'); ?>

<?php ob_start(); ?>

<section id="admin-topic">
    
    <div id="admin-topic-return">
        <p><a href="index.php?action=displayAdminForumTopics&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Retour</a></p>
    </div>
    
    <div>
        <h1>Sujet <?= $infoTopic['topicTitle'] ?></h1>
    </div>
    
    <div id="rename-topic-content">
        <form action="index.php?action=modifyOrRemoveTopic&amp;idTopic=<?= $topicId ?>&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>" id="form-edit-topic" method="post">
            <label for="textarea-edit-topic">Modifier ou supprimer le sujet</label><br />
            <textarea id="textarea-edit-topic" name="textarea-edit-topic"><?= strip_tags($infoTopic['topicTitle']); ?></textarea>
            <span id="topic-exist">Ce sujet existe déjà.</span>
            <span id="no-topic">Le champ sujet est vide.</span>

            <div id="topic-radio">
                <div>
                    <label for ="adm-modify-topic">Modifier le nom du sujet</label>
                    <input type="radio" name="setTopic" value="adm-modify-topic" id="adm-modify-topic" checked />
                </div>
                
                <div>
                    <label for ="adm-remove-topic">Supprimer le sujet</label>
                    <input type="radio" name="setTopic" value="adm-remove-topic" id="adm-remove-topic" />
                </div>
            </div>
            <input type="submit" value="Envoyer" />
        </form>
    </div>

    <div id="admin-messages-content">
        
        <?php    
        while ($topic = $topicMessages->fetch()) {
        ?>
        
            <div class="admin-infos-user-message">
                <div class="admin-infos-user">
                    <p><strong><?= $topic['pseudo'] ?></strong></p>
                </div>

                <p><em>le <?= $topic['message_date'] ?></em></p>
                
                <div class="admin-topic-message"><?= $topic['message'] ?></div>

                <div class="admin-infos-message">
                    
                    <?php
                    if ($topic['moderation'] == true) {
                    ?>

                        <p class="topic-message-reported">Message signalé</p>
                    
                        <div>
                            <a class="validate-topic-message" href="index.php?action=validTopicMessage&amp;idMessage=<?= $topic['tm_id'] ?>&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>&amp;idTopic=<?= $topicId ?>">Valider</a>

                    <?php
                    } else {
                    ?>
                            
                        <div>
                            
                    <?php
                    }
                    ?>
                            
                        <a class="delete-topic-message" href="index.php?action=removeTopicMessage&amp;idMessage=<?= $topic['tm_id'] ?>&amp;idForum=<?= $forumId ?>&amp;catForum=<?= $forumCat ?>&amp;idTopic=<?= $topicId ?>">Supprimer</a>
                    </div>
                </div>
            </div>
        
        <?php
        }
        $topicMessages->closeCursor();
        ?>
            
    </div>
    
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>