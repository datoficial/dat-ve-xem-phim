@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Sửa vé</div>
        <div class="card-body">
            <form action="{{ route('nhanvien.ve.sua', ['id' => $ve->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="user_id">Tên khách hàng</label>
                    <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                        <option value="">-- Chọn loại --</option>
                        @foreach($user as $value)
                            <option value="{{ $value->id }}" {{ ($ve->user_id == $value->id) ? 'selected' : '' }}>{{ $value->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="phim_id">Phim</label>
                    <select class="form-select @error('phim_id') is-invalid @enderror" id="phim_id" name="phim_id" required>
                        <option value="">-- Chọn phim --</option>
                        @foreach($phim as $value)
                            <option value="{{ $value->id }}" {{ ($ve->phim_id == $value->id) ? 'selected' : '' }}>{{ $value->tenphim }}</option>
                        @endforeach
                    </select>
                    @error('phim_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="phongchieu_id">Phòng chiếu</label>
                    <select class="form-select @error('phongchieu_id') is-invalid @enderror" id="phongchieu_id" name="phongchieu_id" required>
                        <option value="">-- Chọn phòng chiếu --</option>
                        @foreach($phongchieu as $value)
                            <option value="{{ $value->id }}" {{ ($ve->phongchieu_id == $value->id) ? 'selected' : '' }}>{{ $value->tenphong }} của {{$value->RapChieu->tenrap}}</option>
                        @endforeach
                    </select>
                    @error('phongchieu_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="suatchieu_id">Suất chiếu</label>
                    <select class="form-select @error('suatchieu_id') is-invalid @enderror" id="suatchieu_id" name="suatchieu_id" required>
                        <option value="">-- Chọn suất chiếu --</option>
                        @foreach($suatchieu as $sc)
                            <option value="{{ $sc->id }}" data-ngaychieu="{{ $sc->ngaychieu }}" data-giobatdau="{{ $sc->giobatdau }}" data-phimid="{{ $sc->phim_id }}" data-phongchieuid="{{ $sc->phongchieu_id }}">{{ $sc->ngaychieu }} - {{ $sc->giobatdau }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="ngayban">Ngày đặt</label>
                    <input type="date" class="form-control @error('ngayban') is-invalid @enderror" id="ngayban" name="ngayban" value="{{ $ve->ngayban }}" required>
                    @error('ngayban')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="tenghe">Tên ghế</label>
                    <input type="text" class="form-control @error('tenghe') is-invalid @enderror" id="tenghe" name="tenghe" value="{{ $ve->tenghe }}" required>
                    @error('tenghe')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="soluong">Số lượng</label>
                    <input type="number" min=0 class="form-control @error('soluong') is-invalid @enderror" id="soluong" name="soluong" value="{{ $ve->soluong }}" required>
                    @error('soluong')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="form-label" for="qrcode">Mã vạch</label>
                    <input type="text" class="form-control @error('qrcode') is-invalid @enderror" id="qrcode" name="qrcode" value="{{ $ve->qrcode }}" readonly required>
                    @error('qrcode')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Sửa vào CSDL</button>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const phimDropdown = document.getElementById('phim_id');
            const phongchieuDropdown = document.getElementById('phongchieu_id');
            const suatchieuDropdown = document.getElementById('suatchieu_id');
            const ngaychieuInput = document.getElementById('ngaychieu');
            const giobatdauInput = document.getElementById('giobatdau');

            function filterSuatchieu() {
                const selectedPhimId = phimDropdown.value;
                const selectedPhongchieuId = phongchieuDropdown.value;

                Array.from(suatchieuDropdown.options).forEach(function(option) {
                    const phimId = option.getAttribute('data-phimid');
                    const phongchieuId = option.getAttribute('data-phongchieuid');

                    if ((phimId === selectedPhimId || selectedPhimId === '') && 
                        (phongchieuId === selectedPhongchieuId || selectedPhongchieuId === '')) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });
            }

            phimDropdown.addEventListener('change', filterSuatchieu);
            phongchieuDropdown.addEventListener('change', filterSuatchieu);

            suatchieuDropdown.addEventListener('change', function() {
                const selectedSuatchieuIndex = this.selectedIndex;
                const selectedSuatchieu = this.options[selectedSuatchieuIndex];
                const ngaychieu = selectedSuatchieu.getAttribute('data-ngaychieu');
                const giobatdau = selectedSuatchieu.getAttribute('data-giobatdau');

                ngaychieuInput.value = ngaychieu;
                giobatdauInput.value = giobatdau;
            });

            // Initialize the suatchieu dropdown based on initial selections
            filterSuatchieu();
        });
    </script>
@endsection
