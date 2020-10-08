<ul>
    <?php
    foreach($getPosts as $post) {
        if ($post['is_open'] == $isOpen) { ?>
            <li>
                <a href="/posts/?message_id=<?=$post['id']?>">Заголовок сообщения - '<?=$post['title']?>; 
                    <span style="color: <?=$post['hex']?>">Раздел - <?=$post['section']?> </span>
                </a> 
            </li>
        <?php }
    } ?> 
</ul>