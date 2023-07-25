<div>
    <div class="container">

        <div class="card shadow-sm">
            <div class="card-body">
                <form autocomplete="off" wire:submit.prevent="create">
                    <div class="mb-3">
                        <label for="" class="form-label">Jenis Tiket</label>

                        <select wire:model.defer="state.jenis" class="form-select @error('jenis') is-invalid @enderror" aria-label="Default select example">
                            <option selected>Opsi</option>
                            <option value="TIKET EARLY BIRD">TIKET EARLY BIRD</option>
                            <option value="TIKET FISIK">TIKET FISIK</option>
                            <option value="TIKET OTS">TIKET OTS</option>
                        </select>
                        @error('jenis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">ket</label>
                        <textarea wire:model.defer="state.ket" class="form-control @error('ket') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3"></textarea>
                        @error('ket')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                        <span>Save Changes</span>
                    </button>
                </form>
            </div>
        </div>
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
    $(document).ready(function() {
        window.addEventListener("alert-tes", function(event) {
            Swal.fire({
                icon: event.detail.icon,
                title: event.detail.title,
                text: event.detail.success,
            })
        });
    });
</script>
@endpush