const body = document.querySelector("body");
const sidebar = body.querySelector(".sidebar");
const navbar = body.querySelector(".navbar");
const toggle = body.querySelector(".toggle");
const modeSwitch = body.querySelector(".toggle-switch");
const modeText = body.querySelector(".mode-text");

function sidebarCookie(data){
  $.ajaxSetup({
    headers: {
      // harus dibuat di html elemen meta ini di head (di file main.blade.php)
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    type: 'POST',
    url: '/sidebar',
    data: data,
    success: function(response) {
      // $('#result').text(response.message);
      console.log(response.message);
    },
    error: function(response) {
      console.log('Error:', response);
    }
  });
}

function themeCookie(data){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    type: 'POST',
    url: '/theme',
    data: data,
    success: function(response) {
      // $('#result').text(response.message);
      console.log(response.message);
    },
    error: function(response) {
      console.log('Error:', response);
    }
  });
}


toggle.addEventListener("click", () =>{
  // var sidebarClosed = document.querySelector(".sidebar.close");
  var sidebarClosed = document.getElementById("sidebar");
  let dataSidebar = '';

  if(sidebarClosed.classList.contains('close')){
    dataSidebar = {
      sidebar: '',
    };
  }else{
    dataSidebar = {
      sidebar: 'close',
    };
  }
  sidebarCookie(dataSidebar);
  sidebar.classList.toggle("close");
  navbar.classList.toggle("open");
})

modeSwitch.addEventListener("click", () =>{
  body.classList.toggle("dark");
  let dataTheme = '';
  
  if(body.classList.contains("dark")){
    dataTheme = {
      theme: 'dark',
    };
    modeText.innerHTML = "Light Mode";
    body.setAttribute("data-bs-theme", "dark")
  }else{
    dataTheme = {
      theme: 'light',
    };
    modeText.innerHTML = "Dark Mode";
    body.setAttribute("data-bs-theme", "light")
  }
  themeCookie(dataTheme);

})



document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const searchResult = document.getElementById("searchResult");

    // Fungsi untuk mengirim permintaan pencarian dengan Ajax
    function searchTransactions() {
        const idtransaksi = searchInput.value;

        if (idtransaksi) {
            // Sembunyikan semua baris tabel
            const rows = document.getElementsByClassName("peminjaman-row");
            for (let i = 0; i < rows.length; i++) {
                rows[i].style.display = "none";
            }

            // Tampilkan baris yang sesuai dengan hasil pencarian
            const matchingRows = document.querySelectorAll(".peminjaman-row[data-idtransaksi='" + idtransaksi + "']");
            for (let i = 0; i < matchingRows.length; i++) {
                matchingRows[i].style.display = "table-row";
            }
        } else {
            // Tampilkan semua baris tabel jika input pencarian kosong
            const rows = document.getElementsByClassName("peminjaman-row");
            for (let i = 0; i < rows.length; i++) {
                rows[i].style.display = "table-row";
            }
        }
    }

    // Merekam perubahan pada input pencarian
    searchInput.addEventListener("input", searchTransactions);
});

