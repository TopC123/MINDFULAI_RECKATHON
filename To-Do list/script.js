document.addEventListener('DOMContentLoaded', function() {
    const loadingContainer = document.getElementById('loading-container');
    const todoContainer = document.getElementById('todo-container');
    const todoForm = document.getElementById('todo-form');
    const todoList = document.getElementById('todo-list');
  
    // Simulating delay
    setTimeout(function() {
      loadingContainer.style.display = 'none';
      todoContainer.classList.add('show');
    }, 2000);
  
    // Store the selected category colors
    const categoryColors = {
      personal: '#ff8080',
      work: '#80b3ff',
      shopping: '#ffcc66',
      health: '#b3ffb3'
    };
  
    todoForm.addEventListener('submit', function(e) {
      e.preventDefault();
  
      const todoInput = document.getElementById('todo-input').value;
      const categoryInput = document.getElementById('category-input').value;
  
      createTodoCard(todoInput, categoryInput);
  
      // Clear the form inputs
      todoForm.reset();
    });
  
    function createTodoCard(todo, category) {
      // Create a new to-do item element
      const todoCard = document.createElement('div');
      todoCard.classList.add('todo-card');
      todoCard.style.backgroundColor = categoryColors[category];
  
      const titleElement = document.createElement('h3');
      titleElement.textContent = todo;
      todoCard.appendChild(titleElement);
  
      const dropButton = document.createElement('button');
      dropButton.textContent = 'Drop';
      dropButton.classList.add('drop-button');
      dropButton.addEventListener('click', function() {
        todoList.removeChild(todoCard);
      });
      todoCard.appendChild(dropButton);
  
      todoCard.addEventListener('mouseenter', function() {
        todoCard.classList.add('expanded');
      });
  
      todoCard.addEventListener('mouseleave', function() {
        todoCard.classList.remove('expanded');
      });
  
      todoList.appendChild(todoCard);
    }
  
    // Rest of your code...
  });




function addTodo() {
  const todoInput = document.getElementById('todo-input');
  const descriptionInput = document.getElementById('description-input');
  const datetimeInput = document.getElementById('datetime-input');

  const task = todoInput.value.trim();
  const description = descriptionInput.value.trim();
  const datetime = datetimeInput.value;

  if (task !== '' && description !== '') {
    const todo = {
      id: Date.now(),
      task: task,
      description: description,
      datetime: datetime,
      completed: false
    };

    todos.push(todo);
    fetchTodos();

    todoInput.value = '';
    descriptionInput.value = '';
    datetimeInput.value = '';
  }
}

function deleteTodo() {
  const todoId = parseInt(this.parentNode.dataset.id);
  todos = todos.filter(todo => todo.id !== todoId);
  fetchTodos();
}

function updateTodoCount() {
  const todoCount = document.getElementById('todo-count');
  const count = todos.length;
  todoCount.textContent = count === 1 ? '1 task' : `${count} tasks`;
}

document.getElementById('todo-form').addEventListener('submit', function (e) {
  e.preventDefault();
  addTodo();
});

window.addEventListener('load', function () {
  const loadingContainer = document.getElementById('loading-container');
  loadingContainer.style.display = 'none';

  const todoContainer = document.getElementById('todo-container');
  todoContainer.style.display = 'block';
});

setTimeout(function () {
  const loadingContainer = document.getElementById('loading-container');
  loadingContainer.style.display = 'none';
  document.getElementById('todo-container').style.display = 'block';
}, 3000);
