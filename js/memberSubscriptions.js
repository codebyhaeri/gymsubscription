document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("searchInput");
    const tableBody = document.getElementById("subscriptionsTableBody");
    let currentStatus = "active";
    let currentSearch = "";

    console.log("JS loaded correctly ✅");

    const loadSubscriptions = () => {
        fetch(`ajax/fetch_members.php?status=${currentStatus}&search=${encodeURIComponent(currentSearch)}`)
            .then(response => {
                if (!response.ok) throw new Error("Network error: " + response.status);
                return response.json();
            })
            .then(data => renderTable(data))
            .catch(err => {
                console.error("Fetch error:", err);
                tableBody.innerHTML = `<tr><td colspan="6">Error loading data</td></tr>`;
            });
    };

    const renderTable = (data) => {
        tableBody.innerHTML = "";
        if (!data.length) {
            tableBody.innerHTML = `<tr><td colspan="6">No results found.</td></tr>`;
            return;
        }
        data.forEach(row => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${row.fullname}</td>
                <td>${row.email}</td>
                <td>${row.plan_name} (${row.plan_tier})</td>
                <td>${row.plan_type}</td>
                <td>${row.subs_end_date}</td>
                <td>${row.subs_status}</td>
            `;
            tableBody.appendChild(tr);
        });
    };

    searchInput.addEventListener("input", (e) => {
        currentSearch = e.target.value;
        loadSubscriptions();
    });

    document.querySelectorAll(".status-tabs .tab").forEach(button => {
        button.addEventListener("click", () => {
            document.querySelector(".status-tabs .tab.active").classList.remove("active");
            button.classList.add("active");
            currentStatus = button.dataset.status;
            currentSearch = "";
            searchInput.value = "";
            loadSubscriptions();
        });
    });

    loadSubscriptions(); // Initial load
});
