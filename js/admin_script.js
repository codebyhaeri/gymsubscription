// ===================== Utility Functions =====================
function showMessage(type, message, containerId = 'message-container') {
    const container = document.getElementById(containerId);
    if (!container) return;

    const div = document.createElement('div');
    div.className = `alert alert-${type}`;
    div.textContent = message;

    container.innerHTML = '';
    container.appendChild(div);

    setTimeout(() => div.remove(), 5000);
}

function showLoadingSpinner() {
    if (!document.getElementById('loading-spinner')) {
        const spinner = document.createElement('div');
        spinner.id = 'loading-spinner';
        spinner.innerHTML = '⏳ Updating...';
        document.body.appendChild(spinner);
    }
}

function removeLoadingSpinner() {
    const spinner = document.getElementById('loading-spinner');
    if (spinner) spinner.remove();
}

// =================== Add New Subscription Plan ===================
const form = document.getElementById('AddNewSubsPlan-subscription-form');

if (form) {
    let isSubmitting = false;

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        if (isSubmitting) return;
        isSubmitting = true;

        const formData = new FormData(form);

        fetch('new_subs_plan.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
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
                showMessage('danger', data.message || 'There was an error. Please try again.', 'message-container-subscription');
            }
        })
        .catch(error => {
            showMessage('danger', 'An error occurred. Please try again later.', 'message-container-subscription');
        })
        .finally(() => {
            isSubmitting = false;
        });
    });
}

// ================== Update Subscription Plan ================
const updateForm = document.getElementById('UpdateSubsPlan-subscription-form');

if (updateForm) {
    let isUpdating = false;

    updateForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (isUpdating) return;
        isUpdating = true;

        const formData = new FormData(updateForm);
        const requiredFields = ['u_plan_name', 'u_plan_type', 'u_plan_tier', 'u_plan_price', 'u_plan_duration_days', 'u_plan_desc'];

        for (let field of requiredFields) {
            if (!formData.get(field)) {
                showMessage('danger', `Please fill in ${field.replace('u_', '').replace(/_/g, ' ')}.`, 'message-container-subscription');
                isUpdating = false;
                return;
            }
        }

        showLoadingSpinner();

        try {
            const response = await fetch('update_subs_plan.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                showMessage('success', 'Subscription Plan Updated Successfully.', 'message-container-subscription');

                setTimeout(() => {
                    window.location.href = '../admin/index.php?page=subsplan';
                }, 2000);
            } else {
                showMessage('danger', data.message || 'Update failed. Try again.', 'message-container-subscription');
            }
        } catch (error) {
            console.error('Fetch error:', error);
            showMessage('danger', 'An unexpected error occurred.', 'message-container-subscription');
        } finally {
            removeLoadingSpinner();
            isUpdating = false;
        }
    });
}

// ====================== Add New Fitness Trainer =======================
const fitForm = document.getElementById('AddNewFitMem-form');

if (fitForm) {
    fitForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(fitForm);

        fetch('new_fitness_trainer.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage('success', 'Fitness Trainer Added Successfully!', 'message-container-fitness');
                fitForm.reset();

                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } else {
                showMessage('danger', data.message || 'An error occurred. Please try again.', 'message-container-fitness');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('danger', 'A network error occurred.', 'message-container-fitness');
        });
    });
}

// ==================== Update Fitness Trainer ================

const UpdateFitnessForm = document.getElementById('UpdateFitMem-form');

if (UpdateFitnessForm) {
    let isUpdating = false;

    UpdateFitnessForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (isUpdating) return;
        isUpdating = true;

        const formData = new FormData(UpdateFitnessForm);
        const requiredFields = ['fmu_trainer_id', 'fmu_trainer_fullname', 'fmu_trainer_spzn', 'fmu_trainer_contact_no'];

        for (let field of requiredFields) {
            if (!formData.get(field)) {
                showMessage('danger', `Please fill in ${field.replace('fmu_', '').replace(/_/g, ' ')}.`, 'message-container-fitness');
                isUpdating = false;
                return;
            }
        }

        showLoadingSpinner();

        try {
            const response = await fetch('update_fitness_trainer.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                showMessage('success', 'Fitness Trainer Updated Successfully.', 'message-container-fitness');

                setTimeout(() => {
                    window.location.href = '../admin/index.php?page=fitness_trainers';
                }, 2000);
            } else {
                showMessage('danger', data.message || 'Update failed. Try again.', 'message-container-fitness');
            }
        } catch (error) {
            console.error('Fetch error:', error);
            showMessage('danger', 'An unexpected error occurred.', 'message-container-fitness');
        } finally {
            removeLoadingSpinner();
            isUpdating = false;
        }
    });
}

$(document).ready(function () {
  // Handle "Add Plan" button click
  $('#addPlanBtn').on('click', function () {
    $('#addPlanForm').show();
    $('.update-form-container').hide(); // Hide all update forms
  });

  // Handle "Update Plan" button click
  $('.updatePlanBtn').on('click', function () {
    const row = $(this).closest('tr');
    const updateForm = row.next('.update-form-container'); // assuming update form is in the next <tr>

    $('#addPlanForm').hide(); // Hide Add form
    $('.update-form-container').not(updateForm).hide(); // Hide other update forms
    updateForm.show();
  });

  // Handle "Cancel" button click in update form
  $('.cancelUpdateBtn').on('click', function () {
    $(this).closest('.update-form-container').hide(); // Hide the current update form
    $('#addPlanForm').show(); // Show Add form again
  });
});





