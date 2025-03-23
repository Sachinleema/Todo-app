<?php

namespace App\Controllers;

use App\Models\TodoModel;
use CodeIgniter\Controller;

class TodoController extends Controller
{
  public function addTodo()
  {
    $todoModel = new TodoModel();

    // ✅ Get and cast user_id to integer
    $userId = (int) session('user_id');
    $task = $this->request->getPost('task');

    // ✅ Check if user is logged in
    if (!$userId) {
      return redirect()->to('/dashboard')->with('error', 'User not logged in.');
    }

    // ✅ Ensure task is not empty
    if (empty($task)) {
      return redirect()->to('/dashboard')->with('error', 'Task cannot be empty.');
    }

    $data = [
      'user_id' => $userId,
      'task' => $task
    ];

    // ✅ Insert into database
    if ($todoModel->insert($data)) {
      return redirect()->to('/dashboard')->with('success', 'Todo added successfully.');
    } else {
      return redirect()->to('/dashboard')->with('error', 'Failed to add todo.');
    }
  }



  public function deleteTodo($id)
  {
    $todoModel = new TodoModel();
    $todoModel->delete($id);
    return redirect()->to('/dashboard')->with('message', 'Todo deleted');
  }

  public function editTodo($id)
  {
    $todoModel = new TodoModel();
    $todo = $todoModel->find($id);
    return view('edit_todo', ['todo' => $todo]);
  }

  public function updateTodo()
  {
    $todoModel = new TodoModel();
    $id = $this->request->getPost('id');
    $task = $this->request->getPost('task');

    $todoModel->update($id, ['task' => $task]);
    return redirect()->to('/dashboard')->with('message', 'Todo updated');
  }
}
