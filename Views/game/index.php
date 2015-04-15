<?php /** @var \Uniwars\Models\University $university */ ?>

<?php foreach ($this->universities as $university): ?>
    <div >
        <a
            href="<?= $this->url('universities', 'change', ['id' => $university->getId()]);?>"
            style="<?= ($university->getId() == $_SESSION['university_id']) ? 'color: red' : '';?>"
            >
            [ <?= $university->getName(); ?>  ]
        </a>
    </div>
<?php endforeach; ?>