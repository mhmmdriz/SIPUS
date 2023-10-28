function showTransactionTable(keyword){
    const pageLinks = document.querySelectorAll(".page-link");

    console.log(keyword);
    $.ajax({
        type: 'GET',
        url: '/ajaxTabelTransaksi',
        data: {'keyword':keyword},
        success: function(response) {
            $('#viewTransactionTable').html(response.html);
            console.log(response.html);
        },
        error: function(response) {
            console.log('Error:', response);
        }
    });

    pageLinks.forEach(btn => {
        btn.parentElement.classList.remove("active");
    });
    pageLinks[keyword-1].parentElement.classList.add("active");
}

showTransactionTable(1);