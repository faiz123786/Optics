window.onload = () => {

    // ======================
    // For Slide Navbar
    // ======================
    var open = document.querySelector('.open');
    var close = document.querySelector('.close');
    var slidenav = document.querySelector('.fixed');
    var cover = document.querySelector('.cover');
    var body = document.body;

    open.addEventListener("click", toggleNav);
    close.addEventListener("click", toggleNav);
    cover.addEventListener("click", toggleNav);

    function toggleNav() {
        slidenav.classList.toggle("act");
        cover.classList.toggle("display");
        body.classList.toggle("noscroll");
    }

    // ======================
    // For Insert Box For Table 1
    // ======================

    // var insertBox = document.querySelector('.insert-con')
    // var insert = document.querySelector('.insert');
    // var cancel = document.querySelector('.cancel');

    // insert.addEventListener("click", toggleInsertBox);
    // cancel.addEventListener("click", toggleInsertBox);

    // function toggleInsertBox() {
    //     insertBox.classList.toggle("active");
    //     body.classList.toggle("noscroll");
    // }
    // ======================
    // For DeleteAll Box For Table 1
    // ======================


    var d_cancel = document.querySelector('.d-cancel');


    d_cancel.addEventListener("click", toggleDeleteBox);

    function toggleDeleteBox() {
        body.classList.toggle("noscroll");
        console.log("hello");

    }
}