import "./bootstrap";
import "../../vendor/masmerise/livewire-toaster/resources/js";

function receiptPrint(url) {
    const print = window.open(url, "_blank", "height=600,width=400");
    if (print) {
        print.print();
        setTimeout(() => {
            print.close();
        }, 3000);
    }
}

window.receiptPrint = receiptPrint;
