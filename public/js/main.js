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
   function fetchTableData() {
      var selectedYear = document.getElementById('year').value;
      console.log("select: "+selectedYear);

      $.ajax({
            url: '/bukti-potong/filterTanggal/' + selectedYear,
            type: 'GET',
            success: function (response) {
            // Hancurkan DataTable jika sudah ada
            console.log(response);
               perbaruiTabel(response)
            },
            error: function(xhr, status, error) {
               console.error(error);
            }
      });
   }

function perbaruiTabel(data) {
   var table = $('#myTable').DataTable();
   table.clear();
   console.log('data:' + data);
   const mperlan = "mperlan_H04-H05";
   for (var i = 0; i < data.length; i++) {
      var rowData = data[i];
      var newRow = [];

      newRow.push(rowData.no_H01);
      const yearFromMperlan = rowData[mperlan].substring(0, 4); // Mengambil tahun dari mperlan
      newRow.push(yearFromMperlan);      
      newRow.push(rowData.npwp_A1);
      newRow.push(rowData.nama_A3);
      newRow.push(rowData.pph_potong || 0);
      newRow.push(rowData.pph_utang || 0);
      newRow.push('');  // Sesuaikan dengan kolom yang ingin ditampilkan
      newRow.push('');  // Sesuaikan dengan kolom yang ingin ditampilkan
      newRow.push('');  // Sesuaikan dengan kolom yang ingin ditampilkan
      newRow.push('');  // Sesuaikan dengan kolom yang ingin ditampilkan
      newRow.push('');  // Sesuaikan dengan kolom yang ingin ditampilkan
      newRow.push(
         '<a href="#" class="btn btn-success mr-2 p-2" onclick="edit(' + rowData.no_H01 + ')">' +
         '<iconify-icon icon="tabler:edit" width="20"></iconify-icon>' +
         '</a>' +
         '<a href="#" class="btn btn-danger p-2" onclick="hapusData(' + rowData.no_H01 + ')">' +
         '<iconify-icon icon="mdi:trash-outline" width="20"></iconify-icon>' +
         '</a>'
      );

      table.row.add(newRow);
   }

   table.draw();
}


$(document).ready(function () {
    // Menggunakan event klik pada tombol submit
    $('#buttonUnggahFile').click(function (e) {
        e.preventDefault(); // Mencegah perilaku bawaan tombol submit

        var fileInput = $('#unggahFile')[0];
        var file = fileInput.files[0];

        // Membuat objek FormData
        var formData = new FormData();
        formData.append('unggahFile', file);

        // Mengambil nilai npwp dan yearOption dari URL
        var urlParams = new URLSearchParams(window.location.search);
        formData.append('npwp', urlParams.get('npwp'));
        formData.append('yearOption', urlParams.get('yearOption'));

        // Menggunakan AJAX untuk mengunggah file
        $.ajax({
            url: '/layanan-pajak/unggah',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Handle respons dari server (jika diperlukan)
                console.log(response);

                // Menampilkan alert success
                alert('File berhasil diunggah');

                // Menunda redirect selama 5 detik
                setTimeout(function () {
                    // Redirect ke URL sebelumnya
                    window.location.href = document.referrer;
                }, 5000);
            },
            error: function (error) {
                // Handle kesalahan (jika diperlukan)
                console.error(error);

                // Menampilkan alert error
                alert('Terjadi kesalahan saat mengunggah file.');
            }
        });
    });
});





