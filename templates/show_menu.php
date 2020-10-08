<ul class="<?=$classUl?>">

<?php foreach (arraySort($array, $sort, $key) as $itemMenu): ?>
    <li>
        <a 
            href="<?=$itemMenu['path']?>" 
            class="<?=isCurrentUrl($itemMenu['path']) ? 'active' : ''?>"
        >
            <?=cutString($itemMenu['title'])?>
        </a>
    </li>
<?php endforeach; ?>

</ul>
