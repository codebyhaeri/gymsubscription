









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

//search
document.addEventListener("DOMContentLoaded", function () {
    const tabButtons = document.querySelectorAll(".status-tabs .tab");
    const searchInput = document.getElementById("searchInput");
    const suggestionList = document.getElementById("suggestionList");
    const tbody = document.querySelector("tbody");

    let currentStatus = "active";
    let searchQuery = "";

    function loadMembers() {
        fetch(`ajax/fetch_members.php?status=${currentStatus}&search=${encodeURIComponent(searchQuery)}`)
            .then(res => res.json())
            .then(data => renderTable(data));
    }

    function renderTable(data) {
        tbody.innerHTML = "";

        if (!data.length) {
            tbody.innerHTML = `<tr><td colspan="6">No results found.</td></tr>`;
            return;
        }

        data.forEach(row => {
            const endDate = new Date(row.subs_end_date);
            const today = new Date();
            const timeDiff = Math.ceil((endDate - today) / (1000 * 60 * 60 * 24));
            const nextPayment = endDate.toLocaleDateString(undefined, { month: 'short', day: 'numeric', year: 'numeric' });

            tbody.innerHTML += `
                <tr>
                    <td>${new Date(row.subs_start_date).toLocaleDateString()}</td>
                    <td>
                        <div class="member-info">
                            <div class="avatar">${getInitials(row.fullname)}</div>
                            <div>
                                <div class="name">${row.fullname}</div>
                                <div class="email">${row.email}</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="plan-tag premium"><i class="fas fa-crown"></i> ${row.plan_type} - ${row.plan_tier}</span></td>
                    <td><span class="status-badge ${row.subs_status}">${capitalize(row.subs_status)}</span></td>
                    <td>
                        <div class="payment-due">
                            <div>${nextPayment}</div>
                            <div class="days-remaining">(${timeDiff} days remaining)</div>
                        </div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-icon"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </td>
                </tr>
            `;
        });
    }

    function getInitials(name) {
        return name.split(" ").map(n => n[0]).join("").toUpperCase();
    }

    function capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    // Tab filter
    tabButtons.forEach(btn => {
        btn.addEventListener("click", function () {
            tabButtons.forEach(b => b.classList.remove("active"));
            this.classList.add("active");
            currentStatus = this.textContent.toLowerCase().split(" ")[0];
            searchQuery = "";
            searchInput.value = "";
            suggestionList.innerHTML = "";
            loadMembers();
        });
    });

    // Search input with suggestions
    searchInput.addEventListener("input", function () {
        searchQuery = this.value;
        loadMembers();
        loadSuggestions();
    });

    // Load suggestions
    function loadSuggestions() {
        if (searchQuery.length < 1) {
            suggestionList.innerHTML = '';
            return;
        }

        fetch(`ajax/fetch_members.php?status=${currentStatus}&search=${encodeURIComponent(searchQuery)}`)
            .then(response => response.json())
            .then(data => {
                suggestionList.innerHTML = '';
                data.slice(0, 5).forEach(item => {
                    const li = document.createElement("li");
                    li.textContent = item.fullname;
                    li.addEventListener("click", () => {
                        searchInput.value = item.fullname;
                        searchQuery = item.fullname;
                        suggestionList.innerHTML = '';
                        loadMembers();
                    });
                    suggestionList.appendChild(li);
                });
            });
    }

    loadMembers(); // initial load
});



document.addEventListener("DOMContentLoaded", () => {
  const tabButtons = document.querySelectorAll(".status-tabs .tab");
  let currentStatus = "active";  // default status filter

  // Function to load members by currentStatus and searchQuery
  // (You need to define loadMembers() somewhere else to fetch and render)
  function loadMembers() {
    const searchInput = document.getElementById("searchInput");
    const searchQuery = searchInput ? searchInput.value : "";
    
    fetch(`ajax/fetch_members.php?status=${currentStatus}&search=${encodeURIComponent(searchQuery)}`)
      .then(res => res.json())
      .then(data => {
        // Your renderTable(data) function here, or handle rendering
        console.log(data); // For testing, replace with actual rendering
      });
  }

  // Add click event listeners to tabs
  tabButtons.forEach(tab => {
    tab.addEventListener("click", () => {
      // Remove active class from all tabs
      tabButtons.forEach(t => t.classList.remove("active"));

      // Add active class to clicked tab
      tab.classList.add("active");

      // Update currentStatus to clicked tab's data-status
      currentStatus = tab.getAttribute("data-status");

      // Clear search input and suggestions if present
      const searchInput = document.getElementById("searchInput");
      if (searchInput) searchInput.value = "";
      const suggestionList = document.getElementById("suggestionList");
      if (suggestionList) suggestionList.innerHTML = "";

      // Reload members list with new status filter
      loadMembers();
    });
  });

  // Initial load for default status
  loadMembers();
});
