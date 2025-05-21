









// ===================== Utility Functions =====================
function showMessage(type, message, containerId = 'message-container') {
  const container = document.getElementById(containerId);
  if (!container) return;
  const div = document.createElement('div');
  div.className = `alert-${type}`; // uses your .alert-success/.alert-error CSS
  div.textContent = message;
  container.innerHTML = '';
  container.appendChild(div);
  setTimeout(() => div.remove(), 5000);
}

function showLoadingSpinner() {
  if (!document.getElementById('loading-spinner')) {
    const spinner = document.createElement('div');
    spinner.id = 'loading-spinner';
    spinner.textContent = '⏳ Updating...';
    document.body.appendChild(spinner);
  }
}

function removeLoadingSpinner() {
  const spinner = document.getElementById('loading-spinner');
  if (spinner) spinner.remove();
}

// ===================== Add New Subscription Plan =====================
;(function(){
  const form = document.getElementById('AddNewSubsPlan-subscription-form');
  if (!form) return;
  let isSubmitting = false;

  form.addEventListener('submit', async e => {
    e.preventDefault();
    if (isSubmitting) return;
    isSubmitting = true;

    const formData = new FormData(form);
    try {
      const res  = await fetch('new_subs_plan.php', { method: 'POST', body: formData });
      const data = await res.json();

      if (data.success) {
        showMessage('success', 'Subscription Plan Added Successfully.', 'message-container-subscription');
        form.reset();

        setTimeout(() => {
          showMessage('info', 'Updating Active Subscription Plans...', 'message-container-subscription');
          showLoadingSpinner();
        }, 3000);

        setTimeout(() => {
          removeLoadingSpinner();
          window.location.reload();
        }, 6000);
      } else {
        showMessage('danger', data.message, 'message-container-subscription');
      }
    } catch {
      showMessage('danger', 'Network error. Please try again.', 'message-container-subscription');
    } finally {
      isSubmitting = false;
    }
  });
})();

// ===================== Update Subscription Plan =====================
;(function(){
  const form = document.getElementById('UpdateSubsPlan-subscription-form');
  if (!form) return;
  let isUpdating = false;

  form.addEventListener('submit', async e => {
    e.preventDefault();
    if (isUpdating) return;
    isUpdating = true;

    const formData = new FormData(form);
    // validate required fields here if needed...

    showLoadingSpinner();
    try {
      const res  = await fetch('update_subs_plan.php', { method: 'POST', body: formData });
      const data = await res.json();

      if (data.success) {
        showMessage('success', 'Subscription Plan Updated.', 'message-container-subscription');
        setTimeout(() => window.location.href = '../admin/index.php?page=subsplan', 2000);
      } else {
        showMessage('danger', data.message, 'message-container-subscription');
      }
    } catch {
      showMessage('danger', 'Unexpected error.', 'message-container-subscription');
    } finally {
      removeLoadingSpinner();
      isUpdating = false;
    }
  });
})();

// ===================== Add New Fitness Trainer =====================
;(function(){
  const form = document.getElementById('AddNewFitMem-form');
  if (!form) return;

  form.addEventListener('submit', async e => {
    e.preventDefault();
    const formData = new FormData(form);

    try {
      const res  = await fetch('new_fitness_trainer.php', { method: 'POST', body: formData });
      const data = await res.json();

      if (data.success) {
        showMessage('success', 'Fitness Trainer Added!', 'message-container-fitness');
        form.reset();
        setTimeout(() => window.location.reload(), 3000);
      } else {
        showMessage('danger', data.message, 'message-container-fitness');
      }
    } catch {
      showMessage('danger', 'Network error.', 'message-container-fitness');
    }
  });
})();

// ===================== Update Fitness Trainer =====================
;(function(){
  const form = document.getElementById('UpdateFitMem-form');
  if (!form) return;
  let isUpdating = false;

  form.addEventListener('submit', async e => {
    e.preventDefault();
    if (isUpdating) return;
    isUpdating = true;

    const formData = new FormData(form);
    // validate required fields here...

    showLoadingSpinner();
    try {
      const res  = await fetch('update_fitness_trainer.php', { method: 'POST', body: formData });
      const data = await res.json();

      if (data.success) {
        showMessage('success', 'Trainer Updated.', 'message-container-fitness');
        setTimeout(() => window.location.href = '../admin/index.php?page=fitness_trainers', 2000);
      } else {
        showMessage('danger', data.message, 'message-container-fitness');
      }
    } catch {
      showMessage('danger', 'Unexpected error.', 'message-container-fitness');
    } finally {
      removeLoadingSpinner();
      isUpdating = false;
    }
  });
})();

// ===================== Add New Fitness Program =====================
;(function(){
  const form = document.getElementById('AddNewFitProgram-form');
  if (!form) return;

  form.addEventListener('submit', async e => {
    e.preventDefault();
    const formData = new FormData(form);

    try {
      const res  = await fetch('new_fitness_program.php', { method: 'POST', body: formData });
      const data = await res.json();

      if (data.success) {
        showMessage('success', 'Fitness Program Added Successfully!', 'message-container-programs');
        form.reset();
        // reload after 3s to show the new row
        setTimeout(() => window.location.reload(), 3000);
      } else {
        showMessage('danger', data.message, 'message-container-programs');
      }
    } catch {
      showMessage('danger', 'Network error.', 'message-container-programs');
    }
  });
})();


// ===================== Update Fitness Program =====================
;(function(){
  const form = document.getElementById('UpdateFitProgram-form');
  if (!form) return;
  let isUpdating = false;

  form.addEventListener('submit', async e => {
    e.preventDefault();
    if (isUpdating) return;
    isUpdating = true;

    const formData = new FormData(form);
    showLoadingSpinner();

    try {
      const res  = await fetch('update_fitness_program.php', { method: 'POST', body: formData });
      const data = await res.json();

      if (data.success) {
        showMessage('success', 'Program Updated.', 'message-container-fitness_prog');
        setTimeout(() => {
          window.location.href = '../admin/index.php?page=program_plans';
        }, 2000);
      } else {
        showMessage('danger', data.message, 'message-container-fitness_prog');
      }
    } catch {
      showMessage('danger', 'Unexpected error.', 'message-container-fitness_prog');
    } finally {
      removeLoadingSpinner();
      isUpdating = false;
    }
  });
})();



