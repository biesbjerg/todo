<?php
/**
 * @var \App\View\AppView $this
 */
?>

<p><?= __('Select a list in the sidebar or add a new one.') ?></p>
<p>
	<?php
		echo $this->Html->link(__('+ Add list'), ['_name' => 'add_todo_list'], [
			'class' => [
				'btn',
				'btn-primary',
			]
		]);
	?>
</p>
