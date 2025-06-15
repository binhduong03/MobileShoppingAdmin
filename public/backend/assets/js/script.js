document.addEventListener("DOMContentLoaded", function() {
    // Lấy href của URL hiện tại
    const currentURL = window.location.href;

    // Lấy chỉ số của phần tử <li> mà URL hiện tại trỏ tới
    let selectedIndex = 0;
    document.querySelectorAll("ul li a").forEach(function(link, index) {
        if (link.href === currentURL) {
            selectedIndex = index;
        }
    });

    // Lấy tất cả các phần tử <span> có class "absolute"
    const spans = document.querySelectorAll("ul li span.absolute");

    // Ẩn tất cả các phần tử <span> có class "absolute"
    spans.forEach(function(span) {
        span.style.display = "none";
    });

    // Hiển thị phần tử <span> tương ứng với selectedIndex
    if (spans.length > selectedIndex) {
        spans[selectedIndex].style.display = "inline";
    }

    // Xử lý sự kiện khi click vào một phần tử <li>
    document.querySelectorAll("ul li").forEach(function(li, index) {
        li.addEventListener("click", function() {
            // Ẩn tất cả các phần tử <span> có class "absolute"
            spans.forEach(function(span) {
                span.style.display = "none";
            });

            // Hiển thị phần tử <span> của phần tử <li> đang được nhấp vào
            spans[index].style.display = "inline";
        });
    });
});
