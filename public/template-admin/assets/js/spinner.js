// Show the spinner when the page is loading
window.addEventListener("beforeunload", function () {
    document.getElementById("spinner").style.display = "block";
    document.getElementById("app").style.display = "none";


    // if (this.document.readyState === "complete") {
    //     document.getElementById("spinner").style.display = "none";
    //     document.getElementById("app").style.display = "block";
    // }
});

$(window).on(load, webAfterLoad())

function webAfterLoad() {

    console.log("jalan")

    let count = 3;

    const stopwatch = setInterval(() => {
        console.log(count);
        count--;

        if (count < 0) {
            clearInterval(stopwatch);
            console.log("Done!");

            document.getElementById("spinner").style.display = "none";
            document.getElementById("app").style.display = "block";
        }
    }, 1000); // 1000 milliseconds = 1 second
}
