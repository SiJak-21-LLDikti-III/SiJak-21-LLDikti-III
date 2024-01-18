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
            if (response.status === 'success' && response.failureCount === 0) {
               // File berhasil diunggah dan tidak ada data yang gagal
               $('#success-alert').html('<div class="alert alert-success alert-dismissible show fade" role="alert"><div class="alert-body"><button class="close" data-dismiss="alert"></button><b>Berhasil ! </b>' + response.message + '</div></div>');
               // Tampilkan jumlah data yang berhasil pada tampilan pengguna
               if (response.successCount > 0) {
                     $('#success-alert').append('<p>Data berhasil dimasukkan: ' + response.successCount + '</p>');
               }
               // Refresh halaman setelah beberapa detik (misalnya 3 detik)
               setTimeout(function () {
                     location.reload();
               }, 3000);
            } else {
               // File berhasil diunggah tetapi terdapat data yang gagal
               let errorHtml = '<div class="alert alert-danger alert-dismissible show fade" role="alert"><div class="alert-body"><button class="close" data-dismiss="alert"></button><b>Gagal ! </b>';

               if (response.successCount > 0) {
                     errorHtml += 'File telah diunggah, namun ' + response.failureCount + ' data gagal, karena duplikasi. ';
               } else {
                     errorHtml += response.message + ' ';
               }

               errorHtml += 'Rincian data gagal:</div></div>';

               // Tampilkan rincian data yang gagal
               response.failedData.forEach(function (failedData) {
                     errorHtml += '<p>Data Gagal - NPWP: ' + failedData.npwp + ', Mperlan: ' + failedData['mperlan_H04-H05'] + '</p>';
               });

               $('#error-alert').html(errorHtml);

               // Refresh halaman setelah beberapa detik (misalnya 3 detik)
               setTimeout(function () {
                     location.reload();
               }, 3000);
            }
         },

         error: function (xhr, status, error) {
            // Tampilkan pesan error jika terjadi kesalahan AJAX
            $('#error-alert').html('<div class="alert alert-danger alert-dismissible show fade" role="alert"><div class="alert-body"><button class="close" data-dismiss="alert"></button><b>Gagal ! </b>' + status + ' ' + error.message + '</div></div>');
            // Refresh halaman setelah beberapa detik (misalnya 3 detik)
            setTimeout(function () {
               location.reload();
            }, 3000);
         }

      });
   }
   function fetchTableData() {
      var selectedYear = document.getElementById('year').value;
      console.log("select: " + selectedYear);

      $.ajax({
         url: '/bukti-potong/filterTanggal/' + selectedYear,
         type: 'GET',
         success: function (response) {
               // Hancurkan DataTable jika sudah ada
               console.log(response);
               perbaruiTabel(response);
         },
         error: function (xhr, status, error) {
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
      newRow.push(rowData.unduh_bukti || 0);
      newRow.push(rowData.bukti_bayar || 0);
      newRow.push(rowData.status_unduh || 0);
      newRow.push(rowData.status_bukti_bayar || 0);
      newRow.push(rowData.file_bukti_bayar || 0);
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


// PROGRESS BAR DI HALAMAN EDIT BUKTI POTONG
$(document).ready(function() {
   $('.nav-link').on('shown.bs.tab', function (e) {
       // Menghitung indeks tab aktif
       var activeTabIndex = $(e.target).parent().index(); // Menggunakan parent() untuk mendapatkan indeks dari elemen li
       
       // Menghitung persentase berdasarkan bobot 25% untuk setiap tab
       var progressPercentage = (activeTabIndex + 1) * 25; // Karena indeks dimulai dari 0
       
       // Update bar progress dengan persentase yang tepat
       $('.progress-bar').css('width', progressPercentage + '%').attr('aria-valuenow', progressPercentage);
       
       // Update teks persentase di dalam bar progress
       $('.progress-text').text(progressPercentage + '%');
   });
});