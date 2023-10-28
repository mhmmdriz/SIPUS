function showPengembalian(index){
    const pageLinks = document.querySelectorAll(".page-link");

    console.log(index);
    $.ajax({
        type: 'GET',
        url: '/ajaxPengembalian',
        data: {'index':index},
        success: function(response) {
            $('#viewPengembalian').html(response.html);
            console.log(response.html);
        },
        error: function(response) {
            console.log('Error:', response);
        }
    });

    pageLinks.forEach(btn => {
        btn.parentElement.classList.remove("active");
    });
    pageLinks[index-1].parentElement.classList.add("active");
}

showPengembalian(1);