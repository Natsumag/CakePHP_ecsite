<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 */
?>

<div class="purchaseHistories form large-9 medium-8 columns content">
    <?= $this->Form->create($contact, ['type' => 'post']) ?>
    <fieldset>
        <legend><?= __('Add Contact') ?></legend>
        <?php
        $username = $this->request->getSession()->read('Auth.User');
        if(isset($username)):
            echo $this->Form->hidden('member_user_id', ['value' => $username['id']]);
            echo $this->Form->hidden('name', ['value' => $username['name']]);
            echo $this->Form->hidden('email', ['value' => $username['email']]);
        else:
            echo $this->Form->control('name');
            echo $this->Form->control('email');
        endif;
        echo $this->Form->control('content');
        ?>
    </fieldset>
    <?= $this->Form->button(__('確認画面へ')) ?>
    <?= $this->Form->end() ?>
</div>
