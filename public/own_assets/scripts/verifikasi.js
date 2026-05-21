
$('#tableVerifikasi').DataTable({
    responsive: true,
    autoWidth: false
});

$('#tableHistory').DataTable({
    responsive: true,
    autoWidth: false
});

document.querySelectorAll('.btn-verifikasi').forEach(button => {

    button.addEventListener('click', async function () {

        const id = this.dataset.id;

        if (!confirm('Verifikasi iklan ini?')) {
            return;
        }

        const originalText = this.innerHTML;

        this.disabled = true;

        this.innerHTML = `
                <span class="spinner-border spinner-border-sm"></span>
                Loading...
            `;

        try {

            const response = await fetch(`/verifikasi/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            if (result.success) {

                const row = document.getElementById(`row-${id}`);

                row.style.transition = 'all 0.3s ease';
                row.style.opacity = '0';
                row.style.transform = 'translateX(20px)';

                setTimeout(() => {
                    row.remove();
                }, 300);

            } else {

                alert(result.message);

                this.disabled = false;
                this.innerHTML = originalText;

            }

        } catch (error) {

            alert('Terjadi kesalahan');

            this.disabled = false;
            this.innerHTML = originalText;

        }

    });

});