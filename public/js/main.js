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

               errorHtml += '<p>Rincian data gagal:</p> ';

               // Tampilkan rincian data yang gagal
               response.failedData.forEach(function (failedData) {
                     errorHtml += '<p>Data Gagal - NPWP: ' + failedData.npwp + ', Mperlan: ' + failedData['mperlan_H04-H05'] + '</p>';
               });

               errorHtml += '</div></div>';
               $('#error-alert').html(errorHtml);

               // Refresh halaman setelah beberapa detik (misalnya 3 detik)
               setTimeout(function () {
                     location.reload();
               }, 3000);
                  // console.log('Jumlah Data Berhasil:', response.successCount);
                  // console.log('Jumlah Data Gagal:', response.failureCount);
                  // console.log('Data Gagal:', response.failedData);
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


const mperlan = "mperlan_H04-H05";

function perbaruiTabel(data) {
    var table = $('#myTable').DataTable();
    table.clear();

    for (var i = 0; i < data.length; i++) {
        var rowData = data[i];

        // Pastikan objek memiliki properti mperlan_H04-H05
        if (rowData.hasOwnProperty(mperlan)) {
            const yearFromMperlan = rowData[mperlan]?.substring(0, 4); // Mengambil tahun dari mperlan

            // Pastikan yearFromMperlan tidak null atau undefined sebelum menggunakan
            if (yearFromMperlan) {
                var base_url = window.location.origin + '/bukti-potong/unduh/' + rowData.npwp_A1 + '/' + rowData.tgl_lahir + '/' + yearFromMperlan;

                var statusUnduhHtml = getStatusUnduhHtml(rowData);
                var unduhBuktiHtml = getUnduhBuktiHtml(base_url, rowData);
                var statusBuktiHtml = getStatusBuktiHtml(rowData);
                var fileBuktiHtml = getFileBuktiHtml(base_url, rowData);

                var newRow = [
                    rowData.no_H01,
                    yearFromMperlan,
                    rowData.npwp_A1,
                    rowData.nama_A3,
                    rowData.pph_potong || 0,
                    rowData.pph_utang || 0,
                    statusUnduhHtml,
                    unduhBuktiHtml,
                    statusBuktiHtml,
                    fileBuktiHtml,
                    '<a href="#" class="btn btn-success mr-2 p-2" onclick="edit(' + rowData.no_H01 + ')">' +
                    '<iconify-icon icon="tabler:edit" width="20"></iconify-icon>' +
                    '</a>' +
                    '<a href="#" class="btn btn-danger p-2" onclick="hapusData(' + rowData.no_H01 + ')">' +
                    '<iconify-icon icon="mdi:trash-outline" width="20"></iconify-icon>' +
                    '</a>'
                ];

                table.row.add(newRow);
            } else {
                console.error(`Nilai ${mperlan} tidak valid.`);
            }
        } else {
            console.error(`Objek data ke-${i} tidak memiliki properti ${mperlan}.`);
        }
    }

    table.draw();
}

function getStatusUnduhHtml(rowData) {
    var statusUnduhHtml = '';
    if (rowData.status_unduh == '0' || rowData.status_unduh == null) {
        statusUnduhHtml = '<div class="d-flex justify-content-center" title="Belum di unduh oleh ' + rowData.nama_A3 + '">' +
            '<a id="" class=" btn btn-danger p-2">' +
            '<iconify-icon icon="maki:cross" width="20"></iconify-icon>' +
            '</a>' +
            '<p hidden>' + rowData.status_unduh + '</p>' +
            '</div>';
    } else if (rowData.status_unduh == '1') {
        statusUnduhHtml = '<div class="d-flex justify-content-center" title="Sudah di unduh oleh ' + rowData.nama_A3 + '">' +
            '<a id="" class="btn btn-success p-2">' +
            '<iconify-icon icon="mingcute:check-fill" width="20"></iconify-icon>' +
            '</a>' +
            '<p hidden>' + rowData.status_unduh + '</p>' +
            '</div>';
    } else {
        statusUnduhHtml = '<div class="d-flex justify-content-center" title="terjadi kesalahan">' +
            '<a id="" class=" btn btn-danger p-2">' +
            '<iconify-icon icon="maki:cross" width="20"></iconify-icon>' +
            '</a>' +
            '</div>';
    }

    return statusUnduhHtml;
}

function getUnduhBuktiHtml(base_url, rowData) {
    return '<div class="d-flex justify-content-center">' +
        '<a id="unduh-bukti-potong" href="' + base_url + '" class="btn btn-info p-2" target="_blank">' +
        '<iconify-icon icon="ph:eye" width="20"></iconify-icon>' +
        '</a>' +
        '</div>';
}


function getStatusBuktiHtml(rowData) {
    var statusBuktiHtml = '';
    if (rowData.status_bukti_bayar == '0' || rowData.status_bukti_bayar == null) {
        statusBuktiHtml = '<div class="d-flex justify-content-center">' +
            '<a id="" class=" btn btn-danger p-2" download>' +
            '<iconify-icon icon="maki:cross" width="20"></iconify-icon>' +
            '</a>' +
            '<p hidden>' + rowData.status_bukti_bayar + '</p>' +
            '</div>';
    } else if (rowData.status_bukti_bayar == '1') {
        statusBuktiHtml = '<div class="d-flex justify-content-center">' +
            '<a id="" class="btn btn-success p-2" download>' +
            '<iconify-icon icon="mingcute:check-fill" width="20"></iconify-icon>' +
            '</a>' +
            '<p hidden>' + rowData.status_bukti_bayar + '</p>' +
            '</div>';
    } else {
        statusBuktiHtml = '<div class="d-flex justify-content-center" title="terjadi kesalahan">' +
            '<a id="" class=" btn btn-danger p-2" download>' +
            '<iconify-icon icon="maki:cross" width="20"></iconify-icon>' +
            '</a>' +
            '</div>';
    }

    return statusBuktiHtml;
}

function getFileBuktiHtml(base_url, rowData) {
    var fileBuktiHtml = '';
    if (rowData.file_bukti_bayar) {
        var folderPath = 'FileUpload/BuktiPembayaranPajak/';
        var fileName = rowData.file_bukti_bayar;
        var fileInfo = pathinfo(folderPath + fileName);
        var fileExtension = fileInfo.extension || '';
        var subfolder = (fileExtension === 'pdf') ? 'pdf/' : 'img/';
        var filePath = folderPath + subfolder + fileName;

        fileBuktiHtml = '<div class="d-flex justify-content-center">' +
            '<a id="downloadButton" href="' + base_url + filePath + '" class="btn btn-info p-2" download>' +
            '<iconify-icon icon="material-symbols:download" width="20"></iconify-icon>' +
            '</a>' +
            '</div>';
    }

    return fileBuktiHtml;
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