<?php if ($this->getContext()->getMessage()!= null): ?>
    <div id="globalMsg" class="alert <?= $this->getContext()->getMessage()->getStatus() ?> alert-dismissible fade show" role="alert">
        <strong><?= $this->getContext()->getMessage()->getName() ?></strong>
        <?= $this->getContext()->getMessage()->getDescription() ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif?>