<?php
/**
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?php
        echo $this->Html->css([
            '/vendor/bootstrap/css/bootstrap.min',
            'sidebar',
            'default'
        ]);
    ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
    <button class="navbar-toggler sidebar-toggle" type="button" aria-label="Toggle sidebar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/"><?= __('Todo') ?></a>
</nav>

    <div id="wrapper">

        <!-- Todo Lists Sidebar -->
        <aside id="sidebar-wrapper" class="bg-light border-right">
            <ul class="nav flex-column nav-pills">
                <li class="nav-item">
                    <a href="#" class="nav-link">My Day</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Planned</a>
                </li>
            </ul>
            <hr class="my-2 mx-3">
            <div class="todo-lists">
                <?php
                    echo $this->cell('TodoLists', [$this->request->getParam('list_id')])->render();
                    echo $this->Html->link(__('+ Add list'), ['_name' => 'add_todo_list'], [
                        'class' => [
                            'btn',
                            'btn-link',
                            'btn-sm'
                        ]
                    ]);
                ?>
            </div>
        </aside>

        <!-- Page Content -->
        <div id="page-content-wrapper" class="p-2">
            <?php
                echo $this->Flash->render();
                echo $this->fetch('content');
            ?>
        </div>

    </div>

    <?php
        echo $this->Html->script([
            '/vendor/jquery/jquery.min',
            '/vendor/bootstrap/js/bootstrap.min',
            'default'
        ]);
        echo $this->fetch('script');
    ?>

</body>
</html>
