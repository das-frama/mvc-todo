<div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto">
  <h1>ТУДУ список</h1>
  <hr>

  <form class="form-inline mt-4 mb-1">
    <input type="text" class="form-control mr-2" placeholder="Купить штаны">
    <button type="submit" class="btn btn-primary">Добавить</button>
  </form>

  <ul class="list-group">
    <?php foreach ($tasks as $task) : ?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <?php if ($task->is_done) : ?>
          <s><?= $task->text ?></s>
        <?php else : ?>
          <?= $task->text ?>
        <?php endif; ?>

        <div class="btn-group btn-group-sm">
          <a href="/todo/switch?id=<?= $task->id ?>" class="btn btn-default">✔</a>
          <a href="/todo/udate?id=<?= $task->id ?>" class="btn btn-default">✏</a>
          <a href="/todo/delete?id=<?= $task->id ?>" class="btn btn-default">❌</a>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
</div>