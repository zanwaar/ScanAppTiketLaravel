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
        window.addEventListener("alert-danger", function(event) {
            Swal.fire({
                icon: 'error',
                title: 'Tiket invalid',
                text: event.detail.message,
            })
        });
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
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
        @this.set('titikkor', $('#titikkor').val());
    })
</script>
@endpush