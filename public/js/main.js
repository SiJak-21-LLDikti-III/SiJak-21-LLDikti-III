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
            $('#error-alert').html('<div class="alert alert-danger alert-dismissible show fade" role="alert"><div class="alert-body"><button class="close" data-dismiss="alert"></button><b>Gagal ! </b>Pilih file terlebih dahulu.</div></div>');
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
               if (response.status === 'success') {
                     // Tampilkan pesan keberhasilan
                     $('#success-alert').html('<div class="alert alert-success alert-dismissible show fade" role="alert"><div class="alert-body"><button class="close" data-dismiss="alert"></button><b>Berhasil ! </b>' + response.message + '</div></div>');
               } else {
                     // Tampilkan pesan kesalahan
                     $('#error-alert').html('<div class="alert alert-danger alert-dismissible show fade" role="alert"><div class="alert-body"><button class="close" data-dismiss="alert"></button><b>Gagal ! </b>' + response.message + '</div></div>');
               }
            },
            error: function (xhr, status, error) {
               // Tampilkan pesan error jika terjadi kesalahan AJAX
               $('#error-alert').html('<div class="alert alert-danger alert-dismissible show fade" role="alert"><div class="alert-body"><button class="close" data-dismiss="alert"></button><b>Gagal ! </b>'+status+' '+ error.message + '</div></div>');

            }
        });
    }

