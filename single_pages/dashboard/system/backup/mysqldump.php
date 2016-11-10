<?php  defined('C5_EXECUTE') or die("Access Denied.");?>

<form action="<?php  echo $this->action('run')?>" method="post" class="ccm-dashboard-content-form">

    <?php echo $this->controller->token->output('mysqldump')?>
    <fieldset>
        <div class="form-group">
            <?php  echo $form->label('compress', t('Compress')); ?>
            <?php  echo $form->select('compress', $dumpOptions['compress'], $defaultOptions['compress']); ?>
        </div>
        <div class="form-group">
            <?php  echo $form->label('add-drop-table', t('Add DROP TABLE')); ?>
            <?php  echo $form->select('add-drop-table', $dumpOptions['add-drop-table'], $defaultOptions['add-drop-table']); ?>
        </div>
        <div class="form-group">
            <?php  echo $form->label('single-transaction', t('Single Transaction')); ?>
            <?php  echo $form->select('single-transaction', $dumpOptions['single-transaction'], $defaultOptions['single-transaction']); ?>
        </div>
        <div class="form-group">
            <?php  echo $form->label('lock-tables', t('Lock Tables')); ?>
            <?php  echo $form->select('lock-tables', $dumpOptions['lock-tables'], $defaultOptions['lock-tables']); ?>
        </div>
        <div class="form-group">
            <?php  echo $form->label('add-locks', t('Add Locks')); ?>
            <?php  echo $form->select('add-locks', $dumpOptions['add-locks'], $defaultOptions['add-locks']); ?>
        </div>
        <div class="form-group">
            <?php  echo $form->label('extended-insert', t('Extended Insert')); ?>
            <?php  echo $form->select('extended-insert', $dumpOptions['extended-insert'], $defaultOptions['extended-insert']); ?>
        </div>
        <div class="form-group">
            <?php  echo $form->label('disable-keys', t('Disable Keys')); ?>
            <?php  echo $form->select('disable-keys', $dumpOptions['disable-keys'], $defaultOptions['disable-keys']); ?>
        </div>
        <div class="form-group">
            <?php  echo $form->label('no-create-info', t('No Create Info')); ?>
            <?php  echo $form->select('no-create-info', $dumpOptions['no-create-info'], $defaultOptions['no-create-info']); ?>
        </div>
        <div class="form-group">
            <?php  echo $form->label('skip-triggers', t('Skip Triggers')); ?>
            <?php  echo $form->select('skip-triggers', $dumpOptions['skip-triggers'], $defaultOptions['skip-triggers']); ?>
        </div>
        <div class="form-group">
            <?php  echo $form->label('add-drop-trigger', t('Add Drop Trigger')); ?>
            <?php  echo $form->select('add-drop-trigger', $dumpOptions['add-drop-trigger'], $defaultOptions['add-drop-trigger']); ?>
        </div>
        <div class="form-group">
            <?php  echo $form->label('add-drop-database', t('Add Drop Database')); ?>
            <?php  echo $form->select('add-drop-database', $dumpOptions['add-drop-database'], $defaultOptions['add-drop-database']); ?>
        </div>
        <div class="form-group">
            <?php  echo $form->label('no-autocommit', t('No Autocommit')); ?>
            <?php  echo $form->select('no-autocommit', $dumpOptions['no-autocommit'], $defaultOptions['no-autocommit']); ?>
        </div>
        <div class="form-group">
            <?php  echo $form->label('skip-comments', t('Skip Comments')); ?>
            <?php  echo $form->select('skip-comments', $dumpOptions['skip-comments'], $defaultOptions['skip-comments']); ?>
        </div>
        <div class="form-group">
            <?php  echo $form->label('skip-dump-date', t('Skip Dump Date')); ?>
            <?php  echo $form->select('skip-dump-date', $dumpOptions['skip-dump-date'], $defaultOptions['skip-dump-date']); ?>
        </div>
    </fieldset>
    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button class="pull-right btn btn-success" type="submit" ><?php  echo t('Export')?></button>
        </div>
    </div>

</form>