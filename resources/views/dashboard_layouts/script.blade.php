<script>
    document.querySelector(".logout").addEventListener("click", function() {

        if (confirm("Apakah Anda yakin ingin logout?")) {

            window.location.href = "/logout";

        }

    });
</script>
