<div>
    <div class="container">

        <form autocomplete="off" class="mb-3" wire:submit.prevent="fsearch">
            <div class="input-group">
                <input type="search" wire:model.defer="nsearch" id="barcode" required class="form-control" placeholder="Masukan Nomor Identitas" aria-describedby="button-addon2">
                <button class="btn btn-info text-white" type="submit" id="button-addon2"> <i class="fa fa-search"></i></button>
             
            </div>
        </form>
        <div id="qr-reader" wire:ignore style="width:100%"></div>
        <div id="qr-reader-results" wire:ignore></div>
        <div class="row mt-5">
            <div class="col-md-4 mb-2">
                <ul class="list-group list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">TIKET EARLY BIRD</div>

                        </div>
                        <span class="badge bg-primary rounded-pill"> {{$data1}}</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 mb-2">
                <ul class="list-group list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">TIKET FISIK</div>

                        </div>
                        <span class="badge bg-primary rounded-pill"> {{$data2}}</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 mb-2">
                <ul class="list-group list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">TIKET OTS</div>

                        </div>
                        <span class="badge bg-primary rounded-pill"> {{$data3}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
@push('js')
<script>
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete" ||
            document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function() {
        window.addEventListener("alert", function(event) {
            Swal.fire({
                icon: event.detail.icon,
                title: event.detail.title,
                text: event.detail.success,
            })
        });
        window.addEventListener("alert-danger", function(event) {
            Swal.fire({
                icon: 'error',
                title: 'Tiket invalid',
                text: 'error',
            })
        });
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                $('#barcode').val(decodedText);
                $.ajax({
                    url: `api/check/${decodedText}`,
                    type: "GET",
                    cache: false,
                    success: function(response) {
                        console.log(response);
                        Swal.fire({
                            icon: response.icon,
                            title: response.title,
                            text: response.success,
                        })

                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Tiket invalid',
                            text: decodedText,
                        })
                        console.log(response);
                    }
                });

            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: 250
            });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>
<script>
    $('form').submit(function() {
        @this.set('nsearch', $('#barcode').val());
    })
</script>
@endpush