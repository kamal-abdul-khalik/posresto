import "./bootstrap";
import "../../vendor/masmerise/livewire-toaster/resources/js";

function receiptPrint(url) {
    const print = window.open(url, "_blank", "height=600,width=400");
    print.addEventListener("load", function () {
        print.print();
        print.addEventListener("afterprint", function () {
            print.close();
        });
    });
    return false;
}

window.receiptPrint = receiptPrint;
