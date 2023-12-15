//========== Data Table ==========
$(document).ready(function() {
    $('#myTable').DataTable();
});

//========== Nama File dimunculkan ketika file sudah diunggah ==========
function displayFileName(input) {
  const fileNameElement = document.getElementById('fileName');
  if (input.files.length > 0) {
      fileNameElement.innerText = input.files[0].name;
  } else {
      fileNameElement.innerText = 'Unggah';
  }
}