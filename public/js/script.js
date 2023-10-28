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

let imgPreview = document.querySelector('.img-preview');

function previewImage(){
  // tangkap inputan imagenya yang berasal dari input dengan id="image"
  let image = document.querySelector('#file_gambar');
  // ambil tag img kosong tadi
  let imgPreview = document.querySelector('.img-preview');

  imgPreview.style.display = 'block';
  imgPreview.style.width = '200px';

  // ambil data gambar
  let oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function(oFREvent){
    imgPreview.src = oFREvent.target.result;
  }
}
