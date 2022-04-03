document.addEventListener('DOMContentLoaded', function () {

    const footer = document.querySelector("FOOTER");
    let footerHeight = footer.offsetHeight;
    let main = document.querySelector("MAIN");
    main = (main.offsetHeight);
    let windowHeight = window.innerHeight;
    let heightDiff = windowHeight - footerHeight - 70;
    console.log(footer)
    console.log(main)
    console.log(heightDiff);
    
    if ( main < heightDiff)
    {
        footer.style.position = 'fixed';
        footer.style.bottom = 0;
        footer.style.width = "100%";
    }
});