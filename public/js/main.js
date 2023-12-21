// Javascript Filter Table
    function displayFileName(input) {
        const fileName = input.files[0].name;
        document.getElementById('fileName').innerText = fileName;
    }

    function uploadFile() {
        // Trigger the file input click event
      //   document.getElementById('formFile').click();
      uploadFile();
    }

    // Fungsi untuk mengirim data ke controller dengan AJAX
    function uploadFile() {
        const fileInput = document.getElementById('formFile');
        const file = fileInput.files[0];

        if (!file) {
            alert('Pilih file terlebih dahulu.');
            return;
        }

        const formData = new FormData();
        formData.append('excel_file', file);

        $.ajax({
            url: '/excel/upload',  // Sesuaikan dengan URL endpoint Anda
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Tambahkan logika penanganan respons di sini
                console.log(response);
            },
            error: function (xhr, status, error) {
                // Tambahkan logika penanganan error di sini
                console.error(error);
            }
        });
    }

