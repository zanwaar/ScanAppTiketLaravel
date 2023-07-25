<x-layout>
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="info-box2">
                    <span class="info-box-icon2 bg-primary"><i class="fa fa-user-plus"></i></span>
                    <div class="info-box-content2">
                        <span class="info-box-number2">{{$data2}}</span>
                        <span class="info-box-text2">TIKET EARLY BIRD</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="info-box1">
                    <span class="info-box-icon1 bg-secondary"><i class="fa fa-user-plus"></i></span>
                    <div class="info-box-content1">
                        <span class="info-box-number1">{{$data1}}</span>
                        <span class="info-box-text1">TIKET FISIK</span>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="info-box1">
                    <span class="info-box-icon1" style="background-color: #E5BA73 ;"><i class="fa fa-user-plus"></i></span>
                    <div class="info-box-content1" style="background-color: #C58940;">
                        <span class="info-box-number1">{{$data3}}</span>
                        <span class="info-box-text1">TIKET OTS</span>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="info-box3">
                    <span class="info-box-icon3 bg-hijau"><span>{{ $data1 + $data2 + $data3}}</span></span>
                    <div class="info-box-content3">
                        <span class="h3 mt-3">Total Tiket Masuk</span>
                        @auth

                        <span class="info-box-text3" id="waktu"> <a href="{{ route('download') }}" class="btn btn-light mb-3">Download Data</a></span>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>