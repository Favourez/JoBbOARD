document.addEventListener('DOMContentLoaded', function() {
  const addProblemForm = document.getElementById('addProblemForm');
  const answerProblemForm = document.getElementById('answerProblemForm');
  const problemsSection = document.querySelector('.problems');

  // Function to add a new problem
  addProblemForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    // Retrieve problem title and description
    const problemTitle = document.getElementById('problem-title').value.trim();
    const problemDescription = document.getElementById('problem-description').value.trim();

    // Create new problem element
    const newProblemDiv = document.createElement('div');
    newProblemDiv.classList.add('problem');
    newProblemDiv.innerHTML = `
      <h3>${problemTitle}</h3>
      <p>${problemDescription}</p>
      <div class="answers">
        <h4>Answers:</h4>
        <ul></ul>
      </div>
    `;

    // Append new problem to problems section
    problemsSection.appendChild(newProblemDiv);

    // Add problem to select dropdown
    const newOption = document.createElement('option');
    newOption.value = `problem-${problemsSection.children.length}`;
    newOption.textContent = problemTitle;
    answerProblemForm.querySelector('#selected-problem').appendChild(newOption);

    // Clear form inputs
    addProblemForm.reset();
  });

  // Function to answer a problem
  answerProblemForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    // Retrieve selected problem index and answer
    const selectedIndex = answerProblemForm.querySelector('#selected-problem').selectedIndex;
    const selectedProblemId = answerProblemForm.querySelector('#selected-problem').options[selectedIndex].value;
    const selectedProblem = document.getElementById(selectedProblemId);
    const answerText = answerProblemForm.querySelector('#answer').value.trim();

    // Create new answer element
    const newAnswer = document.createElement('li');
    newAnswer.textContent = answerText;

    // Append answer to selected problem
    const answersList = selectedProblem.querySelector('.answers ul');
    answersList.appendChild(newAnswer);

    // Clear answer input
    answerProblemForm.querySelector('#answer').value = '';
  });
});
