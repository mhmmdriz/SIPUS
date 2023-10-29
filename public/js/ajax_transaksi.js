function showTabelTransaksi(index){
    const pageLinks = document.querySelectorAll(".page-link");

    // console.log(index);
    $.ajax({
        type: 'GET',
        url: '/ajaxTabelTransaksi',
        data: {'index':index},
        success: function(response) {
            $('#viewTransactionTable').html(response.html);
            // console.log(response.html);
        },
        // error: function(response) {
        //     console.log('Error:', response);
        // }
    });

    pageLinks.forEach(btn => {
        btn.parentElement.classList.remove("active");
    });
    pageLinks[index-1].parentElement.classList.add("active");
}

showTabelTransaksi(1);