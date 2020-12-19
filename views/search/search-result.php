<?php
$this->title = \Yii::$app->id . ' - Search result';
?>

<div class="container-fluid">
    <div class="row-fluid">

        <span class="results-found"><?php echo $count; ?> result<?php echo $count !== 1 ? 's' : ''; ?> found </span>

        <ul id="search-result">
            <?php foreach ($searchResult as $result): ?>
                <li>
                    <a href="<?php echo $result['link'] ?>" class="thumb"><?php echo $result['sym']; ?></a><span class="semi-visible"><?php echo $result['t']; ?></span>
                    <p><?php echo $result['des']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
