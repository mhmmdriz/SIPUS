function showAnggota(index){
    const pageLinks = document.querySelectorAll(".page-link");

    // console.log(index);
    $.ajax({
        type: 'GET',
        url: '/ajaxAnggota',
        data: {'index':index},
        success: function(response) {
            $('#viewAnggota').html(response.html);
            // console.log(response.html);
        },
    });

    pageLinks.forEach(btn => {
        btn.parentElement.classList.remove("active");
    });
    pageLinks[index-1].parentElement.classList.add("active");

    $.getScript('/js/modal_del.js');
}

showAnggota(1);