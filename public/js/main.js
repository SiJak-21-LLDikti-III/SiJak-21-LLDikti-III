// Javascript Filter Table
function displayFileName(input) {
  const fileName = input.files[0].name;
  document.getElementById("fileName").innerText = fileName;
}

function uploadFile() {
  // Trigger the file input click event
  //   document.getElementById('formFile').click();
  uploadFile();
}

// Fungsi untuk mengirim data ke controller dengan AJAX
function uploadFile() {
  const fileInput = document.getElementById("formFile");
  const file = fileInput.files[0];

  if (!file) {
    $("#error-alert").html('<div class="alert alert-danger alert-dismissible show fade" role="alert"><div class="alert-body"><button class="close" data-dismiss="alert"></button><b>Gagal ! </b>Pilih file terlebih dahulu.</div></div>');
    return;
  }

  const formData = new FormData();
  formData.append("excel_file", file);

   $.ajax({
      url: "/excel/upload", // Sesuaikan dengan URL endpoint Anda
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
         if (response.status === "success" && response.failureCount === 0) {
         // File berhasil diunggah dan tidak ada data yang gagal
         $("#success-alert").html(
            '<div class="alert alert-success alert-dismissible show fade" role="alert"><div class="alert-body"><button class="close" data-dismiss="alert"></button><b>Berhasil ! </b>' + response.message + "</div></div>"
         );
         // Tampilkan jumlah data yang berhasil pada tampilan pengguna
         if (response.successCount > 0) {
            $("#success-alert").append("<p>Data berhasil dimasukkan: " + response.successCount + "</p>");
         }
         // Refresh halaman setelah beberapa detik (misalnya 3 detik)
         setTimeout(function () {
            location.reload();
         }, 3000);
         } else {
         // File berhasil diunggah tetapi terdapat data yang gagal
         let errorHtml = '<div class="alert alert-danger alert-dismissible show fade" role="alert"><div class="alert-body"><button class="close" data-dismiss="alert"></button><b>Gagal ! </b>';

         if (response.successCount > 0) {
            errorHtml += "File telah diunggah, namun " + response.failureCount + " data gagal, karena duplikasi. ";
         } else {
            errorHtml += response.message + " ";
         }

         errorHtml += "<p>Rincian data gagal:</p> ";

         // Tampilkan rincian data yang gagal
         response.failedData.forEach(function (failedData) {
            errorHtml += "<p>Data Gagal - NPWP: " + failedData.npwp + ", Mperlan: " + failedData["mperlan_H04-H05"] + "</p>";
         });

         errorHtml += "</div></div>";
         $("#error-alert").html(errorHtml);

         // Refresh halaman setelah beberapa detik (misalnya 5 detik)
         setTimeout(function () {
            location.reload();
         }, 5000);
         // console.log('Jumlah Data Berhasil:', response.successCount);
         // console.log('Jumlah Data Gagal:', response.failureCount);
         // console.log('Data Gagal:', response.failedData);
         }
      },

      error: function (xhr, status, error) {
         // Tampilkan pesan error jika terjadi kesalahan AJAX
         $("#error-alert").html(
         '<div class="alert alert-danger alert-dismissible show fade" role="alert"><div class="alert-body"><button class="close" data-dismiss="alert"></button><b>Gagal ! </b>' + status + " " + error.message + "</div></div>"
         );
         // Refresh halaman setelah beberapa detik (misalnya 3 detik)
         // setTimeout(function () {
         // location.reload();
         // }, 3000);
      },
   });
}
function fetchTableData() {
  var selectedYear = document.getElementById("year").value;
  console.log("select: " + selectedYear);

  $.ajax({
    url: "/bukti-potong/filterTanggal/" + selectedYear,
    type: "GET",
    success: function (response) {
      // Hancurkan DataTable jika sudah ada
      console.log(response);
      perbaruiTabel(response);
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}

const mperlan = "mperlan_H04-H05";

function perbaruiTabel(data) {
  var table = $("#myTable").DataTable();
  table.clear();

  for (var i = 0; i < data.length; i++) {
    var rowData = data[i];

    // Pastikan objek memiliki properti mperlan_H04-H05
    if (rowData.hasOwnProperty(mperlan)) {
      const yearFromMperlan = rowData[mperlan]?.substring(0, 4); // Mengambil tahun dari mperlan

      // Pastikan yearFromMperlan tidak null atau undefined sebelum menggunakan
      if (yearFromMperlan) {
        var base_url = window.location.origin + "/bukti-potong/unduh/" + rowData.npwp_A1 + "/" + rowData.tgl_lahir + "/" + yearFromMperlan;
        var edit_url = window.location.origin + "/edit-bukti-potong/" + rowData.id;
        var delete_url = window.location.origin + "/delete-bukti-potong/" + rowData.id;

        var statusUnduhHtml = getStatusUnduhHtml(rowData);
        var unduhBuktiHtml = getUnduhBuktiHtml(base_url, rowData);
        var statusBuktiHtml = getStatusBuktiHtml(rowData);
        var fileBuktiHtml = getFileBuktiHtml(base_url, rowData);

        var newRow = [
          yearFromMperlan,
          rowData.npwp_A1,
          rowData.nama_A3,
          rowData.pph_potong || 0,
          rowData.pph_utang || 0,
          statusUnduhHtml,
          unduhBuktiHtml,
          statusBuktiHtml,
          fileBuktiHtml,
          '<a href="' +
            edit_url +
            '" class="btn btn-success mr-2 p-2">' +
            '<iconify-icon icon="tabler:edit" width="20"></iconify-icon>' +
            "</a>" +
            '<a href="' +
            delete_url +
            '" class="btn btn-danger p-2">' +
            '<iconify-icon icon="mdi:trash-outline" width="20"></iconify-icon>' +
            "</a>",
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
  var statusUnduhHtml = "";
  if (rowData.status_unduh == "0" || rowData.status_unduh == null) {
    statusUnduhHtml =
      '<div class="d-flex justify-content-center" title="Belum di unduh oleh ' +
      rowData.nama_A3 +
      '">' +
      '<a id="" class=" btn btn-danger p-2">' +
      '<iconify-icon icon="maki:cross" width="20"></iconify-icon>' +
      "</a>" +
      "<p hidden>" +
      rowData.status_unduh +
      "</p>" +
      "</div>";
  } else if (rowData.status_unduh == "1") {
    statusUnduhHtml =
      '<div class="d-flex justify-content-center" title="Sudah di unduh oleh ' +
      rowData.nama_A3 +
      '">' +
      '<a id="" class="btn btn-success p-2">' +
      '<iconify-icon icon="mingcute:check-fill" width="20"></iconify-icon>' +
      "</a>" +
      "<p hidden>" +
      rowData.status_unduh +
      "</p>" +
      "</div>";
  } else {
    statusUnduhHtml = '<div class="d-flex justify-content-center" title="terjadi kesalahan">' + '<a id="" class=" btn btn-danger p-2">' + '<iconify-icon icon="maki:cross" width="20"></iconify-icon>' + "</a>" + "</div>";
  }

  return statusUnduhHtml;
}

function getUnduhBuktiHtml(base_url, rowData) {
  return '<div class="d-flex justify-content-center">' + '<a id="unduh-bukti-potong" href="' + base_url + '" class="btn btn-info p-2" target="_blank">' + '<iconify-icon icon="ph:eye" width="20"></iconify-icon>' + "</a>" + "</div>";
}

function getStatusBuktiHtml(rowData) {
  var statusBuktiHtml = "";
  if (rowData.status_bukti_bayar == "0" || rowData.status_bukti_bayar == null) {
    statusBuktiHtml =
      '<div class="d-flex justify-content-center">' + '<a id="" class=" btn btn-danger p-2" download>' + '<iconify-icon icon="maki:cross" width="20"></iconify-icon>' + "</a>" + "<p hidden>" + rowData.status_bukti_bayar + "</p>" + "</div>";
  } else if (rowData.status_bukti_bayar == "1") {
    statusBuktiHtml =
      '<div class="d-flex justify-content-center">' +
      '<a id="" class="btn btn-success p-2" download>' +
      '<iconify-icon icon="mingcute:check-fill" width="20"></iconify-icon>' +
      "</a>" +
      "<p hidden>" +
      rowData.status_bukti_bayar +
      "</p>" +
      "</div>";
  } else {
    statusBuktiHtml = '<div class="d-flex justify-content-center" title="terjadi kesalahan">' + '<a id="" class=" btn btn-danger p-2" download>' + '<iconify-icon icon="maki:cross" width="20"></iconify-icon>' + "</a>" + "</div>";
  }

  return statusBuktiHtml;
}

function getFileBuktiHtml(base_url, rowData) {
  var fileBuktiHtml = "";
  if (rowData.file_bukti_bayar) {
    var folderPath = "FileUpload/BuktiPembayaranPajak/";
    var fileName = rowData.file_bukti_bayar;
    var fileInfo = pathinfo(folderPath + fileName);
    var fileExtension = fileInfo.extension || "";
    var subfolder = fileExtension === "pdf" ? "pdf/" : "img/";
    var filePath = folderPath + subfolder + fileName;

    fileBuktiHtml =
      '<div class="d-flex justify-content-center">' +
      '<a id="downloadButton" href="' +
      base_url +
      filePath +
      '" class="btn btn-info p-2" download>' +
      '<iconify-icon icon="material-symbols:download" width="20"></iconify-icon>' +
      "</a>" +
      "</div>";
  }

  return fileBuktiHtml;
}

// PROGRESS BAR DI HALAMAN EDIT BUKTI POTONG
$(document).ready(function () {
   // Inisialisasi progress bar dengan 20%
   $(".progress-bar").css("width", "20%").attr("aria-valuenow", 20);
   $(".progress-text").text("20%");

   $(".nav-link").on("shown.bs.tab", function (e) {
      // Menghitung indeks tab aktif
      var activeTabIndex = $(e.target).parent().index(); // Menggunakan parent() untuk mendapatkan indeks dari elemen li
      // console.log("activeTabIndex: " + activeTabIndex);
      // Menghitung persentase berdasarkan bobot 25% untuk setiap tab
      var progressPercentage = (activeTabIndex + 1) * 20; // Karena indeks dimulai dari 0

      // Update bar progress dengan persentase yang tepat
      $(".progress-bar")
         .css("width", progressPercentage + "%")
         .attr("aria-valuenow", progressPercentage);

      // Update teks persentase di dalam bar progress
      $(".progress-text").text(progressPercentage + "%");
   });
});


// button edit bukti potong
var updateButton = document.getElementById('updateData');

// Tambahkan event listener untuk menghandle klik tombol
updateButton.addEventListener('click', function () {
   // Ambil nilai dari input atau elemen formulir lainnya
   var noPendaftaran = $('#no_pendaftaran').val();
   var sptPembetulan = $('#spt_pembetulan').val();
   var pembatalanH03 = $('#pembatalan_H03').prop('checked') ? '1' : '0';
   var month1 = $('#month1').val();
   var month2 = $('#month2').val();
   var year = $('#year').val();
   var mperlan = `${year}-${month1}-${month2}`;



   // part 2
   var kdPajak = $('input[name="kd_pajak"]:checked').val();

   //part 3
   var npwpValue = document.getElementById('npwp').value;
   var nipValue = document.getElementById('nip').value;
   var namaValue = document.getElementById('nama').value;
   var pangkatValue = document.getElementById('pangkat').value;
   var jabatanValue = document.getElementById('jabatan').value;
   var jenisKelaminValue = document.querySelector('input[name="jenis_kelamin"]:checked').value;
   var nikValue = document.getElementById('nik').value;

   // Ambil nilai dari input status tanggungan
   var statusKValue = document.getElementById('status_k').value;
   var statusTKValue = document.getElementById('status_tk').value;
   var statusHBValue = document.getElementById('status_hb').value;

   var status_A8 =`${statusKValue}-${statusTKValue}-${statusHBValue}`;

   //part 4
   var gajiPokok = document.getElementById('gaji_pokok').value;
   var tjIstri = document.getElementById('tj_istri').value;
   var tjAnak = document.getElementById('tj_anak').value;
   var jmlGaji = document.getElementById('jml_gaji').value;
   var tjPerbaikan = document.getElementById('tj_perbaikan').value;
   var tjStruktural = document.getElementById('tj_struktural').value;
   var tjBeras = document.getElementById('tj_beras').value;
   var jmlBruto1 = document.getElementById('jml_bruto_1').value;
   var tjLain = document.getElementById('tj_lain').value;
   var phTetap = document.getElementById('ph_tetap').value;
   var jmlBruto2 = document.getElementById('jml_bruto_2').value;
   var biayaJabatan = document.getElementById('biaya_jabatan').value;
   var iuranPensiun = document.getElementById('iuran_pensiun').value;
   var jmlPengurangan = document.getElementById('jml_pengurangan').value;
   var jmlPh = document.getElementById('jml_ph').value;
   var phNeto = document.getElementById('ph_neto').value;
   var jmlPhNeto = document.getElementById('jml_ph_neto').value;
   var ptkp = document.getElementById('ptkp').value;
   var phKenaPajak = document.getElementById('ph_kena_pajak').value;
   var pphPasal21 = document.getElementById('pph_pasal_21').value;
   var pphTelahDipotong = document.getElementById('pph_telah_dipotong').value;
   var pphTerutang = document.getElementById('pph_terutang').value;
   var atasGaji23A = document.getElementById('atas_gaji_23A').value;
   var atasPh23B = document.getElementById('atas_ph_23B').value;

   // part 5
   // Ambil nilai dari radio button "Status Pegawai"
   var statusPegawai = $('input[name=status_pegawai]:checked').val();


   // Ambil ID dari link url
   // Mendapatkan URL saat ini
   var currentURL = window.location.href;

   // Membagi URL berdasarkan karakter "/"
   var urlParts = currentURL.split('/');

   // Mendapatkan angka yang berada di bagian terakhir setelah karakter "/"
   var dataId = urlParts[urlParts.length - 1];

   console.log(dataId);
   // Kirim data ke controller menggunakan Ajax
   $.ajax({
      url: '/edit-bukti-potong/update/' + dataId, // Ganti 'url_controller/update/' dengan URL yang sesuai di controller
      method: 'POST',
      data: {
            no_H01: noPendaftaran,
            spt_H02: sptPembetulan,
            pembatalan_H03: pembatalanH03,
            'mperlan_H04-H05': mperlan,
            kd_pajak: kdPajak,
            npwp_A1: npwpValue,
            nip_A2: nipValue,
            nama_A3: namaValue,
            pangkat_A4: pangkatValue,
            nama_jabatan_A5: jabatanValue,
            jenis_kelamin_A6: jenisKelaminValue,
            nik_A7: nikValue,
            status_A8: status_A8,
            gaji_pokok: gajiPokok,
            tj_istri: tjIstri,
            tj_anak: tjAnak,
            jml_gaji: jmlGaji,
            tj_perbaikan: tjPerbaikan,
            tj_struktural: tjStruktural,
            tj_beras: tjBeras,
            jml_bruto_1: jmlBruto1,
            tj_lain: tjLain,
            ph_tetap: phTetap,
            jml_bruto_2: jmlBruto2,
            biaya_jabatan: biayaJabatan,
            iuran_pensiun: iuranPensiun,
            jml_pengurangan: jmlPengurangan,
            jml_ph: jmlPh,
            ph_neto: phNeto,
            jml_ph_neto: jmlPhNeto,
            ptkp: ptkp,
            ph_kena_pajak: phKenaPajak,
            pph_ph: pphPasal21,
            pph_potong: pphTelahDipotong,
            pph_utang: pphTerutang,
            atas_gaji_23A: atasGaji23A,
            atas_ph_23B: atasPh23B,
            status_pegawai: statusPegawai,
            // Kirim formulir lainnya sesuai kebutuhan
      },
      success: function (response) {
         $("#success-alert").html(
            '<div class="alert alert-success alert-dismissible show fade" role="alert"><div class="alert-body"><button class="close" data-dismiss="alert"></button><b>Berhasil ! </b>' + response.message + "</div></div>"
         );
         console.log(response);
         // setTimeout(function () {
         //    location.reload();
         // }, 3000);

         //lakukan redirect setelah 3 detik
         setTimeout(function () {
         window.location.href = "/bukti-potong";
         }, 3000);

      },

      error: function (xhr, status, error) {
         // Tampilkan pesan error jika terjadi kesalahan AJAX
         $("#error-alert").html(
         '<div class="alert alert-danger alert-dismissible show fade" role="alert"><div class="alert-body"><button class="close" data-dismiss="alert"></button><b>Gagal ! </b>' + "Data Gagal Diupdate, karena : " + " " + error.message + "</div></div>"
         );
         // Refresh halaman setelah beberapa detik (misalnya 3 detik)
         // setTimeout(function () {
         // location.reload();
         // }, 3000);
      },
   });
});

// delete data bukti potong
function deleteData(id, npwp) {
   // Konfirmasi pengguna sebelum menghapus
   var confirmation = confirm('Apakah Anda yakin ingin menghapus data ini?');

   if (confirmation) {
      // Lakukan pemanggilan Ajax di sini
      $.ajax({
            url: '/delete-bukti-potong/' + id,
            method: 'POST',
            data: {
               npwp: npwp
            },
            success: function (response) {
               $("#success-alert").html(
                           '<div class="alert alert-success alert-dismissible show fade" role="alert"><div class="alert-body"><button class="close" data-dismiss="alert"></button><b>Berhasil ! </b>' + response.message + "</div></div>"
               );
               console.log(response);
               setTimeout(function () {
                  location.reload();
               }, 3000);
            },
            error: function (xhr, status, error) {
               // Tampilkan pesan error jika terjadi kesalahan AJAX
               $("#error-alert").html(
               '<div class="alert alert-danger alert-dismissible show fade" role="alert"><div class="alert-body"><button class="close" data-dismiss="alert"></button><b>Gagal ! </b>' + "Data Gagal Diupdate, karena : " + " " + error.message + "</div></div>"
               );
               // Refresh halaman setelah beberapa detik (misalnya 3 detik)
               // setTimeout(function () {
               // location.reload();
               // }, 3000);
            },
      });
   }
}
