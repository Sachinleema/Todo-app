<!DOCTYPE html>
<html lang="en">

<head>
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Todo App</a>
      <div class="d-flex">
        <span class="navbar-text text-white me-3">
          Welcome, <?= session('user_name') ?>
        </span>
        <a href="<?= site_url('logout') ?>" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <h3 class="text-center">Your Todo List</h3>

    <!-- Messages -->
    <?php if (session()->has('success')): ?>
      <div class="alert alert-success"><?= session('success') ?></div>
    <?php elseif (session()->has('error')): ?>
      <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif; ?>

    <!-- Add Todo Form -->
    <div class="container d-flex justify-content-center align-items-center mt-5">
      <div class="col-md-6">
        <form action="<?= site_url('addTodo') ?>" method="POST">
          <?= csrf_field() ?> <!-- CSRF Token -->
          <input type="hidden" name="user_id" value="<?= session('user_id') ?>">
          <div class="input-group">
            <input type="text" name="task" class="form-control" placeholder="Enter a new task" required>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>

        <!-- Todo List -->
        <div class="card shadow-sm mt-4">
          <div class="card-body">
            <ul class="list-group">
              <?php if (!empty($todos)): ?>
                <?php foreach ($todos as $todo): ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= esc($todo['task']) ?>
                    <div>
                      <a href="<?= site_url('editTodo/' . $todo['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                      <a href="<?= site_url('deleteTodo/' . $todo['id']) ?>" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                  </li>
                <?php endforeach; ?>
              <?php else: ?>
                <li class="list-group-item text-center">No tasks available</li>
              <?php endif; ?>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>

</body>

</html>