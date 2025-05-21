
    function enableEdit() {
        const form = document.getElementById('profileForm');
        const fields = form.querySelectorAll('input, select, textarea');
        fields.forEach(field => {
            if (field.name !== 'user_id') {
                field.removeAttribute('disabled');
            }
        });
        document.getElementById('updateBtn').classList.remove('d-none');
    }
