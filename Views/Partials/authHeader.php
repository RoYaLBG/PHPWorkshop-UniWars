<h1>Welcome <?= $this->playerName; ?></h1>
<h3>Money: <?= $this->university->getMoney(); ?> |
    Lectures: <?= $this->university->getLecturues(); ?>
</h3>

<a href="<?=$this->url('stages');?>">
    Stages
</a>
<br/><br/>